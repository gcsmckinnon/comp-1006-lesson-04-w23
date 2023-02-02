-- Below will alter the film_actor table and add a cascading delete
ALTER TABLE `sakila`.`film_actor` 
DROP FOREIGN KEY `fk_film_actor_actor`,
DROP FOREIGN KEY `fk_film_actor_film`;

ALTER TABLE `sakila`.`film_actor` 
  ADD CONSTRAINT `fk_film_actor_actor`
    FOREIGN KEY (`actor_id`)
    REFERENCES `sakila`.`actor` (`actor_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_film_actor_film`
    FOREIGN KEY (`film_id`)
    REFERENCES `sakila`.`film` (`film_id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE;


