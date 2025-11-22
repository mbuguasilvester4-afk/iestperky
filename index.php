<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bike Rental System</title>

  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      flex-direction: column;
      background: url('images/ducati_bg.jpg') no-repeat center center/cover;
      font-family: 'Poppins', sans-serif;
      color: white;
      overflow: hidden;
    }

    .splash-box {
      text-align: center;
      background: rgba(0, 0, 0, 0.6);
      padding: 50px;
      border-radius: 25px;
      box-shadow: 0 0 25px rgba(0, 0, 0, 0.7);
      animation: fadeInUp 1.5s ease-in-out;
    }

    .logo {
      width: 120px;
      height: 120px;
      margin-bottom: 15px;
      animation: bounce 2s infinite;
    }

    h1 {
      font-size: 2.4em;
      letter-spacing: 2px;
      margin-bottom: 10px;
      text-shadow: 2px 2px 5px black;
    }

    p {
      font-size: 1.1em;
      color: #f0f0f0;
      letter-spacing: 0.5px;
    }

    .loader {
      margin-top: 25px;
      border: 5px solid rgba(255,255,255,0.3);
      border-top: 5px solid #00ff88;
      border-radius: 50%;
      width: 45px;
      height: 45px;
      animation: spin 1s linear infinite;
    }

    /* Animations */
    @keyframes spin {
      100% { transform: rotate(360deg); }
    }

    @keyframes fadeInUp {
      from { opacity: 0; transform: translateY(40px); }
      to { opacity: 1; transform: translateY(0); }
    }

    @keyframes bounce {
      0%, 100% { transform: translateY(0); }
      50% { transform: translateY(-10px); }
    }

    @keyframes fadeOut {
      to { opacity: 0; transform: scale(1.1); }
    }
  </style>
</head>
<body>
  <div class="splash-box" id="splash">
    <!-- Replace logo.png with your actual logo -->
    <img src="images/ducati_bg.jpg" alt="Bike Logo" class="logo">
    <h1> Bike Rental System</h1>
    <p>Fast, Reliable and Convenient</p>
    <div class="loader"></div>
  </div>

  <script>
    // Smooth fade-out and redirect after 3 seconds
    setTimeout(() => {
      document.getElementById('splash').style.animation = "fadeOut 12s forwards";
      setTimeout(() => {
        window.location.href = "login.php";
      }, 1000); // wait for fade-out before redirect
    }, 3000);
  </script>
</body>
</html>