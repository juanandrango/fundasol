<?php
session_start();
if (isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['state_id'])) {
  $sql_insert_client = "INSERT INTO Clients (first_name, last_name, state_id) values ('" . $_POST['first_name'] . "', '" . $_POST['last_name'] . "'," . $_POST['state_id'] . ")";
  $sql_new_client_id = "SELECT id FROM Clients WHERE state_id =" . $_POST['state_id'];
  $conn = mysqli_connect("localhost", "root", "root", "fundasol");
  $result = mysqli_query($conn, $sql_insert_client);
}
if ($result) {
  $_SESSION['search_action'] = 'client';
  $new_client_id = mysqli_fetch_assoc(mysqli_query($conn, $sql_new_client_id));
  $_SESSION['search_result'] = $new_client_id['id'];
  
} else {
  $_SESSION['search_action'] = 'clients_new';
}
mysqli_close($conn); 
header("Location: ../../index.php");

?>