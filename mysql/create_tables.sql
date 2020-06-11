-- Beaver Cinema DB
--
-- Host: classmysql.oregonstate.edu    Database: cs340_***
-- ------------------------------------------------------

--
-- Table structure for table `customers`
--
DROP TABLE IF EXISTS `customers`;
CREATE TABLE `customers` (
	`customer_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
	`first_name` varchar(45) NOT NULL,
	`last_name` varchar(45) NOT NULL,
	`address` varchar(45) NOT NULL,
	`phone` varchar(50) DEFAULT NULL,
	`email` varchar(50) DEFAULT NULL,
	PRIMARY KEY (`customer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

--
-- Insertion queries for table `customers`
--
LOCK TABLES `customers` WRITE;
INSERT INTO `customers` VALUES (1,'Jimmy', 'John', '4134 Monroe Ave, Corvallis, OR 97330', 5034150290, 'jjohn@gmail.com'), (2,'Carla', 'Ruiz', '4153 Jefferson Ave, Portland, OR 97230', 5034150146, 'carlaruiz@gmail.com'), (3,'Joseph', 'McTavern', '2351 Paola Drive, Beaverton, OR 97204', 5034150913, 'josephtavern@gmail.com'), (4,'Miguel', 'Espinoza', '12315 Stark Street, Gresham, OR 97033', 5039310492, 'migueltheking@gmail.com'), (5,'Leonardo', 'Robertson', '1951 Stone Drive, Portland, OR 97230', 5034157592, 'leonardoception@gmail.com');
UNLOCK TABLES;

--
-- Table structure for table `orders`
--
DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
	`order_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
	`customer_id` int(11) unsigned,
	`credit_number` int(11) NOT NULL,
	`credit_exp` int(11) NOT NULL,
	`order_date` datetime NOT NULL,
	PRIMARY KEY (`order_id`),
	CONSTRAINT `fk_order_customer` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

--
-- Insertion queries for table `orders`
--
LOCK TABLES `orders` WRITE;
INSERT INTO `orders` VALUES (1, 1, 1234567812, 0824, '2020-01-02'), (2, 5, 1234523456, 1024, '2020-03-25'), (3, 2, 1867812345, 1222, '2020-04-15'), (4, 3, 1863456778, 0622, '2020-03-22'), (5, 4, 941234567, 0323, '2020-01-29');
UNLOCK TABLES;

--
-- Table structure for table `movies`
--
DROP TABLE IF EXISTS `movies`;
CREATE TABLE `movies` (
	`movie_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
	`title` varchar(255) NOT NULL,
	`price` decimal(5,2) NOT NULL DEFAULT '5.99',
	`num_stock` int(11) unsigned DEFAULT NULL,
	`movie_description` text,
	PRIMARY KEY (`movie_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;


--
-- Create a trigger to automatically insert 'num_stock' value every time an INSERT
-- occurs in 'movie_orders'
--
-- CREATE TRIGGER `stock_integrity` BEFORE INSERT
-- ON test1
-- FOR EACH ROW
-- 	SET NEW.number3=NEW.number1+NEW.number2;


--
-- Insertion queries for table `movies`
--
LOCK TABLES `movies` WRITE;
INSERT INTO `movies` VALUES (1, 'Contagion', 7.99, 20, 'A virus unleashes onto an unprepared world.'), (2, 'The Happening', 5.99, 6, 'A science teacher survives a pleague with a twist at the end'), (3, 'Warm Bodies', 9.00, 20, 'A zombie outbreak with a hint of heart and romance.'), (4, 'The Day After Tomorrow', 10.00, 15, 'A father searches for his son amidst a global weather disaster'), (5, 'World War Z', 6.50, 10, 'Brad Pitt investigates a deadly global virus that turns its victims into monsters'), (6, 'Andromeda Strain', 6.99, 12, 'A group of scientists investigate a deadl virus in a small town'), (7, 'Quarantine', 10.00, 20, 'A TV reporter is trapped in a building with an infectious disease'), (8, 'I Am Legend', 12.00, 25, 'A man and his dog attempt to find a cure to a deadly global outbreak'), (9, 'It Comes At Night', 2.99, 4, 'A family surviving an outbreak in the woods get a surprising visitor'), (10, 'Outbreak', 4.99, 15, 'A team of experts race around the clock to find a cure for an airbone virus'), (11, 'The Godfather', 7.99, 10, 'A sons ascension to his fathers mafia throne in New York City.'), (12, 'The Fellowship of the Ring', 6.99, 12, 'A young hobbit goes on a journey to save the world with an axe by his side.'), (13, 'Interstellar', 9.99, 14, 'A farmer goes on a voyage across the stars to solve the mystery of gravity.'), (14, 'Icarus', 1.99, 6, 'A doping documentary takes a twist into a massive international scandal'), (15, 'Jumanji', 4.99, 5, 'A shoe factory boy finds a mysterious board game filled with monsters'), (16, 'The Hangover', 7.99, 9, 'A bachelor party in Las Vegas is filled with amnesia for this trio');
UNLOCK TABLES;

--
-- Table structure for table `movie_orders`
--
DROP TABLE IF EXISTS `movie_orders`;
CREATE TABLE `movie_orders` (
	`movie_id` int(11) unsigned NOT NULL,
	`order_id` int(11) unsigned NOT NULL,
	`quantity_ordered` int (11) unsigned NOT NULL,
	PRIMARY KEY (`movie_id`,`order_id`),
	CONSTRAINT `fk_movie_orders_movie` FOREIGN KEY (`movie_id`) REFERENCES `movies` (`movie_id`) ON UPDATE CASCADE,
	CONSTRAINT `fk_movie_orders_order` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Insertion queries for table `movie_orders`
--
LOCK TABLES `movie_orders` WRITE;
INSERT INTO `movie_orders` VALUES (1,1,1),(2,4,1),(8,3,1),(15,2,1),(12,5,1);
UNLOCK TABLES;

--
-- Table structure for table `actors`
--
DROP TABLE IF EXISTS `actors`;
CREATE TABLE `actors` (
	`actor_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
	`first_name` varchar(45) NOT NULL,
	`last_name` varchar(45) NOT NULL,
	`trademark` varchar(45) NOT NULL,
	`birth_location` varchar(45) NOT NULL,
	PRIMARY KEY (`actor_id`),
	KEY `idx_actor_first_name` (`first_name`)
) ENGINE=InnoDB AUTO_INCREMENT=200 DEFAULT CHARSET=utf8;

--
-- Insertion queries for table `actors`
-- Additional information obtained from IMDB.com
--
LOCK TABLES `actors` WRITE;
INSERT INTO `actors` VALUES (1,'Brad','Pitt','Chiseled good looks','Oklahoma, USA'),(2,'Matt', 'Damon','Has older brother who sculpts', 'Massachusetts, USA'),(3, 'Dustin', 'Hoffman', 'Known as being a perfectionist', 'Los Angeles, USA'),(4, 'Nicholas', 'Hoult','Has distinctive vulcan eyebrows','Berkshire, UK'), (5, 'James', 'Olson','Discovered while acting in a local play in New York','Illinois, USA'), (6, 'Al', 'Pacino','Jet black hair and dark owl eyes','New York, USA'), (7, 'Joel', 'Edgerton','Razor-sharp cheekbones','New South Wales, Australia'), (8, 'Elijah', 'Wood','Short hobbit stature', 'Iowa, USA'), (9, 'Jake', 'Gyllenhaal','Blue eyes and brown hair','Los Angeles, USA'), (10, 'Mark','Wahlberg','Frequently plays men of authority or criminals','Massachusetts, USA'), (11, 'Matthew', 'McConahay','Known for saying "Alright, alright, alright!"','Texas, USA'), (12, 'Bryan', 'Fogel','Known for voluntary committing himself to doping for a film','Colorado, USA'), (13, 'Robin', 'Williams','Dinstinctive low-pitch and extremely versatile voice','Illinois, USA'), (14, 'Will', 'Smith','Known for his catchphrase, "Aw, hell no!"','Pennsylvania, USA'), (15, 'Jennifer', 'Carpenter','Her ex-husband was her "brother" in the dissapointing series Dexter','Kentucky, USA');
UNLOCK TABLES;

--
-- Table structure for table `movie_actors`
--
DROP TABLE IF EXISTS `movie_actors`;
CREATE TABLE `movie_actors` (
	`movie_id` int(11) unsigned NOT NULL,
	`actor_id` int(11) unsigned NOT NULL,
	PRIMARY KEY (`movie_id`,`actor_id`),
	CONSTRAINT `fk_movie_actors_movie` FOREIGN KEY (`movie_id`) REFERENCES `movies` (`movie_id`) ON UPDATE CASCADE,
	CONSTRAINT `fk_movie_actors_actor` FOREIGN KEY (`actor_id`) REFERENCES `actors` (`actor_id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Insertion queries for table `movie_actors`
--
LOCK TABLES `movie_actors` WRITE;
INSERT INTO `movie_actors` VALUES (1, 2), (2, 10), (3, 4), (4, 9), (5, 1), (6, 5), (7, 15), (8, 14), (9, 7), (10, 3), (11, 6), (12, 8), (13, 11), (14, 12), (15, 13);
UNLOCK TABLES;

--
-- Table structure for table `genres`
--
DROP TABLE IF EXISTS `genres`;
CREATE TABLE `genres` (
	`genre_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
	`genre_name` varchar(25) NOT NULL,
	PRIMARY KEY (`genre_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

--
-- Insertion queries for table `genres`
--
LOCK TABLES `genres` WRITE;
INSERT INTO `genres` VALUES (1,'Action'),(2,'Comedy'),(3,'Science Fiction'),(4, 'Horror'),(5,'Romance'),(6,'Thriller'),(7,'Documentary'),(8,'Drama'), (9,'Fantasy');
UNLOCK TABLES;

--
-- Table structure for table `movie_genres`
--
DROP TABLE IF EXISTS `movie_genres`;
CREATE TABLE `movie_genres` (
	`movie_id` int(11) unsigned NOT NULL,
	`genre_id` int(11) unsigned NOT NULL,
	PRIMARY KEY (`movie_id`,`genre_id`),
	CONSTRAINT `fk_movie_genres_movie` FOREIGN KEY (`movie_id`) REFERENCES `movies` (`movie_id`) ON UPDATE CASCADE,
	CONSTRAINT `fk_movie_genres_genre` FOREIGN KEY (`genre_id`) REFERENCES `genres` (`genre_id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Insertion queries for table `movie_genres`
--
LOCK TABLES `movie_genres` WRITE;
INSERT INTO `movie_genres` VALUES (1, 6), (2, 6), (3, 5), (4, 6), (5, 4), (6, 6), (7, 4), (8, 6), (9, 4), (10, 4), (11, 8), (12, 9), (13, 3), (14, 7), (15, 9), (16, 2);
UNLOCK TABLES;