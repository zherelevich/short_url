<?php
require_once('config.php');
//Подключаем класс ошибок
require_once (DIR_CONTROLLER.'/error.php');
Error::getInstance();
// подключаем класс БД
require_once (DIR_ROOT.'/system/mysql.php');
MySQL::getInstance();
//Роутинг
if (!empty($_GET)){
    if (isset($_GET['controller'])) {
        $controller=$_GET['controller'];
        //Смотрим к какому контроллеру было обращение
        if (is_file ($file=DIR_CONTROLLER.'/'.$controller.'.php')) {
            require_once ($file);
            if (isset($_GET['action']) and $_GET['action']!='') {
                if (method_exists ($$controller, $_GET['action'])) $$controller->$_GET['action'](); else Error::getError('404');
            } else $$controller->Index();
         } else Error::getError('404');

    } elseif (substr($_SERVER['REQUEST_URI'],1,2)==START_LINK) {
        //Редирект
        require_once (DIR_CONTROLLER.'/cutter.php');
        $cutter->redirect(substr($_SERVER['REQUEST_URI'],3));
    } else Error::getError('404');
} else {
    require_once (DIR_CONTROLLER.'/cutter.php');
    $cutter->Index();
}


?>