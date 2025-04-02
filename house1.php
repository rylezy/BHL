    <?php
    session_start();

    // Dummy Data for Boarding House 1
    $house = [
        "name" => "Taruv ni Paul",
        "description" => "A comfortable and affordable boarding house.",
        "price" => "PHP 999, 999/month",
        "image" => "images/house1.jpg",
        "contact" => "09123456789",
        "location" => "Zone 8, Bulan, Sorsogon, Philippines"
    ];
    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo htmlspecialchars($house['name']); ?></title>
        <link rel="stylesheet" href="styles.css"> <!-- External CSS -->
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

            .sidebar ul li:hover {
                background: #E5E5E5;
                border-radius: 5px;
            }

            .sidebar ul li a {
                text-decoration: none;
                color: #333;
                display: flex;
                align-items: center;
                width: 100%;
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

            /* Title */
            h1 {
                font-size: 24px;
                margin-bottom: 20px;
            }

            /* Image & Information Layout */
            .house-container {
                display: flex;
                justify-content: space-between;
                align-items: flex-start;
            }

            .house-image {
                width: 60%;
                height: 400px;
                object-fit: cover;
                border-radius: 10px;
                margin-right: 20px;
            }

            .side-images {
                width: 35%;
                display: flex;
                flex-direction: column;
                gap: 10px;
            }

            .side-images img {
                width: 100%;
                height: 100px;
                object-fit: cover;
                border-radius: 10px;
                cursor: pointer;
                transition: transform 0.3s ease;
            }

            .side-images img:hover {
                transform: scale(1.05);
            }

            .info {
                font-size: 18px;
                margin-bottom: 10px;
            }

            .contact-btn {
                display: inline-block;
                padding: 10px 20px;
                background: #4F46E5;
                color: white;
                text-decoration: none;
                border-radius: 5px;
                margin-top: 20px;
            }

            .back-btn {
                background: #ccc;
                color: black;
            }
        </style>
    </head>
    <body>

        <!-- Sidebar -->
        <div class="sidebar">
            <div class="logo">
                <a href="dashboard.php"><img src="BHL_icon.png" alt="Logo"></a>
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
            <h1><?php echo htmlspecialchars($house['name']); ?></h1>
            <div class="house-container">
                <!-- Main Image -->
                <img src="<?php echo htmlspecialchars($house['image']); ?>" alt="House Image" class="house-image">

                <!-- Side Images (Clickable) -->
                <div class="side-images">
                    <a href="house2.php"><img src="images/house2.jpg" alt="House 2"></a>
                    <a href="house3.php"><img src="images/house3.jpg" alt="House 3"></a>
                    <a href="house4.php"><img src="images/house4.jpg" alt="House 4"></a>
                    <a href="house5.php"><img src="images/house5.jpg" alt="House 5"></a>
                </div>
            </div>
            <p class="info"><strong>Location:</strong> <?php echo htmlspecialchars($house['location']); ?></p>
            <p class="info"><strong>Price:</strong> <?php echo htmlspecialchars($house['price']); ?></p>
            <p class="info"><strong>Description:</strong> <?php echo htmlspecialchars($house['description']); ?></p>
            <p class="info"><strong>Contact:</strong> <?php echo htmlspecialchars($house['contact']); ?></p>
            <a href="tel:<?php echo htmlspecialchars($house['contact']); ?>" class="contact-btn">Rent Now!</a>
            <a href="dashboard.php" class="contact-btn back-btn">Back</a>
        </div>

    </body>
    </html>
