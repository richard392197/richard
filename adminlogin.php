<?php
require('./database.php');

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if ($stmt = $connection->prepare("SELECT id, username, password FROM reg2 WHERE email = ?")) {
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($id, $username, $hashedPassword);
            $stmt->fetch();

            if (password_verify($password, $hashedPassword)) {
                session_start();
                $_SESSION['userid'] = $id;
                $_SESSION['username'] = $username;
                echo '<script>alert("Login Successful!")</script>';
                echo '<script>window.location.href = "admin.php"</script>';
            } else {
                echo '<script>alert("Incorrect password.")</script>';
            }
        } else {
            echo '<script>alert("No user found with that email.")</script>';
        }
        $stmt->close();
    } else {
        echo '<script>alert("Database query failed.")</script>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <title>User Login</title>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background: var(--background-gradient);
            color: var(--text-color);
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
            min-height: 100vh;
            margin: 0;
            transition: background 0.3s ease, color 0.3s ease;
        }

        :root {
            --background-gradient: linear-gradient(to right, #121212, #1c1c1c);
            --text-color: #f5f5f5;
            --input-bg: #333;
            --button-bg: #6200ea;
            --button-hover-bg: #3700b3;
            --link-color: #bb86fc;
        }

        .light-mode {
            --background-gradient: linear-gradient(to right, #f5f5f5, #e0e0e0);
            --text-color: #333;
            --input-bg: #fff;
            --button-bg: #6200ea;
            --button-hover-bg: #3700b3;
            --link-color: #6200ea;
        }

        .toggle-container {
            position: absolute;
            top: 20px;
            right: 20px;
            display: flex;
            align-items: center;
        }

        .toggle-container input[type="checkbox"] {
            display: none;
        }

        .toggle-container label {
            cursor: pointer;
            font-size: 14px;
            color: var(--text-color);
            font-weight: bold;
            transition: color 0.3s;
        }

        .toggle-container label:before {
            content: "🌙";
            font-size: 18px;
            margin-right: 8px;
        }

        .toggle-container input[type="checkbox"]:checked + label:before {
            content: "☀️";
        }

        .admin-link {
            position: absolute;
            top: 20px;
            left: 20px;
            font-size: 14px;
        }

        .admin-link a {
            color: var(--link-color);
            text-decoration: none;
            font-weight: bold;
            transition: color 0.3s;
        }

        .admin-link a:hover {
            color: var(--button-hover-bg);
        }

        .wrapper {
            background: var(--input-bg);
            border-radius: 15px;
            padding: 40px;
            width: 100%;
            max-width: 400px;
            box-shadow: 0px 20px 50px rgba(0, 0, 0, 0.2);
            text-align: center;
            transition: background 0.3s ease;
        }

        .wrapper h2 {
            margin-bottom: 20px;
            font-size: 26px;
            color: var(--text-color);
            font-weight: 700;
        }

        .input-box {
            margin-bottom: 20px;
        }

        .input-box input {
            width: 100%;
            padding: 12px 16px;
            font-size: 16px;
            background: var(--input-bg);
            border: 1px solid #666;
            border-radius: 8px;
            outline: none;
            color: var(--text-color);
            transition: border-color 0.3s ease, background 0.3s ease;
        }

        .input-box input:focus {
            border-color: var(--button-bg);
            box-shadow: 0 0 8px rgba(98, 0, 234, 0.3);
        }

        .input-box.button input {
            background-color: var(--button-bg);
            color: #fff;
            border: none;
            cursor: pointer;
            font-weight: bold;
            transition: background-color 0.3s ease;
            border-radius: 8px;
        }

        .input-box.button input:hover {
            background-color: var(--button-hover-bg);
        }

        .text h3 {
            font-size: 15px;
            color: var(--text-color);
        }

        .text h3 a {
            color: var(--link-color);
            text-decoration: none;
            font-weight: bold;
        }

        .text h3 a:hover {
            color: var(--button-hover-bg);
        }

        @media (max-width: 600px) {
            .wrapper {
                padding: 30px;
                max-width: 90%;
            }

            .wrapper h2 {
                font-size: 24px;
            }

            .input-box input {
                font-size: 16px;
            }

            .text h3 {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>

<div class="toggle-container">
    <input type="checkbox" id="modeToggle" onclick="toggleMode()">
    <label for="modeToggle">Dark Mode</label>
</div>

<div class="admin-link">
    <a href="login.php">user</a>
</div>

<div class="wrapper">
    <h2>login Your Admin Account</h2>
    <form action="" method="post">
        <div class="input-box">
            <input type="email" name="email" id="email" placeholder="Email" required>
        </div>
        <div class="input-box">
            <input type="password" name="password" id="password" placeholder="Password" required>
        </div>
        <div class="input-box button">
            <input type="submit" name="login" value="Login">
        </div>
        <div class="text">
            <h3>Don't have an account? <a href="registration.php">Register here</a></h3>
        </div>
    </form>
</div>

<script>
    function toggleMode() {
        document.body.classList.toggle("light-mode");
    }
</script>

</body>
</html>
