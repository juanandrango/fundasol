<?php

class Account {

	const id = "id";
	const start_week = "start_week";
	const amount = "amount";
	const n_payments = "n_payments";
	const client_id = "client_id";
	const n_paid = "n_paid";
	const status = "status";
	const time_stamp = "time_stamp";

	public static $tableAttrs = array(
		Account::id 			=> 	array("label" => "ID", 					"sqlInit" => 'INT NOT NULL AUTO_INCREMENT PRIMARY KEY', "type" => "INT"),
		Account::start_week 	=>	array("label" => "Primera Semana", 		"sqlInit" => 'INT NOT NULL', "type" => "INT"),
		Account::amount			=>	array("label" => "Cantidad", 			"sqlInit" => 'INT NOT NULL', "type" => "INT"),
		Account::n_payments		=>	array("label" => "Pagos", 				"sqlInit" => 'INT NOT NULL', "type" => "INT"),
		Account::client_id		=>	array("label" => "ID del Cliente",		"sqlInit" => 'INT NOT NULL', "type" => "INT"),
		Account::n_paid			=>	array("label" => "Pagos completados", 	"sqlInit" => 'INT NOT NULL', "type" => "INT"),
		Account::status 		=>	array("label" => "Estado", 				"sqlInit" => "ENUM('active','closed') DEFAULT 'active'", "type" => "STRING"),
		Account::time_stamp		=>	array("label" => "Creado", 				"sqlInit" => 'TIMESTAMP DEFAULT NOW()', "type" => "OTHER")
		);

	public static $createAccountRequiredAttrs = array(
		Account::start_week,
		Account::amount,
		Account::n_payments,
		Account::client_id,
		Account::n_paid
		);

	public $attrArray;

	public function __construct($accountInfo) {
		 foreach(Account::$createAccountRequiredAttrs as $attrKey) {
        if (!array_key_exists($attrKey, $accountInfo)) {
          echo "Initialization of account failed: not all required fields are present (";
          print_r($accountInfo);
          echo " --- " . $accountInfo . ")";
          return;
        }
      }
      //TODO Make sure no other attrs are written to our object!!!
      $this->attrArray = array();
      foreach($accountInfo as $key => $value) {
        $this->attrArray[$key] = $value;
      }
	}

	private function getCreateTableQuery() {
		$query = "CREATE TABLE Account (";
	    foreach($this->tableAttrs as $key=>$value) {
	        $query += $key . " " . $value["sqlInit"] . ", ";
	    }
	    $query += "FOREIGN KEY (" . Account::client_id . ") REFERENCES Clients(" . Account::id . "));";
	    return $query;
	}
}

?>