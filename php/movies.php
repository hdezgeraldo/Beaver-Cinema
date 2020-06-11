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

				<!-- Start query to obtain dropdown results for movies -->
				<?php
				$conn = OpenCon();
				$movie_result = $conn->query("SELECT movie_id, title FROM movies ORDER BY title") or die($conn->error);
				$genre_result = $conn->query("SELECT genre_id, genre_name FROM genres ORDER BY genre_name") or die($conn->error);
				?>

				<!-- "Associate Genre" feature -->
				<div class="box associate">
					<button onclick="openForm()" class="button-submit genre-submit">Associate Genre</button>
					<div class="movie-add-form form-popup">
						<h3>Associate a Genre</h3>
						<form action="" class="form-container" method="POST" enctype="multipart/form-data">
							<div class="form-group">
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
							<div>
								<select class="dropdown-form" name="genre-dropdown">
									<!-- Generate query list and populate dropdown menu -->
									<?php
									while($genre_rows = $genre_result->fetch_assoc()){
										$dd_genre_id = $genre_rows['genre_id'];
										$dd_genre_name = $genre_rows['genre_name'];
										echo "<option value='$dd_genre_id'>$dd_genre_name</option>";
									}
									?>
								</select>
							</div>
							
							<div class="form-group">
								<input type="submit" class="button-submit" name="g-submit" value="Associate">
								<button onclick="closeForm()" class="button-submit">Close Form</button>
							</div>
						</form>
					</div>
				</div>

				<!-- "Add Movie" feature -->
				<div class="box insert">
					<button onclick="openSecond()" class="button-submit movie-submit">Add Movie</button>
					<div class="movie-add-form second-form-popup">
					<h3>Add a new Movie</h3>
					<form action="" class="form-container" method="POST" enctype="multipart/form-data">
						<div class="form-group">
							<input type="text" name="m-title" class="form-control" placeholder="Enter movie title" required>
						</div>
						<div class="form-group">
							<input type="text" name="m-price" class="form-control" placeholder="Enter movie price ($)" required>
						</div>
						<div class="form-group">
							<input type="text" name="m-stock" class="form-control" placeholder="Enter number of movies available" required>
						</div>
						<div class="form-group">
							<textarea type="text" name="m-description" id="mov-description" class="form-control" placeholder="Enter movie description" required></textarea>
						</div>
						<div class="form-group">
							<!-- else, default to "Submit" button for webpage -->
							<input type="submit" class="button-submit" name="m-submit" value="Submit Changes">
							<button onclick="closeSecond()" class="button-submit">Close Form</button>
						</div>
					</form>
					</div>
				</div>
			</div>

			<!-- Display table results -->
			<div class="box tbl-header">
				<?php
				$mysqli = OpenCon();
				$result = $mysqli->query("SELECT m.title, g.genre_name, m.price, m.num_stock, m.movie_description FROM movies AS m
				LEFT JOIN movie_genres AS mg ON mg.movie_id=m.movie_id
				LEFT JOIN genres AS g ON g.genre_id=mg.genre_id
                ORDER BY m.title") or die($mysqli->error);

				?>
				<table class="movie-table">
					
					<thead>
						<tr class="header-row">
							<th>Title</th>
							<th>Genre</th>
							<th>Price</th>
							<th>In Stock</th>
							<th>Descripition</th>
						</tr>
					</thead>
					<tbody>
					<?php	while ($row = $result->fetch_assoc()): ?>
						<tr>
							<td><?php echo $row['title']; ?></td>
							<td><?php echo $row['genre_name']; ?></td>
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