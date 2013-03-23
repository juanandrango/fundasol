<?php
session_start();
$client_name = $_POST['client_name'];
$amount = $_POST['amount'];
//TODO not assume this is valid and sanitaded.
$conn = mysqli_connect("localhost", "root", "root", "fundasol");
$sql = "Insert into receipts (amount) values (" . $amount . ");";
if (mysqli_query($conn, $sql) === false) {
  $_SESSION['receipt_create_msg'] = mysqli_error($conn);
} else {
  $_SESSION['receipt_create_msg'] = "Data inserted!";
}
mysqli_close($conn);
header("Location: http://localhost:8888/fundasol/modules/views/receipt.view.create.phtml");
?>