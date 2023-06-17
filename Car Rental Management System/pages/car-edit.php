<?php
include "../includes/db_conn.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the form data
    $carId = $_POST['car_id'];
    $name = $_POST['name'];
    $model = $_POST['model'];
    $year = $_POST['year'];
    $make = $_POST['make'];
    $color = $_POST['color'];
    $status = $_POST['status'];
    $rentalRate = $_POST['rental_rate'];
    $image = $_FILES['car-image'];

    // Check if a new image was uploaded
    if ($image['name']) {
        // Retrieve the image data
        $imageName = $image['name'];
        $imageTmp = $image['tmp_name'];

        // Read the image file and convert it to binary data
        $imageData = file_get_contents($imageTmp);
        $imageData = mysqli_real_escape_string($conn, $imageData);

        // Update the car record with the new image
        $sql = "UPDATE car SET name='$name', model='$model', year='$year', made='$make', color='$color', status='$status',rental_rate='$rentalRate', image='$imageData' WHERE car_id='$carId'";
    } else {
        // Update the car record without changing the image
        $sql = "UPDATE car SET name='$name', model='$model', year='$year', made='$make', color='$color', status='$status', rental_rate='$rentalRate' WHERE car_id='$carId'";
    }

    if ($conn->query($sql) === TRUE) {
        // Record updated successfully
        header("Location: car.php"); // Redirect to the car page
        exit();
    } else {
        // Error occurred while updating the record
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
