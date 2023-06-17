<?php
include '../includes/db_conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $carId = $_POST["car_id"];
    $customerId = $_POST["customer_id"];
    $pickupLocation = $_POST["pickup_location"];
    $startDate = $_POST["start_date"];
    $endDate = $_POST["end_date"];

    // Perform validation or additional checks if necessary

    // Insert the reservation into the database
    $query = "INSERT INTO reservation (car_id, customer_id, pickup_location, start_date, end_date)
              VALUES ('$carId', '$customerId', '$pickupLocation', '$startDate', '$endDate')";
    $result = mysqli_query($conn, $query);

    if ($result) {
        // Reservation added successfully
        // Update car status to "Booked"
        $updateQuery = "UPDATE car SET status = 'Booked' WHERE car_id = '$carId'";
        $updateResult = mysqli_query($conn, $updateQuery);

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
