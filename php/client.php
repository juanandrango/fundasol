<?php
  
include('person.php');
include('viewInterface.php');

  class Client extends Person implements View {
    public $clientId;
    
    public function Client($name, $gender, $stateId, $clientId) {
      $this->name = $name;
      $this->gender = $gender;
      $this->stateID = $stateId;
      $this->clientId = $clientId;
    }
    
    public function displayRow() {
      echo $this->clientId;
    }

  }

?>