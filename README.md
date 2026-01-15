# App Connect People API

Welcome to the App Connect People API, a Laravel-based application that provides an API for connecting people.

## Prerequisites

Before running the application, make sure you have the following installed:

- PHP 8.1 or later
- Composer
- MySQL or another supported database

## Installation

To install the application, follow these steps:

1. Clone the repository:
   ```
   git clone https://github.com/anetagloc/app_connect_people.git
   ```

2. Change into the project directory:
   ```
   cd app_connect_people
   ```

3. Install dependencies using Composer:
   ```
   composer install
   ```

4. Copy the `.env.example` file and rename it to `.env`:
   ```
   cp .env.example .env
   ```

5. Set up the database configuration in the `.env` file.

6. Generate an application key:
   ```
   php artisan key:generate
   ```

7. Run the database migrations:
   ```
   php artisan migrate
   ```

8. Start the application:
   ```
   php artisan serve
   ```

   The application will be accessible at `http://localhost:8000`.

## API Endpoints

It's available in Swagger UI at `http://localhost:8000/api/documentation`.


## Contributing

Contributions to the App Connect People API are welcome! If you find a bug or have a feature request, please open an issue. To contribute code, follow these steps:

1. Fork the repository.
2. Create a new branch.
3. Make your changes.
4. Run the tests to ensure everything is working as expected.
5. Submit a pull request.

## License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for details.

