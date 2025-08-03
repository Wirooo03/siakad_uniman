<?php
// Script untuk menjalankan migrasi dan seeder

require_once __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);

echo "Menjalankan migrasi...\n";
$exitCode = $kernel->call('migrate', ['--force' => true]);
echo "Migrasi selesai dengan kode: $exitCode\n";

echo "Menjalankan seeder...\n";
$exitCode = $kernel->call('db:seed', ['--class' => 'MahasiswaDetailSeeder', '--force' => true]);
echo "Seeder selesai dengan kode: $exitCode\n";

echo "Semua selesai!\n";
?>
