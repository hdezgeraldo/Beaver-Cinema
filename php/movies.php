<?php

$pageTitle = "Movie Page";

include("templates/header.php");
include("database/db_connection.php");	?>
		<!-- outer grid -->
		<div class="container grid">
				<!-- Page header -->
				<div class="box title">
					<h2 class="title">Browse All Movies</h2>
					<hr>
				</div>
			<!-- inner grid -->
			<div class="grid-movie">
				<!-- Search "feature" -->
				<div class="box search">
					<input type="text" class="search-movie" placeholder="Enter movie name">
					<input type="submit" class="button-submit" value="Search">
				</div>

				<!-- Sort "feature" -->
				<div class="box sort">
					<form class="movie-sort" action="">
							<label for="genre-list">Filter by Genre:</label>
							<select class="genre-list" name="genre-list">
								<option value="action">Action</option>
								<option value="action">Adventure</option>
								<option value="comedy">Comedy</option>
								<option value="horror">Horror</option>
							</select>
							<input type="submit" class="button-submit" value="Submit">
					</form>
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

			<!-- Display table results -->
			<div class="box tbl-header">
				<?php
				$mysqli = OpenCon();
				$result = $mysqli->query("SELECT * FROM movies") or die($mysqli->error);

				?>
				<table class="movie-table">
					
					<thead>
						<tr class="header-row">
							<th>Title</th>
							<th>Price</th>
							<th>In Stock</th>
							<th>Descripition</th>
						</tr>
					</thead>
					<tbody>
					<?php	while ($row = $result->fetch_assoc()): ?>
						<tr>
							<td><?php echo $row['title']; ?></td>
							<td class="center-column"><?php echo '$'; echo $row['price']; ?></td>
							<td class="center-column"><?php echo $row['num_stock']; ?></td>
							<td><?php echo $row['movie_description']; ?></td>
						</tr>
					<?php endwhile; ?>
					</tbody>
				</table>

				<?php
				function pre_r( $array ){
					echo '<pre>';
					print_r($array);
					echo '</pre>';
				}
				?>
			</div>
		</div>
	</div>

<?php include("templates/footer.php");	?>