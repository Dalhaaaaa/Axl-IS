<?php
include "../includes/db_conn.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cname = $_POST['car-name'];
    $cmodel = $_POST['car-model'];
    $year = $_POST['year'];
    $made = $_POST['made'];
    $color = $_POST['color'];
    $rental_rate = $_POST['rental-rate'];

    // Handle the image file separately
    $image = $_FILES['car-image']['tmp_name'];  // Temporary file path
    $imageData = file_get_contents($image);  // Read the image data as binary

    // Prepare the query with a parameter for the image data
    $query = "INSERT INTO car (name, model, year, made, color, rental_rate, image)
              VALUES (?, ?, ?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "ssissis", $cname, $cmodel, $year, $made, $color, $rental_rate, $imageData);

    if (mysqli_stmt_execute($stmt)) {
        header('location: car.php');
    } else {
        echo "Error: " . mysqli_stmt_error($stmt);
    }

    mysqli_stmt_close($stmt);
} else {
    echo "Error uploading the file.";
}
?>
