<?php
  
session_start();
$_SESSION['search_action'] = 'search';
  header("Location: ../../index.php");
?>
