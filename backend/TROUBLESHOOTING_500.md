# 🚨 Troubleshooting: HTTP Error 500

## ❌ Error yang Terjadi
```
Terjadi kesalahan saat mengambil data: HTTP error! status: 500
```

## 🔧 Langkah Troubleshooting yang Sudah Dilakukan

### 1. ✅ Enhanced Error Handling
- Added detailed error logging to API endpoints
- Added debug endpoint: `/api/mahasiswa/debug`
- Added proper exception handling with line numbers

### 2. ✅ Debug Endpoint Added
**URL:** `http://127.0.0.1:8000/api/mahasiswa/debug`

**Purpose:** 
- Test database connection
- Check if mahasiswa table exists
- Show sample data
- Count total records

### 3. ✅ Frontend Debug Button
- Added debug button in API test page
- Results shown in browser console
- Better error messages with details

## 🚀 How to Debug

### Step 1: Start Backend Server
```bash
cd backend
php artisan serve --host=127.0.0.1 --port=8000
```

### Step 2: Test Debug Endpoint
1. Go to: http://localhost:3000/api-test
2. Click **"Debug Database"** button
3. Check browser console for results
4. Or visit directly: http://127.0.0.1:8000/api/mahasiswa/debug

### Step 3: Check Database Connection
```bash
# Test MySQL connection
php artisan tinker
> DB::connection()->getPdo();
> \App\Models\Mahasiswa::count();
```

### Step 4: Verify Database Setup
```bash
# Check if migrations ran
php artisan migrate:status

# Reset database if needed
php artisan migrate:fresh --seed
```

## 🔍 Possible Causes & Solutions

### 1. **Database Not Connected**
**Symptoms:** Can't connect to MySQL
**Solution:**
```bash
# Check MySQL is running
# Update .env with correct credentials
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_DATABASE=siakad_uniman
DB_USERNAME=root
DB_PASSWORD=
```

### 2. **Table Doesn't Exist**
**Symptoms:** Table 'mahasiswa' doesn't exist
**Solution:**
```bash
php artisan migrate:fresh --seed --force
```

### 3. **Model Issues**
**Symptoms:** Class not found errors
**Solution:**
```bash
composer dump-autoload
php artisan config:clear
php artisan cache:clear
```

### 4. **Seeder Failed**
**Symptoms:** No data in database
**Solution:**
```bash
php artisan db:seed --class=MahasiswaSeeder --force
```

## 📊 Debug Response Examples

### Success Response:
```json
{
  "status": "success",
  "message": "Debug mahasiswa endpoint",
  "data": {
    "total_mahasiswa": 5,
    "sample_data": {
      "id": 1,
      "nim": "123456789",
      "nama": "John Doe",
      ...
    },
    "table_exists": true
  }
}
```

### Error Response:
```json
{
  "status": "error",
  "message": "Debug failed", 
  "error": "SQLSTATE[42S02]: Base table or view not found",
  "line": 45,
  "file": "api.php"
}
```

## 🎯 Next Steps

1. **Click Debug Button** - Use the new debug button in frontend
2. **Check Console** - Look for detailed error messages
3. **Verify Database** - Ensure MySQL is running and accessible
4. **Reset if Needed** - Run migrations and seeders again

## 📞 Quick Fixes

### If Database Connection Failed:
1. Start MySQL service
2. Check credentials in `.env`
3. Create database: `CREATE DATABASE siakad_uniman;`

### If Table Not Found:
```bash
php artisan migrate:fresh --seed
```

### If Still Error 500:
1. Check Laravel logs in `storage/logs/laravel.log`
2. Use debug endpoint for detailed error info
3. Enable debug mode in `.env`: `APP_DEBUG=true`

**Debug endpoint ready for testing!** 🔧
