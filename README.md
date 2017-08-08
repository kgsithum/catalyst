# Catalyst Assignment

This is the assignment which is done to provide test for script task and logic task 

## Getting Started

These instructions will get you a copy of the scripts up and running on your local machine for testing purposes.

### Prerequisites

This script runs only in PHP command line. You need to set up PHP path properly to work with PHP command line

```
#php -f <script_file.php>
```

If you want to test derectives, you need to pass them after leading -- and then derective (--file, -u, --dry_run)

```
#php -f <script_file.php> -- <derective> <derective>
#php -f user_upload.php -- --create_table --file users.csv
```

### Installing

Download all the files into a folder in your environment. All the iles should be in same directory. Replace CSV file if you have more data in it.CSV file format should be the same with default one.

Customize Mysql credentials in config.php file

```
HOST
USER
DB
```

## Running the tests

These tests can be run in a console or command prompt. These tests included both Script Task tests and Logic Task tests.

### Script Task Tests

#### Derectives

Following test examples provide facility to test derectives

--help

```
#php -f user_upload.php -- --help
```

--create_table

```
#php -f user_upload.php -- --create_table
```

--file <FileName>

```
#php -f user_upload.php -- --file users.csv
```

--dry_run

```
#php -f user_upload.php -- --dry_run
```

-u <Mysql User Name>

```
#php -f user_upload.php -- -u root
```

-p <Mysql User Password>

```
#php -f user_upload.php -- -p 123
```

-h <Mysql Host>

```
#php -f user_upload.php -- -h localhost
```

#### Feature tests

Following test examples provide facility to test main features


Process CSV file and insert users

```
#php -f user_upload.php -- --create_table --file users.csv
```

Process CSV file and insert users with custom Mysql credentials

```
#php -f user_upload.php -- -u root -p 123 -h localhost --create_table --file users.csv
```

Process CSV file with dry_run

```
#php -f user_upload.php -- --dry_run --create_table --file users.csv
```

### Logic Task Tests

Run foobar.php script with following command

```
#php -f foobar.php
```

## Built With

* [php](http://php.net) - Open source general-purpose scripting language


## Authors

* **Sithum Amarasinghe** - *Initial work* - [CatalystTest](https://github.com/kgsithum)


## References

* [PHP command line](http://php.net/manual/en/features.commandline.php)
* [PHP validation](http://php.net/manual/en/filter.examples.validation.php)
* [fgetcsv](http://php.net/manual/en/function.fgetcsv.php)
