<?php
	session_start();
	include("db_connection.php");
	$conn = OpenCon();

	$isEdit = false;

	// If user enters form data and hits submit
	if(isset($_POST['submit'])){

		// set variables
		$first_name = $_POST['first_name'];
		$last_name = $_POST['last_name'];
		$address = $_POST['address'];
		$phone = $_POST['phone'];
		$email = $_POST['email'];

		// begin query
		$conn->query("INSERT INTO customer (first_name, last_name, address, phone, email) 
						VALUES ('$first_name', '$last_name', '$address', $phone, '$email')")
						or die($conn->error);
		
		// return to current page
		header('location:update.php');
		
		// success messages to echo at update.php
		$_SESSION['response']="SUCCESSFULLY INSERTED TO DB";
		$_SESSION['res_type']="success-alert";
	}

	if(isset($_GET['delete'])){

		// set variable
		$id = $_GET['delete'];

		// begin query
		$conn->query("DELETE FROM customer
					  WHERE customer_id=$id")
					  or die($conn->error);

		// return to current page
		header('location:update.php');

		// success messages to echo at update.php
		$_SESSION['response']="SUCCESSFULLY DELETED";
		$_SESSION['res_type']="delete-alert";
	}

	if(isset($_GET['edit'])){
		// set variable
		$id = $_GET['edit'];
		// begin query
		$result = $conn->query("SELECT * FROM customer
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

	if(isset($_POST['edit'])){
		// set variables
		$id = $_POST['id'];	// hidden id variable
		$first_name = $_POST['first_name'];
		$last_name = $_POST['last_name'];
		$address = $_POST['address'];
		$phone = $_POST['phone'];
		$email = $_POST['email'];

		// begin update query
		$conn->query("UPDATE customer SET first_name='$first_name', last_name='$last_name', address='$address', phone='$phone', email='$email' WHERE customer_id=$id") or die($conn->error);

		// return to current page
		header('location:update.php');

		// success messages to echo at update.php
		$_SESSION['response']="SUCCESSFULLY UPDATED TO DB";
		$_SESSION['res_type']="success-alert";
	}

?>