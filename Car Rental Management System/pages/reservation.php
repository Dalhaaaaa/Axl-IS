<?php
  include '../includes/db_conn.php';
?>
<!DOCTYPE html>
<html>
<head>
  <title>Dashboard</title>
  <link rel="stylesheet" type="text/css" href="../css/dashboard.css?v=p<?php echo time(); ?>">
  <link rel="stylesheet" type="text/css" href="../css/customer.css?v=p<?php echo time(); ?>">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
</head>
<body>
  <div class="container">
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

      <div class="content">
        <table>
          <thead>
              <tr>
                  <th>Reservation ID</th>
                  <th>Car Name</th>
                  <th>Customer Name</th>
                  <th>Pickup Location</th>
                  <th>Start Date</th>
                  <th>End Date</th>
                  <th>Action</th>
              </tr>
          </thead>
          <tbody>
          <?php
            $query = "SELECT r.reservation_id, r.car_id, r.customer_id, c.name, cu.first_name, cu.last_name, r.pickup_location, r.start_date, r.end_date
          FROM reservation r
          INNER JOIN car c ON r.car_id = c.car_id
          INNER JOIN customer cu ON r.customer_id = cu.customer_id";
            $result = mysqli_query($conn, $query);

            if (mysqli_num_rows($result) > 0) {
          ?>
            <?php
                // Fetching and displaying each row of data
                while ($row = mysqli_fetch_assoc($result)) {
            ?>
                    <tr>
                        <td><?php echo $row['reservation_id']; ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['first_name'] . ' ' . $row['last_name']; ?></td>
                        <td><?php echo $row['pickup_location']; ?></td>
                        <td><?php echo $row['start_date']; ?></td>
                        <td><?php echo $row['end_date']; ?></td>
                        <td>
                  <a href="#" onclick="openEditReservationModal('<?php echo htmlspecialchars(json_encode($row), ENT_QUOTES); ?>')">
                      <i class="fas fa-pencil-alt icon-pencil"></i>
                  </a>

                  <a href="#" onclick="openDeleteReservationModal('<?php echo $row['reservation_id']; ?>', '<?php echo $row['car_id']; ?>')">
                      <i class="fas fa-trash icon-trash"></i>
                  </a>
              </td>
                    </tr>
            <?php
                }
            ?>  
          <?php
          } else {
              echo "<tr><td colspan='8'>No reservations found.</td></tr>";
          }
          ?>
          </tbody>
          </table>

          <!-- Button to open the modal form -->
          <button id="openModalBtn" class="button" onclick="openAddReservationModal()">Add Reservation</button>


          <!-- Modal form -->
          <div id="add-reservation-modal" class="modal">
              <div class="modal-content">
                  <h3>Add Reservation</h3>
                  <form class="modal-form" action="reservation-add.php" method="post">
                      <select name="car_id" required>
                        <option value="">Select Car</option>
                        <?php
                          $carQuery = "SELECT * FROM car WHERE status = 'Available'";
                          $carResult = mysqli_query($conn, $carQuery);
                          while ($carRow = mysqli_fetch_assoc($carResult)) {
                            echo '<option value="' . $carRow['car_id'] . '">' . $carRow['name'] . '</option>';
                          }
                        ?>
                      </select>
                      <select name="customer_id" required>
                        <option value="">Select Customer</option>
                        <?php
                          $customerQuery = "SELECT * FROM customer";
                          $customerResult = mysqli_query($conn, $customerQuery);
                          while ($customerRow = mysqli_fetch_assoc($customerResult)) {
                            echo '<option value="' . $customerRow['customer_id'] . '">' . $customerRow['first_name'] . ' ' . $customerRow['last_name'] . '</option>';
                          }
                        ?>
                      </select>
                      <input type="text" name="pickup_location" placeholder="Pickup Location" required>
                      <input type="date" name="start_date" min="2023-06-16"  required>
                      <input type="date" name="end_date" min="2023-06-16"  required>
                      <div class="modal-buttons">
                      <input type="submit" value="Add">
                      <input type="button" value="Cancel"class="cancel-btn" onclick="closeAddReservationModal()">
                  </div>
                  </form>
              </div>
          </div>

          <!-- Edit Modal form -->
          <div id="edit-reservation-modal" class="modal">
              <div class="modal-content">
                  <h3>Edit Reservation</h3>
                  <form class="modal-form" action="reservation-update.php" method="post">
                    <input type="hidden" name="prev-car-id" id="prev-car-id">
                    <input type="hidden" name="reservation_id" id="editReservationId">
                      <select name="car_id" id="editCarId" required>
                        <option value="">Select Car</option>
                        <?php
                          $carQuery = "SELECT * FROM car WHERE status = 'Available'";
                          $carResult = mysqli_query($conn, $carQuery);
                          while ($carRow = mysqli_fetch_assoc($carResult)) {
                            echo '<option value="' . $carRow['car_id'] . '">' . $carRow['name'] . '</option>';
                          }
                        ?>
                      </select>
                      <select name="customer_id" id="editCustomerId" required>
                        <option value="">Select Customer</option>
                        <?php
                          $customerQuery = "SELECT * FROM customer";
                          $customerResult = mysqli_query($conn, $customerQuery);
                          while ($customerRow = mysqli_fetch_assoc($customerResult)) {
                            echo '<option value="' . $customerRow['customer_id'] . '">' . $customerRow['first_name'] . ' ' . $customerRow['last_name'] . '</option>';
                          }
                        ?>
                      </select>
                      <input type="text" name="pickup_location" id="editPickupLocation" required>
                      <input type="date" name="start_date" id="editStartDate" min="2023-06-16"  required>
                      <input type="date" name="end_date" id="editEndDate" min="2023-06-16"  required>
                      <div class="modal-buttons">
                      <input type="submit" value="Update">
                      <input type="button" value="Cancel"class="cancel-btn" onclick="closeEditReservationModal()">
                  </div>
                  </form>
              </div>
          </div>

          <!-- Delete Modal Form -->
          <div id="delete-reservation-modal" class="modal">
          <div class="modal-content">
              <h3>Delete Reservation</h3>
              <p>Are you sure you want to delete this reservation?</p>
              <form class="modal-form" action="reservation-delete.php" method="post">
                  <input type="hidden" id="deleteReservationId" name="reservation_id">
                  <input type="hidden" id="car-id" name="car-id">
                  <input type="submit" value="Delete">
                  <input type="button" onclick="closeDeleteReservationModal()" value="Cancel" class="cancel-btn">
                </form>
          </div>
      </div>

      </div>
    </div>
    
    <script>
    function openAddReservationModal() {
      document.getElementById("add-reservation-modal").style.display = "block";
    }
    function closeAddReservationModal() {
      document.getElementById("add-reservation-modal").style.display = "none";
    }

    function openEditReservationModal(reservationData) {
      document.getElementById("edit-reservation-modal").style.display = "block";

      var decodedData = JSON.parse(reservationData);
      document.getElementById("editReservationId").value = decodedData.reservation_id;
      document.getElementById("editCarId").value = decodedData.car_id;
      document.getElementById("prev-car-id").value = decodedData.car_id;
        document.getElementById("editCustomerId").value = decodedData.customer_id;
        document.getElementById("editPickupLocation").value = decodedData.pickup_location;
        document.getElementById("editStartDate").value = decodedData.start_date;
        document.getElementById("editEndDate").value = decodedData.end_date;
    }

    function closeEditReservationModal() {
      document.getElementById("edit-reservation-modal").style.display = "none";
    }

    function openDeleteReservationModal(reservationId, carId) {
      document.getElementById("delete-reservation-modal").style.display = "block";
      document.getElementById("deleteReservationId").value = reservationId;
      document.getElementById("car-id").value = carId;
    }

    function closeDeleteReservationModal() {
      document.getElementById("delete-reservation-modal").style.display = "none";
    }

    </script>
</body>
</html>
