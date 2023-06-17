<?php
include '../includes/db_conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $reservationId = $_POST["reservation_id"];
    $carId = $_POST["car_id"];
    $customerId = $_POST["customer_id"];
    $pickupLocation = $_POST["pickup_location"];
    $startDate = $_POST["start_date"];
    $endDate = $_POST["end_date"];
    $prevCarId = $_POST['prev-car-id'];

    // Perform validation or additional checks if necessary

    // Update the reservation in the database
    $query = "UPDATE reservation
              SET car_id = '$carId', customer_id = '$customerId', pickup_location = '$pickupLocation', start_date = '$startDate', end_date = '$endDate'
              WHERE reservation_id = '$reservationId'";
    $result = mysqli_query($conn, $query);

     if ($result) {
        // Reservation added successfully
        // Update car status to "Booked"
        $updateQuery = "UPDATE car SET status = 'Booked' WHERE car_id = '$carId'";
        $updateResult = mysqli_query($conn, $updateQuery);

        $updateQuery1 = "UPDATE car SET status = 'Available' WHERE car_id = '$prevCarId'";
        $updateResult1 = mysqli_query($conn, $updateQuery1);

        if ($updateResult) {
            // Car status updated successfully
            header("Location: reservation.php"); // Redirect to the dashboard or any other page
            exit();
        } else {
            // Failed to update car status
            echo "Error updating car status: " . mysqli_error($conn);
        }
    } else {
        // Failed to add the reservation
        echo "Error adding reservation: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>
