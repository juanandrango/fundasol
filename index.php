<?php
	session_start();

  require_once("controller/Controller.php");
  require_once("model/Model.php");
  require_once("view/View.php");
  require_once("php/client.php");
  require_once("php/account.php");


  ini_set('display_errors','On');
  error_reporting(E_ALL);
  
  Controller::processAction();
  Controller::processView();

  return;

?>
