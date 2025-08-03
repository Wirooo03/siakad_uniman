@echo off
echo ========================================
echo MySQL Database Setup for SIAKAD
echo ========================================
echo.

echo Step 1: Creating database 'siakad_uniman'...
mysql -u root -p -e "CREATE DATABASE IF NOT EXISTS siakad_uniman CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"

if %ERRORLEVEL% NEQ 0 (
    echo.
    echo ❌ Error: Could not connect to MySQL!
    echo.
    echo Please check:
    echo 1. MySQL is installed and running
    echo 2. MySQL credentials are correct
    echo 3. Run this as Administrator if needed
    echo.
    pause
    exit /b 1
)

echo ✅ Database 'siakad_uniman' created successfully!
echo.

echo Step 2: Testing Laravel database connection...
php artisan migrate:status

if %ERRORLEVEL% NEQ 0 (
    echo.
    echo ❌ Error: Laravel cannot connect to MySQL!
    echo Please check your .env configuration.
    echo.
    pause
    exit /b 1
)

echo.
echo Step 3: Running migrations...
php artisan migrate:fresh --seed

if %ERRORLEVEL% NEQ 0 (
    echo.
    echo ❌ Error during migration!
    pause
    exit /b 1
)

echo.
echo ✅ MySQL Database Setup Complete!
echo.
echo Database: siakad_uniman
echo Tables: users, cache, jobs, mahasiswa
echo Sample data: 5 mahasiswa records
echo.
echo Ready to start Laravel server!
echo.
pause
