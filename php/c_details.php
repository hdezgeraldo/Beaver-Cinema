<?php

$pageTitle = "Customer Details Page";
include("database/action.php");
include("templates/header.php");	?>

		<div class="container grid">
			<!-- Page header -->
			<div class="box title">
				<h2 class="title">Showing results for: <?= $vfirst . " " . $vlast; ?></h2>
				<hr>
			</div>
			<!-- Display table results -->
			<div class="box tbl-header">
				<table class="customer-table">
					<thead>
						<tr class="header-row">
							<th>First Name</th>
							<th>Last Name</th>
							<th>Address</th>
							<th>Credit Number</th>
							<th>Credit Expiration</th>
						</tr>
					</thead>
					<tbody>

						<tr>
							<td><?= $vfirst; ?></td>
							<td><?= $vlast; ?></td>
							<td><?= $vaddress; ?></td>
							<td><?= $vcredit; ?></td>
							<td><?= $vexp; ?></td>
						</tr>

					</tbody>
				</table>

			</div>
			
		</div>
	</div>


<?php include("templates/footer.php");	?>