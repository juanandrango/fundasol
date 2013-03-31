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
  $title = "Fundasol";
  if (isset($_SESSION['search'])) {
   $search = $_SESSION['search']; 
  }
  function populateDatalist() {
    $conn = mysqli_connect("localhost", "root", "root", "fundasol");
    if (mysqli_connect_errno()){
      echo mysqli_connect_error();
    } else {
        $sql_all_clients = "SELECT last_name, first_name FROM Clients";
      $clients = mysqli_query($conn, $sql_all_clients);
      while($row = mysqli_fetch_array($clients)) {
        echo "<option value=\"" . $row['last_name'] . ", " . $row['first_name'] . "\">";
      }
    }
    mysqli_close($conn);
  }
  function getActionView() {
    if (isset($_POST['menubar-selection'])) {
      $_SESSION['search_action'] = $_POST['menubar-selection'];
      unset($_POST['menubar-selection']);
      echo "is set";
    }
    if (isset($_SESSION['search_action'])){
      if ($_SESSION['search_action'] == 'client') {
        include("modules/views/client.display.phtml");
      } else if ($_SESSION['search_action'] == 'payment') {
        include("modules/views/receipt.display.phtml");
      } else if ($_SESSION['search_action'] == 'clients') {
        include("modules/views/clients.display.phtml");
      } else if ($_SESSION['search_action'] == 'clients_new') {
        include("modules/views/client.create.phtml");
      }
    }
  }
  ?>
  <div class="navbar navbar-static-top">
    <div class="navbar-inner">
      <a class="brand" href="#"><?php echo $title ?></a>
      <ul class="nav">
        <li class='dropdown'><a class='dropdown-toggle' data-toggle='dropdown' href="#">Clientes</a>
          <ul class='dropdown-menu'>
            <li><a href="index.php" onclick="$.post('index.php', {'menubar-selection' : 'clients'});">Mostrar</a></li>
            <li><a href="index.php" onclick="$.post('index.php', {'menubar-selection' : 'clients_new'});">Crear Nuevo</a></li>
          </ul>
        </li>
        <li><a href="index.php">Cuentas</a></li>
        <li><a href="index.php">Reportes</a></li>
      </ul>
      <!-- Search Bar Section -->
      <form class="navbar-search form-search pull-right" action="#" method="POST">
        <!-- search bar box with buttons -->
        <div class="input-append">
          <input type="text" class="search-query" list="accountsAndClients" placeholder="Apellido, Nombre" name="search" value="<?php echo $search ?>" >
          <button type="submit" class="btn btn-custom" formaction="modules/actions/client.display.php"> 
            <i class="icon-search"> </i> 
          </button>
          <button type="submit" class="btn" formaction="modules/actions/receipt.display.php"> 
            <i class="icon-barcode"></i> 
          </button>
        </div>
        <!-- Data list that populates on the search bar -->
        <datalist id="accountsAndClients"> 
          <?php
            populateDatalist();
          ?>
        </datalist>
      </form>
    </div>
  </div>
  <div class="container">        
    <!-- Client Info or Receipts Section -->
    <div class="row">
      <div class="span12">    
        <?php 
          getActionView();
        ?>
      </div>
    </div>
  </div>
  
  <!-- Linking JS files -->
  <script src="js/jquery-1.9.1.js"></script>
  <script src="js/bootstrap.js"></script>
  <script>
  $('#create_account_btn').click(function() {
    if ($('#create_account').is(':hidden')) {
      $('#create_account').slideDown();
      $('#create_account_btn').hide();
    } else {
      $('#create_account').hide();
    }
  });
  $('#account_cancel_btn').click(function() {
    if ($('#create_account').is(':hidden')) {
      $('#create_account').slideDown();
    } else {
      $('#create_account').hide();
      $('#create_account_btn').show();
    }
  });
  
  
  </script>
  
</body>
</html>