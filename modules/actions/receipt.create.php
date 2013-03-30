<?php
session_start();
$search_result = $_SESSION['search_result'];
$amount = $_POST['amount'];
//TODO not assume this is valid and sanitaded.
$conn = mysqli_connect("localhost", "root", "root", "fundasol");

$sql = "INSERT INTO Receipts (account_id, amount, payment_n) SELECT Accounts.id, $amount, Accounts.n_paid + 1 FROM Accounts WHERE Accounts.client_id=" . $search_result;

$sql2 = "UPDATE Accounts SET n_paid = n_paid+1 WHERE Accounts.client_id =" . $search_result;

if ($amount !== NULL) {
  if ($search_result != NULL && mysqli_query($conn, $sql) === false) {
    $_SESSION['receipt_create_msg'] = "<p class='text-warning'>" . mysqli_error($conn) . "</p>";
  } else {
    mysqli_query($conn, $sql2);
    $_SESSION['receipt_create_msg'] = "<p class='text-success'>Data inserted!</p>";
  }
} else {
   $_SESSION['receipt_create_msg'] = "";
}
mysqli_close($conn);
header("Location: ../../index.php");
?>