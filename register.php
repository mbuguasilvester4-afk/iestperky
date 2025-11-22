<?php
include("db_connect.php");
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

if (isset($_POST['register'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = md5($_POST['password']);
    $role = $_POST['role'];
    $check = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");
    if (mysqli_num_rows($check) > 0) {
        $message = "Username already exists!";
    } else {
        $insert = "INSERT INTO users (username, password, role)
                   VALUES ('$username', '$password', '$role')";
        if (mysqli_query($conn, $insert)) {
            $message = "User added successfully!";
        } else {
            $message = "Error: " . mysqli_error($conn);
        }
        if($result){
            echo "<script>alert('User added successfully!'); window.location.href='admin_dashboard.php';</script>";
    }
}
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register New User/Admin</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
<h2>Register New Account</h2>

<form method="POST">
    <input type="text" name="username" placeholder="Enter Username" required><br>
    <input type="password" name="password" placeholder="Enter Password" required><br>

    <label>Role:</label>
    <select name="role" required>
        <option value="user">User</option>
    </select><br><br>

    <button type="submit" name="register">Register</button>
</form>
<a href="login.php"> Back to Dashboard</a>
<?php if (isset($message)) echo "<p class='error'>$message</p>"; ?>
</div>
</body>
</html>