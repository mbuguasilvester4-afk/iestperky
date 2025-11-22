<?php
include 'db_connect.php';
header('Content-Type: application/json');

if (isset($_GET['id']) && $_GET['id'] != 'all') {
    $id = intval($_GET['id']);
    $query = "SELECT * FROM bikes WHERE id = $id AND latitude IS NOT NULL AND longitude IS NOT NULL";
} else {
    $query = "SELECT * FROM bikes WHERE latitude IS NOT NULL AND longitude IS NOT NULL";
}

$result = mysqli_query($conn, $query);
$bikes = [];
while ($row = mysqli_fetch_assoc($result)) {
    $bikes[] = $row;
}
echo json_encode($bikes);
?>