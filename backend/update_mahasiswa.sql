-- Update data mahasiswa yang kosong
UPDATE mahasiswa 
SET 
    program_studi = CASE 
        WHEN program_studi IS NULL OR program_studi = '' THEN 'S1 - PROGRAM STUDI S1 ' || UPPER(jurusan)
        ELSE program_studi 
    END,
    jenis_kelamin = CASE 
        WHEN jenis_kelamin IS NULL OR jenis_kelamin = '' THEN 
            CASE WHEN RANDOM() > 0.5 THEN 'Laki-laki' ELSE 'Perempuan' END
        ELSE jenis_kelamin 
    END,
    tempat_lahir = CASE 
        WHEN tempat_lahir IS NULL OR tempat_lahir = '' THEN 'Manado'
        ELSE tempat_lahir 
    END,
    tanggal_lahir = CASE 
        WHEN tanggal_lahir IS NULL THEN '2000-01-01'::date
        ELSE tanggal_lahir 
    END,
    agama = CASE 
        WHEN agama IS NULL OR agama = '' THEN 
            CASE 
                WHEN RANDOM() < 0.2 THEN 'Islam'
                WHEN RANDOM() < 0.4 THEN 'Kristen'
                WHEN RANDOM() < 0.6 THEN 'Katolik'
                WHEN RANDOM() < 0.8 THEN 'Hindu'
                ELSE 'Buddha'
            END
        ELSE agama 
    END,
    kewarganegaraan = CASE 
        WHEN kewarganegaraan IS NULL OR kewarganegaraan = '' THEN 'Indonesia'
        ELSE kewarganegaraan 
    END,
    nik = CASE 
        WHEN nik IS NULL OR nik = '' THEN '7101' || LPAD(id::text, 12, '0')
        ELSE nik 
    END,
    status_nikah = CASE 
        WHEN status_nikah IS NULL OR status_nikah = '' THEN 'Belum Menikah'
        ELSE status_nikah 
    END,
    sks_total = CASE 
        WHEN sks_total IS NULL THEN FLOOR(RANDOM() * 95 + 50)::int
        ELSE sks_total 
    END,
    ipk = CASE 
        WHEN ipk IS NULL THEN ROUND((RANDOM() * 1.5 + 2.5)::numeric, 2)
        ELSE ipk 
    END,
    konsentrasi = CASE 
        WHEN konsentrasi IS NULL OR konsentrasi = '' THEN 
            CASE jurusan
                WHEN 'FARMASI' THEN 'Farmasi Klinis'
                WHEN 'TEKNIK INFORMATIKA' THEN 'Sistem Informasi'
                WHEN 'KEDOKTERAN' THEN 'Kedokteran Umum'
                WHEN 'EKONOMI' THEN 'Manajemen'
                WHEN 'HUKUM' THEN 'Hukum Pidana'
                ELSE 'Umum'
            END
        ELSE konsentrasi 
    END,
    periode_masuk = CASE 
        WHEN periode_masuk IS NULL OR periode_masuk = '' THEN '2024 Ganjil'
        ELSE periode_masuk 
    END,
    tahun_kurikulum = CASE 
        WHEN tahun_kurikulum IS NULL OR tahun_kurikulum = '' THEN '2022'
        ELSE tahun_kurikulum 
    END,
    sistem_kuliah = CASE 
        WHEN sistem_kuliah IS NULL OR sistem_kuliah = '' THEN 'Reguler'
        ELSE sistem_kuliah 
    END,
    kelas_kelompok = CASE 
        WHEN kelas_kelompok IS NULL OR kelas_kelompok = '' THEN CHR(65 + FLOOR(RANDOM() * 5)::int)
        ELSE kelas_kelompok 
    END,
    jenis_pendaftaran = CASE 
        WHEN jenis_pendaftaran IS NULL OR jenis_pendaftaran = '' THEN 'Mahasiswa Baru'
        ELSE jenis_pendaftaran 
    END,
    jalur_pendaftaran = CASE 
        WHEN jalur_pendaftaran IS NULL OR jalur_pendaftaran = '' THEN 
            CASE 
                WHEN RANDOM() < 0.33 THEN 'SNBP'
                WHEN RANDOM() < 0.66 THEN 'SNBT'
                ELSE 'Mandiri'
            END
        ELSE jalur_pendaftaran 
    END,
    biodata_valid = CASE 
        WHEN biodata_valid IS NULL OR biodata_valid = '' THEN '✓'
        ELSE biodata_valid 
    END,
    kampus = CASE 
        WHEN kampus IS NULL OR kampus = '' THEN 'Kampus Utama Manado'
        ELSE kampus 
    END,
    suku = CASE 
        WHEN suku IS NULL OR suku = '' THEN 
            CASE 
                WHEN RANDOM() < 0.2 THEN 'Minahasa'
                WHEN RANDOM() < 0.4 THEN 'Sangir'
                WHEN RANDOM() < 0.6 THEN 'Talaud'
                WHEN RANDOM() < 0.8 THEN 'Mongondow'
                ELSE 'Bolaang'
            END
        ELSE suku 
    END,
    berat_badan = CASE 
        WHEN berat_badan IS NULL THEN FLOOR(RANDOM() * 46 + 45)::int
        ELSE berat_badan 
    END,
    tinggi_badan = CASE 
        WHEN tinggi_badan IS NULL THEN FLOOR(RANDOM() * 36 + 150)::int
        ELSE tinggi_badan 
    END,
    golongan_darah = CASE 
        WHEN golongan_darah IS NULL OR golongan_darah = '' THEN 
            CASE 
                WHEN RANDOM() < 0.25 THEN 'A'
                WHEN RANDOM() < 0.5 THEN 'B'
                WHEN RANDOM() < 0.75 THEN 'AB'
                ELSE 'O'
            END
        ELSE golongan_darah 
    END,
    transportasi = CASE 
        WHEN transportasi IS NULL OR transportasi = '' THEN 
            CASE 
                WHEN RANDOM() < 0.4 THEN 'Motor'
                WHEN RANDOM() < 0.6 THEN 'Mobil'
                WHEN RANDOM() < 0.8 THEN 'Angkot'
                ELSE 'Ojek Online'
            END
        ELSE transportasi 
    END,
    no_kk = CASE 
        WHEN no_kk IS NULL OR no_kk = '' THEN '7101522' || LPAD(id::text, 9, '0')
        ELSE no_kk 
    END,
    ukuran_jas = CASE 
        WHEN ukuran_jas IS NULL OR ukuran_jas = '' THEN 
            CASE 
                WHEN RANDOM() < 0.2 THEN 'S'
                WHEN RANDOM() < 0.4 THEN 'M'
                WHEN RANDOM() < 0.6 THEN 'L'
                WHEN RANDOM() < 0.8 THEN 'XL'
                ELSE 'XXL'
            END
        ELSE ukuran_jas 
    END,
    no_hp = CASE 
        WHEN no_hp IS NULL OR no_hp = '' THEN 
            CASE WHEN telepon IS NOT NULL THEN telepon 
                 ELSE '081' || LPAD(FLOOR(RANDOM() * 900000000 + 100000000)::text, 9, '0')
            END
        ELSE no_hp 
    END,
    kepemilikan_hp = CASE 
        WHEN kepemilikan_hp IS NULL OR kepemilikan_hp = '' THEN 'Pribadi'
        ELSE kepemilikan_hp 
    END,
    email_kampus = CASE 
        WHEN email_kampus IS NULL OR email_kampus = '' THEN 
            LOWER(REPLACE(nama, ' ', '.')) || '@student.uniman.ac.id'
        ELSE email_kampus 
    END,
    email_pribadi = CASE 
        WHEN email_pribadi IS NULL OR email_pribadi = '' THEN 
            CASE WHEN email IS NOT NULL THEN email 
                 ELSE LOWER(REPLACE(nama, ' ', '.')) || '@gmail.com'
            END
        ELSE email_pribadi 
    END,
    pekerjaan = CASE 
        WHEN pekerjaan IS NULL OR pekerjaan = '' THEN 'Mahasiswa'
        ELSE pekerjaan 
    END,
    instansi_pekerjaan = CASE 
        WHEN instansi_pekerjaan IS NULL OR instansi_pekerjaan = '' THEN '-'
        ELSE instansi_pekerjaan 
    END,
    penghasilan = CASE 
        WHEN penghasilan IS NULL OR penghasilan = '' THEN '0'
        ELSE penghasilan 
    END,
    no_rekening = CASE 
        WHEN no_rekening IS NULL OR no_rekening = '' THEN 
            LPAD(FLOOR(RANDOM() * 9000000000 + 1000000000)::text, 10, '0')
        ELSE no_rekening 
    END,
    nama_rekening = CASE 
        WHEN nama_rekening IS NULL OR nama_rekening = '' THEN nama
        ELSE nama_rekening 
    END,
    nama_bank = CASE 
        WHEN nama_bank IS NULL OR nama_bank = '' THEN 
            CASE 
                WHEN RANDOM() < 0.2 THEN 'BRI'
                WHEN RANDOM() < 0.4 THEN 'BNI'
                WHEN RANDOM() < 0.6 THEN 'BCA'
                WHEN RANDOM() < 0.8 THEN 'Mandiri'
                ELSE 'BTN'
            END
        ELSE nama_bank 
    END,
    updated_at = NOW()
WHERE 
    program_studi IS NULL OR program_studi = '' OR
    jenis_kelamin IS NULL OR jenis_kelamin = '' OR
    tempat_lahir IS NULL OR tempat_lahir = '' OR
    tanggal_lahir IS NULL OR
    agama IS NULL OR agama = '' OR
    kewarganegaraan IS NULL OR kewarganegaraan = '' OR
    nik IS NULL OR nik = '' OR
    status_nikah IS NULL OR status_nikah = '' OR
    sks_total IS NULL OR
    ipk IS NULL;

-- Show results
SELECT 'Update completed! Checking results...' as message;

SELECT 
    COUNT(*) as total_mahasiswa,
    COUNT(CASE WHEN nik IS NOT NULL AND nik != '' THEN 1 END) as with_nik,
    COUNT(CASE WHEN jenis_kelamin IS NOT NULL AND jenis_kelamin != '' THEN 1 END) as with_gender,
    COUNT(CASE WHEN tempat_lahir IS NOT NULL AND tempat_lahir != '' THEN 1 END) as with_birthplace,
    COUNT(CASE WHEN agama IS NOT NULL AND agama != '' THEN 1 END) as with_religion,
    COUNT(CASE WHEN sks_total IS NOT NULL THEN 1 END) as with_sks,
    COUNT(CASE WHEN ipk IS NOT NULL THEN 1 END) as with_ipk
FROM mahasiswa;
