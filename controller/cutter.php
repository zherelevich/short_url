<?
/* Контреллер для работы с cсылкой */

class ControllerCutter {
    /* Действие по умолчанию */
    public function Index() {
        $this->AddLink();
    }

    /*Добавление ссылки*/
    public function AddLink() {
        if (!empty($_POST)) {
            if (!$link=$this->checklink($_POST['name'])) {
                $output['error']='error';
                $output['err_name']='Ссылка имеет неверный формат';
            } else {
                require_once (DIR_MODEL.'/cutter.php');
                $model= new ModelCutter();
                if ($result=$model->getLink($link,'original')) {
                    $output['error']='repeat';
                    $output['err_name']='Ссылка уже была добавлена';
                    $output['err_link']=DOMIAN.'/'.START_LINK.$result['short'];
                }
                elseif($short=$this->createLink(5)) {
                  $data = array(
                       'original' => $_POST['name'],
                       'short'    => $short
                   );
                   if ($model->saveLink($data)) {
                       $output['success']='success';
                       $output['link']=DOMIAN.'/'.START_LINK.$short;
                   }
                } else {
                   $output['error']='error';
                   $output['err_name']='Неудалось получить ссылку';
                }
            }
            echo json_encode($output);
        } else {
            require_once (DIR_VIEW.'/header.php');
            require_once (DIR_VIEW.'/form.php');
            require_once (DIR_VIEW.'/footer.php');
        }
    }
    //перенаправление на страницу
    public function redirect ($link) {
        require_once (DIR_MODEL.'/cutter.php');
        $model= new ModelCutter();
        if ($result=$model->getLink($link,'short')) {
            header("Location: ".$result['original']."");
            exit;
        } else {

            Error::getError('404');
        }
    }
    public function getShortLink () {
        if (!empty($_GET['uri'])) {
            if ($this->checklink($_GET['uri'])) {
                require_once (DIR_MODEL.'/cutter.php');
                $model= new ModelCutter();
                if ($result=$model->getLink($_GET['uri'],'original')){
                    $output['source_url']=$_GET['uri'];
                    $output['short_url']=DOMIAN.'/'.START_LINK.$result['short'];
                    echo json_encode($output);
                }
            }

        }
    exit;
    }
    //убирает лишние символы
    private function pregtrim($str) {
        return preg_replace("/[^\x20-\xFF]/","",@strval($str));
    }
    // Проверяем ссылку
    private function checkLink($link) {
        // режем левые символы и крайние пробелы
        $link=trim($this->pregtrim($link));
        // если пусто - выход
        if (strlen($link)==0) return false;
        //проверяем УРЛ на правильность
        if (!preg_match("~^(?:(?:https?|ftp|telnet)://(?:[a-z0-9_-]{1,32}".
        "(?::[a-z0-9_-]{1,32})?@)?)?(?:(?:[a-z0-9-]{1,128}\.)+(?:com|net|".
        "org|mil|edu|arpa|gov|biz|info|aero|inc|name|[a-z]{2})|(?!0)(?:(?".
        "!0[^.]|255)[0-9]{1,3}\.){3}(?!0|255)[0-9]{1,3})(?:/[абвгдеёзийклмнопрстуфцчшэяАБВГДЕЁЗИЙКЛМНОПРСТУФЦЧШЭЯa-zA-Z0-9.,_@%&".
        "?+=\~/-]*)?(?:#[^ '\"&<>]*)?$~i",$link,$ok))
        return false; // если не правильно - выход
        // если нет протокола - добавить
        if (!strstr($link,"://")) $link="http://".$link;
        $link=preg_replace("~^[a-z]+~ie","strtolower('\\0')",$link);
        return $link;
    }
    //делаем короткую ссылку
    private function createLink ($count=5) {
        $str='abcdefghiklmnopqrstuvwxzABCDEFGHIKLMNOPQRSTUVWXZ0123456789';
        $link = '';
        require_once (DIR_MODEL.'/cutter.php');
        $model= new ModelCutter();
        do {
                $link = '';
                for ($i=0; $i<=$count; $i++) {
                    $link.=$str[rand(0,strlen($str))];
                }
            }
        while ($model->getLink($link,'short'));
        if ($link!='')
            return $link;
        else
            return false;
    }

}

$cutter = new ControllerCutter();

?>