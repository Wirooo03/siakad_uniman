# 🎓 SIAKAD - Sistem Informasi Akademik

Sistem Informasi Akademik modern dengan teknologi **Next.js** (Frontend) dan **Laravel** (Backend).

## 📋 Persyaratan Sistem

### Software yang Diperlukan:
- **Node.js** v18+ dan npm
- **PHP** v8.1+ 
- **Composer** (untuk Laravel)
- **Git**
- **Database**: PostgreSQL atau MySQL/MariaDB

### Optional:
- **pgAdmin** atau **phpMyAdmin** (untuk manajemen database)
- **VS Code** dengan ekstensi PHP dan TypeScript

## 🚀 Cara Setup Proyek

### 1. Clone Repository
```bash
git clone <repository-url>
cd belajar_FEBE
```

### 2. Setup Backend (Laravel)
```bash
# Masuk ke folder backend
cd backend

# Install dependencies
composer install

# Copy file environment
cp .env.example .env

# Generate application key
php artisan key:generate

# Setup database di file .env
# Edit file .env dan sesuaikan konfigurasi database:
# DB_CONNECTION=pgsql
# DB_HOST=127.0.0.1
# DB_PORT=5432
# DB_DATABASE=siakad_uniman
# DB_USERNAME=postgres
# DB_PASSWORD=your_password

# Jalankan migrasi database
php artisan migrate

# Jalankan seeder (optional - untuk data sample)
php artisan db:seed

# Start Laravel server
php artisan serve --host=127.0.0.1 --port=8000
```

### 3. Setup Frontend (Next.js)
```bash
# Buka terminal baru, masuk ke folder frontend
cd frontend

# Install dependencies
npm install

# Copy file environment
cp .env.example .env.local

# Edit .env.local dan sesuaikan API URL:
# NEXT_PUBLIC_API_BASE_URL=http://localhost:8000/api

# Start development server
npm run dev
```

## 🔧 Konfigurasi Database

### PostgreSQL (Recommended)
1. Install PostgreSQL
2. Buat database baru:
   ```sql
   CREATE DATABASE siakad_uniman;
   ```
3. Update file `.env` di folder backend:
   ```env
   DB_CONNECTION=pgsql
   DB_HOST=127.0.0.1
   DB_PORT=5432
   DB_DATABASE=siakad_uniman
   DB_USERNAME=postgres
   DB_PASSWORD=your_password
   ```

### MySQL/MariaDB (Alternative)
1. Install MySQL/MariaDB
2. Buat database baru:
   ```sql
   CREATE DATABASE siakad_uniman;
   ```
3. Update file `.env` di folder backend:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=siakad_uniman
   DB_USERNAME=root
   DB_PASSWORD=your_password
   ```

## 🌐 URL Akses

Setelah setup selesai, akses aplikasi melalui:

- **Frontend (Next.js)**: http://localhost:3000
- **Backend API (Laravel)**: http://localhost:8000/api
- **Dashboard SIAKAD**: http://localhost:3000/siakad/list_mahasiswa

## 📁 Struktur Proyek

```
belajar_FEBE/
├── 📂 backend/                 # Laravel API Backend
│   ├── app/
│   │   ├── Http/Controllers/   # API Controllers
│   │   └── Models/            # Database Models
│   ├── database/
│   │   ├── migrations/        # Database Migrations
│   │   └── seeders/          # Database Seeders
│   ├── routes/
│   │   └── api.php           # API Routes
│   └── .env                  # Environment Config
├── 📂 frontend/               # Next.js Frontend
│   ├── src/
│   │   ├── app/              # Next.js App Router
│   │   ├── components/       # React Components
│   │   ├── lib/              # API Service & Utilities
│   │   └── config/           # Configuration Files
│   └── .env.local            # Frontend Environment
├── 📂 docs/                  # Dokumentasi
└── README.md                 # File ini
```

## 🎯 Fitur Utama

- ✅ **CRUD Mahasiswa** - Kelola data mahasiswa lengkap
- ✅ **Search & Filter** - Pencarian dan filter data
- ✅ **Pagination** - Navigasi data dengan pagination
- ✅ **Responsive Design** - UI responsif untuk semua device
- ✅ **API Terpusat** - Konfigurasi API yang mudah diubah
- ✅ **Validation** - Validasi data frontend dan backend

## 🛠️ Development Commands

### Backend Commands:
```bash
# Start server
php artisan serve

# Migrate database
php artisan migrate

# Reset database dengan seed
php artisan migrate:fresh --seed

# Create new migration
php artisan make:migration create_table_name

# Create new model
php artisan make:model ModelName
```

### Frontend Commands:
```bash
# Start development server
npm run dev

# Build for production
npm run build

# Start production server
npm start

# Lint code
npm run lint
```

## 🔍 Testing & Debugging

### 1. Test Koneksi Database
```bash
# Di folder backend
php artisan tinker
# Jalankan: DB::connection()->getPdo();
```

### 2. Test API Endpoints
- **Health Check**: http://localhost:8000/api/health
- **List Mahasiswa**: http://localhost:8000/api/mahasiswa
- **Detail Mahasiswa**: http://localhost:8000/api/mahasiswa/1

### 3. Check Frontend
- Buka browser developer tools (F12)
- Lihat console untuk error
- Check network tab untuk API calls

## 🚨 Troubleshooting

### Backend Issues:
1. **"Class not found"**
   ```bash
   composer dump-autoload
   ```

2. **"Database connection failed"**
   - Pastikan database service berjalan
   - Check konfigurasi `.env`
   - Test koneksi database

3. **"Permission denied"**
   ```bash
   chmod -R 775 storage bootstrap/cache
   ```

### Frontend Issues:
1. **"Module not found"**
   ```bash
   rm -rf node_modules package-lock.json
   npm install
   ```

2. **"API connection failed"**
   - Pastikan backend server berjalan
   - Check URL di `.env.local`
   - Check CORS configuration

### CORS Issues:
Jika ada error CORS, edit file `backend/config/cors.php`:
```php
'allowed_origins' => [
    'http://localhost:3000',
    'http://127.0.0.1:3000',
],
```

## 📝 Environment Variables

### Backend (.env):
```env
APP_NAME="SIAKAD Uniman"
APP_ENV=local
APP_KEY=base64:...
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=siakad_uniman
DB_USERNAME=postgres
DB_PASSWORD=your_password
```

### Frontend (.env.local):
```env
NEXT_PUBLIC_API_BASE_URL=http://localhost:8000/api
```

## 🤝 Contributing

1. Fork repository
2. Create feature branch: `git checkout -b feature/new-feature`
3. Commit changes: `git commit -am 'Add new feature'`
4. Push to branch: `git push origin feature/new-feature`
5. Create Pull Request

## 📄 License

MIT License - Sistem Informasi Akademik Universitas

---

## 💡 Tips untuk Development

1. **Selalu jalankan backend terlebih dahulu** sebelum frontend
2. **Gunakan browser developer tools** untuk debugging
3. **Check log Laravel** di `storage/logs/laravel.log`
4. **Gunakan Postman/Insomnia** untuk test API secara terpisah
5. **Backup database** sebelum migrasi besar

**Sistem siap digunakan!** 🎉

Jika ada masalah, silakan buat issue di repository ini.
