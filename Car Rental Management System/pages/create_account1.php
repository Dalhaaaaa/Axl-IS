<?php
	include "../includes/db_conn.php";
?>

<?php
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $birthdate = $_POST['birthdate'];
    $user = $_POST['username'];
    $pass = $_POST['password'];

    mysqli_query($conn,"INSERT INTO user
                        (user_id, username, password)
                        VALUES (NULl, '{$user}', '{$pass}')");
    
    header('location: index.php');
?>