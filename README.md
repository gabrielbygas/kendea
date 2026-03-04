# 🏝️ Dubai Activities Booking Platform

A modern, high-performance Laravel 12 application for booking Dubai activities and experiences. Features a responsive single-page application (SPA) with real-time search, category filtering, email notifications, and seamless WhatsApp integration for instant booking confirmations.

## ✨ Features

- **🔍 Advanced Search & Filtering**: Real-time activity search with category-based filtering using DataTables
- **📧 Email Notifications**: Automated confirmation emails for customers and admin notifications for new orders
- **📱 WhatsApp Integration**: Instant booking confirmations via WhatsApp
- **📬 Contact Form**: Multi-recipient contact form with CC functionality
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
- **Email**: Laravel Mail with SMTP/Log drivers

## 📋 Prerequisites

- PHP >= 8.2
- Composer
- Node.js >= 18
- MySQL >= 8.0
- Git
- SMTP Server (for production emails)

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

# Email Configuration (Development)
MAIL_MAILER=log
MAIL_FROM_ADDRESS="admin@kendeatravel.com"
MAIL_FROM_NAME="${APP_NAME}"
```

For production SMTP, uncomment and configure:

```env
MAIL_MAILER=smtp
MAIL_HOST=your-smtp-host.com
MAIL_PORT=465
MAIL_USERNAME=admin@kendeatravel.com
MAIL_PASSWORD=your_password
MAIL_ENCRYPTION=ssl
MAIL_FROM_ADDRESS="admin@kendeatravel.com"
MAIL_FROM_NAME="${APP_NAME}"
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
│   │   ├── ActivityController.php     # Main SPA controller
│   │   ├── CommandeController.php     # Order processing
│   │   └── ContactController.php      # Contact form handler
│   ├── Mail/
│   │   ├── ContactFormMail.php        # Contact form email
│   │   ├── OrderConfirmation.php      # Customer confirmation
│   │   └── OrderNotificationAdmin.php # Admin notification
│   └── Models/
│       ├── Activity.php                # Activity model with slug generation
│       ├── Category.php                # Activity categories
│       ├── Client.php                  # Customer information
│       └── Commande.php                # Orders with activity arrays
├── database/
│   ├── migrations/                     # Database schema
│   └── seeders/
│       └── CategoryActivitySeeder.php  # Sample data seeder
├── public/
│   ├── js/app.js                       # Main frontend logic
│   └── images/                         # Activity images storage
├── resources/
│   └── views/
│       ├── activities/index.blade.php  # Main SPA view
│       ├── contact/index.blade.php     # Contact form
│       ├── emails/                     # Email templates
│       │   ├── contact.blade.php
│       │   ├── order-confirmation.blade.php
│       │   └── order-notification-admin.blade.php
│       ├── layouts/app.blade.php       # Base layout
│       └── partials/                   # Reusable components
└── routes/
    └── web.php                         # API routes
```

## 📧 Email System

The application uses Laravel's Mailable classes with recipient configuration built-in. All email addresses are managed within the Mailable classes themselves.

### Email Types

**1. ContactFormMail** - Contact form submissions
- **To**: contact@kendeatravel.com
- **CC**: admin@kendeatravel.com, david@kendeatravel.com
- **Reply-To**: Customer's email (dynamic)

**2. OrderConfirmation** - Customer booking confirmation
- **To**: Customer's email (dynamic)
- **Reply-To**: admin@kendeatravel.com

**3. OrderNotificationAdmin** - New order notification
- **To**: admin@kendeatravel.com

### Email Configuration

**Development Mode** (current):
- Emails logged to `storage/logs/laravel.log`
- Set `MAIL_MAILER=log` in `.env`

**Production Mode**:
- Uncomment SMTP configuration in `.env`
- Run `php artisan config:clear` after changes

See `CLAUDE.md` for detailed email configuration documentation.

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
- `montant_total`: Total order amount
- `statut`: Order status

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

### Email Sending Pattern

All emails use `Mail::send()` with recipients defined in Mailable classes:

```php
// Correct pattern - recipients in Mailable class
Mail::send(new ContactFormMail($data));
Mail::send(new OrderConfirmation($commande, $client, $activities));
```

### WhatsApp Integration

Orders redirect to WhatsApp with pre-filled booking details:

```javascript
// public/js/app.js
const whatsappNumber = '+971582032582'; // KENDEA number
const whatsappUrl = `https://wa.me/${whatsappNumber}?text=${encodeURIComponent(message)}`;
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
| GET | `/contact` | Contact form page |
| POST | `/contact` | Submit contact form |
| GET | `/api/activities` | DataTables AJAX endpoint (server-side) |
| GET | `/api/activities/{id}` | Single activity details (JSON) |
| POST | `/api/commandes` | Create order, returns WhatsApp URL |
| GET | `/sitemap.xml` | SEO sitemap |

## ⚙️ Configuration

### WhatsApp Number

Update in `/public/js/app.js`:

```javascript
const WHATSAPP_NUMBER = '+971582032582'; // KENDEA number
```

### Email Addresses

Email recipients are configured in Mailable classes:
- `app/Mail/ContactFormMail.php`
- `app/Mail/OrderConfirmation.php`
- `app/Mail/OrderNotificationAdmin.php`

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
- Email validation and sanitization

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

## 📚 Documentation

For detailed architecture and development guidelines, see:
- **CLAUDE.md** - Complete technical documentation for developers
- **HERO_SLIDER_README.md** - Hero slider component documentation

## 📄 License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## 🙏 Acknowledgments

- Built with [Laravel](https://laravel.com)
- DataTables by [Yajra](https://github.com/yajra/laravel-datatables)
- Image processing by [Intervention Image](https://image.intervention.io)
- Animations by [AOS](https://michalsnik.github.io/aos/)

## 📞 Support

For support, contact:
- **Email**: contact@kendeatravel.com
- **Admin**: admin@kendeatravel.com
- **WhatsApp**: +971582032582

---

<p align="center">Made with ❤️ for Dubai Tourism by KENDEA Travel</p>
