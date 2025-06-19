
## Demo Project to implement Design Patterns using Laravel Framework

### This demo project was implemented using PHP 8.3 and Laravel 12 for the Backend and Html/Javscript/Jquery and TailwindCSS for the Frontend.

### Design Patterns implemented in this project

#### Creational
- Singleton (single vehicle instance is created when submit the form)
- Factory (different vehicle instances are created when submit the form)

#### Behavioral
- Strategy (the pattern is used to display Output Formatter Message when submit the form)
- Template Method (the pattern is used when instantiating vehcile instances in the controller)

#### Structural
-Decorator


### How to run the project locally

- Clone the repo locally
- Run composer install and npm install
- Copy .env.example to .env
- Run php artisan key:generate
- Run php artisan migrate and create slqlite db file
- Run php artisan db:seed
- Run composer run dev