<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Mahasiswa;
use App\Models\MahasiswaDomisili;
use App\Models\MahasiswaOrtu;
use App\Models\MahasiswaWali;
use App\Models\MahasiswaPtAsal;

class MahasiswaExtraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Data mahasiswa tambahan untuk berbagai jurusan
        $extraMahasiswa = [
            // EKONOMI
            [
                'nim' => '2024002001',
                'nama' => 'Putri Anggraeni',
                'email' => 'putri.anggraeni@gmail.com',
                'jurusan' => 'EKONOMI',
                'semester' => 2,
                'status' => 'aktif',
                'tanggal_masuk' => '2024-08-15',
                'alamat' => 'Jl. Diponegoro No. 234',
                'telepon' => '08456789012'
            ],
            [
                'nim' => '2024002002',
                'nama' => 'Kevin Mandagi',
                'email' => 'kevin.mandagi@gmail.com',
                'jurusan' => 'EKONOMI',
                'semester' => 4,
                'status' => 'aktif',
                'tanggal_masuk' => '2023-08-15',
                'alamat' => 'Jl. Ahmad Yani No. 567',
                'telepon' => '08567890123'
            ],
            
            // HUKUM
            [
                'nim' => '2024003001',
                'nama' => 'Daniel Waworuntu',
                'email' => 'daniel.waworuntu@gmail.com',
                'jurusan' => 'HUKUM',
                'semester' => 6,
                'status' => 'aktif',
                'tanggal_masuk' => '2022-08-15',
                'alamat' => 'Jl. Sudirman No. 890',
                'telepon' => '08678901234'
            ],
            [
                'nim' => '2024003002',
                'nama' => 'Rachel Tombokan',
                'email' => 'rachel.tombokan@gmail.com',
                'jurusan' => 'HUKUM',
                'semester' => 2,
                'status' => 'aktif',
                'tanggal_masuk' => '2024-08-15',
                'alamat' => 'Jl. Veteran No. 123',
                'telepon' => '08789012345'
            ],
            
            // PSIKOLOGI
            [
                'nim' => '2024004001',
                'nama' => 'Jessica Kumaat',
                'email' => 'jessica.kumaat@gmail.com',
                'jurusan' => 'PSIKOLOGI',
                'semester' => 4,
                'status' => 'aktif',
                'tanggal_masuk' => '2023-08-15',
                'alamat' => 'Jl. Hasanuddin No. 456',
                'telepon' => '08890123456'
            ],
            
            // ARSITEKTUR
            [
                'nim' => '2024005001',
                'nama' => 'Robby Pangkey',
                'email' => 'robby.pangkey@gmail.com',
                'jurusan' => 'ARSITEKTUR',
                'semester' => 6,
                'status' => 'aktif',
                'tanggal_masuk' => '2022-08-15',
                'alamat' => 'Jl. Martadinata No. 789',
                'telepon' => '08901234567'
            ],
            
            // TEKNIK SIPIL
            [
                'nim' => '2024006001',
                'nama' => 'Alexander Sumual',
                'email' => 'alex.sumual@gmail.com',
                'jurusan' => 'TEKNIK SIPIL',
                'semester' => 8,
                'status' => 'aktif',
                'tanggal_masuk' => '2021-08-15',
                'alamat' => 'Jl. Wolter Monginsidi No. 101',
                'telepon' => '09012345678'
            ],
            
            // BAHASA INGGRIS
            [
                'nim' => '2024007001',
                'nama' => 'Olivia Kawalo',
                'email' => 'olivia.kawalo@gmail.com',
                'jurusan' => 'BAHASA INGGRIS',
                'semester' => 4,
                'status' => 'aktif',
                'tanggal_masuk' => '2023-08-15',
                'alamat' => 'Jl. Supratman No. 202',
                'telepon' => '09123456789'
            ],
            
            // PENDIDIKAN GURU SEKOLAH DASAR
            [
                'nim' => '2024008001',
                'nama' => 'Stefani Rurung',
                'email' => 'stefani.rurung@gmail.com',
                'jurusan' => 'PENDIDIKAN GURU SEKOLAH DASAR',
                'semester' => 2,
                'status' => 'aktif',
                'tanggal_masuk' => '2024-08-15',
                'alamat' => 'Jl. Bethesda No. 303',
                'telepon' => '09234567890'
            ],
            
            // BIOLOGI
            [
                'nim' => '2024009001',
                'nama' => 'Jonathan Salaki',
                'email' => 'jonathan.salaki@gmail.com',
                'jurusan' => 'BIOLOGI',
                'semester' => 6,
                'status' => 'aktif',
                'tanggal_masuk' => '2022-08-15',
                'alamat' => 'Jl. Yos Sudarso No. 404',
                'telepon' => '09345678901'
            ]
        ];

        foreach ($extraMahasiswa as $mahasiswaData) {
            // Check if mahasiswa already exists
            $existing = Mahasiswa::where('nim', $mahasiswaData['nim'])->first();
            if (!$existing) {
                Mahasiswa::create($mahasiswaData);
                $this->command->info('Created mahasiswa: ' . $mahasiswaData['nama']);
            }
        }

        $this->command->info('Extra mahasiswa data has been seeded!');
    }
}
