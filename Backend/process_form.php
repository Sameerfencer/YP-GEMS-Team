<?php

// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "9Tube";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    echo "Connection failed: ";
}

$name = $_POST['first'];
$email = $_POST['email'];
$phoneNumber = $_POST['number'];
$alternateEmail = isset($_POST['aemail']) ? $_POST['aemail'] : ''; // Check if the field is set
$organizations = isset($_POST['organizations']) ? $_POST['organizations'] : ''; // Check if the field is set
$password = $_POST['password'];

// SQL query to insert data into the database
$sql = "INSERT INTO `users`(`name`, `email`, `phone_number`, `alternate_email`, `organizations`, `password_hash`) VALUES ('$name', '$email', '$phoneNumber', '$alternateEmail', '$organizations', '$password')";

$result = mysqli_query($conn, $sql);

if ($result) {
    header("Location: index.html");
    exit();
} else {
    echo "error";
}

// Close the statement and connection
$conn->close();

?>