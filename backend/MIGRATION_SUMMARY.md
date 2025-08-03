# 🔄 Database Migration: SQLite → MySQL

## ✅ What Changed

### Database Configuration
- **From:** SQLite (single file database)
- **To:** MySQL (full database server)
- **Database name:** `siakad_uniman`

### Files Updated
1. **`.env`** - Database configuration
2. **`routes/api.php`** - API test endpoint shows MySQL info
3. **`start-server.bat`** - Added MySQL connection check
4. **New files:**
   - `setup-mysql.bat` - Automated setup script
   - `database/create_database.sql` - Manual SQL script
   - `MYSQL_SETUP.md` - Complete setup guide

## 🚀 Quick Setup

### If you have MySQL/XAMPP/Laragon:
```bash
cd backend
setup-mysql.bat
```

### If you need to install MySQL:
1. **Option A:** Install XAMPP (easiest)
   - Download from: https://www.apachefriends.org/
   - Start MySQL service
   - Run setup script

2. **Option B:** Install MySQL Server
   - Download from: https://dev.mysql.com/downloads/
   - Configure with password
   - Update `.env` if needed

## 🧪 Testing After Setup

### 1. Start Backend
```bash
cd backend
start-server.bat
```

### 2. Test API
- Open: http://127.0.0.1:8000/api/test
- Should show MySQL database info

### 3. Test Frontend
- Open: http://localhost:3000/api-test
- All endpoints should work with MySQL data

## 💾 Data Migration

### From SQLite to MySQL:
- ✅ Same table structure
- ✅ Same sample data (5 mahasiswa)
- ✅ Same API endpoints
- ✅ No frontend changes needed

### What You Get:
- 🔒 **Better security** - User permissions
- 📊 **phpMyAdmin** - Visual database management
- ⚡ **Better performance** - For multiple users
- 🔄 **Backup tools** - Professional backup options
- 🏗️ **Scalability** - Production ready

## 🔧 Troubleshooting

### "Cannot connect to MySQL"
1. Check if MySQL is running
2. Verify credentials in `.env`
3. Make sure database `siakad_uniman` exists

### "Access denied"
1. Check MySQL username/password
2. Grant privileges if needed
3. Try with different MySQL user

**Ready to use MySQL! Better performance and production-ready database.** 🎉
