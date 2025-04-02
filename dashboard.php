<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="styles.css"> <!-- External CSS -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            display: flex;
            background-color: #F9F9F9;
        }

        /* Sidebar */
        .sidebar {
            width: 250px;
            background: #fff;
            height: 100vh;
            padding: 20px;
            box-shadow: 2px 0px 5px rgba(0, 0, 0, 0.1);
        }

        .logo {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }

        .logo img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
        }

        .sidebar ul {
            list-style: none;
            padding: 0;
        }

        .sidebar ul li {
            padding: 15px;
            cursor: pointer;
            display: flex;
            align-items: center;
            transition: background 0.3s;
        }

        .sidebar ul li a {
            text-decoration: none;
            color: #333;
            display: flex;
            align-items: center;
            width: 100%;
        }

        .sidebar ul li:hover {
            background: #E5E5E5;
            border-radius: 5px;
        }

        .sidebar ul li i {
            margin-right: 10px;
        }

        .logout {
            margin-top: 50px;
            padding: 15px;
            cursor: pointer;
            display: flex;
            align-items: center;
            color: red;
        }

        .logout a {
            text-decoration: none;
            color: red;
            display: flex;
            align-items: center;
            width: 100%;
        }

        /* Main Content */
        .main-content {
            flex-grow: 1;
            padding: 20px;
        }

        /* Top Navigation */
        .top-nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .search-bar {
            padding: 10px;
            width: 300px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .auth-buttons a {
            padding: 8px 15px;
            border: none;
            border-radius: 5px;
            margin-left: 10px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
        }

        .login-btn {
            background: #4F46E5;
            color: white;
        }

        .signup-btn {
            background: #ccc;
            color: black;
        }

        .profile-icon {
            font-size: 20px;
            cursor: pointer;
        }

        /* Listing Grid */
        .listing-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
        }

        .listing-item {
            background: #fff;
            padding: 20px;
            text-align: center;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s ease-in-out;
        }

        .listing-item:hover {
            transform: translateY(-5px);
        }

        .listing-item img {
            width: 100%;
            height: 150px;
            background: #ccc;
            border-radius: 10px;
            margin-bottom: 10px;
        }

        .listing-item h3 {
            font-size: 16px;
            margin-bottom: 5px;
        }

        .listing-item p {
            color: #666;
            font-size: 14px;
        }

        .listing-item a {
            text-decoration: none;
            color: #333;
            display: block;
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="logo">
            <a href="dashboard.php"><img src="BHL_icon.png" style="float: right; margin-left: 10px;" alt="Logo"></a>
        </div>
        <ul>
            <li><a href="bookmark.php"><i class="fas fa-bookmark"></i> Bookmark</a></li>
            <li><a href="inbox.php"><i class="fas fa-inbox"></i> Inbox</a></li>
            <li><a href="map.php"><i class="fas fa-map"></i> Map</a></li>
        </ul>
        <div class="logout"><a href="index.php"><i class="fas fa-sign-out-alt"></i> Log Out</a></div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        
        <!-- Top Navigation -->
        <div class="top-nav">
            <input type="text" class="search-bar" placeholder="Search bar">
            <div class="auth-buttons">
                <a href="index.php" class="login-btn">Log in</a>
                <a href="signup.php" class="signup-btn">Sign up</a>
                <i class="fas fa-user profile-icon"></i>
            </div>
        </div>

        <!-- Title -->
        <h2>Title</h2>
        <p>Subheading</p>

        <!-- Listings -->
        <div class="listing-grid">
        <?php
        // Dummy Data
        $houses = [
            ["name" => "Taruv ni Paul", "desc" => "Tubol", "link" => "house1.php", "image" => "images/house1.jpg"],
            ["name" => "Boarding House 2", "desc" => "Description", "link" => "house2.php", "image" => "images/house2.jpg"],
            ["name" => "Boarding House 3", "desc" => "Description", "link" => "house3.php", "image" => "images/house3.jpg"],
            ["name" => "Boarding House 4", "desc" => "Description", "link" => "house4.php", "image" => "images/house4.jpg"],
            ["name" => "Boarding House 5", "desc" => "Description", "link" => "house5.php", "image" => "images/house5.jpg"],
            ["name" => "Boarding House 6", "desc" => "Description", "link" => "house6.php", "image" => "images/house6.jpg"],
            ["name" => "Boarding House 7", "desc" => "Description", "link" => "house7.php", "image" => "images/house7.jpg"],
            ["name" => "Boarding House 8", "desc" => "Description", "link" => "house8.php", "image" => "images/house8.jpg"]
        ];

        foreach ($houses as $house) {
            echo "
            <div class='listing-item'>
                <a href='{$house['link']}'>
                    <img src='{$house['image']}' alt='{$house['name']}'>
                    <h3>{$house['name']}</h3>
                    <p>{$house['desc']}</p>
                </a>
            </div>";
        }
        ?>

        </div>

    </div>

</body>
</html>
