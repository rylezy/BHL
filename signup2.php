<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
</head>
<style>
     .form{
        margin-top: 100px;
        display: block;
        margin: 50px;
        padding: 20px;
        text-align: center;
        border: solid 2px;
        border-radius: 0.5rem;
     }
     input {
        padding: 10px;
        border-radius: 5px;
        margin-bottom: 10px;
        margin-right: 10px;
     }
     .radio{
        margin-bottom: 10px;
     }  
     #buton {
        padding: 10px;
        width: 150px;
        border-radius: 5px;
        background-color: #4F46E5;
        color: white;
        border: none;
        cursor: pointer;
     }
</style>    
<body>
    <form class="form" action="signup.php" method="POST">
        <h2>Create Your Account</h2>
        <input type="text" name="firstname" placeholder="First Name" required>
        <input type="text" name="lastname" placeholder="Last Name" required>
        <input type="text" name="address" placeholder="Address" required>
        <input type="text" name="number" placeholder="Number" required>
        <input type="email" name="gmail" placeholder="Gmail" required>
        <input type="password" name="password" placeholder="Password" required><br>
        <div class="radio">
           <input type="radio" name="role" value="Student" required> Student
           <input type="radio" name="role" value="Land Owner" required> Land Owner
        </div>
        <button type="submit" id="buton">Create</button>
    </form>
    
    <?php
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

// Retrieve form data
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$address = $_POST['address'];
$number = $_POST['number'];
$gmail = $_POST['gmail'];
$password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Encrypt password
$role = $_POST['role'];

// Insert data into database
$sql = "INSERT INTO users (firstname, lastname, address, number, gmail, password, role) 
        VALUES ('$firstname', '$lastname', '$address', '$number', '$gmail', '$password', '$role')";

if ($conn->query($sql) === TRUE) {
    echo "Signup successful!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>

</body>
</html>
