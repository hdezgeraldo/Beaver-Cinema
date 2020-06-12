-- Beaver Cinema 
-- Data Manipulation Queries
--
-- Host: classmysql.oregonstate.edu    Database: cs340_hernager
-- ------------------------------------------------------

/********************************************************
*	Data manipulations for "Orders.php" page
********************************************************/

-- add a new order
INSERT INTO orders (customer_id, credit_number, credit_exp, order_date) 
VALUES ($customerID, $creditNum, $creditExp, NOW())

-- get all movie information from a searched up actor using actor's first name
SELECT order_id FROM orders
WHERE customer_id=$customerID AND credit_number=$creditNum AND 
credit_exp=$creditExp

-- add a new row to relational table
INSERT INTO movie_orders (movie_id, order_id, quantity_ordered) 
	VALUES ($movieID, $orderID, 1)

-- get all movie id with their titles
SELECT movie_id, title FROM movies ORDER BY title

-- get all customer id with their full names
SELECT customer_id, first_name, last_name FROM customers ORDER BY first_name

-- get all row values relevant to a customer's order history 
SELECT o.order_id, o.order_date, c.first_name, c.last_name, o.credit_number, o.credit_exp, m.title, m.price FROM customers AS c
	INNER JOIN orders AS o ON o.customer_id=c.customer_id
	INNER JOIN movie_orders AS mo ON o.order_id=mo.order_id
	INNER JOIN movies AS m ON m.movie_id=mo.movie_id
	ORDER BY o.order_id

/********************************************************
*	Data manipulations for "Customers.php" page
********************************************************/

-- add a new customer
INSERT INTO customers (first_name, last_name, address, phone, email) 
	VALUES ('$first_name', '$last_name', '$address', $phone, '$email')

-- delete a customer
DELETE FROM customers WHERE customer_id=$id

-- get all information from the customers table
SELECT * FROM customers WHERE customer_id=$id

-- update any customer's information
UPDATE customers 
	SET first_name='$first_name', last_name='$last_name', address='$address', phone='$phone', email='$email' 
	WHERE customer_id=$id

-- get all information for a single customer matching an id
SELECT first_name, last_name, address, credit_number, credit_exp FROM customers AS c
	INNER JOIN orders AS o ON o.customer_id=c.customer_id
	WHERE c.customer_id=$id

/********************************************************
*	Data manipulations for "movie.php" page
********************************************************/

-- add a new movie 
INSERT INTO movies (title, price, num_stock, movie_description) 
	VALUES ('$mtitle', $mprice, $mstock, '$mdescription')

-- associate a movie with a genre
INSERT INTO movie_genres (movie_id, genre_id) 
	VALUES ($movieID, $genreID)

-- get all movies for dropdown
SELECT movie_id, title FROM movies ORDER BY title

-- get all genres for dropdown
SELECT genre_id, genre_name FROM genres ORDER BY genre_name

-- get all relevant movie information
SELECT m.title, g.genre_name, m.price, m.num_stock, m.movie_description FROM movies AS m
	LEFT JOIN movie_genres AS mg ON mg.movie_id=m.movie_id
	LEFT JOIN genres AS g ON g.genre_id=mg.genre_id
	ORDER BY m.title

/********************************************************
*	Data manipulations for "actor.php" page
********************************************************/

-- add a new actor
INSERT INTO actors (first_name, last_name, trademark, birth_location) 
	VALUES ('$afirst', '$alast', '$atrade', '$aorigin')

-- associate an actor to a movie
INSERT INTO movie_actors (movie_id, actor_id) 
	VALUES ($movieID, $actorID)

-- get all movies for dropdown
SELECT movie_id, title FROM movies ORDER BY title

-- get all actors for dropdown
SELECT actor_id, first_name, last_name FROM actors ORDER BY first_name

-- get all relevant actor information
SELECT a.first_name, a.last_name, COUNT(m.title) AS film_count, a.trademark, a.birth_location FROM actors AS a
	LEFT JOIN movie_actors AS ma ON ma.actor_id=a.actor_id
	LEFT JOIN movies AS m ON m.movie_id=ma.movie_id
	GROUP BY a.first_name

/********************************************************
*	Data manipulations for "genre.php" page
********************************************************/

-- add a new genre
INSERT INTO genres (genre_name) 
	VALUES ('$gname')

-- select all relevant genre information 
SELECT g.genre_name, COUNT(m.title) AS film_count FROM genres AS g
	LEFT JOIN movie_genres AS mg ON mg.genre_id=g.genre_id
	LEFT JOIN movies AS m ON m.movie_id=mg.movie_id
	GROUP BY g.genre_name
	ORDER BY g.genre_name
