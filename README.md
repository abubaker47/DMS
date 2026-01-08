# Document Management System (DMS)

A comprehensive, multilingual document management system built with Laravel 12, designed for organizations to manage, track, and route documents between departments with full audit trails and security features.

## Features

### Core Features
- **Document Management**: Upload, organize, download, and preview documents with version control
- **Department Workflow**: Route documents between departments with status tracking (pending, received, completed, rejected)
- **Multi-language Support**: Full support for English, Dari, and Pashto languages
- **File Type Management**: Categorize and organize documents by customizable file types
- **Document History**: Complete audit trail tracking all document activities and changes
- **Document Encryption**: Secure document storage with encryption support

### User Management & Security
- **Role-based Access Control**: Admin, manager, and user roles with different permissions
- **User Authentication**: Secure login system powered by Laravel Breeze
- **Email Verification**: User email verification support
- **Department Assignment**: Users belong to specific departments for workflow management

### Additional Features
- **Real-time Notifications**: Get notified about document activities and assignments
- **Activity Logging**: System-wide activity tracking for compliance and monitoring
- **Document Preview**: Preview documents directly in the browser
- **Search & Filter**: Advanced document search and filtering capabilities
- **Responsive UI**: Modern, responsive interface built with Tailwind CSS
- **Soft Deletes**: Recover accidentally deleted documents

## Technology Stack

- **Backend**: Laravel 12 (PHP 8.2)
- **Frontend**: Blade Templates, Alpine.js, Tailwind CSS v4
- **Authentication**: Laravel Breeze
- **Build Tool**: Vite
- **Testing**: Pest PHP
- **Database**: SQLite (default), MySQL/PostgreSQL supported

## Requirements

- PHP >= 8.2
- Composer
- Node.js & NPM
- SQLite (default) or MySQL/PostgreSQL
- Git

## Installation

1. **Clone the repository:**

   ```bash
   git clone https://github.com/abubaker47/DMS.git
   cd DMS
   ```

2. **Install PHP dependencies:**

   ```bash
   composer install
   ```

3. **Install JavaScript dependencies:**

   ```bash
   npm install
   ```

4. **Set up environment configuration:**

   ```bash
   cp .env.example .env
   ```

   Edit the `.env` file to configure your database and other settings:
   - For SQLite (default): No additional configuration needed
   - For MySQL/PostgreSQL: Update `DB_CONNECTION`, `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, and `DB_PASSWORD`

5. **Generate application key:**

   ```bash
   php artisan key:generate
   ```

6. **Run database migrations and seeders:**

   ```bash
   php artisan migrate --seed
   ```

   This will create the database structure and seed it with:
   - Default departments
   - Common file types
   - Admin and demo users

7. **Build frontend assets:**

   ```bash
   npm run build
   ```

   For development with hot-reload:
   ```bash
   npm run dev
   ```

8. **Start the development server:**

   ```bash
   php artisan serve
   ```

9. **Access the application:**

   Visit `http://localhost:8000` in your browser.

### Default Users

After seeding, you can log in with these default accounts:

- **Admin User**: Check the `UserSeeder.php` file for default credentials
- Role-based access: Admin users have full system access

## Configuration

### Database
By default, the application uses SQLite for simplicity. To use MySQL or PostgreSQL, update your `.env` file:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=dms_database
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### File Storage
Documents are stored in the `storage/app` directory by default. Configure the `FILESYSTEM_DISK` in `.env` if you want to use cloud storage (AWS S3, etc.).

### Multi-language
The system supports three languages:
- English (default)
- Dari
- Pashto

Users can switch languages from their profile or dashboard.

## Usage

### For Regular Users
- **View Documents**: Access incoming and outgoing documents from your dashboard
- **Upload Documents**: Create new documents and assign them to departments
- **Track Status**: Monitor document status through the workflow (pending → received → completed)
- **Download/Preview**: Download or preview documents directly in the browser
- **Notifications**: Receive notifications when documents are assigned to you or your department

### For Administrators
- **Manage Departments**: Create and manage organizational departments
- **Manage File Types**: Define and categorize document types
- **User Management**: Create users, assign roles, and manage department assignments
- **System Monitoring**: View activity logs and document histories
- **Reports**: Access comprehensive reporting on document workflows

### Document Workflow
1. **Create**: User creates a document and assigns it to a department
2. **Pending**: Document awaits action from the receiving department
3. **Received**: Department acknowledges receipt
4. **Completed**: Document processing is finished
5. **Rejected**: Document is rejected (with reason)

Each step is tracked in the document history for audit purposes.

## Development

### Running Tests
```bash
# Run all tests
php artisan test

# Run tests with coverage
php artisan test --coverage
```

### Code Quality
```bash
# Run Laravel Pint for code formatting
./vendor/bin/pint

# Check code style without fixing
./vendor/bin/pint --test
```

### Asset Development
```bash
# Watch for asset changes (hot reload)
npm run dev

# Build for production
npm run build
```

### Database
```bash
# Create a new migration
php artisan make:migration create_table_name

# Rollback migrations
php artisan migrate:rollback

# Fresh migration with seeding
php artisan migrate:fresh --seed
```

### Concurrent Development
Use the composer dev script to run multiple services simultaneously:
```bash
composer dev
```

This starts:
- PHP development server
- Queue worker
- Log viewer (Laravel Pail)
- Vite development server

## Project Structure

```
DMS/
├── app/
│   ├── Http/Controllers/    # Application controllers
│   ├── Models/              # Eloquent models
│   ├── Policies/            # Authorization policies
│   └── View/                # View composers
├── database/
│   ├── migrations/          # Database migrations
│   └── seeders/             # Database seeders
├── resources/
│   ├── views/               # Blade templates
│   └── js/                  # JavaScript files
├── routes/
│   ├── web.php              # Web routes
│   ├── api.php              # API routes
│   └── auth.php             # Authentication routes
├── storage/                 # File storage
└── tests/                   # Test files
```

## Key Models

- **Document**: Main document entity with workflow status
- **Department**: Organizational departments
- **FileType**: Document categorization
- **User**: System users with roles
- **DocumentHistory**: Audit trail for documents
- **Activity**: System-wide activity logging

## Security

- **Authentication**: Laravel Breeze with email verification
- **Authorization**: Policy-based access control
- **Document Encryption**: Optional encryption for sensitive documents
- **CSRF Protection**: Enabled on all forms
- **SQL Injection Protection**: Eloquent ORM with parameter binding
- **XSS Protection**: Blade template escaping
- **Secure Headers**: Configured in middleware

## Contributing

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

Please ensure:
- Code follows Laravel coding standards (use `./vendor/bin/pint`)
- Tests pass (`php artisan test`)
- Features are documented

## Troubleshooting

### Common Issues

**Database connection error:**
- Check your `.env` database configuration
- Ensure database exists and credentials are correct
- For SQLite, ensure `database/database.sqlite` file exists

**Permission errors:**
- Ensure `storage/` and `bootstrap/cache/` are writable:
  ```bash
  chmod -R 775 storage bootstrap/cache
  ```

**Asset build errors:**
- Clear npm cache: `npm cache clean --force`
- Delete `node_modules` and reinstall: `rm -rf node_modules && npm install`

**Migration errors:**
- Clear config cache: `php artisan config:clear`
- Try fresh migration: `php artisan migrate:fresh`

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
