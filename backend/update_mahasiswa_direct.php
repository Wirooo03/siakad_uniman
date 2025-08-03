<?php
require_once __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Mahasiswa;
use App\Models\MahasiswaDomisili;
use App\Models\MahasiswaOrtu;
    
try {
    echo "=== UPDATING MAHASISWA DATA ===\n";
    
    // Get all mahasiswa
    $mahasiswaList = Mahasiswa::all();
    echo "Found " . $mahasiswaList->count() . " mahasiswa records\n";
    
    $sampleData = [
        'konsentrasi' => ['Farmasi Klinis', 'Sistem Informasi', 'Kedokteran Umum', 'Manajemen', 'Hukum Pidana'],
        'tempat_lahir' => ['Manado', 'Tomohon', 'Bitung', 'Minahasa', 'Kotamobagu'],
        'agama' => ['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha'],
        'suku' => ['Minahasa', 'Sangir', 'Talaud', 'Mongondow', 'Bolaang'],
        'transportasi' => ['Motor', 'Mobil', 'Angkot', 'Ojek Online', 'Jalan Kaki'],
        'bank' => ['BRI', 'BNI', 'BCA', 'Mandiri', 'BTN']
    ];
    
    foreach ($mahasiswaList as $index => $mhs) {
        echo "\nUpdating mahasiswa: " . $mhs->nama . " (ID: " . $mhs->id . ")\n";
        
        // Generate data
        $isLakiLaki = rand(0,1);
        $jenisKelamin = $isLakiLaki ? 'Laki-laki' : 'Perempuan';
        $tempatLahir = $sampleData['tempat_lahir'][array_rand($sampleData['tempat_lahir'])];
        $tanggalLahir = date('Y-m-d', strtotime('-' . rand(18, 25) . ' years'));
        
        // Update mahasiswa data
        $updateData = [
            'program_studi' => $mhs->program_studi ?: 'S1 - PROGRAM STUDI S1 ' . strtoupper($mhs->jurusan),
            'konsentrasi' => $mhs->konsentrasi ?: $sampleData['konsentrasi'][array_rand($sampleData['konsentrasi'])],
            'periode_masuk' => $mhs->periode_masuk ?: '2024 Ganjil',
            'tahun_kurikulum' => $mhs->tahun_kurikulum ?: '2022',
            'sistem_kuliah' => $mhs->sistem_kuliah ?: 'Reguler',
            'kelas_kelompok' => $mhs->kelas_kelompok ?: chr(65 + rand(0, 4)),
            'jenis_pendaftaran' => $mhs->jenis_pendaftaran ?: 'Mahasiswa Baru',
            'jalur_pendaftaran' => $mhs->jalur_pendaftaran ?: ['SNBP', 'SNBT', 'Mandiri'][rand(0,2)],
            'biodata_valid' => $mhs->biodata_valid ?: '✓',
            'kampus' => $mhs->kampus ?: 'Kampus Utama Manado',
            'jenis_kelamin' => $mhs->jenis_kelamin ?: $jenisKelamin,
            'tempat_lahir' => $mhs->tempat_lahir ?: $tempatLahir,
            'tanggal_lahir' => $mhs->tanggal_lahir ?: $tanggalLahir,
            'agama' => $mhs->agama ?: $sampleData['agama'][array_rand($sampleData['agama'])],
            'suku' => $mhs->suku ?: $sampleData['suku'][array_rand($sampleData['suku'])],
            'berat_badan' => $mhs->berat_badan ?: rand(45, 90),
            'tinggi_badan' => $mhs->tinggi_badan ?: rand(150, 185),
            'golongan_darah' => $mhs->golongan_darah ?: ['A', 'B', 'AB', 'O'][rand(0,3)],
            'transportasi' => $mhs->transportasi ?: $sampleData['transportasi'][array_rand($sampleData['transportasi'])],
            'kewarganegaraan' => $mhs->kewarganegaraan ?: 'Indonesia',
            'nik' => $mhs->nik ?: '7101' . str_pad($index + 1, 12, '0', STR_PAD_LEFT),
            'no_kk' => $mhs->no_kk ?: '7101522' . str_pad($index + 1, 9, '0', STR_PAD_LEFT),
            'status_nikah' => $mhs->status_nikah ?: 'Belum Menikah',
            'ukuran_jas' => $mhs->ukuran_jas ?: ['S', 'M', 'L', 'XL'][rand(0,3)],
            'no_hp' => $mhs->no_hp ?: $mhs->telepon ?: '081' . rand(100000000, 999999999),
            'kepemilikan_hp' => $mhs->kepemilikan_hp ?: 'Pribadi',
            'email_kampus' => $mhs->email_kampus ?: strtolower(str_replace(' ', '.', $mhs->nama)) . '@student.uniman.ac.id',
            'email_pribadi' => $mhs->email_pribadi ?: $mhs->email,
            'pekerjaan' => $mhs->pekerjaan ?: 'Mahasiswa',
            'instansi_pekerjaan' => $mhs->instansi_pekerjaan ?: '-',
            'penghasilan' => $mhs->penghasilan ?: '0',
            'no_rekening' => $mhs->no_rekening ?: rand(1000000000, 9999999999),
            'nama_rekening' => $mhs->nama_rekening ?: $mhs->nama,
            'nama_bank' => $mhs->nama_bank ?: $sampleData['bank'][array_rand($sampleData['bank'])],
            'sks_total' => $mhs->sks_total ?: rand(50, 144),
            'ipk' => $mhs->ipk ?: round(rand(250, 400) / 100, 2)
        ];
        
        $mhs->update($updateData);
        echo "✓ Updated basic data\n";
        
        // Create domisili if not exists
        if (!$mhs->domisili) {
            MahasiswaDomisili::create([
                'mahasiswa_id' => $mhs->id,
                'alamat_ktp' => 'Jl. ' . ['Sam Ratulangi', 'Piere Tendean', 'Boulevard'][rand(0,2)] . ' No. ' . rand(1, 999),
                'rt_ktp' => str_pad(rand(1, 20), 3, '0', STR_PAD_LEFT),
                'rw_ktp' => str_pad(rand(1, 15), 3, '0', STR_PAD_LEFT),
                'kelurahan_ktp' => 'Wanea',
                'kecamatan_ktp' => 'Wanea',
                'kabupaten_ktp' => $tempatLahir,
                'provinsi_ktp' => 'Sulawesi Utara',
                'kode_pos_ktp' => '951' . rand(10, 99),
                'alamat_domisili' => $mhs->alamat ?: 'Jl. Kampus Unima No. ' . rand(1, 500),
                'rt_domisili' => str_pad(rand(1, 20), 3, '0', STR_PAD_LEFT),
                'rw_domisili' => str_pad(rand(1, 15), 3, '0', STR_PAD_LEFT),
                'kelurahan_domisili' => 'Tikala Ares',
                'kecamatan_domisili' => 'Tikala',
                'kabupaten_domisili' => 'Manado',
                'provinsi_domisili' => 'Sulawesi Utara',
                'kode_pos_domisili' => '951' . rand(10, 99)
            ]);
            echo "✓ Created domisili data\n";
        }
        
        // Create ortu if not exists
        if (!$mhs->ortu) {
            $namaAyah = ['Budi', 'Ahmad', 'Robert', 'Steven'][rand(0,3)] . ' ' . 
                       ['Pratama', 'Lestari', 'Runtu', 'Mandagi'][rand(0,3)];
            $namaIbu = ['Siti', 'Maria', 'Grace', 'Rita'][rand(0,3)] . ' ' . 
                      ['Nurhaliza', 'Lestari', 'Runtu', 'Mandagi'][rand(0,3)];
            
            MahasiswaOrtu::create([
                'mahasiswa_id' => $mhs->id,
                'nama_ayah' => $namaAyah,
                'nik_ayah' => '7101' . str_pad($index + 1000, 12, '0', STR_PAD_LEFT),
                'tanggal_lahir_ayah' => date('Y-m-d', strtotime($tanggalLahir . ' -25 years')),
                'pendidikan_ayah' => ['SMA', 'D3', 'S1', 'S2'][rand(0,3)],
                'pekerjaan_ayah' => ['PNS', 'Swasta', 'Wiraswasta', 'Petani'][rand(0,3)],
                'penghasilan_ayah' => rand(3, 15) * 1000000,
                'telepon_ayah' => '082' . rand(100000000, 999999999),
                'nama_ibu' => $namaIbu,
                'nik_ibu' => '7101' . str_pad($index + 2000, 12, '0', STR_PAD_LEFT),
                'tanggal_lahir_ibu' => date('Y-m-d', strtotime($tanggalLahir . ' -23 years')),
                'pendidikan_ibu' => ['SMA', 'D3', 'S1'][rand(0,2)],
                'pekerjaan_ibu' => ['Ibu Rumah Tangga', 'PNS', 'Swasta', 'Guru'][rand(0,3)],
                'penghasilan_ibu' => rand(0, 10) * 1000000,
                'telepon_ibu' => '083' . rand(100000000, 999999999)
            ]);
            echo "✓ Created ortu data\n";
        }
    }
    
    echo "\n=== UPDATE COMPLETED ===\n";
    echo "Total mahasiswa updated: " . $mahasiswaList->count() . "\n";
    echo "Mahasiswa with domisili: " . MahasiswaDomisili::count() . "\n";
    echo "Mahasiswa with ortu: " . MahasiswaOrtu::count() . "\n";
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
    echo "File: " . $e->getFile() . " Line: " . $e->getLine() . "\n";
}
?>
