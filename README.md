# Document Management System (DMS)

A modern document management system built with Laravel, featuring file type management, document organization, and secure storage.

## Features

- File type management and organization
- Document upload and storage
- User authentication and authorization
- Modern UI with Tailwind CSS
- Blade templating system

## Requirements

- PHP >= 8.0
- Composer
- Node.js & NPM
- MySQL/PostgreSQL

## Installation

1. Clone the repository:

   ```bash
   git clone <repository-url>
   cd DMS
   ```

2. Install PHP dependencies:

   ```bash
   composer install
   ```

3. Install JavaScript dependencies:

   ```bash
   npm install
   ```

4. Copy the environment file and configure your database:

   ```bash
   cp .env.example .env
   ```

   Update the database configuration in `.env` with your credentials.

5. Generate application key:

   ```bash
   php artisan key:generate
   ```

6. Run database migrations and seeders:

   ```bash
   php artisan migrate --seed
   ```

7. Build assets:

   ```bash
   npm run dev
   ```

8. Start the development server:

   ```bash
   php artisan serve
   ```

Visit `http://localhost:8000` in your browser.

## Development

- Run tests: `php artisan test`
- Watch for asset changes: `npm run watch`
- Production build: `npm run build`

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
