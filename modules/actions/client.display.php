<?php
session_start();
//TODO make this variable global
$not_found_msg = "not_found";
$_SESSION['search_action'] = 'client';
$client_name = $_POST['search'];
$_SESSION['search'] = $client_name;
$_SESSION['receipt_create_msg'] = "";
//TODO not assume this is valid and sanitaded.
$conn = mysqli_connect("localhost", "root", "root", "fundasol");
$name_array = explode(", ", $client_name);
$first_name = $name_array[1];
$last_name = $name_array[0];
$sql_match_client_id = "SELECT * FROM Clients WHERE Clients.first_name='" . $first_name ."' AND Clients.last_name='" . $last_name . "'";
$select_result =  mysqli_fetch_assoc(mysqli_query($conn, $sql_match_client_id));
if ($select_result['id'] === NULL) {
  $_SESSION['search_result'] = $not_found_msg;
} else {
 $_SESSION['search_result'] = $select_result['id']; 
}
mysqli_close($conn);
header("Location: ../../index.php");
?>
