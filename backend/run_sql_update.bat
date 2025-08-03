@echo off
echo ====================================
echo    MENGISI DATA MAHASISWA KOSONG
echo    MENGGUNAKAN SQL SCRIPT
echo ====================================
echo.

echo [INFO] Menjalankan SQL script untuk mengisi data kosong...
echo [INFO] Database: siakad_uniman
echo [INFO] Host: 127.0.0.1:5432
echo.

psql -h 127.0.0.1 -p 5432 -U postgres -d siakad_uniman -f update_mahasiswa.sql

if %errorlevel% equ 0 (
    echo.
    echo ====================================
    echo    UPDATE BERHASIL!
    echo ====================================
    echo Semua data mahasiswa kosong telah diisi.
) else (
    echo.
    echo ====================================
    echo    UPDATE GAGAL!
    echo ====================================
    echo Silakan cek koneksi database atau password.
)

echo.
pause
