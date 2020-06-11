<?php

$pageTitle = "Search Page";
include("database/action.php");
include("templates/header.php");	?>
		<!-- This is the start of CSS Grid style -->
		<div class="container grid">
			<!-- This is the page title -->
			<div class="box title">
				<h2 class="title">Orders Database</h2>
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
					<h3>Add a new Order</h3>
					
					<!-- Start query to obtain dropdown results for movies -->
					<?php
					$conn = OpenCon();
					$movie_result = $conn->query("SELECT movie_id, title FROM movies ORDER BY title") or die($conn->error);
					$customer_result = $conn->query("SELECT customer_id, first_name, last_name FROM customers ORDER BY first_name") or die($conn->error);
					?>

					<form action="database/action.php" method="POST" enctype="multipart/form-data">
							<div class="form-group">
								<h4>Select Movie</h4>
								<select class="dropdown-form" name="movie-dropdown">
									<!-- Generate query list and populate dropdown menu -->
									<?php
									while($rows = $movie_result->fetch_assoc()){
										$dd_movie_id = $rows['movie_id'];
										$dd_movie_title = $rows['title'];
										echo "<option value='$dd_movie_id'>$dd_movie_title</option>";
									}
									?>
								</select>
							</div>
							<div class="form-group">
								<h4>Select Customer</h4>
								<select class="dropdown-form" name="customer-dropdown">
									<!-- Generate query list and populate dropdown menu -->
									<?php
									while($rows = $customer_result->fetch_assoc()){
										$dd_customer_id = $rows['customer_id'];
										$dd_first = $rows['first_name'];
										$dd_last = $rows['last_name'];
										echo "<option value='$dd_customer_id'>$dd_first $dd_last</option>";
									}
									?>
								</select>
							</div>
							<div class="form-group">
								<h4>Enter Credit Card</h4>
								<input type="number" name="credit_number" class="form-control" placeholder="Enter credit card number (10 digits)" required>
							</div>
							<div class="form-group">
								<input type="number" name="credit_exp" class="form-control" placeholder="Enter credit card exp (MMYY)" required>
							</div>
							<div class="form-group">
								<input type="submit" class="button-submit" name="submit" value="Submit Order">
							</div>
					</form>
				</div>
				<!-- This is the Table section -->
				<div class="box tbl-header table-box">
					<h3>Order History</h3>
					<?php

						$mysqli = OpenCon();
						$result = $mysqli->query("SELECT o.order_id, o.order_date, c.first_name, c.last_name, o.credit_number, o.credit_exp, m.title, m.price FROM customers AS c
						LEFT JOIN orders AS o ON o.customer_id=c.customer_id
						LEFT JOIN movie_orders AS mo ON o.order_id=mo.order_id
						LEFT JOIN movies AS m ON m.movie_id=mo.movie_id") or die($mysqli->error);

					?>
					<table class="orders-table">
						<thead>
							<tr class="header-row">
								<th>Order #</th>
								<th>Order Date</th>
								<th>Customer</th>
								<th>CC Number</th>
								<th>CC Exp</th>
								<th>Item</th>
								<th>Total</th>
							</tr>
						</thead>
						
						<?php
							while ($row = $result->fetch_assoc()): ?>
								<tr>
									<td><?php echo $row['order_id']; ?></td>
									<td><?php echo $row['order_date']; ?></td>
									<td><?php echo $row['first_name']." ".$row['last_name']; ?></td>
									<td><?php echo $row['credit_number']; ?></td>
									<td><?php echo $row['credit_exp']; ?></td>
									<td><?php echo $row['title']; ?></td>
									<td>$<?php echo $row['price']; ?></td>
								</tr>
						<?php endwhile; ?>
						
					</table>
				</div>
			</div>
		</div>
	</div>

<?php include("templates/footer.php");	?>