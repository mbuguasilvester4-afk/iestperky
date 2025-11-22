<?php
include("db_connect.php");
session_start();

if ($_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard - Bike Rental</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
<h2>Welcome, Admin <?php echo $_SESSION['username']; ?>!</h2>
<a href="add_bike.php"> Add New Bike</a>
<a href="bike.php">View All Bikes</a>
<a href="track_bikes.php" class="button">Track Bikes</a>
<a href="logout.php">Logout</a>
<hr>
<h3>Rental Record</h3>
<table border="2" cellpadding="10">
    <tr>
        <th>ID</th>
        <th>username</th>
        <th>bike name</th>
        <th>Rent Date</th>
        <th>Return Date</th>
        <th>Status</th>
    </tr>
    <?php
    $query = "SELECT  r.*,u.username, b.bike_name, b.bike_type, b.price_per_hour, b.status
              FROM rentals r
              JOIN users u ON r.user_id = u.id
              JOIN bikes b ON r.bike_id = b.id";
    $result = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
    echo "<td>{$row['id']}</td>";
    echo "<td>{$row['username']}</td>";
   echo "<td>{$row['bike_name']}</td>";
   echo "<td>{$row['rent_date']}</td>";
   echo "<td>{$row['return_date']}</td>";
   echo "<td>{$row['status']}</td>";
       echo "</tr> ";
    }
    ?>
    <style>
        body {
            background-color: grey;
        }
    </style>
     <a href="register.php"> Register</a>
</table>
</div>
</body>
</html>