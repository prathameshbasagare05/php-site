<?php 
include "connection.php"; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $gender = $_POST['gender'];

    
    if ($password !== $confirm_password) {
        echo "<script>alert('Passwords do not match!');</script>";
    } else {
        $query = "SELECT * FROM Users WHERE Username = '$username' OR EmailID = '$email' OR MobileNumber = '$mobile'";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            echo "<script>alert('Username, Email, or Mobile already exists!');</script>";
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT); 
            $insert_query = "INSERT INTO Users (FullName, Username, MobileNumber, EmailID, PasswordHash, Gender) 
                             VALUES ('$full_name', '$username', '$mobile', '$email', '$hashed_password', '$gender')";

            if ($conn->query($insert_query) === TRUE) {
                echo "<script>alert('Registration successful!');</script>";
            } else {
                echo "<script>alert('Error in registration: " . $conn->error . "');</script>";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>
  <link rel="stylesheet" href="styles.css">
  <style>
      body {
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
    <div class="register-box">
      <h1>REGISTER</h1>
      <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div class="form-row">
          <div class="form-group">
            <label for="full-name">Full Name</label>
            <input type="text" id="full-name" name="full_name" placeholder="Enter your full name" required>
          </div>
          <div class="form-group">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" placeholder="Choose a username" required>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group">
            <label for="mobile">Mobile Number</label>
            <input type="text" id="mobile" name="mobile" placeholder="Enter your mobile number" required>
          </div>
          <div class="form-group">
            <label for="email">Email ID</label>
            <input type="email" id="email" name="email" placeholder="Enter your email" required>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Enter your password" required>
          </div>
          <div class="form-group">
            <label for="confirm-password">Confirm Password</label>
            <input type="password" id="confirm-password" name="confirm_password" placeholder="Re-enter your password" required>
          </div>
        </div>
        <div class="gender-selection">
          <label>
            <input type="radio" name="gender" value="Male" required> Male
          </label>
          <label>
            <input type="radio" name="gender" value="Female"> Female
          </label>
          <label>
            <input type="radio" name="gender" value="Other"> Other
          </label>
        </div>
        <button type="submit">Submit</button>
      </form>
    </div>
  </main>
</body>
</html>
