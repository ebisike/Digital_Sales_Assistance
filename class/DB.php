<?php

class DB {

	public static $dbInstance;

	public $con;
	private $_query;
	public $results;
	
	public function __construct() {
		// SQL CONNECTION
		$this->con = mysqli_connect('localhost','root','','sunesis');
	}

	public static function DBInstance() {
		if (!isset(self::$dbInstance)) {
			self::$dbInstance = new DB();
		}
		return self::$dbInstance;
	}

	public function query($sql) {
		if($this->_query = mysqli_query($this->con, $sql)) {
			return $this;
		}
		else{
			return false;
		}
	}

	public function getResults() {
		$this->results = mysqli_fetch_assoc($this->_query);
		return $this->results;
	}

	public function ifExist(){
		$results = mysqli_num_rows($this->_query);
		return $results;
	}

	// public function getResultsArray() {
	// 	$array = [];
	// 	$count = 0;
	// 	while ($arr = mysqli_fetch_array($this->_query)) {
			
	// 	}
	// 	return $array; 
	// }

	public function getQuery() {
		return $this->_query;
	}

}