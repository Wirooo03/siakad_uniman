@echo off
REM SIAKAD Setup Script for Windows
REM Script untuk setup otomatis SIAKAD di Windows

echo 🎓 SIAKAD Setup Script
echo ======================

REM Check if required software is installed
echo 📋 Checking requirements...

REM Check Node.js
node --version >nul 2>&1
if %errorlevel% neq 0 (
    echo ❌ Node.js not found. Please install Node.js v18+
    pause
    exit /b 1
)

REM Check PHP
php --version >nul 2>&1
if %errorlevel% neq 0 (
    echo ❌ PHP not found. Please install PHP v8.1+
    pause
    exit /b 1
)

REM Check Composer
composer --version >nul 2>&1
if %errorlevel% neq 0 (
    echo ❌ Composer not found. Please install Composer
    pause
    exit /b 1
)

echo ✅ All requirements satisfied!

REM Setup Backend
echo.
echo 🔧 Setting up Backend (Laravel)...
cd backend

REM Install dependencies
echo 📦 Installing backend dependencies...
composer install

REM Copy environment file
if not exist .env (
    echo 📄 Creating .env file...
    copy .env.example .env
    echo ⚠️  Please edit .env file to configure your database
)

REM Generate key
echo 🔑 Generating application key...
php artisan key:generate

echo ✅ Backend setup completed!

REM Setup Frontend
echo.
echo 🔧 Setting up Frontend (Next.js)...
cd ..\frontend

REM Install dependencies
echo 📦 Installing frontend dependencies...
npm install

REM Copy environment file
if not exist .env.local (
    echo 📄 Creating .env.local file...
    copy .env.example .env.local
)

echo ✅ Frontend setup completed!

REM Final instructions
echo.
echo 🎉 Setup completed successfully!
echo.
echo 📝 Next steps:
echo 1. Configure database in backend\.env
echo 2. Run: cd backend ^&^& php artisan migrate
echo 3. Start backend: cd backend ^&^& php artisan serve
echo 4. Start frontend: cd frontend ^&^& npm run dev
echo.
echo 🌐 Access the application:
echo - Frontend: http://localhost:3000
echo - Backend API: http://localhost:8000/api
echo - SIAKAD Dashboard: http://localhost:3000/siakad/list_mahasiswa
echo.
echo 📖 Read README.md for detailed instructions!

pause
