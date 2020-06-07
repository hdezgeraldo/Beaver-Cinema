<?php

$pageTitle = "Home Page";

include("header.php");	?>
		<div class="container grid">
			<div class="box title">
				<h1 class="title">Trending this Week</h1>
			</div>
			<div class="box movies">
				<div class="movie-card">
					<img src="../styling/images/contagion.jpg" alt="contagion">
					<h3 class="trending"><a href="">View Details</a></h3>
				</div>
				<div class="movie-card">
					<img src="../styling/images/outbreak.jpg" alt="outbreak">
					<h3 class="trending"><a href="">View Details</a></h3>
				</div>
				<div class="movie-card">
					<img src="../styling/images/28dayslater.jpg" alt="28dayslater">
					<h3 class="trending"><a href="">View Details</a></h3>
				</div>
			</div>
		</div>
	</div>

<?php include("footer.php");	?>