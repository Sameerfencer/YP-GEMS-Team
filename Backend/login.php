<?php
session_start();

// Replace these variables with your actual database credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "9Tube";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$email = $_POST['email'];
$password = $_POST['password'];

// SQL query to check if the provided email exists in the database
$sql = "SELECT * FROM users WHERE email=?";
$stmt = $conn->prepare($sql);

// Check if the statement was prepared properly
if (!$stmt) {
    die("Error in preparing statement: " . $conn->error);
}

$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 1) {
    // User exists, fetch the user data
    $user = $result->fetch_assoc();

    // Verify the password
    if ($password == $user['password_hash']) {
        // Password is correct, set session and redirect to home.html
        $_SESSION['email'] = $email;
        header("Location: home.php");
        exit();
    } else {
        // Password is incorrect, redirect back to login page with error message
        header("Location: login.php?error=1");
        exit();
    }
} else {
    // User does not exist, redirect back to login page with error message
    header("Location: login.php?error=1");
    exit();
}

$stmt->close();
mysqli_close($conn);
?>