<?php
	include "../includes/db_conn.php";

	$fname = $_POST['first_name'];
	$lname = $_POST['last_name'];
	$pnumber = $_POST['phone_number'];
	$email = $_POST['email'];

    mysqli_query($conn,"INSERT INTO customer
                    (customer_id, first_name, last_name, email, phone_number)
                    VALUES (NULl, '{$fname}', '{$lname}', '{$email}', '{$pnumber}')");
    
    header('location: customer.php');
?>
