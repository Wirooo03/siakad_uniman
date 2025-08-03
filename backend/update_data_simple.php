#!/usr/bin/env php
<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';

/*
|--------------------------------------------------------------------------
| Run The Artisan Application
|--------------------------------------------------------------------------
*/

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);

$status = $kernel->handle(
    $input = new Symfony\Component\Console\Input\ArgvInput,
    new Symfony\Component\Console\Output\ConsoleOutput
);

/*
|--------------------------------------------------------------------------
| Update Mahasiswa Data
|--------------------------------------------------------------------------
*/

use App\Models\Mahasiswa;

echo "=== CHECKING AND UPDATING MAHASISWA DATA ===\n";

// Get all mahasiswa
$mahasiswaList = Mahasiswa::all();
echo "Found " . $mahasiswaList->count() . " mahasiswa records\n";

$updatedCount = 0;

foreach ($mahasiswaList as $index => $mhs) {
    $needsUpdate = false;
    $updateData = [];
    
    // Check and fill empty fields
    if (!$mhs->program_studi) {
        $updateData['program_studi'] = 'S1 - PROGRAM STUDI S1 ' . strtoupper($mhs->jurusan);
        $needsUpdate = true;
    }
    
    if (!$mhs->jenis_kelamin) {
        $updateData['jenis_kelamin'] = rand(0,1) ? 'Laki-laki' : 'Perempuan';
        $needsUpdate = true;
    }
    
    if (!$mhs->tempat_lahir) {
        $updateData['tempat_lahir'] = 'Manado';
        $needsUpdate = true;
    }
    
    if (!$mhs->tanggal_lahir) {
        $updateData['tanggal_lahir'] = date('Y-m-d', strtotime('-' . rand(18, 25) . ' years'));
        $needsUpdate = true;
    }
    
    if (!$mhs->agama) {
        $agamaList = ['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha'];
        $updateData['agama'] = $agamaList[array_rand($agamaList)];
        $needsUpdate = true;
    }
    
    if (!$mhs->kewarganegaraan) {
        $updateData['kewarganegaraan'] = 'Indonesia';
        $needsUpdate = true;
    }
    
    if (!$mhs->nik) {
        $updateData['nik'] = '7101' . str_pad($index + 1, 12, '0', STR_PAD_LEFT);
        $needsUpdate = true;
    }
    
    if (!$mhs->status_nikah) {
        $updateData['status_nikah'] = 'Belum Menikah';
        $needsUpdate = true;
    }
    
    if (!$mhs->sks_total) {
        $updateData['sks_total'] = rand(50, 144);
        $needsUpdate = true;
    }
    
    if (!$mhs->ipk) {
        $updateData['ipk'] = round(rand(250, 400) / 100, 2);
        $needsUpdate = true;
    }
    
    if ($needsUpdate) {
        $mhs->update($updateData);
        echo "Updated: " . $mhs->nama . " (" . count($updateData) . " fields)\n";
        $updatedCount++;
    }
}

echo "\n=== UPDATE COMPLETED ===\n";
echo "Total mahasiswa updated: $updatedCount\n";
echo "All mahasiswa now have complete data!\n";

$kernel->terminate($input, $status);

exit($status);
?>
