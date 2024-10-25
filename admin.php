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
    <title>Admin Homepage</title>
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

        /* Toggleable form section */
        .dropdown-form {
            width: 100%;
            background-color: #2b2b2b;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.4);
            margin-top: 15px;
            padding: 20px;
            display: none;
            transition: max-height 0.4s ease;
        }

        .toggle-btn {
            padding: 12px 20px;
            width: 100%;
            font-size: 1em;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            font-weight: bold;
            text-align: left;
            position: relative;
        }

        .toggle-btn:hover {
            background-color: #0056b3;
        }

        .toggle-btn::after {
            content: '▼';
            position: absolute;
            right: 15px;
            font-size: 1.2em;
            transition: transform 0.3s;
        }

        .toggle-btn.active::after {
            transform: rotate(180deg);
        }

        input[type="text"] {
            width: calc(100% - 20px);
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #444;
            background-color: #333;
            color: #e0e0e0;
            border-radius: 5px;
            font-size: 16px;
        }

        input[type="submit"] {
            padding: 12px 18px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            width: 100%;
            font-size: 1em;
            background-color: #28a745;
            color: #fff;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #218838;
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

        .btn {
            padding: 8px 15px;
            font-size: 0.9em;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn-delete {
            background-color: #ff4d4d;
            color: white;
        }

        .btn-delete:hover {
            background-color: #cc3c3c;
        }

        .btn-edit {
            background-color: #007bff;
            color: white;
        }

        .btn-edit:hover {
            background-color: #0056b3;
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
    <script>
        function toggleForm() {
            const form = document.getElementById('dropdownForm');
            const button = document.getElementById('toggleButton');
            form.style.display = form.style.display === 'none' ? 'block' : 'none';
            button.classList.toggle('active');
        }
    </script>
</head>
<body>

<div class="top-bar">
    <form action="adminlogin.php" method="post">
        <input type="submit" value="Logout" class="logout-btn">
    </form>
</div>

<h1>Welcome, <?php echo htmlspecialchars($userName); ?></h1>
<h1>Your'e Accesing The Admin</h1>

<div class="container">
    <button class="toggle-btn" onclick="toggleForm()" id="toggleButton">Add New Menu</button>
    <div class="dropdown-form" id="dropdownForm">
        <form action="create.php" method="post">
            <h3 style="color: #e0e0e0;">New Menu</h3>
            <label for="coffee" style="color: #b3b3b3;">New Coffee</label>
            <input type="text" id="coffee" name="coffee" placeholder="Coffee" required />

            <label for="price" style="color: #b3b3b3;">Price</label>
            <input type="text" id="price" name="price" placeholder="Price" required />

            <label for="size" style="color: #b3b3b3;">Size</label>
            <input type="text" id="size1" name="size1" placeholder="Size" required />

            <input type="submit" name="create" value="Add Menu">
        </form>
    </div>

    <div class="container">
        <table>
            <tr>
                <th>Id</th>
                <th>Coffee</th>
                <th>Price</th>
                <th>Size</th>
                <th>Action</th>
            </tr>
            <?php while ($result = mysqli_fetch_array($sqlAccounts)) { ?>
                <tr>
                    <td><?php echo $result['id']; ?></td>
                    <td><?php echo $result['coffee']; ?></td>
                    <td><?php echo $result['price']; ?></td>
                    <td><?php echo $result['size1']; ?></td>
                    <td>
                        <form action="edit.php" method="post" style="display:inline;">
                            <input type="submit" name="edit" value="EDIT" class="btn btn-edit">
                            <input type="hidden" name="editid" value="<?php echo $result['id']; ?>">
                            <input type="hidden" name="editC" value="<?php echo $result['coffee']; ?>">
                            <input type="hidden" name="editP" value="<?php echo $result['price']; ?>">
                            <input type="hidden" name="editS" value="<?php echo $result['size1']; ?>">
                        </form>
                        <form action="delete.php" method="post" style="display:inline;">
                            <input type="hidden" name="id" value="<?php echo $result['id']; ?>">
                            <input type="submit" name="delete" value="Delete" class="btn btn-delete">
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>
</div>

<button id="printButton" onclick="window.print()">Print</button>

</body>
</html>
