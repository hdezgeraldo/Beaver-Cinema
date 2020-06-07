-- Beaver Cinema DB
--
-- Host: classmysql.oregonstate.edu    Database: cs340_***
-- ------------------------------------------------------

/********************************************************
*	Data manipulations for "search.php" page
********************************************************/

-- get all information from movies using the 'movie search' form
SELECT title, price, num_stock, movie_description FROM movie WHERE title = :title_ID_selected_from_search_bar

-- get all movie information from a searched up actor using actor's first name
SELECT m.movie_id, m.title FROM m
INNER JOIN movie_actor ON movie_actor.movie_id = movie.movie_id
INNER JOIN actor ON actor.actor_id = movie_actor.actor_id
WHERE actor.first_name = :actor_id_selected_from_search_bar
ORDER BY m.movie_id ASC;

/********************************************************
*	Data manipulations for "update.php" page
********************************************************/

-- add a new movie
INSERT INTO movie (title, price, num_stock, movie_description) VALUES (:titleInput, :priceInput, :numStockInput, :descriptionInput)

-- update a movie based on the table edit
UPDATE movie SET title = :titleInput, price = :priceInput, num_stock = :num_stock, m_description = :descriptionInput WHERE id = :movie_id_from_table_update_form

-- delete a character
DELETE FROM movie WHERE id = :movie_id_from_table_delete_form

/********************************************************
*	Data manipulations for "movie.php" page
********************************************************/

-- get all information from movies table
SELECT title, price, num_stock, movie_description FROM movie

/********************************************************
*	Data manipulations for "actor.php" page
********************************************************/

-- get all information from actors table
SELECT first_name, last_name FROM actor

/********************************************************
*	Data manipulations for "genre.php" page
********************************************************/

-- get all information from actors table
SELECT genre_name FROM genre