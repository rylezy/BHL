<?php
session_start();

// DATABASE CONNECTION
$servername = "localhost";
$username = "root"; // Change if needed
$password = ""; // Change if needed
$dbname = "rental_db";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Ensure only owners can access
if (!isset($_SESSION["user_id"]) || $_SESSION["role"] != "owner") {
    header("Location: login.php");
    exit;
}

// Handle adding location
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["location_name"])) {
    $location_name = $_POST["location_name"];
    $stmt = $conn->prepare("INSERT INTO locations (name) VALUES (?)");
    $stmt->bind_param("s", $location_name);
    $stmt->execute();
    header("Location: owner_dashboard.php");
}

// Handle deleting location
if (isset($_GET["delete_id"])) {
    $id = $_GET["delete_id"];
    $stmt = $conn->prepare("DELETE FROM locations WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    header("Location: owner_dashboard.php");
}

// Fetch locations from database
$locations = $conn->query("SELECT * FROM locations");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Owner Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { font-family: Arial, sans-serif; }
        .sidebar { width: 250px; height: 100vh; background: #007bff; color: white; position: fixed; padding-top: 20px; }
        .sidebar a { color: white; display: block; padding: 15px; text-decoration: none; }
        .sidebar a:hover { background: rgba(255, 255, 255, 0.2); }
        .main-content { margin-left: 260px; padding: 20px; }
    </style>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar">
    <h3 class="text-center">NYUMBANI</h3>
    <a href="owner_dashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
    <a href="#"><i class="fas fa-home"></i> Houses</a>
    <a href="#"><i class="fas fa-users"></i> Tenants</a>
    <a href="#"><i class="fas fa-file-invoice"></i> Invoices</a>
    <a href="#"><i class="fas fa-money-bill-wave"></i> Payments</a>
    <a href="#"><i class="fas fa-envelope"></i> Messages</a>
    <a href="#"><i class="fas fa-blog"></i> Blog</a>
    <a href="owner_dashboard.php"><i class="fas fa-map-marker-alt"></i> Locations</a>
    <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
</div>

<!-- Main Content -->
<div class="main-content">
    <h2>Hey there, <?php echo $_SESSION["username"]; ?></h2>
    <hr>
    
    <!-- Add New Location Form -->
    <h4>Add a New Location</h4>
    <form method="POST">
        <div class="mb-3">
            <input type="text" name="location_name" class="form-control" placeholder="Enter a new location name" required>
        </div>
        <button type="submit" class="btn btn-success"><i class="fas fa-plus-circle"></i> Add this Location</button>
    </form>

    <!-- List of Locations -->
    <h4 class="mt-4">Existing Locations</h4>
    <ul class="list-group">
        <?php while ($row = $locations->fetch_assoc()): ?>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <?php echo $row["name"]; ?>
                <a href="owner_dashboard.php?delete_id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
            </li>
        <?php endwhile; ?>
    </ul>
</div>

</body>
</html>
