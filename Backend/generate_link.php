<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generate Invitation Link</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #2c2c2c;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #6e6e6e;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #ffffff;
            margin-bottom: 20px;
        }

        form {
            text-align: center;
        }

        label {
            color: #ffffff;
            display: block;
            margin-bottom: 5px;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border-radius: 4px;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }

        button {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #0056b3;
        }

        #invitationLink {
            text-align: center;
            margin-top: 20px;
        }

        #invitationLink a {
            color: #fff;
            text-decoration: none;
        }

        #invitationLink a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Generate Invitation Link</h2>
        <form>
            <label for="first">Name:</label>
            <input type="text" id="first" name="first"><br>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required><br>

            <label for="phone_number">Phone Number:</label>
            <input type="number" id="phone_number" name="phone_number"><br>

            <label for="alternate_email">Alternate Email:</label>
            <input type="email" id="alternate_email" name="alternate_email"><br>

            <label for="organizations">Organizations:</label>
            <input type="text" id="organizations" name="organizations"><br>

            <button type="button" onclick="generateLink()">Generate Link</button>
        </form>
        <p id="invitationLink"></p>
    </div>

    <script>
        function generateLink() {
            var name = document.getElementById("first").value;
            var email = document.getElementById("email").value;
            var phone_number = document.getElementById("phone_number").value;
            var alternate_email = document.getElementById("alternate_email").value;
            var organizations = document.getElementById("organizations").value;

            if (email.trim() === "") {
                alert("Please enter your email.");
                return;
            }

            var link = "registration.php?name=" + encodeURIComponent(name) +
                "&email=" + encodeURIComponent(email) +
                "&phone_number=" + encodeURIComponent(phone_number) +
                "&alternate_email=" + encodeURIComponent(alternate_email) +
                "&organizations=" + encodeURIComponent(organizations);

            document.getElementById("invitationLink").innerHTML = "<a href='" + link + "'>Click here to register</a>";
        }
    </script>
</body>

</html>