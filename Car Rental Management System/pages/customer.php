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
			            <th>First Name</th>
			            <th>Last Name</th>
			            <th>Phone Number</th>
			            <th>Email Address</th>
			            <th>Action</th>
			            <!-- Add more columns here as needed -->
			        </tr>
			    </thead>
			    <tbody>
	        <?php
            $query = "SELECT * FROM customer";
            $result = mysqli_query($conn, $query);

            if (mysqli_num_rows($result) > 0) {
	        ?>
		        <?php
		            // Fetching and displaying each row of data
		            while ($row = mysqli_fetch_assoc($result)) {
		        ?>
		                <tr>
		                    <td><?php echo $row['first_name']; ?></td>
		                    <td><?php echo $row['last_name']; ?></td>
		                    <td><?php echo $row['phone_number']; ?></td>
		                    <td><?php echo $row['email']; ?></td>
		                    <td>
							    <a href="#" onclick="openEditCustomerModal('<?php echo htmlspecialchars(json_encode($row), ENT_QUOTES); ?>')"><i class="fas fa-pencil-alt icon-pencil"></i>
								</a>

							    <a href="#" onclick="openDeleteCustomerModal('<?php echo $row['customer_id']; ?>')">
							        <i class="fas fa-trash icon-trash"></i>
							    </a>
							</td>
		                </tr>
		        <?php
		            }
		        ?>	
					<?php
					} else {
					    echo " ";
					}
					?>
					</tbody>
					</table>

					<!-- Button to open the modal form -->
					<button id="openModalBtn" class="button" onclick="openAddCustomerModal()">Add Customer</button>


	        <!-- Modal form -->
	        <div id="add-customer-modal" class="modal">
	            <div class="modal-content">
	                <h3>Add Customer</h3>
	                <form class="modal-form" action="customer-add.php" method="post">
	                    <input type="text" name="first_name" placeholder="First Name" required>
	                    <input type="text" name="last_name" placeholder="Last Name" required>
	                    <input type="text" name="phone_number" placeholder="Phone Number" required>
	                    <input type="email" name="email" placeholder="Email Address" required>
	                    <!-- Add more inputs here as needed -->
	                    <div class="modal-buttons">
			                <input type="submit" value="Add">
			                <input type="button" value="Cancel"class="cancel-btn" onclick="closeAddCustomerModal()">
			            </div>
	                </form>
	            </div>
	        </div>

	        <!-- Edit Modal form -->
	        <div id="edit-customer-modal" class="modal">
	            <div class="modal-content">
	                <h3>Add Customer</h3>
	                <form class="modal-form" action="customer-update.php" method="post">
	                	<input type="hidden" name="customer_id" id="editCustomerId">
	                    <input type="text" name="first_name" id="editFirstName" required>
	                    <input type="text" name="last_name" id="editLastName" required>
	                    <input type="text" name="phone_number" id="editPhoneNumber" required>
	                    <input type="email" name="email" id="editEmail" required>
	                    <!-- Add more inputs here as needed -->
	                    <div class="modal-buttons">
			                <input type="submit" value="Update">
			                <input type="button" value="Cancel"class="cancel-btn" onclick="closeEditCustomerModal()">
			            </div>
	                </form>
	            </div>
	        </div>

	        <!-- Delete Modal Form -->
	        <div id="delete-customer-modal" class="modal">
		    <div class="modal-content">
		        <h3>Delete Customer</h3>
		        <p>Are you sure you want to delete this customer?</p>
		        <form class="modal-form" action="customer-delete.php" method="post">
		            <input type="hidden" id="deleteCustomerId" name="customer_id">
		            <input type="submit" value="Delete">
		            <input type="button" onclick="closeDeleteCustomerModal()" value="Cancel" class="cancel-btn">
		        </form>
		    </div>
		</div>

	    </div>
    </div>
    
    <script>
		function openAddCustomerModal() {
			document.getElementById("add-customer-modal").style.display = "block";
		}
		function closeAddCustomerModal() {
			document.getElementById("add-customer-modal").style.display = "none";
		}

		function openEditCustomerModal(customerData) {
			document.getElementById("edit-customer-modal").style.display = "block";

			var decodedData = JSON.parse(customerData);
			document.getElementById("editCustomerId").value = decodedData.customer_id;
		    document.getElementById("editFirstName").value = decodedData.first_name;
		    document.getElementById("editLastName").value = decodedData.last_name;
		    document.getElementById("editPhoneNumber").value = decodedData.phone_number;
		    document.getElementById("editEmail").value = decodedData.email;
		}

		function closeEditCustomerModal() {
			document.getElementById("edit-customer-modal").style.display = "none";
		}

		function openDeleteCustomerModal(customerId) {
			document.getElementById("delete-customer-modal").style.display = "block";
			document.getElementById("deleteCustomerId").value = customerId;
		}

		function closeDeleteCustomerModal() {
			document.getElementById("delete-customer-modal").style.display = "none";
		}

    </script>
</body>
</html>
