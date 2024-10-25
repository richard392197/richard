<?php

require('./database.php');

if(isset($_POST['create'])){
    $coffee = $_POST['coffee'];
    $price = $_POST['price'];
    $size1 = $_POST['size1'];
    $querryCreate = "INSERT INTO menu3 VALUES (null, '$coffee', '$price' , '$size1')";
    $sqlCreate = mysqli_query($connection, $querryCreate); 
    
    echo '<script>alert("successfully Created!")</script>';
    echo '<script>window.location.href = "/richard/admin.php "</script>';
}
    
?>