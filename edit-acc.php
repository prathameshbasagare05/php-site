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
                background: url('images/home-bg.jpg') no-repeat center center fixed;
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
        <main class="main-content">
            <div class = "profile-fields">
                <form class = "field" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
                    <h2 class="item">Username</h2>
                    <input class="item" type="text" name="username" id="username" value="<?php echo $username ?>">
                    <button class="item"  type="submit" name="submit-username">Change Username</button>
                </form>
                <form class = "field" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
                    <h2 class="item" >Name</h2>
                    <input class="item"  type="text" name="name" id="name" value="<?php echo $name ?>">
                    <button class="item"  type="submit" name="submit-name">Change Name</button>
                </form>
                <form class = "field" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
                    <h2 class="item" >Mobile Number</h2>  
                    <input class="item"  type="text" name="mobile" id="mobile" value="<?php echo $mobile ?>">
                    <button class="item"  type="submit" name="submit-mobile">Change Mobile Number</button>
                </form>
                <form class = "field" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
                    <h2 class="item" >Email</h2>
                    <input class="item"  type="text" name="email" id="email" value="<?php echo $email ?>">
                    <button class="item"  type="submit" name="submit-email">Change Email</button>
                </form>
            </div>
        </main>
    </body>
</html>