<?php 
include "connection.php";
session_start();
if(!isset($_SESSION['username'])) header("location:home.php");

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>PHP Site</title>
        <link rel="stylesheet" href="styles.css">
        <style>
            body{
                background: url('images/form-bg.jpg') no-repeat center center fixed;
                background-size: cover;
            }
        </style>
    </head>
    <body>
        <?php 
            include "navbar.php";
            $username = $_SESSION['username'];
            $query = "SELECT * FROM Users WHERE Username = '$username'; ";
            $result = $conn->query($query);
            $row = $result->fetch_assoc();
            $name = $row['FullName'];
            $mobile = $row['MobileNumber'];
            $email = $row['EmailID'];
            $passwordHash = $row['PasswordHash'];
        ?>
        <section class="main-content">
            <div class = "profile-fields">
                <form class = "field" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>">
                    <h2 class="item">Username</h2>
                    <input class="item" type="text" name="username" id="username" value="<?php echo $username ?>">
                    <button class="item"  type="submit" name="submit-username">Change Username</button>
                </form>
                <form class = "field" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>">
                    <h2 class="item" >Name</h2>
                    <input class="item"  type="text" name="name" id="name" value="<?php echo $name ?>">
                    <button class="item"  type="submit" name="submit-name">Change Name</button>
                </form>
                <form class = "field" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>">
                    <h2 class="item" >Mobile Number</h2>  
                    <input class="item"  type="tel" name="mobile" id="mobile" value="<?php echo $mobile ?>">
                    <button class="item"  type="submit" name="submit-mobile">Change Mobile Number</button>
                </form>
                <form class = "field" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>">
                    <h2 class="item" >Email</h2>
                    <input class="item"  type="text" name="email" id="email" value="<?php echo $email ?>">
                    <button class="item"  type="submit" name="submit-email">Change Email</button>
                </form>
            </div>
            <div class="login-box">
                    <h1>Change Password</h1>
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                        <label for="current-pass">Current Password</label>
                        <input type="text" id="current-pass" name="current-pass" placeholder="Enter your Current Password" required>
                        <label for="new-pass">New Password</label>
                        <input type="password" id="new-pass" name="new-pass" placeholder="Enter your new Password" required>
                        <label for="password">Confirm Password</label>
                        <input type="password" id="password" name="password" placeholder="Confirm your password" required>
                        <button type="submit" name="change-pass">Change Password</button>
                    </form>
            </div>
            
            
                


        </section>

        <?php
            if (isset($_SESSION['alert'])) {
                echo '<script>alert("' . $_SESSION['alert'] . '");</script>';
                unset($_SESSION['alert']); 
            }
            if(isset($_POST['username'])){
                $new_username = htmlspecialchars($_POST['username']);
                $q = "SELECT * FROM Users where Username= '$new_username'";
                $result=$conn->query($q);
                if($result->num_rows>0){
                    $_SESSION['alert'] = "The username already exists";
                }else{
                    $q = "UPDATE Users SET Username = '$new_username' WHERE Username = '$username'";
                    if($res=$conn->query($q)===TRUE){
                        $_SESSION['username'] = $new_username;
                        $_SESSION['alert'] = "Username Updated Successfully";
                    }
                }
                header(header: "Location: " . $_SERVER['PHP_SELF']);
            }elseif (isset($_POST['name'])) {
                $new_name = htmlspecialchars($_POST['name']);
                if ($new_name == $name) {
                    $_SESSION['alert'] = "Please provide a different name.";
                } else {
                    $q = "UPDATE Users SET FullName = '$new_name' WHERE FullName = '$name'";
                    if ($conn->query($q) === TRUE) {
                        $_SESSION['alert'] = "Name Updated Successfully.";
                    }
                }
                header("Location: " . $_SERVER['PHP_SELF']);
            }elseif(isset($_POST['mobile'])){
                $new_mobile = $_POST['mobile'];
                $q = "SELECT * FROM Users where MobileNumber= '$new_mobile'";
                $result=$conn->query($q);
                if ($result->num_rows>0) {
                    $_SESSION['alert'] = "Please provide a different mobile number. This Mobile Number already exists.";
                } else {
                    $q = "UPDATE Users SET MobileNumber = '$new_mobile' WHERE MobileNumber = '$mobile'";
                    if ($conn->query($q) === TRUE) {
                        $_SESSION['alert'] = "Mobile Number Updated Successfully.";
                    }
                }
                header("Location: " . $_SERVER['PHP_SELF']);
            }elseif (isset($_POST['email'])) {
                $new_email = htmlspecialchars($_POST['email']);
                $q = "SELECT * FROM Users where EmailID= '$new_email'";
                $result=$conn->query($q);
                if ($result->num_rows>0) {
                    $_SESSION['alert'] = "Please provide a different Email ID. This Email ID already exists.";
                } else {
                    $q = "UPDATE Users SET EmailID = '$new_email' WHERE EmailID = '$email'";
                    if ($conn->query($q) === TRUE) {
                        $_SESSION['alert'] = "Email ID Updated Successfully.";
                    }
                }
                header("Location: " . $_SERVER['PHP_SELF']);
            }elseif(isset($_POST['current-pass'])){
                $current_pass = htmlspecialchars($_POST['current-pass']);
                $new_pass = htmlspecialchars($_POST['new-pass']);
                $pass = htmlspecialchars($_POST['password']);
                if($new_pass!=$pass){
                    $_SESSION['alert'] = "New password and Confirm Password Do not match";
                }else{
                    if(password_verify($current_pass,$passwordHash)){
                        $new_passwordHash = password_hash($pass, PASSWORD_DEFAULT);
                        $q = "UPDATE Users SET PasswordHash='$new_passwordHash' WHERE Username = '$username'";
                        if($conn->query($q)===TRUE){
                            $_SESSION['alert'] = "Password Changed Successfully";
                        }
                    }else{
                        $_SESSION['alert'] = "Current Password is wrong";
                    }
                }
                header("Location: " . $_SERVER['PHP_SELF']);
            }



            
        ?>
    </body>
</html>