<?php
include "../includes/db_conn.php";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the updated customer information from the form
    $customerId = $_POST['customer_id'];
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $phoneNumber = $_POST['phone_number'];
    $email = $_POST['email'];

    // Perform the update query
    $query = "UPDATE customer SET first_name = '$firstName', last_name = '$lastName', phone_number = '$phoneNumber', email = '$email' WHERE customer_id = '$customerId'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        // Update successful
        header("Location: customer.php");
        exit();
    } else {
        // Update failed
        echo "Error updating customer information: " . mysqli_error($conn);
    }
}
?>
