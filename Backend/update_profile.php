<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['email']) || empty($_SESSION['email'])) {
    // Redirect to login page if not logged in
    header("Location: login.php");
    exit();
}

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

// Get form data
$name = $_POST['name'];
$phone = $_POST['phone_number'];
$email = $_SESSION['email'];

// SQL update query
$sql = "UPDATE users SET name=?, phone_number=? WHERE email=?";
$stmt = $conn->prepare($sql);

// Bind parameters
$stmt->bind_param("sss", $name, $phone, $email);

// Execute query
if ($stmt->execute()) {
    // Redirect to edit profile page with success message
    header("Location: edit_profile.php?success=1");
    exit();
} else {
    // Redirect to edit profile page with error message
    header("Location: edit_profile.php?error=1");
    exit();
}

$stmt->close();
$conn->close();
?>