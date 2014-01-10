<?php
class MySQL {
	private $link;
    protected static $_instance;  //экземпляр объекта

    public static function getInstance() { // получить экземпляр данного класса
        if (self::$_instance === null) { // если экземпляр данного класса  не создан
            self::$_instance = new self;  // создаем экземпляр данного класса
        }
        return self::$_instance; // возвращаем экземпляр данного класса
    }
    private function __construct() {
		if (!$this->link = mysql_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD)) {
      		trigger_error('Не могу соединится с базой' . DB_USERNAME . '@' . DB_HOSTNAME);
    	}

    	if (!mysql_select_db(DB_DATABASE, $this->link)) {
      		trigger_error('Не могу найти базу ' . DB_DATABASE);
    	}
		
		mysql_query("SET NAMES 'utf8'", $this->link);
		mysql_query("SET CHARACTER SET utf8", $this->link);
		mysql_query("SET CHARACTER_SET_CONNECTION=utf8", $this->link);
	}
    private function __clone() { //запрещаем клонирование объекта модификатором private
    }

    private function __wakeup() {//запрещаем клонирование объекта модификатором private
    }



    public function query($sql) {
        $obj=self::$_instance;
		$resource = mysql_query($sql, $obj->link);

		if ($resource) {
			if (is_resource($resource)) {
				$i = 0;
    	
				$data = array();
		
				while ($result = mysql_fetch_assoc($resource)) {
					$data[$i] = $result;
    	
					$i++;
				}
				
				mysql_free_result($resource);
				
				$query = new stdClass();
				$query->row = isset($data[0]) ? $data[0] : array();
				$query->rows = $data;
				$query->num_rows = $i;
				
				unset($data);

				return $query;	
    		} else {
				return true;
			}
		} else {
			trigger_error('Ошибка: ' . mysql_error($this->link) . '<br />Error No: ' . mysql_errno($this->link) . '<br />' . $sql);
			exit();
    	}
  	}
	
	public function escape($value) {
        $obj=self::$_instance;
       return mysql_real_escape_string($value, $obj->link);
	}
	
  	public function countAffected() {
    	return mysql_affected_rows($this->link);
  	}

  	public function getLastId() {
    	return mysql_insert_id($this->link);
  	}	
	
	public function __destruct() {
		mysql_close($this->link);
	}
}
?>