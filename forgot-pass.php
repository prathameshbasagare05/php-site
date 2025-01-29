<?php
include "connection.php";
session_start();

if (isset($_SESSION['username'])) header("location:home.php");

if (isset($_SESSION['alert'])) {
    echo "<script>alert('" . $_SESSION['alert'] . "');</script>";
    unset($_SESSION['alert']);
}

$stage = 'get_code';
$otp = $_SESSION['otp'] ?? -1;


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['get_code'])) {
        $username = $_POST['username'];
        $q = "SELECT EmailID FROM Users WHERE Username='$username'";
        $result = $conn->query($q);

        if ($result->num_rows == 0) {
            $_SESSION['alert'] = 'Please Enter a Valid Username';
            header("location:forgot-pass.php");
        } else {
            $row = $result->fetch_assoc();
            $otp = random_int(100000, 999999);
            $_SESSION['otp'] = $otp;
            $_SESSION['uid'] = $username;

            $email = $row['EmailID'];
            $subject = "One-Time Code";
            $body = "Your OTP is: $otp";
            sendEmail( $email, $subject, $body);

            $stage = 'verify_code';
        }
    } elseif (isset($_POST['verify_code'])) {
        $enteredOtp = $_POST['otp'];
        if ($enteredOtp == $_SESSION['otp']) {
            $stage = 'change_password';
        } else {
            $_SESSION['alert'] = "Invalid OTP. Please try again.";
            header("location:forgot-pass.php");
        }
    } elseif (isset($_POST['change_password'])) {
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirm_password'];

        if ($password !== $confirmPassword) {
            $_SESSION['alert'] = "Passwords do not match.";
        } else {
            $username = $_SESSION['uid'];
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $conn->query("UPDATE Users SET PasswordHash='$hashedPassword' WHERE Username='$username'");
            
            session_unset();
            $_SESSION['alert'] = "Password successfully changed.";
            header("location:login.php");
            exit;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
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
    <main style="justify-content:flex-start" class="main-content">
        <div class="fields">
            <h1>Forgot Password?</h1>

            <?php if ($stage === 'get_code'): ?>
                <form class="field" method="post">
                    <h2 class="item">Username:</h2>
                    <input class="item" type="text" name="username" value="<?php echo $_POST['username'] ?? '' ?>" placeholder="Enter your username" required>
                    <button class="item" type="submit" name="get_code">Get Code</button>
                </form>
            <?php endif; ?>

            <?php if ($stage === 'verify_code'): ?>
                <form class="field" method="post">
                    <h2 class="item">OTP:</h2>
                    <input class="item" type="number" name="otp" placeholder="Enter OTP" required>
                    <button class="item" type="submit" name="verify_code">Verify</button>
                </form>
            <?php endif; ?>

            <?php if ($stage === 'change_password'): ?>
                <form style="background-color:transparent" class="login-box" method="post">
                    
                    <label for="password">New Password</label>
                    <input class="item" type="password" id="password" name="password" placeholder="Enter New Password" required>
                    
                    <label for="confirm_password">Confirm Password</label>
                    <input class="item" type="password" id="confirm_password" name="confirm_password" placeholder="Confirm Password" required>
                    <button class="item" type="submit" name="change_password">Change Password</button>
                </form>
            <?php endif; ?>
        </div>
    </main>
</body>
</html>
