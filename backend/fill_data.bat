@echo off
echo ====================================
echo    MENGISI DATA MAHASISWA KOSONG
echo ====================================
echo.

echo [INFO] Menjalankan artisan command untuk mengisi data...

php artisan tinker --execute="
use App\Models\Mahasiswa;
use App\Models\MahasiswaDomisili;
use App\Models\MahasiswaOrtu;

echo 'Starting data update...' . PHP_EOL;

\$mahasiswaList = Mahasiswa::all();
echo 'Found ' . \$mahasiswaList->count() . ' mahasiswa' . PHP_EOL;

foreach (\$mahasiswaList as \$index => \$mhs) {
    \$updateData = [
        'program_studi' => \$mhs->program_studi ?: 'S1 - PROGRAM STUDI S1 ' . strtoupper(\$mhs->jurusan),
        'jenis_kelamin' => \$mhs->jenis_kelamin ?: (rand(0,1) ? 'Laki-laki' : 'Perempuan'),
        'tempat_lahir' => \$mhs->tempat_lahir ?: 'Manado',
        'tanggal_lahir' => \$mhs->tanggal_lahir ?: '2000-01-01',
        'agama' => \$mhs->agama ?: 'Kristen',
        'kewarganegaraan' => \$mhs->kewarganegaraan ?: 'Indonesia',
        'nik' => \$mhs->nik ?: '7101' . str_pad(\$index + 1, 12, '0', STR_PAD_LEFT),
        'status_nikah' => \$mhs->status_nikah ?: 'Belum Menikah',
        'sks_total' => \$mhs->sks_total ?: rand(50, 144),
        'ipk' => \$mhs->ipk ?: round(rand(250, 400) / 100, 2)
    ];
    
    \$mhs->update(\$updateData);
    echo 'Updated: ' . \$mhs->nama . PHP_EOL;
}

echo 'Data update completed!' . PHP_EOL;
"

echo.
echo ====================================
echo    UPDATE SELESAI!
echo ====================================
echo Data mahasiswa telah diupdate.
echo.
pause
