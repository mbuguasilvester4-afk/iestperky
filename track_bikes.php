<?php
include 'db_connect.php';
session_start();

// optional check: ensure only admin can access
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

// fetch bike names for dropdown
$result = mysqli_query($conn, "SELECT id, bike_name FROM bikes");
$bikes = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Bike Tracker</title>
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: "Poppins", sans-serif;
      background: #f5f5f5;
    }
    header {
      background: #00b894;
      color: white;
      text-align: center;
      padding: 10px;
    }
    #controls {
      text-align: center;
      padding: 10px;
      background: #fff;
      box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }
    select, button {
      padding: 10px;
      margin: 5px;
      border-radius: 6px;
      border: 1px solid #ccc;
      font-size: 16px;
    }
    #map {
      height: 80vh;
      width: 100%;
    }
  </style>
</head>
<body>
  <header><h2>🚴 Admin Bike Tracking</h2></header>

  <div id="controls">
    <label for="bikeSelect">Select Bike:</label>
    <select id="bikeSelect">
      <option value="all">All Bikes</option>
      <?php foreach ($bikes as $bike): ?>
        <option value="<?= $bike['id'] ?>"><?= $bike['bike_name'] ?></option>
      <?php endforeach; ?>
    </select>
    <button onclick="fetchAndUpdate()">Track Now</button>
  </div>

  <div id="map"></div>

  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAb8RN6J1_gsIDyj0z6PYYcYKfuAi5pPAsMsIX2nWYIg1ZcQFuw"></script>
  <script>
    let map;
    let markers = {};

    function initMap() {
      map = new google.maps.Map(document.getElementById("map"), {
        zoom: 12,
        center: {lat: -1.2921, lng: 36.8219}
      });
      fetchAndUpdate();
      setInterval(fetchAndUpdate, 5000);
    }

    function fetchAndUpdate() {
      const selectedBike = document.getElementById("bikeSelect").value;
      let url = "get_bikes.php";
      if (selectedBike !== "all") {
        url += "?id=" + selectedBike;
      }

      fetch(url)
        .then(res => res.json())
        .then(bikes => {
          // Clear markers not in use
          Object.keys(markers).forEach(id => {
            if (!bikes.find(b => b.id === id)) {
              markers[id].setMap(null);
              delete markers[id];
            }
          });

          bikes.forEach(bike => {
            const id = bike.id;
            const position = {lat: parseFloat(bike.latitude), lng: parseFloat(bike.longitude)};
            const color = bike.status === 'rented'
              ? 'http://maps.google.com/mapfiles/ms/icons/red-dot.png'
              : 'http://maps.google.com/mapfiles/ms/icons/green-dot.png';

            if (!markers[id]) {
              markers[id] = new google.maps.Marker({
                position,
                map,
                icon: color,
                title: bike.bike_name
              });

              const info = new google.maps.InfoWindow({
                content: `<b>${bike.bike_name}</b><br>Status: ${bike.status}<br>Lat: ${bike.latitude}, Lng: ${bike.longitude}`
              });
              markers[id].addListener('click', () => info.open(map, markers[id]));
            } else {
              markers[id].setPosition(position);
              markers[id].setIcon(color);
            }
          });
        });
    }

    window.onload = initMap;
  </script>
</body>
</html>