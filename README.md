<p align="center"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></p>


## About SwissGuesser

...


## Installation

To install the app, you need to follow the next steps : 

1. Clone the git repo on your own environment : `cd path/to/project` `git clone https://github.com/bread-inc/projart2021.git` ;

2. Pull the last version of the project : `cd projart2021` `git pull` ;

3. Download the vendor and node modules folders : `composer install` ;

4. Update the `.env` file (database access e.g.) ;

5. Update the `.gitignore` file and add the `node_modules/` and `vendor/` folders and the `.env` file to avoid pushing them ;

6. Launch the app : `php artisan serve` ;

7. *In development environnement, create the `database.sqlite` file ;*

8. Migrate all the tables : `php artisan migrate:install`, `php artisan migrate` ;

9. Feed the table : `php artisan db:seed` ;

10. Start the app : `php artisan serve`.

### General informations

The default users created at seeding are :

- {`pseudo => admin`, `email => admin@gmx.ch`, `password => admin`}
- {`pseudo => user`, `email => user@gmx.ch`, `password => user`}

**Please only use those users for development purpose !**

### Collaboration

1. Follow the installation steps;

2. Start editing the project;

3. When you're done, you can commit your edits or reviews to the main branch : `git add .` `git commit -m "Your message"` ;

4. Push your commit : `git push`.

## Additionnal elements

The complete app static design can be found in the folder `/_webdesign/`.

## License

The SwissGuesser app is open-sourced project licensed under the [MIT license](https://opensource.org/licenses/MIT).
