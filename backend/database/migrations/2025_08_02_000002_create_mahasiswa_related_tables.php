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
        // Tabel untuk informasi domisili
        Schema::create('mahasiswa_domisili', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mahasiswa_id')->constrained('mahasiswa')->onDelete('cascade');
            
            // Alamat KTP
            $table->text('alamat_ktp')->nullable();
            $table->string('rt_ktp')->nullable();
            $table->string('rw_ktp')->nullable();
            $table->string('kelurahan_ktp')->nullable();
            $table->string('kecamatan_ktp')->nullable();
            $table->string('kabupaten_ktp')->nullable();
            $table->string('provinsi_ktp')->nullable();
            $table->string('kode_pos_ktp')->nullable();
            
            // Alamat Domisili
            $table->text('alamat_domisili')->nullable();
            $table->string('rt_domisili')->nullable();
            $table->string('rw_domisili')->nullable();
            $table->string('kelurahan_domisili')->nullable();
            $table->string('kecamatan_domisili')->nullable();
            $table->string('kabupaten_domisili')->nullable();
            $table->string('provinsi_domisili')->nullable();
            $table->string('kode_pos_domisili')->nullable();
            
            $table->timestamps();
        });

        // Tabel untuk informasi orang tua
        Schema::create('mahasiswa_ortu', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mahasiswa_id')->constrained('mahasiswa')->onDelete('cascade');
            
            // Data Ayah
            $table->string('nama_ayah')->nullable();
            $table->string('nik_ayah')->nullable();
            $table->date('tanggal_lahir_ayah')->nullable();
            $table->string('pendidikan_ayah')->nullable();
            $table->string('pekerjaan_ayah')->nullable();
            $table->string('penghasilan_ayah')->nullable();
            $table->string('telepon_ayah')->nullable();
            
            // Data Ibu
            $table->string('nama_ibu')->nullable();
            $table->string('nik_ibu')->nullable();
            $table->date('tanggal_lahir_ibu')->nullable();
            $table->string('pendidikan_ibu')->nullable();
            $table->string('pekerjaan_ibu')->nullable();
            $table->string('penghasilan_ibu')->nullable();
            $table->string('telepon_ibu')->nullable();
            
            $table->timestamps();
        });

        // Tabel untuk informasi wali
        Schema::create('mahasiswa_wali', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mahasiswa_id')->constrained('mahasiswa')->onDelete('cascade');
            
            $table->string('nama_wali')->nullable();
            $table->string('nik_wali')->nullable();
            $table->date('tanggal_lahir_wali')->nullable();
            $table->string('pendidikan_wali')->nullable();
            $table->string('pekerjaan_wali')->nullable();
            $table->string('penghasilan_wali')->nullable();
            $table->string('telepon_wali')->nullable();
            $table->string('hubungan_wali')->nullable(); // saudara, paman, dll
            
            $table->timestamps();
        });

        // Tabel untuk perguruan tinggi asal
        Schema::create('mahasiswa_pt_asal', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mahasiswa_id')->constrained('mahasiswa')->onDelete('cascade');
            
            $table->string('nama_pt_asal')->nullable();
            $table->string('fakultas_asal')->nullable();
            $table->string('prodi_asal')->nullable();
            $table->string('jenjang_asal')->nullable();
            $table->year('tahun_masuk_asal')->nullable();
            $table->year('tahun_lulus_asal')->nullable();
            $table->string('no_ijazah')->nullable();
            $table->date('tanggal_ijazah')->nullable();
            $table->decimal('ipk_asal', 3, 2)->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mahasiswa_pt_asal');
        Schema::dropIfExists('mahasiswa_wali');
        Schema::dropIfExists('mahasiswa_ortu');
        Schema::dropIfExists('mahasiswa_domisili');
    }
};
