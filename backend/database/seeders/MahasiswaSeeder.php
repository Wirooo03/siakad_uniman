<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Mahasiswa;

class MahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeder.
     */
    public function run(): void
    {
        $mahasiswa = [
            [
                'nim' => '123456789',
                'nama' => 'John Doe',
                'email' => 'john.doe@uniman.ac.id',
                'jurusan' => 'Teknik Informatika',
                'semester' => 6,
                'status' => 'aktif',
                'tanggal_masuk' => '2022-08-01',
                'alamat' => 'Jl. Sudirman No. 123, Manado',
                'telepon' => '081234567890'
            ],
            [
                'nim' => '987654321',
                'nama' => 'Jane Smith',
                'email' => 'jane.smith@uniman.ac.id',
                'jurusan' => 'Sistem Informasi',
                'semester' => 4,
                'status' => 'aktif',
                'tanggal_masuk' => '2023-08-01',
                'alamat' => 'Jl. Sam Ratulangi No. 456, Manado',
                'telepon' => '081234567891'
            ],
            [
                'nim' => '111222333',
                'nama' => 'Ahmad Rahman',
                'email' => 'ahmad.rahman@uniman.ac.id',
                'jurusan' => 'Teknik Informatika',
                'semester' => 8,
                'status' => 'aktif',
                'tanggal_masuk' => '2021-08-01',
                'alamat' => 'Jl. Pierre Tendean No. 789, Manado',
                'telepon' => '081234567892'
            ],
            [
                'nim' => '444555666',
                'nama' => 'Siti Nurhaliza',
                'email' => 'siti.nurhaliza@uniman.ac.id',
                'jurusan' => 'Manajemen Informatika',
                'semester' => 2,
                'status' => 'aktif',
                'tanggal_masuk' => '2024-08-01',
                'alamat' => 'Jl. Piere Tendean No. 321, Manado',
                'telepon' => '081234567893'
            ],
            [
                'nim' => '777888999',
                'nama' => 'Budi Santoso',
                'email' => 'budi.santoso@uniman.ac.id',
                'jurusan' => 'Sistem Informasi',
                'semester' => 6,
                'status' => 'cuti',
                'tanggal_masuk' => '2022-08-01',
                'alamat' => 'Jl. Martadinata No. 654, Manado',
                'telepon' => '081234567894'
            ]
        ];

        foreach ($mahasiswa as $data) {
            Mahasiswa::create($data);
        }
    }
}
