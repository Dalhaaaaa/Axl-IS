<?php
$conn=mysqli_connect("localhost", "root", "") or die(mysqli_error($conn));
mysqli_select_db($conn,"car_rental") or die(mysqli_error($conn));
?>