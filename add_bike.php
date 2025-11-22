<?php
include("db_connect.php");
session_start();

if ($_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

if (isset($_POST['add_bike'])) {
    $bike_name = $_POST['bike_name'];
    $bike_type = $_POST['bike_type'];
    $price = $_POST['price_per_hour'];

    $query = "INSERT INTO bikes (bike_name, bike_type, price_per_hour)
              VALUES ('$bike_name', '$bike_type', '$price')";

    if (mysqli_query($conn, $query)) {
        header("Location: admin_dashboard.php");
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Bike</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
<h2>Add New Bike</h2>
<form method="POST">
    <input type="text" name="bike_name" placeholder="Bike Name" required><br>
    <input type="text" name="bike_type" placeholder="Bike Type" required><br>
    <input type="number" step="0.01" name="price_per_hour" placeholder="Price per Hour (KSh)" required><br>
    <button type="submit" name="add_bike">Add Bike</button><br>
</form>
<a href="admin_dashboard.php"> Back</a>
</div>
</body>
</html>