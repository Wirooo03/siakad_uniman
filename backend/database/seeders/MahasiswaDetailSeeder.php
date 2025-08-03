<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Mahasiswa;
use App\Models\MahasiswaDomisili;
use App\Models\MahasiswaOrtu;
use App\Models\MahasiswaWali;
use App\Models\MahasiswaPtAsal;
use Carbon\Carbon;

class MahasiswaDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Data sample mahasiswa yang lebih lengkap
        $mahasiswaData = [
            [
                // Data utama
                'nim' => '2024001001',
                'nama' => 'Ahmad Rizki Pratama',
                'email' => 'ahmad.rizki@gmail.com',
                'jurusan' => 'FARMASI',
                'semester' => 6,
                'status' => 'aktif',
                'tanggal_masuk' => '2024-08-15',
                'alamat' => 'Jl. Raya Manado No. 123',
                'telepon' => '08123456789',
                
                // Field tambahan
                'program_studi' => 'S1 - PROGRAM STUDI S1 FARMASI',
                'konsentrasi' => 'Farmasi Klinis',
                'periode_masuk' => '2024 Ganjil',
                'tahun_kurikulum' => '2022',
                'sistem_kuliah' => 'Reguler',
                'kelas_kelompok' => 'A',
                'jenis_pendaftaran' => 'Mahasiswa Baru',
                'jalur_pendaftaran' => 'SNBP',
                'gelombang' => 'Gelombang 1',
                'kebutuhan_khusus' => 'Tidak',
                'biodata_valid' => '✓',
                'kampus' => 'Kampus Utama Manado',
                
                // Informasi pribadi
                'jenis_kelamin' => 'Laki-laki',
                'tempat_lahir' => 'Manado',
                'tanggal_lahir' => '2002-05-15',
                'agama' => 'Islam',
                'suku' => 'Minahasa',
                'berat_badan' => 70,
                'tinggi_badan' => 175,
                'golongan_darah' => 'A',
                'transportasi' => 'Motor',
                
                // Administrasi
                'kewarganegaraan' => 'Indonesia',
                'nik' => '7101051505020001',
                'no_kk' => '7101052205220001',
                'status_nikah' => 'Belum Menikah',
                'ukuran_jas' => 'L',
                
                // Kontak
                'no_hp' => '08123456789',
                'kepemilikan_hp' => 'Pribadi',
                'email_kampus' => 'ahmad.rizki@student.uniman.ac.id',
                'email_pribadi' => 'ahmad.rizki@gmail.com',
                
                // Pekerjaan
                'pekerjaan' => 'Mahasiswa',
                'instansi_pekerjaan' => '-',
                'penghasilan' => '0',
                
                // Bank
                'no_rekening' => '1234567890',
                'nama_rekening' => 'Ahmad Rizki Pratama',
                'nama_bank' => 'BRI',
                
                // Akademik
                'sks_total' => 110,
                'ipk' => 3.45,
                
                // Data relasi
                'domisili' => [
                    'alamat_ktp' => 'Jl. Sam Ratulangi No. 45',
                    'rt_ktp' => '001',
                    'rw_ktp' => '005',
                    'kelurahan_ktp' => 'Wanea',
                    'kecamatan_ktp' => 'Wanea',
                    'kabupaten_ktp' => 'Manado',
                    'provinsi_ktp' => 'Sulawesi Utara',
                    'kode_pos_ktp' => '95115',
                    'alamat_domisili' => 'Jl. Raya Manado No. 123',
                    'rt_domisili' => '002',
                    'rw_domisili' => '003',
                    'kelurahan_domisili' => 'Tikala Ares',
                    'kecamatan_domisili' => 'Tikala',
                    'kabupaten_domisili' => 'Manado',
                    'provinsi_domisili' => 'Sulawesi Utara',
                    'kode_pos_domisili' => '95125'
                ],
                'ortu' => [
                    'nama_ayah' => 'Budi Pratama',
                    'nik_ayah' => '7101051205780001',
                    'tanggal_lahir_ayah' => '1978-12-05',
                    'pendidikan_ayah' => 'S1',
                    'pekerjaan_ayah' => 'PNS',
                    'penghasilan_ayah' => '5000000',
                    'telepon_ayah' => '08234567890',
                    'nama_ibu' => 'Siti Nurhaliza',
                    'nik_ibu' => '7101052205800001',
                    'tanggal_lahir_ibu' => '1980-02-22',
                    'pendidikan_ibu' => 'SMA',
                    'pekerjaan_ibu' => 'Ibu Rumah Tangga',
                    'penghasilan_ibu' => '0',
                    'telepon_ibu' => '08345678901'
                ]
            ],
            [
                // Data mahasiswa kedua
                'nim' => '2024001002',
                'nama' => 'Sari Dewi Lestari',
                'email' => 'sari.dewi@gmail.com',
                'jurusan' => 'TEKNIK INFORMATIKA',
                'semester' => 4,
                'status' => 'aktif',
                'tanggal_masuk' => '2024-08-15',
                'alamat' => 'Jl. Boulevard No. 456',
                'telepon' => '08234567890',
                
                'program_studi' => 'S1 - PROGRAM STUDI S1 TEKNIK INFORMATIKA',
                'konsentrasi' => 'Sistem Informasi',
                'periode_masuk' => '2024 Ganjil',
                'tahun_kurikulum' => '2022',
                'sistem_kuliah' => 'Reguler',
                'kelas_kelompok' => 'B',
                'jenis_pendaftaran' => 'Mahasiswa Baru',
                'jalur_pendaftaran' => 'SNBT',
                'gelombang' => 'Gelombang 1',
                'kebutuhan_khusus' => 'Tidak',
                'biodata_valid' => '✓',
                'kampus' => 'Kampus Utama Manado',
                
                'jenis_kelamin' => 'Perempuan',
                'tempat_lahir' => 'Tomohon',
                'tanggal_lahir' => '2003-08-22',
                'agama' => 'Kristen',
                'suku' => 'Minahasa',
                'berat_badan' => 55,
                'tinggi_badan' => 160,
                'golongan_darah' => 'B',
                'transportasi' => 'Angkot',
                
                'kewarganegaraan' => 'Indonesia',
                'nik' => '7101052208030002',
                'no_kk' => '7101052205220002',
                'status_nikah' => 'Belum Menikah',
                'ukuran_jas' => 'M',
                
                'no_hp' => '08234567890',
                'kepemilikan_hp' => 'Pribadi',
                'email_kampus' => 'sari.dewi@student.uniman.ac.id',
                'email_pribadi' => 'sari.dewi@gmail.com',
                
                'pekerjaan' => 'Mahasiswa',
                'instansi_pekerjaan' => '-',
                'penghasilan' => '0',
                
                'no_rekening' => '2345678901',
                'nama_rekening' => 'Sari Dewi Lestari',
                'nama_bank' => 'BNI',
                
                'sks_total' => 70,
                'ipk' => 3.78,
                
                'domisili' => [
                    'alamat_ktp' => 'Jl. Tomohon Raya No. 78',
                    'rt_ktp' => '003',
                    'rw_ktp' => '007',
                    'kelurahan_ktp' => 'Woloan Satu',
                    'kecamatan_ktp' => 'Tomohon Timur',
                    'kabupaten_ktp' => 'Tomohon',
                    'provinsi_ktp' => 'Sulawesi Utara',
                    'kode_pos_ktp' => '95416',
                    'alamat_domisili' => 'Jl. Boulevard No. 456',
                    'rt_domisili' => '004',
                    'rw_domisili' => '008',
                    'kelurahan_domisili' => 'Malalayang',
                    'kecamatan_domisili' => 'Malalayang',
                    'kabupaten_domisili' => 'Manado',
                    'provinsi_domisili' => 'Sulawesi Utara',
                    'kode_pos_domisili' => '95163'
                ],
                'ortu' => [
                    'nama_ayah' => 'Robert Lestari',
                    'nik_ayah' => '7101051205750002',
                    'tanggal_lahir_ayah' => '1975-12-05',
                    'pendidikan_ayah' => 'S2',
                    'pekerjaan_ayah' => 'Dosen',
                    'penghasilan_ayah' => '7000000',
                    'telepon_ayah' => '08345678901',
                    'nama_ibu' => 'Maria Lestari',
                    'nik_ibu' => '7101052205770002',
                    'tanggal_lahir_ibu' => '1977-02-22',
                    'pendidikan_ibu' => 'S1',
                    'pekerjaan_ibu' => 'Guru',
                    'penghasilan_ibu' => '4000000',
                    'telepon_ibu' => '08456789012'
                ]
            ],
            [
                // Data mahasiswa ketiga
                'nim' => '2024001003',
                'nama' => 'Michael Steven Runtu',
                'email' => 'michael.steven@gmail.com',
                'jurusan' => 'KEDOKTERAN',
                'semester' => 8,
                'status' => 'aktif',
                'tanggal_masuk' => '2021-08-15',
                'alamat' => 'Jl. Piere Tendean No. 789',
                'telepon' => '08345678901',
                
                'program_studi' => 'S1 - PROGRAM STUDI S1 KEDOKTERAN',
                'konsentrasi' => 'Kedokteran Umum',
                'periode_masuk' => '2021 Ganjil',
                'tahun_kurikulum' => '2020',
                'sistem_kuliah' => 'Reguler',
                'kelas_kelompok' => 'A',
                'jenis_pendaftaran' => 'Mahasiswa Baru',
                'jalur_pendaftaran' => 'Prestasi',
                'gelombang' => 'Gelombang 1',
                'kebutuhan_khusus' => 'Tidak',
                'biodata_valid' => '✓',
                'kampus' => 'Kampus Utama Manado',
                
                'jenis_kelamin' => 'Laki-laki',
                'tempat_lahir' => 'Manado',
                'tanggal_lahir' => '2000-11-10',
                'agama' => 'Kristen',
                'suku' => 'Minahasa',
                'berat_badan' => 75,
                'tinggi_badan' => 180,
                'golongan_darah' => 'O',
                'transportasi' => 'Mobil',
                
                'kewarganegaraan' => 'Indonesia',
                'nik' => '7101051011000003',
                'no_kk' => '7101052205220003',
                'status_nikah' => 'Belum Menikah',
                'ukuran_jas' => 'XL',
                
                'no_hp' => '08345678901',
                'kepemilikan_hp' => 'Pribadi',
                'email_kampus' => 'michael.steven@student.uniman.ac.id',
                'email_pribadi' => 'michael.steven@gmail.com',
                
                'pekerjaan' => 'Mahasiswa',
                'instansi_pekerjaan' => '-',
                'penghasilan' => '0',
                
                'no_rekening' => '3456789012',
                'nama_rekening' => 'Michael Steven Runtu',
                'nama_bank' => 'Mandiri',
                
                'sks_total' => 140,
                'ipk' => 3.89,
                
                'domisili' => [
                    'alamat_ktp' => 'Jl. Piere Tendean No. 789',
                    'rt_ktp' => '005',
                    'rw_ktp' => '009',
                    'kelurahan_ktp' => 'Wenang',
                    'kecamatan_ktp' => 'Wenang',
                    'kabupaten_ktp' => 'Manado',
                    'provinsi_ktp' => 'Sulawesi Utara',
                    'kode_pos_ktp' => '95111',
                    'alamat_domisili' => 'Jl. Piere Tendean No. 789',
                    'rt_domisili' => '005',
                    'rw_domisili' => '009',
                    'kelurahan_domisili' => 'Wenang',
                    'kecamatan_domisili' => 'Wenang',
                    'kabupaten_domisili' => 'Manado',
                    'provinsi_domisili' => 'Sulawesi Utara',
                    'kode_pos_domisili' => '95111'
                ],
                'ortu' => [
                    'nama_ayah' => 'Steven Runtu',
                    'nik_ayah' => '7101051205700003',
                    'tanggal_lahir_ayah' => '1970-12-05',
                    'pendidikan_ayah' => 'S3',
                    'pekerjaan_ayah' => 'Dokter',
                    'penghasilan_ayah' => '15000000',
                    'telepon_ayah' => '08456789012',
                    'nama_ibu' => 'Grace Runtu',
                    'nik_ibu' => '7101052205720003',
                    'tanggal_lahir_ibu' => '1972-02-22',
                    'pendidikan_ibu' => 'S2',
                    'pekerjaan_ibu' => 'Dosen',
                    'penghasilan_ibu' => '8000000',
                    'telepon_ibu' => '08567890123'
                ]
            ]
        ];

        foreach ($mahasiswaData as $data) {
            // Pisahkan data relasi
            $domisiliData = $data['domisili'];
            $ortuData = $data['ortu'];
            unset($data['domisili'], $data['ortu']);

            // Buat mahasiswa
            $mahasiswa = Mahasiswa::create($data);

            // Buat data domisili
            $domisiliData['mahasiswa_id'] = $mahasiswa->id;
            MahasiswaDomisili::create($domisiliData);

            // Buat data orang tua
            $ortuData['mahasiswa_id'] = $mahasiswa->id;
            MahasiswaOrtu::create($ortuData);

            // Contoh data wali (opsional)
            if ($mahasiswa->nim === '2024001001') {
                MahasiswaWali::create([
                    'mahasiswa_id' => $mahasiswa->id,
                    'nama_wali' => 'Ir. Ahmad Suryanto',
                    'nik_wali' => '7101051205650001',
                    'tanggal_lahir_wali' => '1965-12-05',
                    'pendidikan_wali' => 'S1',
                    'pekerjaan_wali' => 'Pensiunan',
                    'penghasilan_wali' => '3000000',
                    'telepon_wali' => '08123456780',
                    'hubungan_wali' => 'Paman'
                ]);
            }

            // Contoh data PT asal (untuk transfer)
            if ($mahasiswa->nim === '2024001002') {
                MahasiswaPtAsal::create([
                    'mahasiswa_id' => $mahasiswa->id,
                    'nama_pt_asal' => 'Universitas Sam Ratulangi',
                    'fakultas_asal' => 'Fakultas Teknik',
                    'prodi_asal' => 'Teknik Informatika',
                    'jenjang_asal' => 'S1',
                    'tahun_masuk_asal' => 2023,
                    'tahun_lulus_asal' => null,
                    'no_ijazah' => null,
                    'tanggal_ijazah' => null,
                    'ipk_asal' => 3.25
                ]);
            }
        }

        // Update existing mahasiswa with missing fields - COMPREHENSIVE UPDATE
        $existingMahasiswa = Mahasiswa::all();
        
        $sampleKonsentrasi = [
            'FARMASI' => ['Farmasi Klinis', 'Farmasi Industri', 'Farmasi Komunitas'],
            'TEKNIK INFORMATIKA' => ['Sistem Informasi', 'Jaringan Komputer', 'Pemrograman Web'],
            'KEDOKTERAN' => ['Kedokteran Umum', 'Kedokteran Gigi', 'Kedokteran Spesialis'],
            'EKONOMI' => ['Manajemen', 'Akuntansi', 'Ekonomi Pembangunan'],
            'HUKUM' => ['Hukum Pidana', 'Hukum Perdata', 'Hukum Tata Negara']
        ];
        
        $sampleTempatLahir = ['Manado', 'Tomohon', 'Bitung', 'Minahasa', 'Kotamobagu', 'Tondano', 'Airmadidi', 'Langowan'];
        $sampleSuku = ['Minahasa', 'Sangir', 'Talaud', 'Mongondow', 'Bolaang', 'Bantik'];
        $sampleTransportasi = ['Motor', 'Mobil', 'Angkot', 'Ojek Online', 'Jalan Kaki'];
        $sampleBank = ['BRI', 'BNI', 'BCA', 'Mandiri', 'BTN', 'CIMB Niaga'];
        
        foreach ($existingMahasiswa as $index => $mhs) {
            $isLakiLaki = rand(0,1);
            $jenisKelamin = $isLakiLaki ? 'Laki-laki' : 'Perempuan';
            $tempatLahir = $sampleTempatLahir[array_rand($sampleTempatLahir)];
            $tanggalLahir = date('Y-m-d', strtotime('-' . rand(18, 25) . ' years -' . rand(1, 365) . ' days'));
            $tahunLahir = date('Y', strtotime($tanggalLahir));
            $bulanLahir = date('m', strtotime($tanggalLahir));
            $hariLahir = date('d', strtotime($tanggalLahir));
            
            // Generate NIK based on tempat lahir and tanggal lahir
            $nikPrefix = '7101'; // Kode Sulawesi Utara
            $nikTanggal = $hariLahir . $bulanLahir . substr($tahunLahir, 2);
            $nikJenisKelamin = $isLakiLaki ? '0' : '4'; // 0 untuk laki-laki, 4 untuk perempuan
            $nik = $nikPrefix . $nikJenisKelamin . $nikTanggal . str_pad($index + 1, 4, '0', STR_PAD_LEFT);
            
            $updateData = [
                // Basic fields yang mungkin kosong
                'sks_total' => $mhs->sks_total ?: rand(50, 144),
                'ipk' => $mhs->ipk ?: round(rand(250, 400) / 100, 2),
                
                // Program studi dan akademik
                'program_studi' => $mhs->program_studi ?: 'S1 - PROGRAM STUDI S1 ' . strtoupper($mhs->jurusan),
                'konsentrasi' => $mhs->konsentrasi ?: ($sampleKonsentrasi[$mhs->jurusan] ?? ['Umum'])[array_rand($sampleKonsentrasi[$mhs->jurusan] ?? ['Umum'])],
                'periode_masuk' => $mhs->periode_masuk ?: '2024 Ganjil',
                'tahun_kurikulum' => $mhs->tahun_kurikulum ?: '2022',
                'sistem_kuliah' => $mhs->sistem_kuliah ?: 'Reguler',
                'kelas_kelompok' => $mhs->kelas_kelompok ?: chr(65 + rand(0, 4)), // A-E
                
                // Informasi pendaftaran
                'jenis_pendaftaran' => $mhs->jenis_pendaftaran ?: 'Mahasiswa Baru',
                'jalur_pendaftaran' => $mhs->jalur_pendaftaran ?: ['SNBP', 'SNBT', 'Mandiri', 'Prestasi'][rand(0,3)],
                'gelombang' => $mhs->gelombang ?: 'Gelombang 1',
                'kebutuhan_khusus' => $mhs->kebutuhan_khusus ?: 'Tidak',
                'biodata_valid' => $mhs->biodata_valid ?: '✓',
                'kampus' => $mhs->kampus ?: 'Kampus Utama Manado',
                
                // Informasi pribadi
                'jenis_kelamin' => $mhs->jenis_kelamin ?: $jenisKelamin,
                'tempat_lahir' => $mhs->tempat_lahir ?: $tempatLahir,
                'tanggal_lahir' => $mhs->tanggal_lahir ?: $tanggalLahir,
                'agama' => $mhs->agama ?: ['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha'][rand(0,4)],
                'suku' => $mhs->suku ?: $sampleSuku[array_rand($sampleSuku)],
                'berat_badan' => $mhs->berat_badan ?: rand(45, 90),
                'tinggi_badan' => $mhs->tinggi_badan ?: rand(150, 185),
                'golongan_darah' => $mhs->golongan_darah ?: ['A', 'B', 'AB', 'O'][rand(0,3)],
                'transportasi' => $mhs->transportasi ?: $sampleTransportasi[array_rand($sampleTransportasi)],
                
                // Administrasi
                'kewarganegaraan' => $mhs->kewarganegaraan ?: 'Indonesia',
                'nik' => $mhs->nik ?: $nik,
                'no_kk' => $mhs->no_kk ?: $nikPrefix . '52' . $bulanLahir . $hariLahir . '220' . str_pad($index + 1, 3, '0', STR_PAD_LEFT),
                'status_nikah' => $mhs->status_nikah ?: 'Belum Menikah',
                'ukuran_jas' => $mhs->ukuran_jas ?: ['S', 'M', 'L', 'XL', 'XXL'][rand(0,4)],
                
                // Kontak
                'no_hp' => $mhs->no_hp ?: $mhs->telepon ?: '081' . rand(100000000, 999999999),
                'kepemilikan_hp' => $mhs->kepemilikan_hp ?: 'Pribadi',
                'email_kampus' => $mhs->email_kampus ?: strtolower(str_replace(' ', '.', $mhs->nama)) . '@student.uniman.ac.id',
                'email_pribadi' => $mhs->email_pribadi ?: $mhs->email ?: strtolower(str_replace(' ', '.', $mhs->nama)) . '@gmail.com',
                
                // Pekerjaan
                'pekerjaan' => $mhs->pekerjaan ?: 'Mahasiswa',
                'instansi_pekerjaan' => $mhs->instansi_pekerjaan ?: '-',
                'penghasilan' => $mhs->penghasilan ?: '0',
                
                // Bank
                'no_rekening' => $mhs->no_rekening ?: rand(1000000000, 9999999999),
                'nama_rekening' => $mhs->nama_rekening ?: $mhs->nama,
                'nama_bank' => $mhs->nama_bank ?: $sampleBank[array_rand($sampleBank)]
            ];
            
            $mhs->update($updateData);
            
            // Create related data if not exists
            if (!$mhs->domisili) {
                $kelurahan = ['Wanea', 'Tikala Ares', 'Malalayang', 'Wenang', 'Sario'][rand(0,4)];
                $kecamatan = ['Wanea', 'Tikala', 'Malalayang', 'Wenang', 'Sario'][rand(0,4)];
                
                MahasiswaDomisili::create([
                    'mahasiswa_id' => $mhs->id,
                    'alamat_ktp' => 'Jl. ' . ['Sam Ratulangi', 'Piere Tendean', 'Boulevard', 'Diponegoro', 'Sudirman'][rand(0,4)] . ' No. ' . rand(1, 999),
                    'rt_ktp' => str_pad(rand(1, 20), 3, '0', STR_PAD_LEFT),
                    'rw_ktp' => str_pad(rand(1, 15), 3, '0', STR_PAD_LEFT),
                    'kelurahan_ktp' => $kelurahan,
                    'kecamatan_ktp' => $kecamatan,
                    'kabupaten_ktp' => $tempatLahir,
                    'provinsi_ktp' => 'Sulawesi Utara',
                    'kode_pos_ktp' => '951' . rand(10, 99),
                    'alamat_domisili' => $mhs->alamat ?: 'Jl. ' . ['Raya Manado', 'Kampus Unima', 'Sudirman', 'Ahmad Yani'][rand(0,3)] . ' No. ' . rand(1, 500),
                    'rt_domisili' => str_pad(rand(1, 20), 3, '0', STR_PAD_LEFT),
                    'rw_domisili' => str_pad(rand(1, 15), 3, '0', STR_PAD_LEFT),
                    'kelurahan_domisili' => $kelurahan,
                    'kecamatan_domisili' => $kecamatan,
                    'kabupaten_domisili' => 'Manado',
                    'provinsi_domisili' => 'Sulawesi Utara',
                    'kode_pos_domisili' => '951' . rand(10, 99)
                ]);
            }
            
            if (!$mhs->ortu) {
                $namaAyah = ['Budi', 'Ahmad', 'Robert', 'Steven', 'David', 'Michael', 'Daniel'][rand(0,6)] . ' ' . 
                           ['Pratama', 'Lestari', 'Runtu', 'Mandagi', 'Waworuntu', 'Tombokan'][rand(0,5)];
                $namaIbu = ['Siti', 'Maria', 'Grace', 'Rita', 'Linda', 'Ester', 'Sarah'][rand(0,6)] . ' ' . 
                          ['Nurhaliza', 'Lestari', 'Runtu', 'Mandagi', 'Waworuntu', 'Tombokan'][rand(0,5)];
                
                MahasiswaOrtu::create([
                    'mahasiswa_id' => $mhs->id,
                    'nama_ayah' => $namaAyah,
                    'nik_ayah' => $nikPrefix . '51' . $bulanLahir . '05' . (intval($tahunLahir) - rand(25, 35)) . str_pad($index + 1, 4, '0', STR_PAD_LEFT),
                    'tanggal_lahir_ayah' => date('Y-m-d', strtotime($tanggalLahir . ' -' . rand(25, 35) . ' years')),
                    'pendidikan_ayah' => ['SMA', 'D3', 'S1', 'S2', 'S3'][rand(0,4)],
                    'pekerjaan_ayah' => ['PNS', 'Swasta', 'Wiraswasta', 'Petani', 'Dosen', 'Dokter'][rand(0,5)],
                    'penghasilan_ayah' => rand(3, 15) * 1000000,
                    'telepon_ayah' => '082' . rand(100000000, 999999999),
                    'nama_ibu' => $namaIbu,
                    'nik_ibu' => $nikPrefix . '52' . $bulanLahir . '05' . (intval($tahunLahir) - rand(23, 33)) . str_pad($index + 1, 4, '0', STR_PAD_LEFT),
                    'tanggal_lahir_ibu' => date('Y-m-d', strtotime($tanggalLahir . ' -' . rand(23, 33) . ' years')),
                    'pendidikan_ibu' => ['SMA', 'D3', 'S1', 'S2'][rand(0,3)],
                    'pekerjaan_ibu' => ['Ibu Rumah Tangga', 'PNS', 'Swasta', 'Guru', 'Perawat'][rand(0,4)],
                    'penghasilan_ibu' => rand(0, 10) * 1000000,
                    'telepon_ibu' => '083' . rand(100000000, 999999999)
                ]);
            }
            
            // Random wali for some students
            if (rand(0, 4) === 0 && !$mhs->wali) {
                $namaWali = ['Ir. Ahmad', 'Drs. Robert', 'Dr. Steven', 'Prof. David'][rand(0,3)] . ' ' . 
                           ['Suryanto', 'Mandagi', 'Runtu', 'Waworuntu'][rand(0,3)];
                           
                MahasiswaWali::create([
                    'mahasiswa_id' => $mhs->id,
                    'nama_wali' => $namaWali,
                    'nik_wali' => $nikPrefix . '51' . $bulanLahir . '05' . (intval($tahunLahir) - rand(30, 45)) . str_pad($index + 1, 4, '0', STR_PAD_LEFT),
                    'tanggal_lahir_wali' => date('Y-m-d', strtotime($tanggalLahir . ' -' . rand(30, 45) . ' years')),
                    'pendidikan_wali' => ['S1', 'S2', 'S3'][rand(0,2)],
                    'pekerjaan_wali' => ['Pensiunan', 'PNS', 'Dosen', 'Dokter'][rand(0,3)],
                    'penghasilan_wali' => rand(3, 8) * 1000000,
                    'telepon_wali' => '081' . rand(100000000, 999999999),
                    'hubungan_wali' => ['Paman', 'Bibi', 'Kakek', 'Nenek', 'Saudara'][rand(0,4)]
                ]);
            }
            
            // Random PT asal for transfer students
            if (rand(0, 5) === 0 && !$mhs->ptAsal) {
                $ptAsal = ['Universitas Sam Ratulangi', 'Universitas Negeri Manado', 'Politeknik Negeri Manado', 'STMIK Kharisma'][rand(0,3)];
                
                MahasiswaPtAsal::create([
                    'mahasiswa_id' => $mhs->id,
                    'nama_pt_asal' => $ptAsal,
                    'fakultas_asal' => 'Fakultas ' . ['Teknik', 'Ekonomi', 'Hukum', 'MIPA'][rand(0,3)],
                    'prodi_asal' => $mhs->jurusan,
                    'jenjang_asal' => 'S1',
                    'tahun_masuk_asal' => intval(date('Y')) - rand(1, 3),
                    'tahun_lulus_asal' => null,
                    'no_ijazah' => null,
                    'tanggal_ijazah' => null,
                    'ipk_asal' => round(rand(275, 375) / 100, 2)
                ]);
            }
        }

        $this->command->info('Sample mahasiswa data with complete details has been seeded!');
    }
}
