<?php
session_start();

// Initialize locations array in session if not set
if (!isset($_SESSION['locations'])) {
    $_SESSION['locations'] = ['Shika Adabu', 'Mtongwe', 'Mvita', 'Nyali'];
}

// Add location
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['location_name'])) {
    $_SESSION['locations'][] = htmlspecialchars($_POST['location_name']);
}

// Delete location
if (isset($_GET['delete'])) {
    $index = intval($_GET['delete']);
    if (isset($_SESSION['locations'][$index])) {
        array_splice($_SESSION['locations'], $index, 1);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Boarding House Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body { font-family: Arial, sans-serif; background:hsl(210, 16.70%, 97.60%); }
        .sidebar { width: 250px; height: 100vh; background: #4F46E5; color: white; position: fixed; }
        .content { margin-left: 260px; padding: 20px; }
        .menu-item { padding: 15px; color: white; display: block; text-decoration: none; }
        .menu-item:hover { background: #4F46E5; }
    </style>
</head>
<body>
    <div class="sidebar p-3">
        <h3>BHL</h3>
        <p>Hey there, <b>(name)</b></p>
        <a href="#" class="menu-item">Dashboard</a>
        <a href="#" class="menu-item">Houses</a>
        <a href="#" class="menu-item">Tenants</a>
        <a href="#" class="menu-item">Invoices</a>
        <a href="#" class="menu-item">Payments</a>
        <a href="#" class="menu-item">Messages</a>
        <a href="#" class="menu-item">Blog</a>
        <a href="#" class="menu-item">Locations</a>
    </div>
    <div class="content">
        <h2>Locations</h2>
        <form method="POST" class="mb-3">
            <input type="text" name="location_name" placeholder="Enter a new location name" class="form-control" required>
            <button type="submit" class="btn btn-success mt-2">Add this Location</button>
        </form>
        <ul class="list-group">
            <?php foreach ($_SESSION['locations'] as $index => $name): ?>
                <li class="list-group-item d-flex justify-content-between">
                    <?= htmlspecialchars($name) ?>
                    <a href="?delete=<?= $index ?>" class="text-danger">&#128465;</a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</body>
</html>