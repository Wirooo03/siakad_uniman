<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('mahasiswa', function (Blueprint $table) {
            // Informasi Pendaftaran
            $table->string('program_studi')->nullable()->after('jurusan');
            $table->string('konsentrasi')->nullable()->after('program_studi');
            $table->string('periode_masuk')->nullable()->after('konsentrasi');
            $table->string('tahun_kurikulum')->nullable()->after('periode_masuk');
            $table->string('sistem_kuliah')->nullable()->after('tahun_kurikulum');
            $table->string('kelas_kelompok')->nullable()->after('sistem_kuliah');
            $table->string('jenis_pendaftaran')->nullable()->after('kelas_kelompok');
            $table->string('jalur_pendaftaran')->nullable()->after('jenis_pendaftaran');
            $table->string('gelombang')->nullable()->after('jalur_pendaftaran');
            $table->string('kebutuhan_khusus')->default('Tidak')->after('gelombang');
            $table->string('biodata_valid')->default('✗')->after('kebutuhan_khusus');
            $table->string('kampus')->nullable()->after('biodata_valid');
            
            // Informasi Umum - Umum
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan'])->nullable()->after('kampus');
            $table->string('tempat_lahir')->nullable()->after('jenis_kelamin');
            $table->date('tanggal_lahir')->nullable()->after('tempat_lahir');
            $table->string('agama')->nullable()->after('tanggal_lahir');
            $table->string('suku')->nullable()->after('agama');
            $table->integer('berat_badan')->nullable()->after('suku'); // kg
            $table->integer('tinggi_badan')->nullable()->after('berat_badan'); // cm
            $table->enum('golongan_darah', ['A', 'B', 'AB', 'O'])->nullable()->after('tinggi_badan');
            $table->string('transportasi')->nullable()->after('golongan_darah');
            
            // Administrasi
            $table->string('kewarganegaraan')->default('Indonesia')->after('transportasi');
            $table->string('nik')->nullable()->after('kewarganegaraan');
            $table->string('paspor')->nullable()->after('nik');
            $table->string('no_kk')->nullable()->after('paspor');
            $table->string('no_kps')->nullable()->after('no_kk');
            $table->enum('status_nikah', ['Belum Menikah', 'Menikah', 'Cerai'])->nullable()->after('no_kps');
            $table->enum('ukuran_jas', ['S', 'M', 'L', 'XL', 'XXL'])->nullable()->after('status_nikah');
            $table->string('file_akta')->nullable()->after('ukuran_jas');
            
            // Kontak - update existing telepon and add new fields
            $table->string('no_hp')->nullable()->after('telepon');
            $table->string('kepemilikan_hp')->nullable()->after('no_hp');
            $table->string('email_kampus')->nullable()->after('email');
            $table->string('email_pribadi')->nullable()->after('email_kampus');
            
            // Pekerjaan
            $table->string('pekerjaan')->nullable()->after('email_pribadi');
            $table->string('instansi_pekerjaan')->nullable()->after('pekerjaan');
            $table->string('penghasilan')->nullable()->after('instansi_pekerjaan');
            
            // Bank
            $table->string('no_rekening')->nullable()->after('penghasilan');
            $table->string('nama_rekening')->nullable()->after('no_rekening');
            $table->string('nama_bank')->nullable()->after('nama_rekening');
            
            // Academic fields
            $table->integer('sks_total')->default(0)->after('semester');
            $table->decimal('ipk', 3, 2)->default(0.00)->after('sks_total');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mahasiswa', function (Blueprint $table) {
            $table->dropColumn([
                'program_studi', 'konsentrasi', 'periode_masuk', 'tahun_kurikulum',
                'sistem_kuliah', 'kelas_kelompok', 'jenis_pendaftaran', 'jalur_pendaftaran',
                'gelombang', 'kebutuhan_khusus', 'biodata_valid', 'kampus',
                'jenis_kelamin', 'tempat_lahir', 'tanggal_lahir', 'agama', 'suku',
                'berat_badan', 'tinggi_badan', 'golongan_darah', 'transportasi',
                'kewarganegaraan', 'nik', 'paspor', 'no_kk', 'no_kps',
                'status_nikah', 'ukuran_jas', 'file_akta',
                'no_hp', 'kepemilikan_hp', 'email_kampus', 'email_pribadi',
                'pekerjaan', 'instansi_pekerjaan', 'penghasilan',
                'no_rekening', 'nama_rekening', 'nama_bank',
                'sks_total', 'ipk'
            ]);
        });
    }
};
