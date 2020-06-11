<?php

$pageTitle = "Genre Page";
include("templates/header.php");
include("database/action.php");	?>

		<div class="container grid">
			<div class="box title">
				<h2 class="title">Browse All Genres</h2>
				<hr>
				<?php	if(isset($_SESSION['response'])){	?>
				<div class="alert <?php echo $_SESSION['res_type']; ?>">
					<strong><?php echo $_SESSION['response']; ?></strong>
				</div>
				<?php } unset($_SESSION['response']); ?>
			</div>

			<!-- inner grid -->
			<div class="grid-movie">
				<div class="box">
					<!--  -->
				</div>

				<div class="box">
					<!--  -->
				</div>

				<!-- "Add Genre" feature -->
				<div class="box insert">
					<button onclick="openSecond()" class="button-submit movie-submit">Add Genre</button>
					<div class="movie-add-form second-form-popup">
					<h3>Add a new Genre</h3>
					<form action="" class="form-container" method="POST" enctype="multipart/form-data">
						<div class="form-group">
							<input type="text" name="a-genre" class="form-control" placeholder="Enter genre category" required>
						</div>
						<div class="form-group">
							<!-- else, default to "Submit" button for webpage -->
							<input type="submit" class="button-submit" name="add-genre-submit" value="Submit Genre">
							<button onclick="closeSecond()" class="button-submit">Close Form</button>
						</div>
					</form>
					</div>
				</div>

			</div>

			<div class="row table">
				<?php
					$conn = OpenCon();
					$result = $conn->query("SELECT g.genre_name, COUNT(m.title) AS film_count FROM genres AS g
					LEFT JOIN movie_genres AS mg ON mg.genre_id=g.genre_id
					LEFT JOIN movies AS m ON m.movie_id=mg.movie_id
					GROUP BY g.genre_name
					ORDER BY g.genre_name") or die($conn->error);
				?>
				<table class="actor-table">
					<thead>
						<tr class="header-row">
							<th>Genre</th>
							<th># of movies</th>
						</tr>
					</thead>
					<?php
					while($row = $result->fetch_assoc()):
					?>
					<tr>
						<td><?php echo $row['genre_name']; ?></td>
						<td><?php echo $row['film_count']; ?></td>
					</tr>
					<?php endwhile; ?>
				</table>
			</div>
		</div>
	</div>


<?php include("templates/footer.php");	?>