<?php
include '../includes/db_conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $reservationId = $_POST["reservation_id"];
    $carId = $_POST['car-id'];

    // Delete the reservation from the database
    $query = "DELETE FROM reservation WHERE reservation_id = '$reservationId'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        // Reservation added successfully
        // Update car status to "Booked"
        $updateQuery = "UPDATE car SET status = 'Available' WHERE car_id = '$carId'";
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
