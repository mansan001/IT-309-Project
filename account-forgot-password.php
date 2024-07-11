<?php

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $conn = mysqli_connect("localhost", "root", "", "mikrafts");

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get the submitted email from the form
    $email = $_POST['email'];

    // Check if the email exists in the database
    $sql = "SELECT * FROM user WHERE user_email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows == 0) {
        // Email not found in the database
        echo '<script>alert("Email not found in the database.");</script>';
    } else {
        // Email found, check current password
        $row = $result->fetch_assoc();
        $currentPassword = $_POST['current_password'];

        // Check if the current password matches the one in the database
        if ($currentPassword != $row['user_password']) {
            // Current password incorrect
            echo '<script>alert("Current password incorrect.");</script>';
        } else {
            // Current password correct, check new password and confirm password
            $newPassword = $_POST['new_password'];
            $confirmPassword = $_POST['confirm_password'];

            // Check if new password matches confirm password
            if ($newPassword != $confirmPassword) {
                // New password does not match
                echo '<script>alert("New password does not match.");</script>';
            } else {
                // Update the password in the database
                $newPassword = mysqli_real_escape_string($conn, $newPassword);
                $sql = "UPDATE user SET user_password='$newPassword' WHERE user_email='$email'";
                if ($conn->query($sql) === TRUE) {
                    echo "<script>alert('Password updated successfully. Please log in.'); location.href='./account-setup.php'; </script>";
                } else {
                    echo '<script>alert("Error updating password: ' . $conn->error . '");</script>';
                }
            }
        }
    }

    // Close connection
    $conn->close();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="./stylesheet/forgot-password.css">
    <link rel="icon" href="./img/mikrafts-logo-light.png">
    <style>
        * {
            margin: 0;
            padding: 0;
            /* box-sizing: border-box; */
            font-family: 'Poppins', sans-serif;
        }
    </style>
    <title>Mikrafts | Forgot Password</title>
</head>
<body>
 <div class="wrapper">
    <nav class="nav">
        <div class="nav-logo">
            <p>MIKRAFTS - PH</p>
        </div>
    </nav>

<!----------------------------- Form box ----------------------------------->    
    <div class="form-box">
        
        <!------------------- Forgot Password form -------------------------->
        <div class="forgot-password-container">
            <form method="POST" action="">
                <div class="top">
                    <header>Forgot Password</header>
                </div>
                <div class="input-box">
                    <input type="email" class="input-field" name="email" placeholder="Email">
                    <i class="bx bx-envelope"></i>
                </div>
                <div class="input-box">
                    <input type="password" class="input-field" name="current_password" placeholder="Current Password">
                    <i class="bx bxs-lock-alt"></i>
                </div>
                <div class="input-box">
                    <input type="password" class="input-field" name="new_password" placeholder="New Password">
                    <i class="bx bxs-lock-alt"></i>
                </div>
                <div class="input-box">
                    <input type="password" class="input-field" name="confirm_password" placeholder="Confirm Password">
                    <i class="bx bxs-lock-alt"></i>
                </div>
                <div class="input-box">
                    <input type="submit" class="submit" value="Reset Password">
                </div>
                
            </form>
            <a class="back-btn" onclick="goBack()">Back</a>
        </div>
    </div>
</div>   
<script>
    function goBack() {
        location.href = "/account-setup.php";
    }
</script>

</body>
</html>
