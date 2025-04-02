<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <style>
        .form {
            margin: 50px auto;
            padding: 20px;
            text-align: center;
            border: solid 2px;
            border-radius: 0.5rem;
            width: 350px;
        }
        input {
            width: 100%;
            max-width: 300px;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
        }
        .radio {
            margin-bottom: 10px;
        }
        #button {
            padding: 10px;
            width: 150px;
            border-radius: 5px;
            background-color: #4F46E5;
            color: white;
            border: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <form class="form" action="" method="POST">
        <h2>Create Your Account</h2>
        <input type="text" name="firstname" placeholder="First Name" required>
        <input type="text" name="lastname" placeholder="Last Name" required>
        <input type="text" name="address" placeholder="Address" required>
        <input type="text" name="number" placeholder="Number" required>
        <input type="email" name="gmail" placeholder="Gmail" required>
        <input type="password" name="password" placeholder="Password" required><br>
        <div class="radio">
            <label><input type="radio" name="role" value="Student" required> Student</label>
            <label><input type="radio" name="role" value="Land Owner" required> Land Owner</label>
        </div>
        <button type="submit" id="button">Create</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $server = "localhost";
        $username = "root";
        $password = "";
        $database = "rental_db";

        // Create connection
        $conn = new mysqli($server, $username, $password, $database);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Retrieve and sanitize form data
        $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
        $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
        $address = mysqli_real_escape_string($conn, $_POST['address']);
        $number = mysqli_real_escape_string($conn, $_POST['number']);
        $gmail = mysqli_real_escape_string($conn, $_POST['gmail']);
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $role = mysqli_real_escape_string($conn, $_POST['role']);

        // Insert data using prepared statement
        $stmt = $conn->prepare("INSERT INTO users (firstname, lastname, address, number, gmail, password, role) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssss", $firstname, $lastname, $address, $number, $gmail, $password, $role);

        if ($stmt->execute()) {
            echo "<p style='color:green; text-align:center;'>Signup successful!</p>";
        } else {
            echo "<p style='color:red; text-align:center;'>Error: Could not create account.</p>";
        }

        $stmt->close();
        $conn->close();
    }
    ?>
</body>
</html>
