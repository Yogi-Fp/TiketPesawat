<?php
session_start();
include "config.php";

$error = "";
$pesan = "";

if (isset($_POST['login'])) {
    $user = $_POST['username'];
    $pass = md5($_POST['password']);

    $cek = mysqli_query($conn, "SELECT * FROM users WHERE username='$user' AND password='$pass'");
    
    if (mysqli_num_rows($cek) > 0) {
        $_SESSION['login'] = true;
        header("Location: index.php");
    } else {
        $error = "Username atau password salah!";
    }
}

if (isset($_POST['register'])) {
    $user = $_POST['username'];
    $pass = md5($_POST['password']);

    $cek = mysqli_query($conn, "SELECT * FROM users WHERE username='$user'");
    
    if (mysqli_num_rows($cek) > 0) {
        $pesan = "Username sudah digunakan!";
    } else {
        mysqli_query($conn, "INSERT INTO users (username, password) VALUES ('$user','$pass')");
        $pesan = "Akun berhasil dibuat!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login & Register</title>

    <style>
        body {
            font-family: Arial;
            background: linear-gradient(135deg, #2563eb, #1e3a8a);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .card {
            background: white;
            padding: 25px;
            width: 360px;
            border-radius: 10px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
            text-align: center;
        }

        .tabs {
            display: flex;
            margin-bottom: 20px;
            gap: 8px;
        }

        .tabs button {
            flex: 1;
            padding: 10px;
            border: none;
            cursor: pointer;
            background: #e5e7eb;
            border-radius: 8px;
            font-weight: 600;
            transition: background 0.2s ease, transform 0.2s ease;
        }

        .tabs button.active {
            background: #2563eb;
            color: white;
            transform: translateY(-2px);
        }

        .tabs button:hover:not(.active) {
            background: #dbeafe;
        }

        input {
            width: 90%;
            padding: 10px;
            margin: 8px 0;
            border-radius: 6px;
            border: 1px solid #ccc;
        }

        button.submit {
            margin-top: 10px;
            width: 98%;
            padding: 10px;
            background: #2563eb;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }

        button.submit:hover {
            background: #1e40af;
        }

        .form-wrapper {
            position: relative;
            height: 160px;
            overflow: hidden;
        }

        .form {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            transform: translateX(100%);
            opacity: 0;
            transition: transform 0.4s ease, opacity 0.4s ease;
        }

        .form.active {
            transform: translateX(0);
            opacity: 1;
        }

        .form.slide-out-left {
            transform: translateX(-100%);
            opacity: 0;
        }

        .error {
            background: #fee2e2;
            color: #b91c1c;
            padding: 8px;
            margin-bottom: 10px;
            border-radius: 5px;
        }

        .pesan {
            background: #d1fae5;
            color: #065f46;
            padding: 8px;
            margin-bottom: 10px;
            border-radius: 5px;
        }
    </style>
</head>

<body>

<div class="card">

    <div class="tabs">
        <button id="btnLogin" class="active" onclick="showForm('login')">Login</button>
        <button id="btnRegister" onclick="showForm('register')">Register</button>
    </div>

    <?php if ($error): ?>
        <div class="error"><?= $error ?></div>
    <?php endif; ?>

    <?php if ($pesan): ?>
        <div class="pesan"><?= $pesan ?></div>
    <?php endif; ?>

    <div class="form-wrapper">
        <div id="loginForm" class="form active">
        <form method="post">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button class="submit" name="login">Login</button>
        </form>
        </div>

        <div id="registerForm" class="form">
        <form method="post">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button class="submit" name="register">Register</button>
        </form>
        </div>
    </div>
    </div>

</div>

<script>
function showForm(type) {
    document.getElementById("loginForm").classList.remove("active");
    document.getElementById("registerForm").classList.remove("active");
    document.getElementById("loginForm").classList.remove("slide-out-left");
    document.getElementById("registerForm").classList.remove("slide-out-left");
    document.getElementById("btnLogin").classList.remove("active");
    document.getElementById("btnRegister").classList.remove("active");

    if (type === "login") {
        document.getElementById("registerForm").classList.add("slide-out-left");
        setTimeout(() => {
            document.getElementById("loginForm").classList.add("active");
        }, 20);
        document.getElementById("btnLogin").classList.add("active");
    } else {
        document.getElementById("loginForm").classList.add("slide-out-left");
        setTimeout(() => {
            document.getElementById("registerForm").classList.add("active");
        }, 20);
        document.getElementById("btnRegister").classList.add("active");
    }
}
</script>

</body>
</html>