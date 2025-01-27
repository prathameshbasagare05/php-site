<?php 
include "connection.php" ;
session_start();
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
      <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="username">Username</label>
        <input type="text" id="username" name="username" placeholder="Enter your username" required>
        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Enter your password" required>
        <a href="forgot-pass.php" class="forgot-password">Forgot Password?</a>
        <button type="submit" name="submit">Submit</button>
      </form>
      <p class="register-link">Not registered yet? <a href="signup.php">Create an account!</a></p>
    </div>
  </main>


  <?php

      if(isset($_POST["submit"])){
        $username = htmlspecialchars($_POST["username"]);
        $password = htmlspecialchars($_POST["password"]);

        $query = "SELECT PasswordHash from Users WHERE Username = '$username'";
        $result = $conn->query($query);
        if ($result->num_rows > 0) {
          // Fetch the hashed password from the database
          $row = $result->fetch_assoc();
          $hashed_password = $row['PasswordHash'];

          // Verify the entered password with the hashed password
          if (password_verify($password, $hashed_password)) {
              // Start session and redirect to the dashboard or home page
              $_SESSION['username'] = $username;
              echo "<script>alert('Login successful!'); window.location.href = 'home.php';</script>";
          } else {
              // Incorrect password
              echo "<script>alert('Incorrect password. Please try again.');</script>";
          }
          } else {
              // Username not found
              echo "<script>alert('Username not found. Please register first.');</script>";
          }

       


      }
  ?>
</body>
</html>
