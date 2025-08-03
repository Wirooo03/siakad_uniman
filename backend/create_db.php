<?php
try {
    $pdo = new PDO('pgsql:host=127.0.0.1;port=5432;dbname=postgres', 'postgres', '$H1+$h1+');
    
    // Drop database if exists
    $pdo->exec('DROP DATABASE IF EXISTS siakad_uniman');
    echo "🗑️ Dropped existing database (if any)\n";
    
    // Create database
    $pdo->exec('CREATE DATABASE siakad_uniman');
    echo "✅ Database siakad_uniman created successfully\n";
    
} catch(Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
}
?>
