# 🏝️ Dubai Activities Booking Platform

A modern, high-performance Laravel 12 application for booking Dubai activities and experiences. Features a responsive single-page application (SPA) with real-time search, category filtering, and seamless WhatsApp integration for instant booking confirmations.

## ✨ Features

- **🔍 Advanced Search & Filtering**: Real-time activity search with category-based filtering using DataTables
- **📱 WhatsApp Integration**: Instant booking confirmations via WhatsApp
- **🖼️ Rich Media Gallery**: Multi-image support for each activity with fallback handling
- **⭐ Rating System**: Decimal-precision rating display (0.0-5.0) with visual star ratings
- **🛒 Shopping Cart**: Client-side cart management for multiple activity bookings
- **🎨 Modern UI/UX**: Smooth animations with AOS library and responsive Bootstrap design
- **🚀 High Performance**: Server-side pagination and processing with Yajra DataTables
- **🔗 SEO Optimized**: Auto-generated XML sitemap and SEO-friendly URLs with slugs

## 🛠️ Tech Stack

- **Backend**: Laravel 12 (PHP 8.2+)
- **Database**: MySQL with optimized indexes
- **Frontend**: jQuery, DataTables, Bootstrap Icons
- **Styling**: Tailwind CSS 4.0
- **Build Tool**: Vite with hot-reload
- **Image Processing**: Intervention Image
- **Animations**: AOS (Animate On Scroll)

## 📋 Prerequisites

- PHP >= 8.2
- Composer
- Node.js >= 18
- MySQL >= 8.0
- Git

## 🚀 Quick Start

### 1. Clone the Repository

```bash
git clone https://github.com/yourusername/dubai-activities.git
cd dubai-activities
```

### 2. One-Command Setup

```bash
composer setup
```

This command will:
- Install PHP dependencies
- Create `.env` file from example
- Generate application key
- Run database migrations
- Install Node.js dependencies
- Build frontend assets

### 3. Configure Environment

Edit `.env` file with your database credentials:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=dubai_activities
DB_USERNAME=your_username
DB_PASSWORD=your_password

APP_TIMEZONE=Africa/Kinshasa
APP_LOCALE=fr
APP_FAKER_LOCALE=fr_FR
```

### 4. Seed Sample Data

```bash
php artisan db:seed
```

This populates the database with realistic Dubai activities across multiple categories (Desert Safari, Water Parks, City Tours, etc.).

### 5. Run Development Server

```bash
composer dev
```

This concurrently runs:
- Laravel development server (http://localhost:8000)
- Queue worker for background jobs
- Real-time log monitoring (Laravel Pail)
- Vite dev server with hot-reload

🎉 **Visit** http://localhost:8000 to see your application!

## 📁 Project Structure

```
dubai-activities/
├── app/
│   ├── Http/Controllers/
│   │   ├── ActivityController.php    # Main SPA controller
│   │   └── CommandeController.php    # Order processing
│   └── Models/
│       ├── Activity.php               # Activity model with slug generation
│       ├── Category.php               # Activity categories
│       ├── Client.php                 # Customer information
│       └── Commande.php               # Orders with activity arrays
├── database/
│   ├── migrations/                    # Database schema
│   └── seeders/
│       └── CategoryActivitySeeder.php # Sample data seeder
├── public/
│   ├── js/app.js                      # Main frontend logic
│   └── images/                        # Activity images storage
├── resources/
│   └── views/
│       ├── activities/index.blade.php # Main SPA view
│       ├── layouts/app.blade.php      # Base layout
│       └── partials/                  # Reusable components
└── routes/
    └── web.php                        # API routes
```

## 🗄️ Database Schema

### Core Tables

**categories**
- Activity categories (e.g., Desert Safari, Water Parks, City Tours)

**activities**
- `id`: Primary key
- `nom`: Activity name
- `slug`: Auto-generated SEO-friendly URL (unique, indexed)
- `images`: JSON array of image paths (up to 5)
- `prix`: Decimal price (10,2)
- `notes`: Decimal rating (2,1) from 0.0 to 5.0
- `lieu`: Location
- `categorie_id`: Foreign key to categories (indexed)

**clients**
- Customer information (name, email, phone)

**commandes**
- `id`: Order ID
- `client_id`: Foreign key to clients
- `activities`: JSON array of activity IDs
- `datetime`: Order timestamp (Carbon instance)

### Key Relationships

- Activity → Category (belongsTo)
- Commande → Client (belongsTo)
- Commande → Activities (manual via `getActivitiesDetails()`)

## 🔧 Development Commands

### Daily Development

```bash
composer dev              # Run all services concurrently
php artisan serve         # Laravel server only (localhost:8000)
npm run dev               # Vite dev server only
```

### Database Operations

```bash
php artisan migrate                    # Run migrations
php artisan migrate:fresh --seed       # Reset database with sample data
php artisan db:seed                    # Seed data only
```

### Testing & Quality

```bash
composer test             # Run PHPUnit test suite
php artisan test          # Alternative test command
vendor/bin/pint           # Format code with Laravel Pint
```

### Asset Management

```bash
npm run build             # Production build
npm run dev               # Development build with hot-reload
```

### Utilities

```bash
php artisan route:list    # View all routes
php artisan tinker        # Interactive REPL
php artisan config:clear  # Clear configuration cache
php artisan cache:clear   # Clear application cache
php artisan pail          # Real-time log monitoring
```

## 🎯 Key Features Implementation

### Server-Side DataTables

Activities use Yajra DataTables for efficient server-side pagination and filtering:

```php
// ActivityController::getActivities()
return DataTables::of($query)
    ->addColumn('checkbox', function ($activity) {
        return '<input type="checkbox" class="activity-checkbox" value="'.$activity->id.'">';
    })
    ->rawColumns(['checkbox', 'image', 'details', 'actions'])
    ->make(true);
```

### Auto-Generated Slugs

Activities automatically generate SEO-friendly slugs on creation:

```php
// Activity Model
protected static function boot()
{
    parent::boot();
    static::creating(function ($activity) {
        $activity->slug = Str::slug($activity->nom);
    });
}
```

### WhatsApp Integration

Orders redirect to WhatsApp with pre-filled booking details:

```javascript
// public/js/app.js
const whatsappUrl = `https://wa.me/${WHATSAPP_NUMBER}?text=${encodeURIComponent(message)}`;
window.location.href = whatsappUrl;
```

### Image Handling

Multiple images with automatic fallback:

```php
// Activity Model
public function getFirstImageAttribute()
{
    $images = $this->images ?? [];
    return !empty($images) ? $images[0] : 'images/default.jpg';
}
```

## 🌐 API Endpoints

| Method | Endpoint | Description |
|--------|----------|-------------|
| GET | `/` | Main SPA page |
| GET | `/api/activities` | DataTables AJAX endpoint (server-side) |
| GET | `/api/activities/{id}` | Single activity details (JSON) |
| POST | `/api/commandes` | Create order, returns WhatsApp URL |
| GET | `/sitemap.xml` | SEO sitemap |

## ⚙️ Configuration

### WhatsApp Number

Update in `/public/js/app.js`:

```javascript
const WHATSAPP_NUMBER = '+971501234567'; // Replace with your number
```

### Locale & Timezone

Already configured in `.env`:

```env
APP_TIMEZONE=Africa/Kinshasa
APP_LOCALE=fr
APP_FAKER_LOCALE=fr_FR
```

### Image Storage

Images stored in `public/images/` directory. Update storage path in Activity model if needed.

## 🧪 Testing

Run the test suite:

```bash
composer test
```

Tests located in `tests/` directory using PHPUnit.

## 🔒 Security

- CSRF protection enabled for all POST requests
- SQL injection prevention via Eloquent ORM
- XSS protection with Blade templating
- Environment variables for sensitive data

## 📈 Performance Optimization

- **Database Indexes**: Optimized on slug, prix, notes, categorie_id
- **Server-Side Processing**: No foreach loops on large datasets
- **Eager Loading**: Prevent N+1 queries with `with('category')`
- **Asset Pipeline**: Vite for optimized builds with code splitting
- **Image Optimization**: Use Intervention Image for processing

## 🤝 Contributing

Contributions are welcome! Please follow these steps:

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## 📝 Code Style

Use Laravel Pint for consistent formatting:

```bash
vendor/bin/pint
```

## 📄 License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## 🙏 Acknowledgments

- Built with [Laravel](https://laravel.com)
- DataTables by [Yajra](https://github.com/yajra/laravel-datatables)
- Image processing by [Intervention Image](https://image.intervention.io)
- Animations by [AOS](https://michalsnik.github.io/aos/)

## 📞 Support

For support, email support@dubaiactivities.com or open an issue on GitHub.

---

<p align="center">Made with ❤️ for Dubai Tourism</p>
