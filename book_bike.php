<?php
include 'db_connect.php';  // database connection

if (isset($_GET['id'])) {
    $bike_id = $_GET['id'];

    // Update the status to unavailable
    $query = "UPDATE bike SET status='unavailable' WHERE id=$bike_id";
    $result = mysqli_query($conn, $query);

    if ($result) {
        echo "<script>alert('Bike booked successfully!'); window.location='view_bikes.php';</script>";
    } else {
        echo "<script>alert('Error updating status.'); window.location='view_bikes.php';</script>";
    }
}
?>