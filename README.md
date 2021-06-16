<p align="center"><img src="/storage/app/public/images/logo/logo.png" width="250"></p>


## About SwissGuesser

SwissGuesser is a non-profit project developed by 7 students from the Media Engineering department of the School of Management and Engineering Vaud. You can test the app [here](https://pingouin.heig-vd.ch/bread/).


## Installation

To install the app, you need to follow the next steps : 

1. Clone the git repo on your own environment : `cd path/to/project` `git clone https://github.com/bread-inc/projart2021.git` ;

2. Pull the last version of the project : `cd projart2021` `git pull` ;

3. Download the vendor and node modules folders : `composer i` `npm i` ;

4. Update the `.env` file (database access e.g.) ;

5. Update the `.gitignore` file and add the `node_modules/` and `vendor/` folders and the `.env` file to avoid pushing them ;

6. *In development environnement, create the `database.sqlite` file ;*

7. Migrate all the tables : `php artisan migrate:install`, `php artisan migrate` ;

8. Feed the table : `php artisan db:seed` ;

9. Create the symbolic link between the `public` and `storage` folders : `php artisan storage:link` ;

10. Compile the last JS and CSS files : `npm run prod` *if it does not work, you can use `npm run watch`*; 

11. Start the app : `php artisan serve`.

### General informations

The default users created at seeding are :

- {`pseudo => admin`, `email => admin@gmx.ch`, `password => admin`}
- {`pseudo => user`, `email => user@gmx.ch`, `password => user`}

**Please only use those users for development purpose !*

## Documentation

The documentation of the SwissGuesser Laravel app can be found here : [https://bread-inc.github.io/projart2021/](https://bread-inc.github.io/projart2021/)

## License

The SwissGuesser app is open-sourced project licensed under the [MIT license](https://opensource.org/licenses/MIT).
