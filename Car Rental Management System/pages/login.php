<?php 
session_start(); 
include "../includes/db_conn.php";

if (isset($_POST['username']) && isset($_POST['password'])) {

	function validate($data){
       $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}

	$uname = validate($_POST['username']);
	$pass = validate($_POST['password']);

    $sql = "SELECT * FROM user WHERE username='$uname' AND password='$pass'";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        if ($row['username'] === $uname && $row['password'] === $pass) {
            $_SESSION['username'] = $row['username'];
            $_SESSION['name'] = $row['name'];
            $_SESSION['id'] = $row['user_id'];
            header("Location: dashboard.php");
            exit();
        }else{
            header("Location: index.php?error=1");
            exit();
        }
    }else{
        header("Location: index.php?error=2");
        exit();
}
	
}else{
	header("Location: index.php");
	exit();
}
