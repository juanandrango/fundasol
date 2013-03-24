<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <link href="css/bootstrap.css" rel="stylesheet">
  <link href="css/custom.css" rel="stylesheet">
</head>
<body>
  <?php
  $title = "GUI Fundasol Employee interface";
  ?>
  <div class="searchBarCtnr container">
    <div class="row">
      <div class="span8">
        <h1> <?php echo $title ?> </h1>
      </div>
    </div>
    <div class="row">
      <div class="span8">
        <form class="form-search" action="#" method="POST">
          <div class="input-append">
            <input type="text" class="span6 search-query" list="accountsAndClients" placeholder="Cliente o cuenta ...">
            <button type="submit" class="btn btn-custom" formaction="modules/actions/search.php"> Search </button>
            <button type="submit" class="btn" formaction="modules/actions/receipt.create.php"> Payment </button>
          </div>
          <datalist id="accountsAndClients"> 
            <?php
              $conn = mysqli_connect("localhost", "root", "root", "fundasol");
              if (mysqli_connect_errno()){
                echo "failed" . mysqli_connect_error();
              } else {
                $sql = "Select * from clients";
                $clients = mysqli_query($conn, $sql);
                while($row = mysqli_fetch_array($clients)) {
                  echo "<option value=\"" . $row['name'] . "\">";
                }
              }
              mysqli_close($conn);
            ?>
          </datalist>
        </form>
      </div>
    </div>
    <div class="row">
      <div class="span12">    
        <?php 
          if (isset($_SESSION['search_action'])){
            if ($_SESSION['search_action'] == 'search') {
              include("modules/views/client.phtml");
            } else if ($_SESSION['search_action'] == 'payment') {
              include("modules/views/receipt.create.phtml");
            }
          } 
        ?>
      </div>
    </div>
  </div>
  <script src="js/jquery-1.9.1.js"></script>
  <script src="js/bootstrap.js"></script>
</body>
</html>