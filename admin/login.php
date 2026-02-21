<?php
session_start();
include("../includes/db.php");

if(isset($_POST['login'])) {

    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users 
              WHERE email='$email' 
              AND password='$password' 
              AND role='admin'";

    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result) > 0){
        $_SESSION['admin'] = $email;
        header("Location: dashboard.php");
        exit();
    } else {
        echo "Invalid Admin Credentials";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #4e73df, #1cc88a);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-box {
            background: white;
            padding: 50px;
            border-radius: 15px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.3);
            text-align: center;
            width: 350px;
        }

        .login-box h2 {
            font-size: 32px;
            color: #4e73df;
            margin-bottom: 25px;
        }

        .login-box input {
            width: 100%;
            padding: 14px;
            margin: 12px 0;
            border-radius: 8px;
            border: 1px solid #ccc;
            font-size: 16px;
        }

        .login-box button {
            width: 100%;
            padding: 14px;
            background: #1cc88a;
            border: none;
            color: white;
            border-radius: 8px;
            font-size: 18px;
            cursor: pointer;
        }
    </style>

</head>
<body>

<div class="login-box">
    <h2>ADMIN LOGIN</h2>
    <form method="POST">
        <input type="email" name="email" placeholder="Enter Email" required>
        <input type="password" name="password" placeholder="Enter Password" required>
        <button type="submit" name="login">LOGIN</button>
    </form>
</div>

</body>
</html>