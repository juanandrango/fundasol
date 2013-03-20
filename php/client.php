<?php
  
include('person.php');
include('viewInterface.php');

  class Client extends Person implements View {
    var $clientId;
    function displayRow() {
      return $this->$clientId;
    }
  }

?>