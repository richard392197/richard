<?php
require('./database.php');

$editid = '';
$editC = '';
$editP = '';
$editS = '';

if (isset($_POST['edit'])) {
    $editid = $_POST['editid'];
    $editC = $_POST['editC'];
    $editP = $_POST['editP'];
    $editS = $_POST['editS'];
}

if (isset($_POST['update'])) {
    $updateid = $_POST['updateid'];
    $updateC = mysqli_real_escape_string($connection, $_POST['updateC']);
    $updateP = mysqli_real_escape_string($connection, $_POST['updateP']);
    $updateS = mysqli_real_escape_string($connection, $_POST['updateS']);

    $queryupdate = "UPDATE menu3 SET coffee = '$updateC', price = '$updateP', size1 = '$updateS' WHERE id = $updateid";
    $sqlupdate = mysqli_query($connection, $queryupdate);

    if ($sqlupdate) {
        echo '<script>alert("Successfully Updated!")</script>';
        echo '<script>window.location.href = "/richard/admin.php"</script>';
    } else {
        echo '<script>alert("Failed to Update: ' . $connection->error . '")</script>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Menu</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Georgia', serif;
            background: url('bgweb.jpg') no-repeat center center fixed;
            background-size: cover;
            color: #333;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
            min-height: 100vh;
        }

        .container {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 15px;
            padding: 40px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            max-width: 400px;
            width: 100%;
            text-align: center;
            transition: transform 0.6s ease-in-out;
        }

        .container:hover {
            transform: scale(1.02);
        }

        h1 {
            font-size: 2em;
            color: #333;
            margin-bottom: 20px;
        }

        form h3 {
            font-size: 1.2em;
            color: #555;
            margin-bottom: 10px;
        }

        .input-field {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.3s ease;
        }

        .input-field:focus {
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
            outline: none;
            border-color: #56ab2f;
        }

        .btn-submit {
            padding: 12px 20px;
            border: none;
            border-radius: 8px;
            background: linear-gradient(45deg, #56ab2f, #a8e063);
            color: white;
            font-weight: bold;
            cursor: pointer;
            width: 100%;
            margin-top: 20px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
        }

        .btn-submit:hover {
            background: linear-gradient(45deg, #4facfe, #00f2fe);
            transform: scale(1.05);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
        }

        .btn-submit:active {
            transform: scale(1);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        @media (max-width: 600px) {
            .container {
                width: 90%;
                padding: 30px;
            }

            h1 {
                font-size: 1.5em;
            }

            form h3 {
                font-size: 1em;
            }

            .input-field {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Edit Menu</h1>
        <form action="" method="post">
            <input type="text" class="input-field" name="updateC" placeholder="Coffee" value="<?php echo $editC ?>" required />
            <input type="text" class="input-field" name="updateP" placeholder="Price" value="<?php echo $editP ?>" required />
            <input type="text" class="input-field" name="updateS" placeholder="Size's" value="<?php echo $editS ?>" required />
            <input type="hidden" name="updateid" value="<?php echo $editid ?>"/>
            <input type="submit" class="btn-submit" name="update" value="Update">
        </form>
    </div>
</body>
</html>
