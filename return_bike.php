<?php
include("db_connect.php");
session_start();

if ($_SESSION['role'] != 'user') {
    header("Location: login.php");
    exit();
}

$rent_id = $_GET['rent_id'];

// Get rental record
$rental_query = mysqli_query($conn, "SELECT * FROM rentals WHERE id='$rent_id' AND status='rented'");
if (mysqli_num_rows($rental_query) == 0) {
    echo "<script>alert('Invalid or already returned rental!'); window.location='rentals.php';</script>";
    exit();
}

$rental = mysqli_fetch_assoc($rental_query);
$bike_id = $rental['bike_id'];

// Update rental record and bike status
mysqli_query($conn, "UPDATE rentals SET status='returned', return_date=NOW() WHERE id='$rent_id'");
mysqli_query($conn, "UPDATE bikes SET status='available' WHERE id='$bike_id'");

echo "<script>alert('Bike returned successfully!'); window.location='rentals.php';</script>";
?>