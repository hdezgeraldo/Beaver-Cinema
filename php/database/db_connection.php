<?php

function OpenCon(){
	$dbhost = "classmysql.engr.oregonstate.edu";
	$dbuser = "cs340_hernager";
	$dbpass = "6862";
	$db = "cs340_hernager";
	$conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);
	
	return $conn;
}
	
function CloseCon($conn){
	$conn -> close();
}

?>