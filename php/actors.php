<?php

$pageTitle = "Actor Page";
include("templates/header.php");
include("database/db_connection.php");	?>

		<div class="container grid">
			<div class="box title">
				<h2 class="title">Browse All Actors</h2>
				<hr>
			</div>

			<!-- inner grid -->
			<div class="grid-movie">
				<!-- Search "feature" -->
				<div class="box search">
					<!--  -->
				</div>

				<!-- Sort "feature" -->
				<div class="box sort">
					<!-- <form class="movie-sort" action="">
							<label for="genre-list">Filter by Genre:</label>
							<select class="genre-list" name="genre-list">
								<option value="action">Action</option>
								<option value="action">Adventure</option>
								<option value="comedy">Comedy</option>
								<option value="horror">Horror</option>
							</select>
							<input type="submit" class="button-submit" value="Submit">
					</form> -->
				</div>

				<!-- Insert "feature -->
				<div class="box insert">
					<button onclick="openForm()" class="button-submit movie-submit">Add Movie</button>
					<div class="movie-add-form form-popup">
					<h3>Add a new Movie</h3>
					<form action="action.php" class="form-container" method="POST" enctype="multipart/form-data">
						<input type="hidden" name="id" value="<?php echo $id; ?>">
						<div class="form-group">
							<input type="text" name="first_name" value="<?php echo $first_name; ?>" class="form-control" placeholder="Enter movie title" required>
						</div>
						<div class="form-group">
							<input type="text" name="last_name" value="<?php echo $last_name; ?>" class="form-control" placeholder="Enter movie price ($)" required>
						</div>
						<div class="form-group">
							<input type="text" name="address" value="<?php echo $address; ?>" class="form-control" placeholder="Enter number of movies available" required>
						</div>
						<div class="form-group">
							<input type="text" name="phone" id="mov-description" value="<?php echo $phone; ?>" class="form-control" placeholder="Enter movie description" required>
						</div>
						<div class="form-group">
							<!-- check if user clicked "Edit" button -->
							<?php if($isEdit==true){ ?>
							<input type="submit" class="button-edit" name="edit" value="Submit Customer">
							
							<!-- else, default to "Submit" button for webpage -->
							<?php	}else{ ?>
							<input type="submit" class="button-submit" name="submit" value="Submit Changes">
							<?php	} ?>
							<button onclick="closeForm()" class="button-submit">Close Form</button>
						</div>
					</form>
					</div>
				</div>
			</div>

			<div class="row table">
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

<?php include("templates/footer.php");	?>