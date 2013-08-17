<?php
//TODO Validation!
session_start();

if (1) {
  return;
}

if (isset($_POST['amount']) && isset($_POST['n_payments']) && isset($_POST['start_week'])) {
$conn = mysqli_connect("localhost", "root", "qpalFJ10mysql", "fundasol");
  $client_id = $_SESSION['search_result'];
  $amount = $_POST['amount'];
  $n_payments = $_POST['n_payments'];
  $start_week = $_POST['start_week'];
  
  $sql_create_account = "INSERT INTO Accounts (amount, n_payments, n_paid, client_id, start_week) VALUES (" . $amount . ", " . $n_payments . ", 0, " . $client_id . ", WEEKOFYEAR('" . $start_week . "'))";
  if (mysqli_query($conn, $sql_create_account)) {
   $insert_id = mysqli_insert_id($conn); 
   $sql_create_first_receipt = "
    INSERT INTO Receipts (account_id, amount, payment_n)
    SELECT Accounts.id, Accounts.amount/Accounts.n_payments, Accounts.n_paid + 1 
    FROM Accounts
    WHERE Accounts.id =" . $insert_id;
    if(mysqli_query($conn, $sql_create_first_receipt)) {
      //commit, success
      mysqli_close($conn);
      header("Location: ../../index.php");
    } else {
      //unable to create first receipt, rollback
      return;
    }
  } else {
    //unable to create account, revise
    return;
  }
} else {
  //Print message return, something went wrong, try again!
  return;
}
  
?>