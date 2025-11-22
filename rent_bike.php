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

$bike_id = $_GET['bike_id'];

// Check if bike is available
$check = mysqli_query($conn, "SELECT * FROM bikes WHERE id='$bike_id' AND status='available'");
if (mysqli_num_rows($check) == 0) {
    echo "<script>alert('Bike is not available!'); window.location='user_dashboard.php';</script>";
    exit();
}

// Rent bike
mysqli_query($conn, "INSERT INTO rentals (user_id, bike_id) VALUES ('$user_id', '$bike_id')");
mysqli_query($conn, "UPDATE bikes SET status='rented' WHERE id='$bike_id'");

echo "<script>alert('Bike rented successfully!'); window.location='user_dashboard.php';</script>";
?>