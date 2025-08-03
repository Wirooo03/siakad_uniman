# Cara Mengatasi Error PSY/PSYSH dan Menjalankan Laravel Server

## Masalah:
Parse error pada PSY/PSYSH package yang menyebabkan Laravel server tidak bisa dijalankan.

## Solusi 1: Hapus PSY/PSYSH (Recommended)
```bash
cd d:\main\v1\experiment\bejir\backend
rm -rf vendor/psy
composer install --no-dev
php artisan serve --host=127.0.0.1 --port=8000
```

## Solusi 2: Skip Artisan, gunakan PHP Server langsung
```bash
cd d:\main\v1\experiment\bejir\backend
php -S 127.0.0.1:8000 -t public
```

## Solusi 3: Fix Composer Dependencies
```bash
cd d:\main\v1\experiment\bejir\backend
composer clear-cache
composer remove psy/psysh --dev
composer install
php artisan serve --host=127.0.0.1 --port=8000
```

## Testing Edit Functionality:
1. Start server menggunakan salah satu cara di atas
2. Buka browser: http://localhost:3000/siakad/list_mahasiswa
3. Pilih mahasiswa dan klik Edit
4. Ubah field seperti nama, suku, NIK, paspor
5. Klik Simpan
6. Cek Console Browser untuk melihat detailed error jika ada
7. Verifikasi perubahan di detail mahasiswa

## Error Handling yang Sudah Diperbaiki:
- ✅ Enhanced validation error display
- ✅ Proper field type conversion (string, number, boolean)
- ✅ Only send non-empty fields to avoid validation issues
- ✅ Detailed console logging for debugging
- ✅ Backend validation rules include all extended fields

## Field yang Sudah Diperbaiki:
- ✅ suku, nik, paspor - semua field administrasi
- ✅ Field numerik (berat_badan, tinggi_badan) dengan proper conversion
- ✅ Boolean field (biodata_valid) dengan proper conversion
- ✅ Email validation untuk email_kampus dan email_pribadi
- ✅ Date validation untuk tanggal_lahir dan tanggal_masuk
