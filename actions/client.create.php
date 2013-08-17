<?php
session_start();

include_once("../index.php");
if ($controller->actionResult['create_client_A'] == TRUE) {
	echo "Client inserted successfully";
} else {
	echo "Something went wrong!";
}
//echo $controller->actionResult['create_client_A'];
return;
?>