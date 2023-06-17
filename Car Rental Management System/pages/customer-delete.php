<?php
include "../includes/db_conn.php";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the customer ID from the form
    $customerId = $_POST['customer_id'];

    // Perform the delete query
    $query = "DELETE FROM customer WHERE customer_id = '$customerId'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        // Deletion successful
        header("Location: customer.php");
        exit();
    } else {
        // Deletion failed
        echo "Error deleting customer: " . mysqli_error($conn);
    }
}
?>
