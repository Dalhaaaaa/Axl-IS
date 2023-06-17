<?php
    include "../includes/db_conn.php";
    $car_id = 3;
    // Retrieve the image data from the database
    $query = "SELECT image FROM car WHERE car_id = ?";
    $stmt = mysqli_prepare($conn, $query);
    $car_id = 1; // Replace with the actual car ID
    mysqli_stmt_bind_param($stmt, "i", $car_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $car_img_hex);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

    echo "<p color: 'white'>c</p>". $car_img;
    // Convert the hexadecimal string to binary data
    $car_img = hex2bin($car_img_hex);

    // Output the image data as an <img> tag
    header('Content-Type: image/jpeg');
    echo $car_img;

    error_reporting(E_ALL);
ini_set('display_errors', 1);

?>
