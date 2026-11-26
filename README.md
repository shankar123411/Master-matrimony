# Master Matrimony (மாஸ்டர் மணமாலை)

Bilingual (Tamil & English) Matrimony Management SaaS & Biodata Automation Platform built with **Laravel 12** and **Filament 5**.

## Key Features
- **36-Field Smart Biodata Parser & Auto-Fill**: Supports PDF, image OCR (`Tesseract.js`), and text biodata import.
- **12-House South Indian Horoscope Grid**: Interactive Rasi & Navamsam charts with Tamil planetary placements.
- **Print-Ready A4 Yellow Biodata Sheet**: High-DPI `html2canvas` + `jsPDF` export with custom vector crest & seal watermark.
- **Bilingual Portal (தமிழ் / English)**: Instant UI and biodata language switching, admin settings, and OTP password recovery.
- **Filament 5 Admin Panel (`/admin`)**: Full CRUD, search, and printable record management.

## Local Setup
```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan serve
```

## Render Deployment (Docker)
- **Runtime:** Docker (`Dockerfile` + `render-start.sh`)
- **Environment Variables:**
  - `APP_ENV=production`
  - `APP_DEBUG=false`
  - `APP_KEY=<base64:...>`
  - `DB_CONNECTION=sqlite`
  - `ADMIN_ID=<your-admin-id>` (optional, defaults to `admin`)
  - `ADMIN_PASSWORD=<your-password>` (optional, defaults to `password`)
