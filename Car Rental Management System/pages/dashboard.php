<?php
include "../includes/db_conn.php";
?>
<!DOCTYPE html>
<html>
<head>
  <title>Dashboard</title>
  <link rel="stylesheet" type="text/css" href="../css/dashboard.css?v=1.1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
</head>
<body>
<div class="sidebar">
  <?php
      $current_file = basename($_SERVER['PHP_SELF']);
      $nav_links = array(
          'Home' => 'dashboard.php',
          'Car Section' => 'car.php',
          'Customer Section' => 'customer.php',
          'Reservation' => 'reservation.php',
          'Logout' => 'index.php'
      );
  ?>
  <h2><i class="fas fa-car"></i> Luxury Car Rental System</h2>
  <?php foreach ($nav_links as $label => $file_name): 
      $split = explode('.', $file_name);
  ?>
      <a href="<?php echo $file_name ?>" <?php if (strstr($current_file, $split[0]) !== false) { echo 'class="active"'; } ?>>
          <i <?php if ($label === 'Home') { echo 'class="fas fa-home"';} 
                  elseif ($label === 'Car Section') { echo 'class="fas fa-car-alt"';} 
                  else if ($label === 'Customer Section') { echo 'class="fas fa-user"';}
                  else if ($label === 'Reservation') { echo 'class="fas fa-calendar-plus"';} 
                  elseif ($label === 'Logout') { echo 'class="fas fa-sign-out-alt"';}    ?>></i>
          <?php echo $label ?>
      </a>
  <?php endforeach; ?>   
</div>

<div class="main-content">
  <?php

  // Get the count of available cars
  $availableCarsQuery = "SELECT COUNT(*) as count FROM car";
  $availableCarsResult = $conn->query($availableCarsQuery);
  $availableCarsCount = $availableCarsResult->fetch_assoc()['count'];
    // Get the count of customers
  $customersQuery = "SELECT COUNT(*) as count FROM customer";
  $customersResult = $conn->query($customersQuery);
  $customersCount = $customersResult->fetch_assoc()['count'];   
  ?>

  <div class="card">
    <h3>Available Cars</h3>
    <p>Number of cars available: <?php echo $availableCarsCount; ?></p>
  </div>

  <div class="card">
    <h3>Customers</h3>
    <p>Number of customers: <?php echo $customersCount; ?></p>
  </div>

</div>
</body>
</html>
