<?php
  
class Receipt {
  private $id;
  private $owner;
  private $amount;
  public $date;
  public Receipt($owner, $amount) {
    $this->owner = $owner;
    $this->amount = $amount;
    $this->date = 'should be generated here!';
    $this->id = 'should be provided here by the database';
  }
  
  public function getOwner() {
    return $this->owner;
  }
  
?>