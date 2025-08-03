#!/bin/bash
# SIAKAD Setup Script
# Script untuk setup otomatis SIAKAD di Linux/Mac

echo "🎓 SIAKAD Setup Script"
echo "======================"

# Check if required software is installed
echo "📋 Checking requirements..."

# Check Node.js
if ! command -v node &> /dev/null; then
    echo "❌ Node.js not found. Please install Node.js v18+"
    exit 1
fi

# Check PHP
if ! command -v php &> /dev/null; then
    echo "❌ PHP not found. Please install PHP v8.1+"
    exit 1
fi

# Check Composer
if ! command -v composer &> /dev/null; then
    echo "❌ Composer not found. Please install Composer"
    exit 1
fi

echo "✅ All requirements satisfied!"

# Setup Backend
echo ""
echo "🔧 Setting up Backend (Laravel)..."
cd backend

# Install dependencies
echo "📦 Installing backend dependencies..."
composer install

# Copy environment file
if [ ! -f .env ]; then
    echo "📄 Creating .env file..."
    cp .env.example .env
    echo "⚠️  Please edit .env file to configure your database"
fi

# Generate key
echo "🔑 Generating application key..."
php artisan key:generate

echo "✅ Backend setup completed!"

# Setup Frontend
echo ""
echo "🔧 Setting up Frontend (Next.js)..."
cd ../frontend

# Install dependencies
echo "📦 Installing frontend dependencies..."
npm install

# Copy environment file
if [ ! -f .env.local ]; then
    echo "📄 Creating .env.local file..."
    cp .env.example .env.local
fi

echo "✅ Frontend setup completed!"

# Final instructions
echo ""
echo "🎉 Setup completed successfully!"
echo ""
echo "📝 Next steps:"
echo "1. Configure database in backend/.env"
echo "2. Run: cd backend && php artisan migrate"
echo "3. Start backend: cd backend && php artisan serve"
echo "4. Start frontend: cd frontend && npm run dev"
echo ""
echo "🌐 Access the application:"
echo "- Frontend: http://localhost:3000"
echo "- Backend API: http://localhost:8000/api"
echo "- SIAKAD Dashboard: http://localhost:3000/siakad/list_mahasiswa"
echo ""
echo "📖 Read README.md for detailed instructions!"
