<?php

$pageTitle = "Actor Page";
include("header.php");
include("../backend/db_connection.php");	?>

		<div class="container grid">
			<div class="box title">
				<h2 class="title">Browse All Actors</h2>
				<hr>
			</div>
			<div class="row table">
				<form action="/action_page.php">
					<label for="actor-list">Sort by:</label>
					<select id="actor-list" name="actor-list">
						<option value="action">First Name</option>
						<option value="action">Last Name</option>
					</select>
					<input type="submit" value="Submit">
				</form>
				<?php
					$conn = OpenCon();
					$result = $conn->query("SELECT * FROM actor") or die($conn->error);
				?>
				<table class="actor-table">
					<thead>
						<tr class="header-row">
							<th>First Name</th>
							<th>Last Name</th>
							<th>Trademark</th>
							<th>Place of Origin</th>
						</tr>
					</thead>
					<?php
					while($row = $result->fetch_assoc()):
					?>
					<tr>
						<td><?php echo $row['first_name']; ?></td>
						<td><?php echo $row['last_name']; ?></td>
						<td><?php echo $row['trademark']; ?></td>
						<td><?php echo $row['birth_location']; ?></td>
					</tr>
					<?php endwhile; ?>
				</table>
			
				<?php
				function pre_r($array){
					echo '<pre>';
					print_r($array);
					echo '</pre>';
				}
				?>
			</div>
		</div>
	</div>

<?php include("footer.php");	?>