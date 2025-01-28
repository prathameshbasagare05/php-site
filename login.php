<?php 
include "connection.php" ;
session_start();
if(isset($_SESSION['username'])) header("location:home.php");
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
<?php include "navbar.php"; ?>
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
          $row = $result->fetch_assoc();
          $hashed_password = $row['PasswordHash'];

          if (password_verify($password, $hashed_password)) {
              $_SESSION['username'] = $username;
              echo "<script>alert('Login successful!'); window.location.href = 'home.php';</script>";
          } else {
              echo "<script>alert('Incorrect password. Please try again.');</script>";
          }
          } else {
              echo "<script>alert('Username not found. Please register first.');</script>";
          }

       


      }
  ?>
</body>
</html>
