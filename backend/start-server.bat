@echo off
echo ================================
echo Laravel Backend Server (MySQL)
echo ================================
echo.
echo Checking dependencies...
if not exist "vendor\autoload.php" (
    echo Installing dependencies...
    composer install
    echo.
)

echo Checking MySQL connection...
php artisan migrate:status >nul 2>&1
if %ERRORLEVEL% NEQ 0 (
    echo.
    echo ❌ Cannot connect to MySQL database!
    echo.
    echo Please ensure:
    echo 1. MySQL is running
    echo 2. Database 'siakad_uniman' exists
    echo 3. Credentials in .env are correct
    echo.
    echo Run 'setup-mysql.bat' to create database first
    echo.
    pause
    exit /b 1
)

echo ✅ MySQL connection OK!
echo.

echo Generating application key...
php artisan key:generate --force

echo.
echo Starting server at: http://127.0.0.1:8000
echo API endpoints available at: http://127.0.0.1:8000/api/
echo Database: MySQL (siakad_uniman)
echo.
echo Test endpoints:
echo - http://127.0.0.1:8000/api/test
echo - http://127.0.0.1:8000/api/mahasiswa
echo.
echo Press Ctrl+C to stop the server
echo ================================
echo.

php artisan serve --host=127.0.0.1 --port=8000
