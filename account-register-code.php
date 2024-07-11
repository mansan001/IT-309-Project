<!-------------- REGISTER PHP BACKEND -------------->

<?php 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $reg_username = $_POST['reg_username'];
    $reg_email = $_POST['reg_email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Establish connection to the database
    $conn = mysqli_connect("localhost", "root", "", "mikrafts");

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Prepare SQL statement to insert data into the database
    if ($password != $confirm_password) {
        echo "
        <script>
            alert('Password did not match!');
            location.href='./account-setup.php';
        </script>
        ";
    } elseif (strlen($password) <= 8) {
        echo "
        <script>
            alert('Password must be longer than 8 characters!');
            location.href='./account-setup.php';
        </script>
        ";
    } else {
        $sql = "INSERT INTO user (user_name, user_email, user_password) VALUES ('$reg_username', '$reg_email', '$password')";

        if (mysqli_query($conn, $sql)) {
            echo "
            <script>
                alert('Account Created Successfully!');
                location.href='./account-setup.php';
            </script>
            ";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }

    // Close database connection
    mysqli_close($conn);
}

?>

<!-------------- REGISTER PHP BACKEND -------------->
