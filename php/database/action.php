<?php
	session_start();
	include("db_connection.php");

	// Establish connection to database
	$conn = OpenCon();

	// Default variables
	$isEdit = false;

	/***********************************************************
	 * Type: HTTP POST method
	 * Webpage: orders.php
	 * Description: This will enter data from the Orders form.
	 * It will require input from two separate tables, and update
	 * the available stock from Movies.
	 **********************************************************/
	if(isset($_POST['submit-order'])){

		// set variables
		$movieID = $_POST['movie-dropdown'];
		$customerID = $_POST['customer-dropdown'];
		$creditNum = $_POST['credit_number'];
		$creditExp = $_POST['credit_exp'];

		// begin insertion query to `orders` table
		$conn->query("INSERT INTO orders (customer_id, credit_number, credit_exp, order_date) 
						VALUES ($customerID, $creditNum, $creditExp, NOW())")
						or die($conn->error);
		
		// begin order_id query
		$result = $conn->query("SELECT order_id FROM orders
					  WHERE customer_id=$customerID AND credit_number=$creditNum AND 
					  credit_exp=$creditExp")
					  or die($conn->error);
		$row = $result->fetch_assoc();
		$orderID = $row['order_id'];

		// begin insertion query to relational table
		$conn->query("INSERT INTO movie_orders (movie_id, order_id, quantity_ordered) 
						VALUES ($movieID, $orderID, 1)")
						or die($conn->error);

		// return to current page
		header('location:../orders.php');
		
		// success messages to echo at update.php
		$_SESSION['response']="SUCCESSFULLY INSERTED TO DB";
		$_SESSION['res_type']="success-alert";
	}

	/***********************************************************
	 * Type: HTTP POST method
	 * Webpage: customers.php
	 * Description: If the user enters values in the 'add new
	 * customers' form and presses submit, then values will be
	 * updated to the DB.
	 **********************************************************/
	if(isset($_POST['submit'])){

		// set variables
		$first_name = $_POST['first_name'];
		$last_name = $_POST['last_name'];
		$address = $_POST['address'];
		$phone = $_POST['phone'];
		$email = $_POST['email'];

		// begin query
		$conn->query("INSERT INTO customers (first_name, last_name, address, phone, email) 
						VALUES ('$first_name', '$last_name', '$address', $phone, '$email')")
						or die($conn->error);
		
		// return to current page
		header('location:../customers.php');
		
		// success messages to echo at update.php
		$_SESSION['response']="SUCCESSFULLY INSERTED TO DB";
		$_SESSION['res_type']="success-alert";
	}

	/***********************************************************
	 * Type: HTTP GET method
	 * Webpage: customers.php
	 * Description: This will delete a customer from the table
	 **********************************************************/
	if(isset($_GET['delete'])){

		// set variable
		$id = $_GET['delete'];

		// begin query
		$conn->query("DELETE FROM customers
					  WHERE customer_id=$id")
					  or die($conn->error);

		// return to current page
		header('location:../customers.php');

		// success messages to echo at update.php
		$_SESSION['response']="SUCCESSFULLY DELETED";
		$_SESSION['res_type']="delete-alert";
	}

	/***********************************************************
	 * Type: HTTP GET method
	 * Webpage: customers.php
	 * Description: This will obtain all information from the
	 * customer table to disply to the user
	 **********************************************************/
	if(isset($_GET['edit'])){
		// set variable
		$id = $_GET['edit'];
		// begin query
		$result = $conn->query("SELECT * FROM customers
					  WHERE customer_id=$id")
					  or die($conn->error);
		$row = $result->fetch_assoc();

		$id = $row['customer_id'];
		$first_name = $row['first_name'];
		$last_name = $row['last_name'];
		$address = $row['address'];
		$phone = $row['phone'];
		$email = $row['email'];

		$isEdit = true;
	}

	/***********************************************************
	 * Type: HTTP POST method
	 * Webpage: customers.php
	 * Description: This will allow the user to update any 
	 * customer's information.
	 **********************************************************/
	if(isset($_POST['edit'])){
		// set variables
		$id = $_POST['id'];	// hidden id variable
		$first_name = $_POST['first_name'];
		$last_name = $_POST['last_name'];
		$address = $_POST['address'];
		$phone = $_POST['phone'];
		$email = $_POST['email'];

		// begin update query
		$conn->query("UPDATE customers 
			SET first_name='$first_name', last_name='$last_name', address='$address', phone='$phone', email='$email' 
			WHERE customer_id=$id") or die($conn->error);

		// return to current page
		header('location:../customers.php');

		// success messages to echo at update.php
		$_SESSION['response']="SUCCESSFULLY UPDATED TO DB";
		$_SESSION['res_type']="success-alert";
	}

	/***********************************************************
	 * Type: HTTP GET method
	 * Webpage: customers.php and c_details.php
	 * Description: This will allow to select all the information
	 * for a specific customer matching the id
	 **********************************************************/
	if(isset($_GET['c_details'])){
		$id = $_GET['c_details'];
		$result = $conn->query("SELECT first_name, last_name, address, credit_number, credit_exp FROM customers AS c
		INNER JOIN orders AS o ON o.customer_id=c.customer_id
		WHERE c.customer_id=$id") or die($conn->error);
		$row = $result->fetch_assoc();

		//  Get all values from DB and store in variables
		$vid = $row['customer_id'];
		$vfirst = $row['first_name'];
		$vlast = $row['last_name'];
		$vaddress = $row['address'];
		$vcredit = $row['credit_number'];
		$vexp = $row['credit_exp'];
	}

	/***********************************************************
	 * Type: HTTP POST method
	 * Webpage: movies.php
	 * Description: This will retrieve values submitted from the
	 * 'Add Movie' form, and insert them into the database.
	 **********************************************************/
	if(isset($_POST['m-submit'])){

		// set variables
		$mtitle = $_POST['m-title'];
		$mprice = $_POST['m-price'];
		$mstock = $_POST['m-stock'];
		$mdescription = $_POST['m-description'];

		// begin query
		$conn->query("INSERT INTO movies (title, price, num_stock, movie_description) 
			VALUES ('$mtitle', $mprice, $mstock, '$mdescription')")
			or die($conn->error);
		
		// return to current page
		header('location:../movies.php');
		
		// success messages to echo at update.php
		$_SESSION['response']="SUCCESSFULLY INSERTED TO DB";
		$_SESSION['res_type']="success-alert";
	}

	/***********************************************************
	 * Type: HTTP POST method
	 * Webpage: movies.php
	 * Description: This will retrieve values submitted from the
	 * 'Associate Genre' form, and insert them into the database.
	 * This serves to insert into a relational table (M-M)
	 **********************************************************/
	if(isset($_POST['g-submit'])){

		// set variables
		$movieID = $_POST['movie-dropdown'];
		$genreID = $_POST['genre-dropdown'];

		// begin query
		$conn->query("INSERT INTO movie_genres (movie_id, genre_id) 
						VALUES ($movieID, $genreID)")
						or die($conn->error);
		
		// return to current page
		header('location:../movies.php');
		
		// success messages to echo at update.php
		$_SESSION['response']="SUCCESSFULLY ASSOCIATED M:M TABLE";
		$_SESSION['res_type']="success-alert";
	}

	/***********************************************************
	 * Type: HTTP POST method
	 * Webpage: actors.php
	 * Description: This will retrieve values submitted from the
	 * 'Add Actor' form, and insert them into the database.
	 **********************************************************/
	if(isset($_POST['add-actor-submit'])){

		// set variables
		$afirst = $_POST['a-first'];
		$alast = $_POST['a-last'];
		$atrade = $_POST['a-trademark'];
		$aorigin = $_POST['a-origin'];

		// begin query
		$conn->query("INSERT INTO actors (first_name, last_name, trademark, birth_location) 
						VALUES ('$afirst', '$alast', '$atrade', '$aorigin')")
						or die($conn->error);
		
		// return to current page
		header('location:../actors.php');
		
		// success messages to echo at update.php
		$_SESSION['response']="SUCCESSFULLY INSERTED TO DB";
		$_SESSION['res_type']="success-alert";
	}

	/***********************************************************
	 * Type: HTTP POST method
	 * Webpage: actors.php
	 * Description: This will retrieve values submitted from the
	 * 'Associate Movie' form, and insert them into the database.
	 * This serves to insert into a relational table (M-M)
	 **********************************************************/
	if(isset($_POST['assoc-a-submit'])){

		// set variables
		$movieID = $_POST['movie-dropdown'];
		$actorID = $_POST['actor-dropdown'];

		// begin query
		$conn->query("INSERT INTO movie_actors (movie_id, actor_id) 
						VALUES ($movieID, $actorID)")
						or die($conn->error);
		
		// return to current page
		header('location:../actors.php');
		
		// success messages to echo at update.php
		$_SESSION['response']="SUCCESSFULLY ASSOCIATED M:M TABLE";
		$_SESSION['res_type']="success-alert";
	}

	/***********************************************************
	 * Type: HTTP POST method
	 * Webpage: genres.php
	 * Description: This will insert a new genre
	 **********************************************************/
	if(isset($_POST['add-genre-submit'])){

		// set variables
		$gname = $_POST['a-genre'];

		// begin query
		$conn->query("INSERT INTO genres (genre_name) 
						VALUES ('$gname')")
						or die($conn->error);
		
		// return to current page
		header('location:../genres.php');
		
		// success messages to echo at update.php
		$_SESSION['response']="SUCCESSFULLY INSERTED TO DB";
		$_SESSION['res_type']="success-alert";
	}
?>