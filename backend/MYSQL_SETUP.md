# 🐬 MySQL Database Setup Guide

## ✅ Configuration Changed: SQLite → MySQL

### 📊 Database Configuration

**Before (SQLite):**
```env
DB_CONNECTION=sqlite
```

**After (MySQL):**
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=siakad_uniman
DB_USERNAME=root
DB_PASSWORD=
```

## 🚀 Setup Steps

### Option 1: Automatic Setup (Recommended)
1. **Run setup script:**
   ```bash
   cd backend
   setup-mysql.bat
   ```
   
2. **Enter MySQL password when prompted**

3. **Script will:**
   - Create database `siakad_uniman`
   - Test Laravel connection
   - Run migrations & seeders
   - Setup sample data

### Option 2: Manual Setup

#### Step 1: Create Database
**Via MySQL Command Line:**
```sql
mysql -u root -p
CREATE DATABASE siakad_uniman CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE siakad_uniman;
EXIT;
```

**Via phpMyAdmin:**
- Database name: `siakad_uniman`
- Charset: `utf8mb4_unicode_ci`

#### Step 2: Run Laravel Migrations
```bash
cd backend
php artisan migrate:fresh --seed
```

## 🔧 Prerequisites

### Required Software:
1. **MySQL Server 8.0+** or **MariaDB**
2. **PHP MySQL Extension** (usually included)

### Popular MySQL Distributions:
- **XAMPP** (includes MySQL + phpMyAdmin)
- **Laragon** (lightweight alternative)
- **WAMP** (Windows)
- **MySQL Community Server** (standalone)

### Check MySQL Status:
```bash
mysql --version
mysql -u root -p -e "SHOW DATABASES;"
```

## 📋 Database Structure (Same as Before)

### Table: `mahasiswa`
- 11 columns with indexes
- 5 sample records
- UTF8MB4 charset for international characters

### Sample Data:
- John Doe (Teknik Informatika)
- Jane Smith (Sistem Informasi)  
- Ahmad Rahman (Teknik Informatika)
- Siti Nurhaliza (Manajemen Informatika)
- Budi Santoso (Sistem Informasi - Cuti)

## 🌐 API Endpoints (Unchanged)
- `/api/test` - Test connection + MySQL status
- `/api/mahasiswa` - All students from MySQL
- `/api/mahasiswa/{id}` - Student by ID
- `/api/mahasiswa/status/aktif` - Active students
- `/api/mahasiswa/jurusan/{name}` - Filter by major

## ⚡ Benefits of MySQL vs SQLite

| Feature | SQLite | MySQL |
|---------|--------|--------|
| **Performance** | Good for small apps | Better for concurrent users |
| **Scalability** | Limited | High scalability |
| **Data Types** | Limited | Rich data types |
| **Tools** | Basic | phpMyAdmin, Workbench |
| **Production** | Not recommended | Production ready |
| **Backup** | File copy | mysqldump, replication |

## 🔄 Next Steps
1. ✅ Database configuration updated
2. 🔄 Run setup script or manual setup
3. 🔄 Test API endpoints
4. 🔄 Verify data in phpMyAdmin
5. 🔄 Start Laravel server

**MySQL configuration ready! Run the setup to complete the migration.** 🎉
