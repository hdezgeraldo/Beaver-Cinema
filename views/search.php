<?php

/****************************************************
 * MIGHT DELETE PAGE AND ADD IT TO 'BROWSE' PAGES *
****************************************************/

$pageTitle = "Search Page";

include("header.php");	?>

		<div class="container grid">
			<div>
				<h1>Search Movies</h1>
			</div>
			<div class="search movieDb">
				<input type="text" class="searchTerm" placeholder="Enter Movie Title">
				<button type="submit" class="searchButton">
					<i class="fa fa-search">
					</i>
				</button>
			</div>
			<div>
				<h1>Search Actors</h1>
			</div>
			<div class="search actorDb">
				<input type="text" class="searchTerm" placeholder="Enter Actor's First Name">
				<button type="submit" class="searchButton">
					<i class="fa fa-search">
					</i>
				</button>
			</div>
		</div>
	</div>


<?php include("footer.php");	?>