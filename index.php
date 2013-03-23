<!DOCTYPE html>
<html>
<head>
</head>
<body>
  <?php 
    
    include('php/client.php');
    $tmp = new Client('andres', 'male', '12345', 'fundasolId');
    echo $tmp->clientId;
  
  ?>
</body>
</html>