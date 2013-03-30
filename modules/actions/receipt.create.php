<?php
session_start();
$search_result = $_SESSION['search_result'];
$account_selected = $_SESSION['account_selected'];
$receipt_to_pay = $_POST['receipt_to_pay'];
//TODO not assume this is valid and sanitaded.
$conn = mysqli_connect("localhost", "root", "root", "fundasol");
$sql_pay_receipt = "UPDATE Receipts SET status = 'paid' WHERE id =" . $receipt_to_pay;
$sql_create_new_receipt = "INSERT INTO Receipts (account_id, amount, payment_n) SELECT Accounts.id,  Accounts.amount/Accounts.n_payments, Accounts.n_paid + 1 FROM Accounts WHERE Accounts.id =" . $account_selected;
$sql_update_account = "UPDATE Accounts SET n_paid = n_paid+1 WHERE Accounts.id =" . $account_selected;

try {
  mysqli_autocommit($conn, FALSE);
  mysqli_query($conn, $sql_pay_receipt);
  $_SESSION['receipt_create_msg'] = "<p class='text-success'>Data inserted!</p>";
  mysqli_query($conn, $sql_update_account);
  mysqli_query($conn, $sql_create_new_receipt);
  mysqli_commit($conn);
} catch(Exception $e) {
  mysqli_rollback($conn);
}
mysqli_close($conn);
header("Location: ../../index.php");
?>