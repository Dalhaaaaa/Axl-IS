<?php
// Check if the delete form is submitted
if (isset($_POST['delete-car'])) {
    include "../includes/db_conn.php";

    // Get the car ID from the form
    $carId = $_POST['car_id'];

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // SQL query to delete the car
    $sql = "DELETE FROM car WHERE car_id = $carId";

    if ($conn->query($sql) === TRUE) {
        // Car deleted successfully
        echo "Car deleted successfully.";
        header("Location: car.php");
        exit;
    } else {
        // Error deleting car
        echo "Error deleting car: " . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>
