## Installation ##

Database can be created using:

	cd data
	sqlite3 -init ../app/models/db.sql sqlite3.db
	chmod 777 sqlite3.db
	chmod 777 .

## Running tests ##

### Unit tests ###

Install PHPUnit:

	pear config-set auto_discover 1
	pear install pear.phpunit.de/PHPUnit

Run unit tests:

	cd tests
	phpunit ./app

### Selenium tests ###

1. Download Selenium server (JAR).
2. Run Selenium server:

	java -jar selenium-server-standalone.jar

3. Run selenium tests:

	cd tests
	phpunit ./selenium

