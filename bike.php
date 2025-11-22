<?php
include("db_connect.php");
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Bikes - Bike Rental</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
<h2>Available Bikes</h2>
<table border="1" cellpadding="8">
    <tr>
        <th>ID</th>
        <th>Bike Name</th>
        <th>Type</th>
        <th>Price (KSh/hr)</th>
        <th>Status</th>
    </tr>

    <?php
    $query = "SELECT * FROM bikes";
    $result = mysqli_query($conn, $query);

    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>
            <td>{$row['id']}</td>
            <td>{$row['bike_name']}</td>
            <td>{$row['bike_type']}</td>
            <td>{$row['price_per_hour']}</td>
            <td>{$row['status']}</td>
        </tr>";
    }
    ?>
</table>
<br><a href="login.php">Back</a>
</div>
</body>
</html>