<?php 
session_start();
include "connection.php" ;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PHP Site</title>
  <link rel="stylesheet" href="styles.css">
  <style>
      body{
        background: url('images/home-bg.jpg') no-repeat center center fixed;
        background-size: cover;
      }
    </style>
</head>
<body>
  <header class="navbar">
    <div class="container">
      <a href="#" class="logo">Home</a>
      <?php
        if(isset($_SESSION['username'])) {
          echo '<a href="#" class="logo">Edit Account</a>';
          echo '<a href="logout.php" class="login-button">Logout</a>';
        }else{
          echo '<a href="login.php" class="login-button">Login</a>';
        }      
      ?>
      
    </div>
  </header>
  <main class="main-content">
    <div class="content">
      <p>
          Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus elementum vehicula est vitae sollicitudin. 
          Ut pulvinar ultricies posuere. Integer ac iaculis dui, vel rhoncus erat. In tortor nisl, vulputate quis ante vel, 
          vestibulum luctus nunc. Phasellus id lectus ante. Vivamus ultricies, nunc ut sollicitudin hendrerit, leo tellus 
          lacinia nulla, at porta orci orci eget eros. Nullam id ullamcorper mauris, sit amet cursus risus. Nullam a commodo 
          metus, et facilisis velit. Maecenas volutpat mattis odio vel dignissim. Etiam ac fringilla diam, suscipit sodales 
          ipsum. Nam in velit quam. Nunc luctus tempor leo, vel rhoncus mi mattis nec. Lorem ipsum dolor sit amet, consectetur 
          adipiscing elit. Nullam felis massa, ultrices sit amet turpis vel, accumsan blandit est. Etiam nec eros commodo, 
          cursus turpis pulvinar, volutpat odio.
        </p>
        <?php 
          if(isset($_SESSION['username'])){
            echo '<p>';
              echo 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus elementum vehicula est vitae sollicitudin. 
          Ut pulvinar ultricies posuere. Integer ac iaculis dui, vel rhoncus erat. In tortor nisl, vulputate quis ante vel, 
          vestibulum luctus nunc. Phasellus id lectus ante. Vivamus ultricies, nunc ut sollicitudin hendrerit, leo tellus 
          lacinia nulla, at porta orci orci eget eros. Nullam id ullamcorper mauris, sit amet cursus risus. Nullam a commodo 
          metus, et facilisis velit. Maecenas volutpat mattis odio vel dignissim. Etiam ac fringilla diam, suscipit sodales 
          ipsum. Nam in velit quam. Nunc luctus tempor leo, vel rhoncus mi mattis nec. Lorem ipsum dolor sit amet, consectetur 
          adipiscing elit. Nullam felis massa, ultrices sit amet turpis vel, accumsan blandit est. Etiam nec eros commodo, 
          cursus turpis pulvinar, volutpat odio.';
            echo '</p>';

          }else{
            echo '<p>To read more, please <a href="login.php">Login</a> or <a href="signup.php">Register</a></p>';
          }
        ?>
        
    </div>
  </main>
</body>
</html>
