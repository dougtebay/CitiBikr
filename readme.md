# CitiBikr

CitiBikr is a PHP/Laravel web app that allows users to retrieve data for all Citi Bike stations in the NYC system, save their favorite stations, and search for nearby stations based on address.

Try CitiBikr on Heroku [here](http://citibikr.herokuapp.com/).

## Database

* The database consists of four tables: a users table, favorites table, favorite_user pivot/join table, and sessions table. ("Favorites" are Citi Bike stations that a user likes or visits frequently.)
* A user can have many favorites and a favorite can have many users.
* The app uses Sqlite locally/for development and Postgres on Heroku/for production. I never quite figured out how to properly set up different environments using different databases, so I made this work by pushing a version of the database.php to Heroku with the default set to pgsql.
* The sessions table is used to prevent users from having multiple active sessions in different browsers.

## APIs

* The app uses adapters to connect to the Citi Bike API (app/Adapters/CitiBikeApi.php) and Google Maps Geocoding API (app/Adapters/GoogleMapsGeocodingApi.php).
* HTTP requests are handled by Guzzle.

#### Citi Bike API

* Two routes are used: station_information (for station name, id, latitude, and longitude) and station_status (for number of bikes available).
* The get_stations and build_stations functions convert JSON from the API into an array of PHP objects representing all stations in the NYC system.
* The get_bikes and build_bikes functions create an array of key value pairs, associating each station id with the number of bikes available at that station.

#### Google Maps Geocoding API

* The get_coordinates function converts the human-readable address, entered by the user in the navbar search field, into latitude/longitude coodinates that can be used to locate Citi Bike stations.

## Models

#### User and Favorite Models

* These models establish the many-to-many relationship between instances of these classes.

#### Station Model

* This model includes functions related to finding nearby stations, given a latitude/longitude.
* These methods make use of data from both APIs. After an address is entered by the user, it's converted into latitude/longitude coordinates by way of the Google API. Those coordinates are then compared against the coordinates of all stations in the system, in order to identify stations within a quarter mile of the given address.
* I first tried writing my own algorithm for finding nearby stations, but realized there were a lot of complexities involved in accurately calculating 'nearness' based on latitude/longitude. For more accurate results, I used Geotools.

#### Session Model

* This model includes functions related to preventing a user from having multiple active sessions.
* The persistSession and userHasMultipleSessions functions are called from the layout blade. (I know it's bad form to interact with models directly from the view, but at this time I haven't found another reliable way of calling these functions on every refresh.)
* The persistSession function logs the current user id and session id to the database.
* The userHasMultipleSessions function checks the database for a record with the current user id and a created by date later than that of the current session. If such a record exists—indicating that the user has logged in from another browser—they are logged out of their current session (but remain logged in to the more recent session).

## Authentication

* All signup/login/logout functionality was created by the authentication scaffold generator.

## Tests

* Only the Station and Session models include functions. I wrote tests for all of those, which can be found under tests/unit.
* The tests need refactoring, to reduce repetition, and could probably also be improved through use of factories/faker.

## To Do (a partial list)
* Add ability to load stations from API in batches, instead of all at once
* Add more data related to stations and bikes (e.g. number of docks available, etc.)
* Incorporate maps
* Add an event to periodically check/update data of persisted stations
* Organize repetitive code from controllers into service objects
* Add integration tests
* Prevent station from being added to favorites more than once
* Display a message if the user hasn't added any favorites yet
* Fix inconsistent use of snake case vs camel case in function names

## Technologies Used

* Laravel
* PHP
* SQLite
* PostgreSQL
* Citi Bike NYC API
* Google Maps Geocoding API
* Guzzle
* Geotools
* Bootstrap
