<?php

interface DBInterface {
	function writeToDB($conn);
	function loadFromDB($conn);
}

?>