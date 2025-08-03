# 🚨 DIAGNOSA MASALAH: MySQL Tidak Terdeteksi

## 🔍 Hasil Analisis

Berdasarkan testing yang sudah dilakukan, ditemukan bahwa:

**❌ MySQL tidak berjalan atau tidak terinstall di sistem**
- Port 3306 tidak listening
- Command `mysql --version` tidak ditemukan
- Database connection test gagal

## 🛠️ Solusi yang Harus Dilakukan

### Opsi 1: Install MySQL (Recommended for Production)

#### Windows dengan XAMPP:
1. **Download XAMPP**: https://www.apachefriends.org/download.html
2. **Install XAMPP** dengan komponen MySQL
3. **Start MySQL** dari XAMPP Control Panel
4. **Buat Database**:
   ```sql
   CREATE DATABASE siakad_uniman;
   ```

#### Windows dengan MySQL Installer:
1. **Download MySQL**: https://dev.mysql.com/downloads/installer/
2. **Install MySQL Server** + **MySQL Workbench**
3. **Set root password** (kosongkan jika ingin tanpa password)
4. **Start MySQL Service**

### Opsi 2: Gunakan SQLite (Quick Setup)

Jika ingin cepat untuk development, ubah ke SQLite:

#### 1. Update .env file:
```env
DB_CONNECTION=sqlite
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=siakad_uniman
# DB_USERNAME=root
# DB_PASSWORD=
```

#### 2. Buat database file:
```bash
cd backend
touch database/database.sqlite
```

#### 3. Run migrations:
```bash
php artisan migrate:fresh --seed
```

## 🚀 After MySQL Setup - Testing Steps

### 1. Test Database Connection
```bash
cd backend
php test_db_simple.php
```

### 2. Setup Laravel Database
```bash
# Create database in MySQL first
mysql -u root -p -e "CREATE DATABASE siakad_uniman;"

# Run migrations
php artisan migrate:fresh --seed
```

### 3. Start Laravel Server
```bash
php artisan serve --host=127.0.0.1 --port=8000
```

### 4. Test API Endpoints
```bash
# Test basic endpoint
curl http://127.0.0.1:8000/api/test

# Test debug endpoint  
curl http://127.0.0.1:8000/api/mahasiswa/debug

# Test mahasiswa endpoint
curl http://127.0.0.1:8000/api/mahasiswa
```

## 🎯 Quick Resolution

**Cara Tercepat untuk Testing:**

1. **Install XAMPP** (5 menit)
2. **Start MySQL** dari control panel
3. **Buat database** siakad_uniman
4. **Run migrations**: `php artisan migrate:fresh --seed`
5. **Start server**: `php artisan serve`

## 📞 Troubleshooting Commands

```bash
# Check if MySQL is running
netstat -an | findstr ":3306"

# Test PHP MySQL extension
php -m | findstr mysql

# Test basic MySQL connection
mysql -u root -p -e "SHOW DATABASES;"

# Reset Laravel if needed
php artisan config:clear
php artisan cache:clear
composer dump-autoload
```

## 📋 Status Checklist

- [ ] MySQL Server installed
- [ ] MySQL Service running (port 3306)
- [ ] Database `siakad_uniman` created
- [ ] Laravel migrations run successfully
- [ ] Sample data seeded
- [ ] API endpoints accessible

**Next Action:** Install MySQL atau switch to SQLite untuk quick testing!
