@echo off
cls
echo ====================================
echo     SETUP DATABASE MAHASISWA
echo ====================================
echo.

echo [1/5] Checking PHP and Laravel...
php --version
if %errorlevel% neq 0 (
    echo ERROR: PHP tidak ditemukan!
    pause
    exit /b 1
)
echo.

echo [2/5] Menjalankan migrasi database...
php artisan migrate --force
if %errorlevel% neq 0 (
    echo ERROR: Migrasi gagal!
    pause
    exit /b 1
)
echo Migrasi berhasil!
echo.

echo [3/5] Menjalankan seeder utama...
php artisan db:seed --class=MahasiswaDetailSeeder --force
if %errorlevel% neq 0 (
    echo WARNING: Seeder utama mungkin sudah dijalankan sebelumnya
)
echo.

echo [4/5] Menambah data mahasiswa tambahan...
php artisan db:seed --class=MahasiswaExtraSeeder --force
if %errorlevel% neq 0 (
    echo WARNING: Data tambahan mungkin sudah ada
)
echo.

echo [5/5] Checking hasil...
php artisan tinker --execute="echo 'Total mahasiswa: ' . \App\Models\Mahasiswa::count(); echo PHP_EOL . 'Mahasiswa dengan NIK: ' . \App\Models\Mahasiswa::whereNotNull('nik')->count(); echo PHP_EOL . 'Mahasiswa dengan data ortu: ' . \App\Models\MahasiswaOrtu::count(); echo PHP_EOL . 'Mahasiswa dengan data domisili: ' . \App\Models\MahasiswaDomisili::count();"
echo.

echo ====================================
echo     SETUP SELESAI!
echo ====================================
echo Database telah disetup dengan data lengkap:
echo - Migrasi tabel berhasil
echo - Data sample lengkap
echo - Relasi antar tabel
echo - Field kosong telah diisi
echo.
echo Anda sekarang dapat:
echo 1. Menjalankan: start_servers.bat
echo 2. Akses frontend: http://localhost:3000
echo 3. Test database: http://localhost:3000/test
echo.
pause
