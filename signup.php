<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>
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
    <div class="register-box">
      <h1>REGISTER</h1>
      <form>
        <div class="form-row">
          <div class="form-group">
            <label for="full-name">Full Name</label>
            <input type="text" id="full-name" placeholder="Enter your full name" required>
          </div>
          <div class="form-group">
            <label for="username">Username</label>
            <input type="text" id="username" placeholder="Choose a username" required>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group">
            <label for="mobile">Mobile Number</label>
            <input type="text" id="mobile" placeholder="Enter your mobile number" required>
          </div>
          <div class="form-group">
            <label for="email">Email ID</label>
            <input type="email" id="email" placeholder="Enter your email" required>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" placeholder="Enter your password" required>
          </div>
          <div class="form-group">
            <label for="confirm-password">Confirm Password</label>
            <input type="password" id="confirm-password" placeholder="Re-enter your password" required>
          </div>
        </div>
        <div class="gender-selection">
          <label>
            <input type="radio" name="gender" value="male" required> Male
          </label>
          <label>
            <input type="radio" name="gender" value="female"> Female
          </label>
          <label>
            <input type="radio" name="gender" value="other"> Other
          </label>
        </div>
        <button type="submit">Submit</button>
      </form>
    </div>
  </main>
</body>
</html>
