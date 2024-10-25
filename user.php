<?php
session_start(); 
require('./read.php');

$userName = isset($_SESSION['username']) ? $_SESSION['username'] : 'User';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Homepage</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Arial', sans-serif;
            background-color: #121212;
            color: #e0e0e0;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
            min-height: 100vh;
        }

        .top-bar {
            display: flex;
            justify-content: flex-end;
            width: 100%;
            max-width: 900px;
            margin-bottom: 20px;
        }

        .logout-btn {
            padding: 10px 20px;
            background-color: #ff4d4d;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 1em;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .logout-btn:hover {
            background-color: #cc3c3c;
        }

        h1 {
            margin-bottom: 20px;
            color: #66b2ff;
            text-align: center;
            font-size: 2.2em;
            font-weight: bold;
            border-bottom: 2px solid #66b2ff;
            padding-bottom: 8px;
        }

        .container {
            background-color: #1e1e1e;
            border-radius: 12px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.4);
            padding: 20px;
            width: 100%;
            max-width: 900px;
            margin-bottom: 20px;
        }

        /* Table styling */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #222;
            color: #e0e0e0;
            border-radius: 5px;
            overflow: hidden;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #444;
        }

        th {
            background-color: #333;
            color: #66b2ff;
        }

        tr:hover {
            background-color: #2e2e2e;
        }

        #printButton {
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #4caf50;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 1em;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        #printButton:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<div class="top-bar">
    <form action="login.php" method="post">
        <input type="submit" value="Logout" class="logout-btn">
    </form>
</div>

<h1>Welcome, <?php echo htmlspecialchars($userName); ?></h1>
<h1>This is Our Menu</h1>

<div class="container">
    <table>
        <tr>
            <th>Id</th>
            <th>Coffee</th>
            <th>Price</th>
            <th>Size</th>
        </tr>
        <?php while ($result = mysqli_fetch_array($sqlAccounts)) { ?>
            <tr>
                <td><?php echo $result['id']; ?></td>
                <td><?php echo $result['coffee']; ?></td>
                <td><?php echo $result['price']; ?></td>
                <td><?php echo $result['size1']; ?></td>
            </tr>
        <?php } ?>
    </table>
</div>

<button id="printButton" onclick="window.print()">Print</button>

</body>
</html>
