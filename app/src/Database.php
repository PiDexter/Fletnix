<?php


namespace app\src;


use PDO;

class Database
{
    public PDO $pdo;

    public function __construct(array $config)
    {

        $dsn = $config['dsn'];
        $user = $config['user'];
        $password = $config['password'];

        // Creëer een nieuwe database connectie via een nieuwe PDO instantie
        try {
            $this->pdo = new PDO($dsn, $user, $password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }
        $this->run();
    }
    public function run() {
        $string = "CREATE TABLE IF NOT EXISTS Movie
(
 `movie_id`         int NOT NULL ,
 `title`            varchar(255) NOT NULL ,
 `duration`         int NULL ,
 `description`      varchar(255) NULL ,
 `publication_year` int NULL ,
 `cover_image`      varchar(255) NULL ,
 `previous_part`    int NULL ,
 `price`            numeric(5, 2) NOT NULL ,
 `URL`              varchar(255) NULL ,


 CONSTRAINT `PK_Movie_1` PRIMARY KEY (`movie_id` ASC),
 CONSTRAINT `FK_previous_part` FOREIGN KEY (`previous_part`)  REFERENCES Movie(`movie_id`)
);

CREATE TABLE IF NOT EXISTS Person
(
 `person_id` int NOT NULL ,
 `lastname`  varchar(50) NOT NULL ,
 `firstname` varchar(50) NOT NULL ,
 `gender`    char(1) NULL ,

 CONSTRAINT `PK_Person` PRIMARY KEY (`person_id` ASC)
);

CREATE TABLE IF NOT EXISTS Genre
(
 `genre_name`  varchar(50) NOT NULL ,
 `description` varchar(255) NULL 

);

CREATE TABLE IF NOT EXISTS Movie_Genre
(
 `movie_id`   int NOT NULL ,
 `genre_name` varchar(50) NOT NULL ,


 CONSTRAINT `PK_Movie_Genre` PRIMARY KEY (`movie_id` ASC, `genre_name` ASC),
 CONSTRAINT `FK3_movie_id` FOREIGN KEY (`movie_id`)  REFERENCES Movie(`movie_id`) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE IF NOT EXISTS Movie_Cast
(
 `movie_id`  int NOT NULL ,
 `person_id` int NOT NULL ,
 `role`      varchar(255) NOT NULL ,


 CONSTRAINT `PK_Movie_Cast` PRIMARY KEY (`movie_id` ASC, `person_id` ASC, `role` ASC),
 CONSTRAINT `FK2_movie_id` FOREIGN KEY (`movie_id`)  REFERENCES Movie(`movie_id`) ON DELETE CASCADE ON UPDATE CASCADE,
 CONSTRAINT `FK2_person_id` FOREIGN KEY (`person_id`)  REFERENCES Person(`person_id`) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE IF NOT EXISTS Movie_Director
(
 `movie_id`  int NOT NULL ,
 `person_id` int NOT NULL ,


 CONSTRAINT `PK_Movie_Directors` PRIMARY KEY (`movie_id` ASC, `person_id` ASC),
 CONSTRAINT `FK_movie_id` FOREIGN KEY (`movie_id`)  REFERENCES Movie(`movie_id`) ON DELETE CASCADE ON UPDATE CASCADE,
 CONSTRAINT `FK_person_id` FOREIGN KEY (`person_id`)  REFERENCES Person(`person_id`) ON DELETE CASCADE ON UPDATE CASCADE
);";
        $this->pdo->query($string);
    }

}