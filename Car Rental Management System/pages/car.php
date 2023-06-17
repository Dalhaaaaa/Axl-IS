<?php 
    include "../includes/db_conn.php";
  ?>
  <!DOCTYPE html>
  <html>
  <head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" type="text/css" href="../css/car.css?v=p<?php echo time(); ?>">
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
      <button id="add-cars-btn" onclick="openAddCarsModal()">
        <svg height="36px" width="36px" viewBox="0 0 36 36" xmlns="http://www.w3.org/2000/svg">
            <rect fill="#fdd835" y="0" x="0" height="36" width="36"></rect>
            <path d="M38.67,42H11.52C11.27,40.62,11,38.57,11,36c0-5,0-11,0-11s1.44-7.39,3.22-9.59 c1.67-2.06,2.76-3.48,6.78-4.41c3-0.7,7.13-0.23,9,1c2.15,1.42,3.37,6.67,3.81,11.29c1.49-0.3,5.21,0.2,5.5,1.28 C40.89,30.29,39.48,38.31,38.67,42z" fill="#e53935"></path>
            <path d="M39.02,42H11.99c-0.22-2.67-0.48-7.05-0.49-12.72c0.83,4.18,1.63,9.59,6.98,9.79 c3.48,0.12,8.27,0.55,9.83-2.45c1.57-3,3.72-8.95,3.51-15.62c-0.19-5.84-1.75-8.2-2.13-8.7c0.59,0.66,3.74,4.49,4.01,11.7 c0.03,0.83,0.06,1.72,0.08,2.66c4.21-0.15,5.93,1.5,6.07,2.35C40.68,33.85,39.8,38.9,39.02,42z" fill="#b71c1c"></path>
            <path d="M35,27.17c0,3.67-0.28,11.2-0.42,14.83h-2C32.72,38.42,33,30.83,33,27.17 c0-5.54-1.46-12.65-3.55-14.02c-1.65-1.08-5.49-1.48-8.23-0.85c-3.62,0.83-4.57,1.99-6.14,3.92L15,16.32 c-1.31,1.6-2.59,6.92-3,8.96v10.8c0,2.58,0.28,4.61,0.54,5.92H10.5c-0.25-1.41-0.5-3.42-0.5-5.92l0.02-11.09 c0.15-0.77,1.55-7.63,3.43-9.94l0.08-0.09c1.65-2.03,2.96-3.63,7.25-4.61c3.28-0.76,7.67-0.25,9.77,1.13 C33.79,13.6,35,22.23,35,27.17z" fill="#212121"></path>
            <path d="M17.165,17.283c5.217-0.055,9.391,0.283,9,6.011c-0.391,5.728-8.478,5.533-9.391,5.337 c-0.913-0.196-7.826-0.043-7.696-5.337C9.209,18,13.645,17.32,17.165,17.283z" fill="#01579b"></path>
            <path d="M40.739,37.38c-0.28,1.99-0.69,3.53-1.22,4.62h-2.43c0.25-0.19,1.13-1.11,1.67-4.9 c0.57-4-0.23-11.79-0.93-12.78c-0.4-0.4-2.63-0.8-4.37-0.89l0.1-1.99c1.04,0.05,4.53,0.31,5.71,1.49 C40.689,24.36,41.289,33.53,40.739,37.38z" fill="#212121"></path>
            <path d="M10.154,20.201c0.261,2.059-0.196,3.351,2.543,3.546s8.076,1.022,9.402-0.554 c1.326-1.576,1.75-4.365-0.891-5.267C19.336,17.287,12.959,16.251,10.154,20.201z" fill="#81d4fa"></path>
            <path d="M17.615,29.677c-0.502,0-0.873-0.03-1.052-0.069c-0.086-0.019-0.236-0.035-0.434-0.06 c-5.344-0.679-8.053-2.784-8.052-6.255c0.001-2.698,1.17-7.238,8.986-7.32l0.181-0.002c3.444-0.038,6.414-0.068,8.272,1.818 c1.173,1.191,1.712,3,1.647,5.53c-0.044,1.688-0.785,3.147-2.144,4.217C22.785,29.296,19.388,29.677,17.615,29.677z M17.086,17.973 c-7.006,0.074-7.008,4.023-7.008,5.321c-0.001,3.109,3.598,3.926,6.305,4.27c0.273,0.035,0.48,0.063,0.601,0.089 c0.563,0.101,4.68,0.035,6.855-1.732c0.865-0.702,1.299-1.57,1.326-2.653c0.051-1.958-0.301-3.291-1.073-4.075 c-1.262-1.281-3.834-1.255-6.825-1.222L17.086,17.973z" fill="#212121"></path>
            <path d="M15.078,19.043c1.957-0.326,5.122-0.529,4.435,1.304c-0.489,1.304-7.185,2.185-7.185,0.652 C12.328,19.467,15.078,19.043,15.078,19.043z" fill="#e1f5fe"></path>
        </svg>
        <span class="now">Cars!</span>
        <span class="play">Add</span>
      </button>
      <div class="cards-container">
        <?php
        // Query to retrieve car data
        $sql = "SELECT * FROM car";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
          // Loop through each row in the result set
          while ($row = $result->fetch_assoc()) {
            $cid = htmlspecialchars($row['car_id']);
            $cname = htmlspecialchars($row['name']);
            $model = htmlspecialchars($row['model']);
            $year = htmlspecialchars($row['year']);
            $make = htmlspecialchars($row['made']);
            $color = htmlspecialchars($row['color']);
            $status = htmlspecialchars($row['status']);
            $rental_rate = htmlspecialchars($row['rental_rate']);
            $image = $row['image'];
            ?>
            <div class="card">
              <img src="data:image/jpeg;base64,<?php echo base64_encode($image); ?>" alt="Car Image">
              <h2><?php echo $cname; ?></h2>
              <h3><?php echo $model; ?></h3>
              <p>Year: <?php echo $year; ?></p>
              <p>Make: <?php echo $make; ?></p>
              <p>Color: <?php echo $color; ?></p>
              <p>Status: <span style="color: blue; font-weight: bold;" class="status"><?php echo $status; ?></span></p>
              <p>Rental Rate: ₱ <?php echo $rental_rate; ?> per hour </p>
              <div class="car-btn-container">
                <?php if ($status != 'Booked') { ?>
                  <button id="edit-cars-btn" onclick="openEditCarsModal('<?php echo $cid; ?>', '<?php echo $cname; ?>', '<?php echo $model; ?>', '<?php echo $year; ?>', '<?php echo $make; ?>', '<?php echo $color; ?>', '<?php echo $status; ?>', '<?php echo $rental_rate; ?>')"><i class="fas fa-edit"></i></button>
                <?php } ?>
                <button id="delete-cars-btn" onclick="openDeleteCarsModal('<?php echo $cid; ?>')"><i class="fas fa-trash"></i></button>
              </div>
            </div>
        <?php
          }
        } else {
          echo "No cars found.";
        }
        ?>
      </div>
    </div>

    <!-- Modal form -->
    <div id="add-cars-modal" class="modal">
        <div class="modal-content">
            <h3>Add Cars</h3>
            <form class="modal-form" action="car-add.php" method="post" enctype="multipart/form-data">
                <input type="text" name="car-name" placeholder="Car Name" required>
                <input type="text" name="car-model" placeholder="Car Model" required>
                <input type="date" name="year" placeholder="Year" required>
                <input type="text" name="made" placeholder="Made" required>
                <input type="text" name="color" placeholder="Color" required>
                <input type="number" name="rental-rate" placeholder="Rental Rate" required>
                <input type="file" name="car-image" accept="image/*">
                <!-- Add more inputs here as needed -->
                <div class="modal-buttons">
                  <input type="submit" value="Add">
                  <input type="button" value="Cancel"class="cancel-btn" onclick="closeAddCarsModal()">
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Modal forms -->
    <div id="edit-car-modal" class="modal">
      <div class="modal-content">
        <h3>Edit Car</h3>
        <form class="modal-form" action="car-edit.php" method="post" enctype="multipart/form-data">
          <input type="hidden" name="car_id" id="edit-car-id" value="">
          <input type="text" name="name" id="edit-car-name" value="" placeholder="Name" required>
          <input type="text" name="model" id="edit-car-model" value="" placeholder="Model" required>
          <input type="text" name="year" id="edit-car-year" value="" placeholder="Year" required>
          <input type="text" name="make" id="edit-car-make" value="" placeholder="Make" required>
          <input type="text" name="color" id="edit-car-color" value="" placeholder="Color" required>
          <select name="status" id="edit-car-status">
            <option value="Available">Available</option>
            <option value="Under Maintenance">Under Maintenance</option>
          </select>
          <input type="text" name="rental_rate" id="edit-car-rental-rate" value="" placeholder="Rental Rate" required>
          <input type="file" name="car-image" id="car-image" accept="image/*">
          <div class="modal-buttons">
            <input type="submit" value="Update" name="update-car">
            <input type="button" value="Cancel" class="cancel-btn" onclick="closeEditCarsModal()">
          </div>
        </form>
      </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="delete-car-modal" class="modal">
      <div class="modal-content">
        <h3>Delete Car</h3>
        <p>Are you sure you want to delete this car?</p>
        <form class="modal-form" action="car-delete.php" method="post">
          <input type="hidden" name="car_id" id="delete-car-id">
          <div class="modal-buttons">
            <input type="submit" value="Delete" name="delete-car">
            <input type="button" value="Cancel" class="cancel-btn" onclick="closeDeleteCarsModal()">
          </div>
        </form>
      </div>
    </div>

    <script>
      function openAddCarsModal() {
        document.getElementById("add-cars-modal").style.display = "block";
      }

      function closeAddCarsModal() {
        document.getElementById("add-cars-modal").style.display = "none";
      }

      function openEditCarsModal(cId, cname, model, year, make, color, status, rentalRate) {
        document.getElementById("edit-car-modal").style.display = "block";
        // Set the input values based on the car's information
        document.getElementById("edit-car-id").value = cId;
        document.getElementById("edit-car-name").value = cname;
        document.getElementById("edit-car-model").value = model;
        document.getElementById("edit-car-year").value = year;
        document.getElementById("edit-car-make").value = make;
        document.getElementById("edit-car-color").value = color;
        document.getElementById("edit-car-status").value = status;
        document.getElementById("edit-car-rental-rate").value = rentalRate;
      }

      function closeEditCarsModal() {
        document.getElementById("edit-car-modal").style.display = "none";
      }

      function openDeleteCarsModal(cId) {
        document.getElementById("delete-car-modal").style.display = "block";
        document.getElementById("delete-car-id").value = cId;
      }

      function closeDeleteCarsModal() {
        document.getElementById("delete-car-modal").style.display = "none";
      }

      // Add this function to your JavaScript code
      function updateStatusColor() {
        var statusElements = document.getElementsByClassName('status');
        for (var i = 0; i < statusElements.length; i++) {
          var status = statusElements[i].innerHTML;
          if (status === 'Available') {
            statusElements[i].style.color = 'green';
          } else if (status === 'Booked') {
            statusElements[i].style.color = 'orange';
          } else if (status === 'Under Maintenance') {
            statusElements[i].style.color = 'red';
          } else {
            statusElements[i].style.color = 'black';
          }
        }
      }

      // Call the updateStatusColor() function after the cards are loaded or when the status is updated
      updateStatusColor();

    </script>
  </body>
  </html>