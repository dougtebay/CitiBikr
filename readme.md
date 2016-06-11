# CitiBikr

App description TK

Try CitiBikr on Heroku [here](http://citibikr.herokuapp.com/).

## Database

* The database consists of three tables: a users table, favorites table, and favorite_user pivot/join table. ("Favorites" are Citi Bike stations that a user likes or visits frequently.)
* A user can have many favorites and a favorite can have many users.
* The app uses Sqlite locally/for development and Postgres on Heroku/for production. I never quite figured out how to properly set up different environments using different databases, so I made this work by pushing up a version of the database.php to Heroku with the default set to pgsql.

## Citi Bike API

* The app uses an adapter (app/Adapters/CitiBikeApi.php) to connect to the API.
* HTTP requests are handled by Guzzle.
* Two routes are used: station_information (for station name, id, latitude, and longitude) and station_status (for number of bikes available).
* The get_stations and build_stations functions convert JSON from the API into an array of PHP objects representing all stations in the NYC system.
* The get_bikes and build_bikes functions create an array of key value pairs, associating each station id with the number of bikes available at that station.

## Models

* The User and Favorite models establish the many-to-many relationship between instances of these classes.
* The Station model includes a number of methods related to finding nearby stations, given a latitude/longitude.
* I first tried writing my own algorithm for finding nearby stations, but realized there were a lot of complexities involved in accurately calculating 'nearness' based on latitude/longitude. For more accurate results, I used Geotools.

## Technologies Used

* Laravel
* PHP
* SQLite
* PostgreSQL
* Citi Bike NYC API
* Bootstrap

# Next Steps

* TK
