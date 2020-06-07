<?php

$pageTitle = "Update";
include("database/action.php");
include("templates/header.php");	?>
		<!-- This is the start of CSS Grid style -->
		<div class="container grid">
			<!-- This is the page title -->
			<div class="box title">
				<h2 class="title">Update Customer Database</h2>
				<hr>
				<?php	if(isset($_SESSION['response'])){	?>
				<div class="alert <?php echo $_SESSION['res_type']; ?>">
					<strong><?php echo $_SESSION['response']; ?></strong>
				</div>
				<?php } unset($_SESSION['response']); ?>
			</div>

			<div class="box box-update">
				<!-- This is the POST form section -->
				<div class="edit-customer-form">
					<h3>Add/Edit Customer</h3>
					
					<form action="action.php" method="POST" enctype="multipart/form-data">
							<input type="hidden" name="id" value="<?php echo $id; ?>">
							<div class="form-group">
								<input type="text" name="first_name" value="<?php echo $first_name; ?>" class="form-control" placeholder="Enter first name" required>
							</div>
							<div class="form-group">
								<input type="text" name="last_name" value="<?php echo $last_name; ?>" class="form-control" placeholder="Enter last name" required>
							</div>
							<div class="form-group">
								<input type="text" name="address" value="<?php echo $address; ?>" class="form-control" placeholder="Enter street, city, state, zip" required>
							</div>
							<div class="form-group">
								<input type="text" name="phone" value="<?php echo $phone; ?>" class="form-control" placeholder="Enter phone number" required>
							</div>
							<div class="form-group">
								<input type="text" name="email" value="<?php echo $email; ?>" class="form-control" placeholder="Enter email address" required>
							</div>
							<div class="form-group">
								<!-- check if user clicked "Edit" button -->
								<?php if($isEdit==true){ ?>
									<input type="submit" class="button-edit" name="edit" value="Submit Customer">
								
								<!-- else, default to "Submit" button for webpage -->
								<?php	}else{ ?>
									<input type="submit" class="button-submit" name="submit" value="Submit Changes">
								<?php	} ?>
							</div>
					</form>
				</div>
				<!-- This is the Table section -->
				<div class="box tbl-header table-box">
					<h3>Customers in Database</h3>
					<?php

						$mysqli = OpenCon();
						$result = $mysqli->query("SELECT * FROM customer") or die($mysqli->error);

					?>
					<table class="customer-table">
						<thead>
							<tr class="header-row">
								<th>First</th>
								<th>Last</th>
								<th>Address</th>
								<th>Phone</th>
								<th>Email</th>
								<th>Action</th>
							</tr>
						</thead>
						
						<?php
							while ($row = $result->fetch_assoc()): ?>
								<tr>
									<td><a href="#" class="name-button"><?php echo $row['first_name']; ?></a></td>
									<td><?php echo $row['last_name']; ?></td>
									<td><?php echo $row['address']; ?></td>
									<td><?php echo $row['phone']; ?></td>
									<td><?php echo $row['email']; ?></td>
									<td>
										<a href="update.php?edit=<?php echo $row['customer_id']; ?>" 
											class="edit-button">Edit</a>

										<a href="action.php?delete=<?php echo $row['customer_id']; ?>" 
											class="delete-button">Delete</a>
									</td>
								</tr>
						<?php endwhile; ?>
						
					</table>
				</div>
			</div>
		</div>
	</div>

<?php include("templates/footer.php");	?>