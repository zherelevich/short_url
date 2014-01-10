<?
/* Модель*/
class ModelCutter {
    /* Получение ссылки */
    public function getLink($link,$param) {
      $query= MySQL::query ("SELECT * FROM `link` WHERE `".$param."`='".$link."'");
      if ($query->num_rows) {
        $data=reset($query->rows);
          if (!empty($data)) {
              return $data;
          }
      } else return false;
    }
/* Сохранение ссылки */
    public function saveLink($data) {
        if (MySQL::query ("INSERT INTO `link` SET `original`='".$data['original']."', `short`='".$data['short']."' "))
            return true;
        else
            return false;
    }
    
}






?>