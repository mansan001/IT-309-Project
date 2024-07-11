<!-------------- LOG IN PHP BACKEND -------------->

<?php 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $username = $_POST['username']; // Assuming 'username' is used for both username and email
    $password = $_POST['password'];

    // Establish connection to the database
    $conn = mysqli_connect("localhost", "root", "", "mikrafts");

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Prepare SQL statement to check if user exists with the provided credentials
    $sql = "SELECT * FROM user WHERE (user_name = '$username' OR user_email = '$username') AND user_password = '$password'";

    // Execute the query
    $result = mysqli_query($conn, $sql);

    // Check if any row is returned
    if (mysqli_num_rows($result) > 0) {
        echo "
        <script>
            alert('Logged in successfully!');
            window.location.href = './products.php';
        </script>
        ";
    } else {
        echo "
        <script>
            alert('Credentials not found.');
        </script>
        ";
    }

    // Close database connection
    mysqli_close($conn);
}

?>

<!-------------- LOG IN PHP BACKEND -------------->




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="./stylesheet/account-setup.css">
    <link rel="icon" href="./img/mikrafts-logo-light.png">
    <title>Mikrafts | Login & Registration</title>
</head>
<body>
 <div class="wrapper">
    <nav class="nav">
        <div class="nav-logo">
            <p>MIKRAFTS - PH</p>
        </div>
        <div class="nav-menu" id="navMenu">
            <ul>
                <li><a href="#" class="link active">Home</a></li>
                <li><a href="./blog-services-about.html#design" class="link">Arts</a></li>
                <li><a href="./blog-services-about.html#blog" class="link">Blogs</a></li>
                <li><a href="./blog-services-about.html#about" class="link">About</a></li>
            </ul>
        </div>
        <div class="nav-button">
            <button class="btn white-btn" id="loginBtn" onclick="login()">Sign In</button>
            <button class="btn" id="registerBtn" onclick="register()">Sign Up</button>
        </div>
        <div class="nav-menu-btn">
            <i class="bx bx-menu" onclick="myMenuFunction()"></i>
        </div>
    </nav>

<!----------------------------- Form box ----------------------------------->    
    <div class="form-box">
        
        <!------------------- login form -------------------------->

        <div class="login-container" id="login">
            <div class="top">
                <span>Don't have an account? <a href="#" onclick="register()">Sign Up</a></span>
                <header>Login</header>
            </div>
            <form method="POST" action="">
                <div class="input-box">
                    <input type="text" class="input-field" name="username" placeholder="Username or Email">
                    <i class="bx bx-user"></i>
                </div>
                <div class="input-box">
                    <input type="password" class="input-field" name="password" placeholder="Password">
                    <i class="bx bx-lock-alt"></i>
                </div>
                <div class="input-box">
                    <input type="submit" class="submit" value="Sign In">
                </div>
            </form>
            <div class="two-col">
                <div class="one">
                    <input type="checkbox" id="login-check">
                    <label for="login-check"> Remember Me</label>
                </div>
                <div class="two">
                    <label><a href="./account-forgot-password.php">Forgot password?</a></label>
                </div>
            </div>
        </div>

        <!------------------- registration form -------------------------->
        <div class="register-container" id="register">
            <form method="POST" action="./account-register-code.php">
                <div class="top">
                    <span>Have an account? <a href="#" onclick="login()">Login</a></span>
                    <header>Sign Up</header>
                </div>
                <div class="input-box">
                    <input type="text" class="input-field" name="reg_username" placeholder="Username" required>
                    <i class="bx bx-user"></i>
                </div>
                <div class="input-box">
                    <input type="email" class="input-field" name="reg_email" placeholder="Email">
                    <i class="bx bx-envelope"></i>
                </div>
                <div class="two-forms">
                    <div class="input-box">
                        <input type="password" class="input-field" name="password" placeholder="Password">
                        <i class="bx bx-lock-alt"></i>
                    </div>
                    <div class="input-box">
                        <input type="password" class="input-field" name="confirm_password" placeholder="Confirm Password">
                        <i class="bx bx-lock-alt"></i>
                    </div>
                </div>
                <div class="input-box">
                    <input type="submit" class="submit" value="Register">
                </div>
                <div class="two-col">
                    <div class="one">
                        <input type="checkbox" id="register-check">
                        <label for="register-check"> Remember Me</label>
                    </div>
                    <div class="two">
                        <label><a href="#">Terms & conditions</a></label>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>   
<script type="text/javascript" src="./script/account-setup.js"></script>
</body>
</html>