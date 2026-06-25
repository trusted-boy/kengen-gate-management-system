# KenGen Gate Management System

A comprehensive Laravel 12 application for managing gate operations, visitors, vehicles, contractors, and equipment movements at Kenya's power generation facility.

## Features

### Core Modules

1. **Dashboard & Analytics**
   - Real-time statistics on visitors, vehicles, contractors, and equipment
   - Key metrics display (visitors inside/outside, active vehicles, etc.)
   - Quick navigation links to all modules
   - Comprehensive analytics view

2. **Visitor Management**
   - Check-in and check-out functionality
   - Visitor registration with details (name, ID, phone, organization)
   - Host and department assignment
   - Purpose tracking
   - Status monitoring (IN/OUT)
   - Search and pagination

3. **Vehicle Management**
   - Vehicle registration with comprehensive details
   - Registration number, type, make/model, year tracking
   - Owner and driver information management
   - Vehicle status (Active, Inactive, Under Maintenance)
   - Color and remarks tracking
   - Full CRUD operations
   - Search and pagination

4. **Contractor Management**
   - Company registration and management
   - License tracking with expiry dates
   - Contact person and communication details
   - Services offered documentation
   - Status management (Active, Inactive, Expired)
   - License expiry notifications
   - Full CRUD operations
   - Search and pagination

5. **Equipment Movement Tracking**
   - Equipment check-out and check-in functionality
   - Equipment type and description tracking
   - Owner and recipient management
   - Check-out and check-in time logging
   - Duration calculation
   - Authorization tracking
   - Purpose and remarks documentation
   - Full CRUD operations
   - Search and pagination

6. **Department Management**
   - Department creation and management
   - Department codes and descriptions
   - Full CRUD operations
   - Search and pagination

### Advanced Features

#### Role-Based Access Control
- **Admin**: Full system access
- **Security Officer**: Access to monitoring and reporting
- **Supervisor**: Access to operational modules with limited admin functions
- Middleware-based route protection
- Role validation on protected routes

#### Search & Pagination
- Advanced search across all modules
- Configurable pagination (10, 25, 50, 100 items per page)
- Quick filtering by multiple fields
- Search term highlighting

#### Reporting & Export
- **PDF Reports**: Comprehensive system reports in PDF format
  - System statistics summary
  - Recent visitors, vehicles, contractors, and equipment
  - Professional formatting
- **Excel Reports**: Data export to spreadsheet format
  - Visitor data export
  - Formatted headers and styling
  - Ready for analysis

#### User Interface
- **Bootstrap 5** responsive design
- Sidebar navigation with collapsible menu on mobile
- Professional dashboard with stat cards
- Consistent styling across all modules
- Responsive tables with action buttons
- Status badges with color coding
- Form validation and error display

#### Authentication & Authorization
- User registration and login
- Profile management
- Role assignment
- Secure password handling
- Session management

## Installation & Setup

### Prerequisites
- PHP 8.2+
- MySQL 8.0+
- Composer
- Node.js & npm (optional, for asset compilation)

### Installation Steps

1. **Clone the repository**
```bash
git clone <repository-url>
cd kengen-gate-system
```

2. **Install PHP dependencies**
```bash
composer install
```

3. **Setup environment**
```bash
cp .env.example .env
```

4. **Generate application key**
```bash
php artisan key:generate
```

5. **Configure database** (edit `.env`)
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=kengen_gate
DB_USERNAME=root
DB_PASSWORD=
```

6. **Run migrations**
```bash
php artisan migrate
```

7. **Install JavaScript dependencies** (optional)
```bash
npm install && npm run build
```

8. **Start development server**
```bash
php artisan serve
```

Access the application at `http://localhost:8000`

## Default Roles

Create users with the following roles:
- **Admin**: Full access to all features
- **Security Officer**: Monitoring and basic operations
- **Supervisor**: Operational management and reports

## Database Schema

### Tables
- `users` - User accounts with roles
- `visitors` - Visitor check-in/out logs
- `vehicles` - Vehicle registry
- `contractors` - Contractor information
- `equipment_movements` - Equipment tracking
- `departments` - Department management

### Key Relationships
- Equipment Movements → Users (authorized_by)
- All modules → Timestamps (created_at, updated_at)

## API Routes

All routes are protected by `auth` middleware. Role-based routes use the `role` middleware.

### Authenticated Routes
- `GET /dashboard` - Dashboard view
- `/visitors` - Visitor management (CRUD)
- `/vehicles` - Vehicle management (CRUD)
- `/contractors` - Contractor management (CRUD)
- `/equipment_movements` - Equipment tracking (CRUD)
- `/departments` - Department management (CRUD)

### Admin/Supervisor Routes
- `GET /reports/pdf` - PDF report export
- `GET /reports/excel` - Excel report export

## Usage Examples

### Creating a Visitor Record
1. Navigate to Visitors → Add New Visitor
2. Fill in visitor details
3. Click "Check In Visitor"
4. Visitor appears in the register

### Tracking Equipment
1. Navigate to Equipment → Check Out Equipment
2. Enter equipment details
3. Specify owner and recipient
4. Click "Check Out Equipment"
5. To return, edit the record and set check-in time

### Exporting Reports
1. Click "PDF Reports" or "Excel Reports" in sidebar
2. System generates comprehensive report
3. File downloads automatically

## File Structure

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── VisitorController.php
│   │   ├── VehicleController.php
│   │   ├── ContractorController.php
│   │   ├── EquipmentMovementController.php
│   │   ├── DepartmentController.php
│   │   └── DashboardController.php
│   └── Middleware/
│       └── CheckRole.php
├── Models/
│   ├── Visitor.php
│   ├── Vehicle.php
│   ├── Contractor.php
│   ├── EquipmentMovement.php
│   ├── Department.php
│   └── User.php
└── Exports/
    └── ReportsExport.php

database/
├── migrations/
└── seeders/

resources/views/
├── layouts/
│   ├── app.blade.php
│   ├── sidebar.blade.php
│   └── topbar.blade.php
├── visitors/
├── vehicles/
├── contractors/
├── equipment_movements/
├── departments/
└── dashboard.blade.php

routes/
├── web.php
└── auth.php
```

## Configuration

### User Roles
Edit role options in:
- Database migration: `2026_06_25_074518_add_role_to_users_table.php`
- Model: `app/Models/User.php`

### Search Fields
Each module searches across specific fields:
- Visitors: name, ID, host
- Vehicles: registration, type, owner
- Contractors: company name, contact person, license
- Equipment: equipment name, owner, recipient

### Pagination
Default pagination: 10 items per page
Configurable to: 25, 50, 100 per page

## Security Features

- CSRF protection on all forms
- Role-based middleware
- Secure password hashing
- SQL injection prevention (Eloquent ORM)
- XSS protection (Blade templating)
- Authenticated user verification

## Dependencies

- Laravel 12.x
- Bootstrap 5.3
- DomPDF (PDF generation)
- Laravel Excel (Excel export)
- MySQL

## Troubleshooting

### Database Connection Error
- Check `.env` database credentials
- Ensure MySQL is running
- Verify database name exists

### Migration Errors
```bash
php artisan migrate:reset
php artisan migrate
```

### Permission Issues
```bash
chmod -R 775 storage bootstrap/cache
```

## Development & Customization

### Adding New Modules
1. Create migration: `php artisan make:migration create_tablename_table --create=tablename`
2. Create model: `php artisan make:model ModelName`
3. Create controller: `php artisan make:controller ModelController --resource --model=ModelName`
4. Add routes to `routes/web.php`
5. Create views in `resources/views/modelname/`

### Modifying Roles
Update role enum in migration and use middleware on routes:
```php
Route::middleware(['auth', 'role:Admin,Supervisor'])->group(function () {
    // Protected routes
});
```

## Support & Contact

For issues, questions, or feature requests, please contact the development team.

## License

This project is proprietary software for Kenya Electricity Generating Company (KenGen).

---

**Version**: 1.0.0  
**Last Updated**: June 25, 2026
