<?
/* Контреллер для обработки ошибок */

class Error {
    protected static $_instance;  //экземпляр объекта

    public static function getInstance() { // получить экземпляр данного класса
        if (self::$_instance === null) { // если экземпляр данного класса  не создан
            self::$_instance = new self;  // создаем экземпляр данного класса
        }
        return self::$_instance; // возвращаем экземпляр данного класса
    }

    private function __clone() { //запрещаем клонирование объекта модификатором private
    }

    private function __wakeup() {//запрещаем клонирование объекта модификатором private
    }


    public function getError ($err) {

        switch ($err){
            case '404':
                require_once(DIR_VIEW.'/error/404.php');
        }

    }

}


?>