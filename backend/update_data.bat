@echo off
cls
echo ========================================
echo    UPDATING DATABASE MAHASISWA
echo ========================================
echo.

echo [INFO] Menjalankan seeder untuk mengisi data kosong...
php artisan db:seed --class=MahasiswaDetailSeeder --force

echo.
echo [INFO] Checking jumlah mahasiswa...
php artisan tinker --execute="echo 'Total mahasiswa: ' . \App\Models\Mahasiswa::count(); echo PHP_EOL . 'Mahasiswa dengan data lengkap: ' . \App\Models\Mahasiswa::whereNotNull('nik')->count();"

echo.
echo ========================================
echo    UPDATE SELESAI!
echo ========================================
echo Data mahasiswa telah diupdate dengan informasi lengkap
echo.
pause
