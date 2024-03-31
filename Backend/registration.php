<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./assets/images/icon.ico" type="image/x-icon">
    <title>9TeenInitiative</title>
    <link rel="stylesheet" href="style1.css">
</head>

<body>
    <div class="main">
        <h1>9Teen Initiative</h1>
        <form action="process_form.php" method="POST">

            <label for="first">
                Name <span>*</span> :
            </label>
            <input type="text" id="first" name="first" value="<?php echo isset($_GET['name']) ? $_GET['name'] : ''; ?>"
                required>

            <label for="email">
                Email <span>*</span> :
            </label>
            <input type="email" id="email" name="email"
                value="<?php echo isset($_GET['email']) ? $_GET['email'] : ''; ?>" required>

            <label for="phone_number">
                Phone Number <span>*</span> :
            </label>
            <input type="number" id="phone_number" name="phone_number"
                value="<?php echo isset($_GET['phone_number']) ? $_GET['phone_number'] : ''; ?>" required>

            <label for="alternate_email">
                Alternate Email ID:
            </label>
            <input type="email" id="alternate_email" name="alternate_email"
                value="<?php echo isset($_GET['alternate_email']) ? $_GET['alternate_email'] : ''; ?>">

            <label for="organizations">
                Organizations:
            </label>
            <input type="text" id="organizations" name="organizations"
                value="<?php echo isset($_GET['organizations']) ? $_GET['organizations'] : ''; ?>">

            <label for="password">
                Password <span>*</span> :
            </label>
            <input type="password" id="password" name="password" placeholder="Enter your Password" required>

            <div class="wrap">
                <button type="submit" onclick="solve()">
                    Create
                </button>
            </div>
        </form>

        <p>Already registered?
            <a href="index.html" style="text-decoration: none;">
                Sign In
            </a>
        </p>
    </div>
</body>

</html>