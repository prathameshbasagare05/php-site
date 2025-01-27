<?php 
include "connection.php" ;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign In</title>
  <link rel="stylesheet" href="styles.css">
  <style>
      body{
        background: url('images/form-bg.jpg') no-repeat center center fixed;
        background-size: cover;
      }
    </style>
</head>
<body>
  <header class="navbar">
    <div class="container">
      <a href="home.php" class="logo">Home</a>
      <a href="login.php" class="login-button">Login</a>
    </div>
  </header>
  <main class="main-content">
    <div class="login-box">
      <h1>SIGN IN</h1>
      <form>
        <label for="username">Username</label>
        <input type="text" id="username" placeholder="Enter your username" required>
        <label for="password">Password</label>
        <input type="password" id="password" placeholder="Enter your password" required>
        <a href="#" class="forgot-password">Forgot Password?</a>
        <button type="submit">Submit</button>
      </form>
      <p class="register-link">Not registered yet? <a href="signup.php">Create an account!</a></p>
    </div>
  </main>
</body>
</html>
