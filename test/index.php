<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
  <!-- <link href="css/bootstrap.css" rel="stylesheet">
  <link href="css/custom.css" rel="stylesheet"> -->
</head>
<body>

<script src="../js/jquery-1.9.1.js"></script>

<h1 id='header' > Change me </h1>
<a href='#' onclick="$.ajax({ url: 'requestProcessor.php', type: 'post', data: {title : 'YEAHHHH'} });"> Click Here </a>


</body>
</html>