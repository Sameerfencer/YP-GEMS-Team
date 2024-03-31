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


// Fetch user details from the database based on session email
$email = $_SESSION['email'];
$sql = "SELECT * FROM users WHERE email=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

// Check if user exists
if ($result->num_rows == 1) {
    // Fetch user details
    $row = $result->fetch_assoc();
} else {
    // Redirect to a different page if user not found
    header("Location: edit_profile.php");
    exit();
}

// Close database connection
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./assets/images/icon.ico" type="image/x-icon">
    <title>9TeenInitiative - Edit Profile</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #2c2c2c;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            background-color: #6e6e6e;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        form {
            width: 100%;
            max-width: 400px;
            margin: 0 auto;
        }

        label {
            display: block;
            font-weight: bold;
            color: #fff;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="email"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        button[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            margin-top: 10px;
        }

        button[type="submit"]:hover {
            background-color: #000;
        }
    </style>
</head>

<body>

    <div class="container">
        <h2>Edit Profile</h2>

        <!-- <form action="update_profile.php" method="post"> -->
        <form id="editProfileForm" action="update_profile.php" method="post" enctype="multipart/form-data">

            <label for="image">Profile Picture:</label>
            <input type="file" id="image" name="image" accept="image/*" onchange="previewImage(event)" required>
            <img id="imagePreview" src="#" alt="Preview" style="display:none; max-width: 200px; margin-top: 10px;">


            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="<?php echo $row['name']; ?>" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo $row['email']; ?>" required disabled>

            <label for="number">Phone Number:</label>
            <input type="text" id="number" name="number" value="<?php echo $row['phone_number']; ?>" required>

            <label for="aemail">Alternate Email ID:</label>
            <input type="email" id="aemail" name="aemail" value="<?php echo $row['alternate_email']; ?>" required>

            <label for="organizations">Organizations:</label>
            <input type="text" id="organizations" name="organizations" value="<?php echo $row['organizations']; ?>"
                required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" value="<?php echo $row['password_hash']; ?>">

            <button type="submit">Update Profile</button>
        </form>


         <script>
            function previewImage(event) {
                var reader = new FileReader();
                reader.onload = function () {
                    var imgPreview = document.getElementById('imagePreview');
                    imgPreview.src = reader.result;
                    imgPreview.style.display = 'block';
                }
                reader.readAsDataURL(event.target.files[0]);
            }
        </script>
    </div>

</body>

</html>