<?php

$pageTitle = "Actor Page";
include("templates/header.php");
include("database/action.php");	?>

		<div class="container grid">
			<div class="box title">
				<h2 class="title">Browse All Actors</h2>
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
					<!--  -->
				</div>

				<!-- Start query to obtain dropdown results for movies -->
				<?php
				$conn = OpenCon();
				$movie_result = $conn->query("SELECT movie_id, title FROM movies ORDER BY title") or die($conn->error);
				$actor_result = $conn->query("SELECT actor_id, first_name, last_name FROM actors ORDER BY first_name") or die($conn->error);
				?>

				<!-- "Associate Movie" feature -->
				<div class="box associate">
					<button onclick="openForm()" class="button-submit genre-submit">Associate Movie</button>
					<div class="movie-add-form form-popup">
						<h3>Associate an Actor to a Movie</h3>
						<form action="" class="form-container" method="POST" enctype="multipart/form-data">
							<input type="hidden" name="id" value="">
							<div class="form-group">
								<select class="dropdown-form" name="movie-dropdown">
									<!-- Generate movie list and populate dropdown menu -->
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
								<select class="dropdown-form" name="actor-dropdown">
									<!-- Generate actor list and populate dropdown menu -->
									<?php
									while($actor_rows = $actor_result->fetch_assoc()){
										$dd_actor_id = $actor_rows['actor_id'];
										$dd_first_name = $actor_rows['first_name'];
										$dd_last_name = $actor_rows['last_name'];
										echo "<option value='$dd_actor_id'>$dd_first_name $dd_last_name</option>";
									}
									?>
								</select>
							</div>
							<div class="form-group">
								<input type="submit" class="button-submit" name="assoc-a-submit" value="Associate">
								<button onclick="closeForm()" class="button-submit">Close Form</button>
							</div>
						</form>
					</div>
				</div>

				<!-- "Add Actor" feature -->
				<div class="box insert">
					<button onclick="openSecond()" class="button-submit movie-submit">Add Actor</button>
					<div class="movie-add-form second-form-popup">
					<h3>Add a new Actor</h3>
					<form action="" class="form-container" method="POST" enctype="multipart/form-data">
						<div class="form-group">
							<input type="text" name="a-first" class="form-control" placeholder="Enter first name" required>
						</div>
						<div class="form-group">
							<input type="text" name="a-last" class="form-control" placeholder="Enter last name" required>
						</div>
						<div class="form-group">
							<input type="text" name="a-trademark" class="form-control" placeholder="Enter trademark" required>
						</div>
						<div class="form-group">
							<input type="text" name="a-origin" class="form-control" placeholder="Enter city of origin" required>
						</div>
						<div class="form-group">
							<!-- else, default to "Submit" button for webpage -->
							<input type="submit" class="button-submit" name="add-actor-submit" value="Submit Changes">
							<button onclick="closeSecond()" class="button-submit">Close Form</button>
						</div>
					</form>
					</div>
				</div>

			</div>

			<div class="row table">
				<?php
					$conn = OpenCon();
					$result = $conn->query("SELECT a.first_name, a.last_name, COUNT(m.title) AS film_count, a.trademark, a.birth_location FROM actors AS a
					LEFT JOIN movie_actors AS ma ON ma.actor_id=a.actor_id
					LEFT JOIN movies AS m ON m.movie_id=ma.movie_id
					GROUP BY a.first_name;") or die($conn->error);
				?>
				<table class="actor-table">
					<thead>
						<tr class="header-row">
							<th>Name</th>
							<th># of movies</th>
							<th>Trademark</th>
							<th>Place of Origin</th>
						</tr>
					</thead>
					<?php
					while($row = $result->fetch_assoc()):
					?>
					<tr>
						<td><?php echo $row['first_name']." ".$row['last_name']; ?></td>
						<td><?php echo $row['film_count']; ?></td>
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