<?php

$pageTitle = "Movies Search Results Page";
include("database/db_connection.php");
include("templates/header.php");	
?>
        <div class="container grid">
        <?php
        // Establish connection to database
	    $conn = OpenCon();

        if(isset($_POST['movie'])){

            // set variables
            $vmovie_name = $_POST['movie'];

            // repalce anything that's not the first argument
            // $vmovie_name = preg_replace("#[^0-9a-z]#i","", $vmovie_name);

            // begin query
            $result = $conn->query("SELECT m.title, m.movie_description, g.genre_name, a.first_name, a.last_name 
            FROM movies AS m
            INNER JOIN movie_genres AS mg ON m.movie_id=mg.movie_id
            INNER JOIN genres AS g ON g.genre_id=mg.genre_id
            INNER JOIN movie_actors AS ma ON ma.movie_id=m.movie_id
            INNER JOIN actor AS a ON a.actor_id=ma.actor_id
            WHERE m.title = '$vmovie_name'") or die($conn->error);

            $count = $result->num_rows;

            if($count == 0){
                $output = "There was no search results!";
            }else{
                $row = $result->fetch_assoc();

                $mtitle = $row['title'];
                $mdescription = $row['movie_description'];
                $mgenre = $row['genre_name'];
                $mactor = $row['first_name'];
                $mlast = $row['last_name'];
            }
        }
        ?>
			<!-- Page header -->
			<div class="box title">
				<h2 class="title">Showing results for: <?= $mtitle . " " . $output; ?></h2>
				<hr>
			</div>
			<!-- Display table results -->
			<div class="box tbl-header">
				<table class="customer-table">
					<thead>
						<tr class="header-row">
							<th>Title</th>
							<th>Description</th>
							<th>Genre</th>
							<th>Starring Actor</th>
						</tr>
					</thead>
					<tbody>

						<tr>
							<td><?= $mtitle; ?></td>
							<td><?= $mdescription; ?></td>
							<td><?= $mgenre; ?></td>
							<td><?= $mactor." ".$mlast; ?></td>
						</tr>

					</tbody>
				</table>

			</div>
			
		</div>
	</div>


<?php include("templates/footer.php");	?>