<header class="navbar">
    <div class="container">
      <a href="home.php" class="logo">Home</a>
      <?php
        if(isset($_SESSION['username'])) {
          echo '<a href="edit-acc.php" class="logo">Edit Account</a>';
          echo '<a href="logout.php" class="login-button">Logout</a>';
        }else{
          echo '<a href="login.php" class="login-button">Login</a>';
        }      
      ?>
      
    </div>
  </header>