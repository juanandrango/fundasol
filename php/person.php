<?php

class Person {
  public $name;
  public $gender;
  public $stateID;
  public function __constructor($name, $gender, $stateID) {
    $this->name = $name;
    $this->gender = $gender;
    $this->stateID = $stateID;
  }
}

?>