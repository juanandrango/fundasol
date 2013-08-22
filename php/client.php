<?php

  class Client {

    const id = "id";
    const first_name = "first_name";
    const last_name = "last_name";
    const state_id = "state_id";
    const status = "status";
    const phone_home = "phone_home";
    const phone_work = "phone_work";
    const phone_reference = "phone_reference";
    const phone_cell = "phone_cell";
    const address_home = "address_home";
    const address_work = "address_work";
    const time_stamp = "time_stamp";


    public static $tableAttrs = array(
      Client::id              => array("label" => "ID",                   "sqlInit" => "INT NOT NULL AUTO_INCREMENT PRIMARY KEY"), 
      Client::first_name      => array("label" => "Primer Nombre",        "sqlInit" => "VARCHAR(50) NOT NULL"), 
      Client::last_name       => array("label" => "Apellido",             "sqlInit" => "VARCHAR(50) NOT NULL"), 
      Client::state_id        => array("label" => "Cedula de Identidad",  "sqlInit" => "INT NOT NULL UNIQUE"), 
      Client::status          => array("label" => "Status",               "sqlInit" => "ENUM('active', 'inactive', 'pending') NOT NULL DEFAULT 'pending'"), 
      Client::phone_home      => array("label" => "Home Phone",           "sqlInit" => "VARCHAR(10)"), 
      Client::phone_work      => array("label" => "Work Phone",           "sqlInit" => "VARCHAR(10)"), 
      Client::phone_reference => array("label" => "Phone Reference",      "sqlInit" => "VARCHAR(10)"), 
      Client::phone_cell      => array("label" => "CellPhone",            "sqlInit" => "VARCHAR(10)"), 
      Client::address_home    => array("label" => "Home Address",         "sqlInit" => "VARCHAR(200)"), 
      Client::address_work    => array("label" => "Work Address",         "sqlInit" => "VARCHAR(200)"), 
      Client::time_stamp      => array("label" => "Time Stamp",           "sqlInit" => "TIMESTAMP DEFAULT NOW()")
      );

    public static $createUserRequiredAttrs = array(
      Client::first_name, 
      Client::last_name, 
      Client::state_id
      );
    
    public $attrArray;

    public function __construct($clientFromDB) {
      
      foreach(Client::$createUserRequiredAttrs as $attrKey) {
        if (!array_key_exists($attrKey, $clientFromDB)) {
          echo "Initialization of client failed: not all required fields are present";
          return;
        }
      }

      $this->attrArray = array();
      foreach($clientFromDB as $key => $value) {
        $this->attrArray[$key] = $value;
      }
    }

    private function getCreateTableQuery() {
      $query = "CREATE TABLE Clients (";
      foreach($this->tableAttrs as $key=>$value) {
        $query += $key . " " . $value["sqlInit"] . ", ";
      }
      $query += "INDEX(last_name(50)));";
      return $query;
    }

  }

?>