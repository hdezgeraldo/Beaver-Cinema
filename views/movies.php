<?php

$pageTitle = "Movie Page";

include("header.php");
include("../backend/db_connection.php");	?>

		<div class="container grid">
			<div class="box title">
					<h2 class="title">Browse All Movies</h2>
					<hr>
				</div>
			<div class="box tbl-header">

			<form action="/action_page.php">
				<label for="genre-list">Display by Genre:</label>
				<select id="genre-list" name="genre-list">
					<option value="action">Action</option>
					<option value="action">Adventure</option>
					<option value="comedy">Comedy</option>
					<option value="horror">Horror</option>
				</select>
				<input type="submit" value="Submit">
			</form>
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

<?php include("footer.php");	?>