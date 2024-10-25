<?php
require('./database.php');

if (isset($_POST['registration'])) {  
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    if ($sqlregistration = $connection->prepare("INSERT INTO reg2 (email, username, password) VALUES (?, ?, ?)")) {
        $sqlregistration->bind_param("sss", $email, $username, $hashedPassword);
        if ($sqlregistration->execute()) {
            echo '<script>alert("Registration Successful!")</script>';
            echo '<script>window.location.href = "adminlogin.php"</script>'; 
        } else {
            echo '<script>alert("Failed to register: ' . $connection->error . '")</script>';
        }
        $sqlregistration->close();
    } else {
        echo '<script>alert("Database query preparation failed.")</script>';
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
    <title>Admin Registration</title>
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

<div class="wrapper">
    <h2>Admin Registration</h2>
    <form action="" method="post">
        <div class="input-box">
            <input type="email" name="email" id="email" placeholder="Email" required>
        </div>
        <div class="input-box">
            <input type="text" name="username" id="username" placeholder="Username" required>
        </div>
        <div class="input-box">
            <input type="password" name="password" id="password" placeholder="Enter Password" required>
        </div>
        <div class="input-box button">
            <input type="submit" name="registration" value="Register">
        </div>
        <div class="text">
            <h3>Already have an account? <a href="adminlogin.php">Login here</a></h3>
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
