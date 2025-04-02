<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        .form {
            margin: 100px auto;
            text-align: left;
            border: solid 2px;
            background-color: #fff;
            padding: 1rem;
            max-width: 350px;
            border-radius: 0.5rem;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }

        .form-title {
            font-size: 1.25rem;
            font-weight: 600;
            text-align: center;
            color: #000;
        }

        .input-container {
            position: relative;
        }

        .input-container input, .form button {
            outline: none;
            border: 1px solid #e5e7eb;
            margin: 8px 0;
        }

        .input-container input {
            background-color: #fff;
            padding: 1rem;
            font-size: 0.875rem;
            width: 100%;
            border-radius: 0.5rem;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        }

        .submit {
            display: block;
            padding: 10px;
            background-color: #4F46E5;
            color: white;
            font-size: 0.875rem;
            font-weight: 500;
            width: 100%;
            border-radius: 0.5rem;
            text-transform: uppercase;
            cursor: pointer;
            border: none;
        }

        .signup-link {
            color: #6B7280;
            font-size: 0.875rem;
            text-align: center;
            margin-top: 10px;
        }

        .signup-link a {
            text-decoration: underline;
            color: #4F46E5;
        }

        .error-message {
            color: red;
            text-align: center;
            font-size: 0.875rem;
        }
    </style>
</head>
<body>
    <form class="form" action="" method="POST">
       <p class="form-title">Sign in to your account</p>
        <div class="input-container">
          <input placeholder="Enter email" type="email" name="gmail" required>
        </div>
        <div class="input-container">
          <input placeholder="Enter password" type="password" name="password" required>
        </div>
        <button class="submit" type="submit">
           Sign in
        </button>

      <p class="signup-link">
        No account?
        <a href="signup.php">Sign up</a>
      </p>
    </form>

    <?php
    session_start();
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $server = "localhost";
        $username = "root";
        $password = "";
        $database = "rental_db";

        // Create connection
        $conn = new mysqli($server, $username, $password, $database);

        // Check connection
        if ($conn->connect_error) {
            die("<p class='error-message'>Connection failed: " . $conn->connect_error . "</p>");
        }

        // Retrieve and sanitize form data
        $gmail = mysqli_real_escape_string($conn, $_POST['gmail']);
        $password = $_POST['password'];

        // Check if user exists
        $sql = "SELECT * FROM users WHERE gmail = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $gmail);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_role'] = $user['role'];
            $_SESSION['user_name'] = $user['firstname'];

            // Redirect to dashboard
            header("Location: dashboard.php");
            exit();
        } else {
            echo "<p class='error-message'>Invalid email or password.</p>";
        }

        $stmt->close();
        $conn->close();
    }
    ?>
</body>
</html>
