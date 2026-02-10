# KENDEA.md

This file provides guidance to AI Agents when working with code in this repository.

## Project Overview

This is a Laravel 12 application for booking activities. It's a single-page application (SPA) using traditional server-side rendering with Blade templates, enhanced with jQuery and AJAX for dynamic content. The application uses Yajra DataTables for server-side activity listings and WhatsApp integration for booking confirmations.

**Tech Stack:**

- Laravel 12 (PHP 8.2+)
- MySQL database
- jQuery with DataTables
- Bootstrap Icons
- AOS (Animate On Scroll) library
- Intervention Image for image processing

## Development Commands

### Initial Setup

```bash
composer setup  # Full setup: installs dependencies, generates key, runs migrations, builds assets
```

### Development Server

```bash
composer dev    # Runs all services concurrently: Laravel server, queue worker, pail logs, and Vite
```

Individual services:

```bash
php artisan serve              # Development server (localhost:8000)
php artisan queue:listen       # Queue worker
php artisan pail               # Real-time log monitoring
npm run dev                    # Vite development server with hot-reload
```

### Database Operations

```bash
php artisan migrate            # Run migrations
php artisan migrate:fresh      # Drop all tables and re-run migrations
php artisan db:seed            # Seed database with CategoryActivitySeeder
php artisan migrate:fresh --seed   # Reset and seed database
```

### Testing & Quality

```bash
composer test                  # Run PHPUnit tests (clears config first)
php artisan test               # Alternative test command
vendor/bin/pint                # Laravel Pint code formatter
```

### Asset Building

```bash
npm run build                  # Production build
npm run dev                    # Development build with hot-reload
```

### Artisan Helpers

```bash
php artisan route:list         # View all routes
php artisan tinker             # Interactive REPL
php artisan config:clear       # Clear configuration cache
php artisan cache:clear        # Clear application cache
```

## Architecture

### Database Schema

**Core Tables:**

- `categories`: Activity categories (e.g., Desert Safari, Water Parks, City Tours)
- `activities`: Main activities table with JSON image arrays, pricing, location, and ratings
- `clients`: Customer information
- `commandes`: Orders linking clients to multiple activities (stored as JSON array of IDs)

**Key Relationships:**

- Activity → Category (belongsTo via `categorie_id`)
- Commande → Client (belongsTo)
- Commande contains array of activity IDs (manual relationship via `getActivitiesDetails()`)

**Important Schema Details:**

- Activities use auto-generated slugs from the `nom` field
- Images stored as JSON array (up to 5 paths)
- Ratings are decimal(2,1) from 0.0 to 5.0
- Prices are decimal(10,2)
- Activities table has indexes on: slug, prix, notes, categorie_id

### Request Flow

1. **Initial Page Load**: `GET /` → `ActivityController@index` → renders `activities.index` view with all categories
2. **Activity Data**: AJAX `GET /api/activities` → DataTables server-side processing with category filtering
3. **Activity Details**: AJAX `GET /api/activities/{id}` → returns single activity JSON
4. **Booking**: AJAX `POST /api/commandes` → stores order and returns WhatsApp redirect URL

### Frontend Architecture

**SPA Pattern:**

- Single main view (`resources/views/activities/index.blade.php`)
- Layout: `resources/views/layouts/app.blade.php`
- Partials: header and footer in `resources/views/partials/`
- Main JavaScript: `/public/js/app.js` (compiled from resources during build)

**Key Frontend Features:**

- DataTables handles pagination, search, and filtering (no foreach loops on large datasets)
- Shopping cart tracked in JavaScript global state (`selectedActivities` array)
- AOS library for scroll animations
- WhatsApp integration for order confirmation

### Controllers

**ActivityController** (`app/Http/Controllers/ActivityController.php`):

- `index()`: Main SPA entry point, loads categories
- `getActivities()`: DataTables AJAX endpoint with server-side processing
- `show($id)`: Single activity details
- `sitemap()`: XML sitemap generation
- `renderStars()`: Private helper for star rating HTML

**CommandeController** (`app/Http/Controllers/CommandeController.php`):

- `store()`: Creates order with client + activities, returns WhatsApp URL

### Models

**Activity** (`app/Models/Activity.php`):

- Auto-generates slug from `nom` on creation
- Casts `images` to array, `prix` to decimal(2), `notes` to decimal(1)
- `getFirstImageAttribute()`: Accessor for first image with fallback
- `category()`: BelongsTo relationship

**Commande** (`app/Models/Commande.php`):

- Casts `activities` to array (stores activity IDs)
- Casts `datetime` to Carbon instance
- `getActivitiesDetails()`: Method to fetch Activity models from ID array

**Category** (`app/Models/Category.php`):

- HasMany relationship to activities

**Client** (`app/Models/Client.php`):

- Basic client info model

## Important Patterns & Conventions

### DataTables Usage

- Always use server-side processing via `Yajra\DataTables\Facades\DataTables`
- Never use foreach loops to render large datasets
- Return DataTables JSON from controller, render HTML in column callbacks
- Use `rawColumns()` for HTML output (checkbox, image, details, actions)

### Image Handling

- Images stored in `public/images/` directory
- Activity model stores array of relative paths in JSON
- Use Intervention Image for uploads/processing
- Always provide fallback: `images/default.jpg`

### Code Comments

- Each modified file includes `// Modified by Antigravity` at the top
- This is required per user instructions in ANTIGRAVITY.md

### Localization

- Default locale: French (`fr`)
- Timezone: Africa/Kinshasa
- Faker locale: `fr_FR`

## Configuration Notes

- **WhatsApp Number**: Update `WHATSAPP_NUMBER` in `/public/js/app.js` (currently placeholder)
- **Environment**: Development mode with debug enabled
- **Database**: Configured in `.env` (connection details not committed)
- **Asset Pipeline**: Vite with Tailwind CSS 4.0

## Seeding Data

Use `CategoryActivitySeeder` which creates realistic activities across multiple categories. Run after migrations:

```bash
php artisan db:seed
```

## Routes Structure

**Web Routes** (`routes/web.php`):

- `/` - Main SPA page
- `/api/activities` - DataTables AJAX endpoint
- `/api/activities/{id}` - Single activity JSON
- `/api/commandes` - POST order creation
- `/sitemap.xml` - SEO sitemap

All routes use controller methods (no closures).
