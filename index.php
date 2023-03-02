<?php
session_start();


$username = !empty($_SESSION['username']) ? $_SESSION['username'] : "Login";
$userId = !empty($_SESSION['user_id']) ? $_SESSION['user_id'] : 0;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BOOKS</title>
    <link rel="stylesheet" href="style.css">
</head>

<!-- PAGE -->
<!-- ------------------------------------------------- -->
<div class="page">

  <!-- HEADER -->
  <!-- ------------------------------------------------- -->
  <header class="header">

    <div class="header__links">
      <a href="https://www.novinky.cz/" class="header__link" target = "blank">Novinky</a>
      <a href="https://www.knihovny.cz/" class="header__link" target = "blank">Knihovna</a>
    </div>
    
    
    <a href="login.php" class="header__search" type="text"><?php echo $username ?></a>
    <?php
      if($userId != 0) {
        echo <<<HTML
        <a href="logout.php" type="text" >Logout</a>
HTML;
      }
    ?>
    
  </header>

  <!-- SIDEBAR -->
  <!-- ------------------------------------------------- -->
  <div class="sidebar">
    <h2 id="numBooks" class="sidebar__title"></h2>

    <div class="sidebar__category">
      <div class="sidebar__heading">Zanry<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-up">
          <polyline points="18 15 12 9 6 15"></polyline>
        </svg></div>
      <div id="genres" class="sidebar__options">
        
        
      </div>
    </div>

    <div class="sidebar__category">
      <div class="sidebar__options">
       
      </div>
    </div>
  </div>

  <!-- MAIN -->
  <!-- ------------------------------------------------- -->
  <div class="main">

    <!-- PLANTS -->
    <!-- ------------------------------------------------- -->
    <h2 class="main__title"></h2>

    <!-- ITEMS -->
    <!-- ------------------------------------------------- -->
    <div id="books" class="items">
      
      
    </div>                                                                                                

    <!-- PAGINATION -->
    <!-- ------------------------------------------------- -->


  </div>

  <!-- FOOTER -->
  <!-- ------------------------------------------------- -->
  <footer class="footer">
   
  </footer>
  <script src="js/jquery-3.6.3.min.js"></script>
  <script src="js/main.js"></script>
</div>
</body>
</html>