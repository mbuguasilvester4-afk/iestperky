<?php
include("db_connect.php");
session_start();

if ($_SESSION['role'] != 'user') {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];
$user_query = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");
$user = mysqli_fetch_assoc($user_query);
$user_id = $user['id'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Dashboard - Bike Rental</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
<h2>Welcome, <?php echo $_SESSION['username']; ?>!</h2>
<a href="bikes.php">
<a href="rentals.php">My Rentals</a> 
<a href="return_bike.php">Return Bike</a>
<a href="logout.php">Logout</a>
<hr>

<h3>Available Bikes to Rent</h3>
<table border="1" cellpadding="8">
    <tr>
        <th>Bike Name</th>
        <th>Type</th>
        <th>Price (KSh/hr)</th>
        <th>Status</th>
        <th>Action</th>
    </tr>

    <?php
    $query = "SELECT * FROM bikes WHERE status='available'";
    $result = mysqli_query($conn, $query);

    while ($bike = mysqli_fetch_assoc($result)) {
        echo "<tr>
            <td>{$bike['bike_name']}</td>
            <td>{$bike['bike_type']}</td>
            <td>{$bike['price_per_hour']}</td>
            <td>{$bike['status']}</td>
            <td><a href='rent_bike.php?bike_id={$bike['id']}'>Rent</a></td>
        </tr>";
    }
    ?>
</table>
    </div>
</body>
</html>