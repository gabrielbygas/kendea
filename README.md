# 🏝️ KENDEATRAVEL - Dubai Activities Booking Platform

A modern, high-performance Laravel 12 application for booking Dubai and UAE activities and experiences. Built with server-side rendering, session-based cart system, bilingual support (French/English), email notifications, and seamless WhatsApp integration for instant booking confirmations.

## ✨ Features

- **🌍 Multi-Page Application**: Complete Laravel routing with dedicated pages for home, activities, categories, blog, about, contact, and cart
- **🌐 Bilingual Support**: French and English language switching with persistent session state
- **🔍 Advanced Filtering**: Server-side category, emirate, and sorting filters with instant results
- **🛒 Session-Based Cart**: Secure server-side cart with quantity management per activity
- **📧 Email Notifications**: Automated confirmation emails for customers and admin notifications for new orders
- **📱 WhatsApp Integration**: Instant booking confirmations via WhatsApp with pre-filled order details
- **📬 Contact Form**: Multi-recipient contact form with CC functionality
- **🖼️ Rich Media Gallery**: Multi-image support for each activity with automatic fallback handling
- **⭐ Rating System**: Decimal-precision rating display (0.0-5.0) with visual star ratings
- **🎨 Modern UI/UX**: Smooth animations with AOS library and responsive Bootstrap 5 design
- **🚀 High Performance**: Server-side rendering with optimized database queries and eager loading
- **🔗 SEO Optimized**: Auto-generated XML sitemap and SEO-friendly URLs with slugs
- **📍 Emirate Filtering**: Filter activities by UAE emirates (Dubai, Abu Dhabi, Sharjah, etc.)

## 🛠️ Tech Stack

- **Backend**: Laravel 12 (PHP 8.2+)
- **Database**: MySQL with optimized indexes
- **Frontend**: jQuery, Blade templating, Bootstrap Icons
- **Styling**: Bootstrap 5.3.3 (loaded via CDN)
- **Build Tool**: Vite
- **Image Processing**: Intervention Image Laravel
- **Animations**: AOS (Animate On Scroll)
- **Email**: Laravel Mail with SMTP/Log drivers
- **Session Management**: Laravel session for cart and locale
- **DataTables**: Yajra DataTables (installed but not actively used in views)

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
git clone https://github.com/yourusername/dubai-activities_antigravity.git
cd dubai-activities_antigravity
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
dubai-activities_antigravity/
├── app/
│   ├── Http/Controllers/
│   │   ├── HomeController.php          # Homepage with hero slider
│   │   ├── ActivityController.php      # Activities listing & detail pages
│   │   ├── CategoryController.php      # Category-specific pages
│   │   ├── BlogController.php          # Blog section
│   │   ├── AboutController.php         # About page
│   │   ├── ContactController.php       # Contact form handler
│   │   └── CommandeController.php      # Order processing & emails
│   ├── Mail/
│   │   ├── ContactFormMail.php         # Contact form email
│   │   ├── OrderConfirmation.php       # Customer confirmation
│   │   └── OrderNotificationAdmin.php  # Admin notification
│   └── Models/
│       ├── Activity.php                # Activity model with slug generation
│       ├── Category.php                # Activity categories
│       ├── Client.php                  # Customer information
│       └── Commande.php                # Orders with activity quantities
├── database/
│   ├── migrations/                     # Database schema
│   └── seeders/
│       ├── CategorySeeder.php          # UAE categories seeder
│       └── ActivitySeeder.php          # Sample activities seeder
├── public/
│   ├── js/
│   │   ├── app.js                      # Main application logic
│   │   ├── activities.js               # Activities filtering & AJAX
│   │   ├── cart.js                     # Cart management
│   │   └── session-cart.js             # Session cart utilities
│   └── images/                         # Activity images storage
├── resources/
│   └── views/
│       ├── home/index.blade.php        # Homepage with hero slider
│       ├── activities/
│       │   ├── index.blade.php         # Activities listing page (SSR)
│       │   └── show.blade.php          # Activity detail page
│       ├── categories/show.blade.php   # Category detail page
│       ├── blog/index.blade.php        # Blog page
│       ├── about/index.blade.php       # About page
│       ├── contact/index.blade.php     # Contact form
│       ├── cart/index.blade.php        # Shopping cart page
│       ├── emails/                     # Email templates
│       │   ├── contact.blade.php
│       │   ├── order-confirmation.blade.php
│       │   └── order-notification-admin.blade.php
│       ├── layouts/app.blade.php       # Base layout
│       └── partials/                   # Reusable components
│           ├── header.blade.php
│           ├── footer.blade.php
│           └── hero-slider.blade.php
└── routes/
    └── web.php                         # All routes (web + API)
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
- `id`: Primary key
- `nom`: Category name (French)
- `nom_en`: Category name (English)
- Example: Desert Safari, Water Parks, City Tours, Adventure Sports

**activities**
- `id`: Primary key
- `nom`: Activity name (French)
- `nom_en`: Activity name (English)
- `slug`: Auto-generated SEO-friendly URL (unique, indexed)
- `description`: Activity description (French)
- `description_en`: Activity description (English)
- `images`: JSON array of image paths (up to 5)
- `prix`: Decimal price (10,2)
- `notes`: Decimal rating (2,1) from 0.0 to 5.0
- `location`: Location (French)
- `location_en`: Location (English)
- `emirate`: UAE emirate (Dubai, Abu Dhabi, Sharjah, etc.)
- `categorie_id`: Foreign key to categories (indexed)

**clients**
- `id`: Primary key
- `prenom`: First name
- `nom`: Last name
- `email`: Email address (unique)
- `telephone`: Phone number

**commandes**
- `id`: Order ID
- `client_id`: Foreign key to clients
- `activities`: JSON array of activity IDs
- `activities_quantities`: JSON object with activity quantities `{"1": 2, "3": 4}`
- `datetime`: Order timestamp (Carbon instance)
- `montant_total`: Total order amount
- `statut`: Order status
- `message`: Optional customer message

### Key Relationships

- Activity → Category (belongsTo via `categorie_id`)
- Commande → Client (belongsTo via `client_id`)
- Commande → Activities (manual via `getActivitiesDetails()` method)

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

### Server-Side Rendering

Activities and categories use traditional Laravel server-side rendering with Blade templates:

```php
// ActivityController::index()
public function index(Request $request)
{
    $query = Activity::with('category');
    
    // Apply filters
    if ($request->filled('category')) {
        $query->where('categorie_id', $request->category);
    }
    
    $activities = $query->get();
    return view('activities.index', compact('categories', 'activities', 'filters'));
}
```

```blade
{{-- activities/index.blade.php --}}
@foreach($activities as $activity)
    <div class="card activity-card">
        <img src="{{ asset($activity->first_image) }}" alt="{{ $activity->nom }}">
        <h5>{{ App::getLocale() == 'en' ? $activity->nom_en : $activity->nom }}</h5>
    </div>
@endforeach
```

### Session-Based Cart

Cart data stored securely in Laravel sessions with quantity management:

```php
// Add to cart
$cart = session('cart', []);
$cart[$activityId] = ['quantity' => $quantity];
session(['cart' => $cart]);

// Get cart items
$cartIds = array_keys(session('cart', []));
$activities = Activity::whereIn('id', $cartIds)->get();
```

### Bilingual Support

Language switching with session persistence:

```php
// Language switch route
Route::get('/lang/{locale}', function ($locale) {
    if (in_array($locale, ['fr', 'en'])) {
        session(['locale' => $locale]);
    }
    return redirect()->back();
})->name('lang.switch');
```

```blade
{{-- Display bilingual content --}}
<h3>{{ App::getLocale() == 'en' ? $activity->nom_en : $activity->nom }}</h3>
<p>{{ App::getLocale() == 'en' ? $activity->description_en : $activity->description }}</p>
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
// After order confirmation
const whatsappNumber = '+971582032582'; // KENDEA number
const message = `Bonjour KENDEA, je confirme ma réservation:\n${orderDetails}`;
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

```blade
{{-- Blade template with fallback --}}
<img src="{{ asset($activity->first_image) }}" 
     alt="{{ $activity->nom }}"
     onerror="this.src='{{ asset('images/default.jpg') }}'">
```

## 🌐 API Endpoints

### Web Routes (Server-Side Rendered)

| Method | Endpoint | Description |
|--------|----------|-------------|
| GET | `/` | Homepage with hero slider |
| GET | `/activities` | Activities listing page (SSR) |
| GET | `/activity/{slug}` | Single activity detail page |
| GET | `/category/{id}` | Category-specific activities page |
| GET | `/blog` | Blog section |
| GET | `/about` | About page |
| GET | `/contact` | Contact form page |
| POST | `/contact` | Submit contact form |
| GET | `/cart` | Shopping cart page |
| GET | `/lang/{locale}` | Switch language (fr/en) |

### API Routes (AJAX/JSON)

| Method | Endpoint | Description |
|--------|----------|-------------|
| GET | `/api/activities` | Get activities with filters (JSON) |
| GET | `/api/activities/{id}` | Single activity details (JSON) |
| POST | `/api/activities/bulk` | Get multiple activities by IDs |
| POST | `/api/commandes` | Create order, send emails, return WhatsApp URL |
| POST | `/api/cart/add` | Add activity to session cart |
| POST | `/api/cart/remove` | Remove activity from cart |
| POST | `/api/cart/update-quantity` | Update activity quantity |
| GET | `/api/cart/count` | Get cart items count |
| POST | `/api/cart/clear` | Clear entire cart |

### SEO Routes

| Method | Endpoint | Description |
|--------|----------|-------------|
| GET | `/sitemap.xml` | XML sitemap for search engines |

## ⚙️ Configuration

### WhatsApp Number

Update in your JavaScript files (e.g., `/public/js/cart.js`):

```javascript
const WHATSAPP_NUMBER = '971582032582'; // KENDEA number
```

### Email Addresses

Email recipients are configured in Mailable classes:
- `app/Mail/ContactFormMail.php`
- `app/Mail/OrderConfirmation.php`
- `app/Mail/OrderNotificationAdmin.php`

### Locale & Timezone

Configured in `.env`:

```env
APP_TIMEZONE=Africa/Kinshasa
APP_LOCALE=fr
APP_FAKER_LOCALE=fr_FR
```

Users can switch between French and English using the language switcher in the header. Their preference is stored in the session.

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

- **Database Indexes**: Optimized on `slug`, `prix`, `notes`, `categorie_id`, and `emirate`
- **Server-Side Rendering**: Traditional SSR with Blade templates (no heavy client-side framework)
- **Eager Loading**: Prevent N+1 queries with `Activity::with('category')`
- **Session-Based Cart**: Secure server-side cart storage instead of localStorage
- **Asset Pipeline**: Vite for optimized builds with code splitting and hot-reload
- **Image Optimization**: Use Intervention Image for processing and fallback images
- **Query Optimization**: Filtered queries at database level, not in-memory filtering

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
- **CLAUDE.md** - Complete technical documentation for developers (AI assistant guidance)
- **HERO_SLIDER_README.md** - Hero slider component documentation (if exists)

## 📄 License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## 🙏 Acknowledgments

- Built with [Laravel 12](https://laravel.com)
- Styled with [Bootstrap 5](https://getbootstrap.com)
- Image processing by [Intervention Image Laravel](https://image.intervention.io)
- Animations by [AOS](https://michalsnik.github.io/aos/)
- Icons by [Bootstrap Icons](https://icons.getbootstrap.com)

## 📞 Support

For support, contact:
- **Email**: contact@kendeatravel.com
- **Admin**: admin@kendeatravel.com
- **WhatsApp**: +971582032582

---

<p align="center">Made with ❤️ for Dubai Tourism by KENDEA Travel</p>
