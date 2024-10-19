<?php
include '../includes/connect.php';
session_start();
$_SESSION["login"] = "no";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_REQUEST['username'];
    $password = $_REQUEST['password'];

    if ($username == "user" && $password == "password") {
        $_SESSION["login"] = "yes";
        header("Location: index.php");
        exit;
    } else if ($username == "admin" && $password == "password") {
        header('Location: ../admin_pages/admin.php');
        exit;
    } else if (($username == "user" || $password == "password") || ($username == "admin" || $password == "password")) {
        echo "<script>alert('Invalid username or password')</script>";
    } else {
        echo "<script>alert('Username and Password incorrect')</script>";
    }
}

?>

<html>

<head>
    <title>
        Member Login
    </title>
    <link rel="icon" type="image/x-icon" href="../assets/images/logo.jpeg">
    <link crossorigin="anonymous" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <style>
        body {
            background: linear-gradient(135deg, #6e8efb, #a777e3);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-container {
            background: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
        }

        .login-container img {
            width: 150px;
            margin-right: 40px;
        }

        .login-form {
            max-width: 400px;
        }

        .login-form h2 {
            font-weight: bold;
            margin-bottom: 20px;
        }

        .form-control {
            border-radius: 30px;
            padding: 10px 20px;
            margin-bottom: 20px;
        }

        .btn-login {
            background: #4CAF50;
            color: white;
            border-radius: 30px;
            padding: 10px 20px;
            width: 100%;
        }

        .btn-login:hover {
            background: #45a049;
        }

        .forgot-password,
        .create-account {
            display: block;
            font-size: 14px;
            text-align: center;
            margin-top: 10px;
            color: #666;
        }

        .create-account {
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <img alt="Illustration of a laptop with a user icon on the screen" height="150" src="../assets/images/logo.jpeg"
            width="150" />
        <div class="login-form">
            <h2>
                Member Login
            </h2>
            <form action="" method="post">
                <div class="mb-3">
                    <input class="form-control" placeholder="Username" type="text" name="username" require />
                </div>
                <div class="mb-3">
                    <input class="form-control" placeholder="Password" type="password" name="password" require />
                </div>
                <button class="btn btn-login" type="submit">
                    LOGIN
                </button>
                <a class="forgot-password" href="#">
                    Forgot Username / Password?
                </a>
                <a class="create-account" href="#">
                    Create your Account →
                </a>
            </form>
        </div>
    </div>
</body>

</html>