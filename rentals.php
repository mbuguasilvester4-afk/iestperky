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
    <title>My Rentals</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
<h2>My Rental History</h2>
<hr>

<table border="1" cellpadding="8">
    <tr>
        <th>Bike Name</th>
        <th>Type</th>
        <th>Price</th>
        <th>Rent Date</th>
        <th>Status</th>
        <th>Action</th>
    </tr>
  <?php
$query = "SELECT r.*, b.bike_name, b.bike_type, b.price_per_hour
          FROM rentals r
          JOIN bikes b ON r.bike_id = b.id
          WHERE r.user_id='$user_id'";
$result = mysqli_query($conn, $query);

while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>
        <td>{$row['bike_name']}</td>
        <td>{$row['bike_type']}</td>
        <td>{$row['price_per_hour']}</td>
        <td>{$row['rent_date']}</td>
        <td>{$row['status']}</td>";

    if ($row['status'] == 'rented') {
        echo "<td><a href='return_bike.php?rent_id={$row['id']}'>Return</a></td>";
    } else {
        echo "<td>Returned on {$row['return_date']}</td>";
    }

    echo "</tr>";
}
?>
</table>

<a href="user_dashboard.php"> Back to Dashboard</a><br>
    </div>
</body>
</html>