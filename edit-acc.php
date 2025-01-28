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
        
    </body>
</html>