<?php

try {
    $dbhost = "classmysql.engr.oregonstate.edu";
    $dbuser = "cs340_hernager";
    $dbpass = "6862";
    $db = "cs340_hernager";

    // create instance of PDO and pass MySQL info to constructor
    $dbh = new PDO("mysql:host=$dbhost;dbname=$db", $dbuser, $dbpass);
    // force an Exception to display successful connection
    $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

} catch (Exception $e) {
    echo "Unable to connect";
    // call Exception method to get the error message
    echo $e->getMessage();
    exit;
}

try {
    // run statement you want to run
    $query = 'SELECT title, price FROM movies';
    $results = $dbh->query($query);

} catch (Exception $e) {
    echo "Unable to retrieve results";
    exit;
}

$catalog = $results->fetchAll();

?>

