<?php

$pageTitle = "Movie Page";
include("templates/header.php");
include("database/action.php");	?>
		<!-- outer grid -->
		<div class="container grid">
			<!-- Page header -->
			<div class="box title">
				<h2 class="title">Browse All Movies <?php echo $movie; ?> </h2>
				<hr>
				<?php	if(isset($_SESSION['response'])){	?>
				<div class="alert <?php echo $_SESSION['res_type']; ?>">
					<strong><?php echo $_SESSION['response']; ?></strong>
				</div>
				<?php } unset($_SESSION['response']); ?>
			</div>
			<!-- inner grid -->
			<div class="grid-movie">
				<!-- Search "feature" -->
				<div class="box search">
					<form action="search_movies.php" method="POST">
						<input type="text" class="search-movie" name="movie" placeholder="Enter movie name">
						<input type="submit" class="button-submit" name="search-movie" value="Search">
					</form>
				</div>

				<!-- Sort "feature" -- implement at a later date -->
				<div class="box sort">
					<!-- <form class="movie-sort" action="">
							<label for="genre-list">Filter by Genre:</label>
							<select class="genre-list" name="genre-list">
								<option value="action">Action</option>
								<option value="adventure">Adventure</option>
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
					<form action="" class="form-container" method="POST" enctype="multipart/form-data">
						<input type="hidden" name="id" value="">
						<div class="form-group">
							<input type="text" name="m-title" value="" class="form-control" placeholder="Enter movie title" required>
						</div>
						<div class="form-group">
							<input type="text" name="m-price" value="" class="form-control" placeholder="Enter movie price ($)" required>
						</div>
						<div class="form-group">
							<input type="text" name="m-stock" value="" class="form-control" placeholder="Enter number of movies available" required>
						</div>
						<div class="form-group">
							<textarea type="text" name="m-description" id="mov-description" value="" class="form-control" placeholder="Enter movie description" required>
							</textarea>
						</div>
						<div class="form-group">
							<!-- else, default to "Submit" button for webpage -->
							<input type="submit" class="button-submit" name="m-submit" value="Submit Changes">
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