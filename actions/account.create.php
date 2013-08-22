<?php
session_start();

include_once("../index.php");

if ($controller->actionResult['create_account_A'] == TRUE) {
	echo "Account created successfully";
} else {
	echo "Something went wrong!";
}

return;
?>