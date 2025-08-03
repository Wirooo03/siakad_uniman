<?php
echo "=== INFORMASI DATABASE POSTGRESQL ===\n\n";

try {
    // Koneksi ke PostgreSQL
    $pdo = new PDO('pgsql:host=127.0.0.1;port=5432;dbname=siakad_uniman', 'postgres', '$H1+$h1+');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "✅ Koneksi PostgreSQL berhasil!\n\n";
    
    // 1. Informasi Database
    echo "📊 INFORMASI DATABASE:\n";
    echo "========================================\n";
    $stmt = $pdo->query("SELECT version()");
    echo "PostgreSQL Version: " . $stmt->fetchColumn() . "\n";
    
    $stmt = $pdo->query("SELECT current_database()");
    echo "Database Name: " . $stmt->fetchColumn() . "\n";
    
    $stmt = $pdo->query("SELECT current_user");
    echo "Current User: " . $stmt->fetchColumn() . "\n";
    
    $stmt = $pdo->query("SELECT inet_server_addr(), inet_server_port()");
    $server_info = $stmt->fetch(PDO::FETCH_NUM);
    echo "Server Address: " . ($server_info[0] ?: 'localhost') . "\n";
    echo "Server Port: " . ($server_info[1] ?: '5432') . "\n\n";
    
    // 2. Daftar semua tabel
    echo "📋 DAFTAR TABEL:\n";
    echo "========================================\n";
    $stmt = $pdo->query("
        SELECT table_name, table_type 
        FROM information_schema.tables 
        WHERE table_schema = 'public'
        ORDER BY table_name
    ");
    
    $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($tables as $table) {
        echo "• " . $table['table_name'] . " (" . $table['table_type'] . ")\n";
    }
    echo "\n";
    
    // 3. Struktur tabel mahasiswa
    echo "🏗️ STRUKTUR TABEL MAHASISWA:\n";
    echo "========================================\n";
    $stmt = $pdo->query("
        SELECT 
            column_name, 
            data_type, 
            is_nullable, 
            column_default,
            character_maximum_length
        FROM information_schema.columns 
        WHERE table_name = 'mahasiswa' 
        ORDER BY ordinal_position
    ");
    
    $columns = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($columns as $col) {
        $length = $col['character_maximum_length'] ? "({$col['character_maximum_length']})" : '';
        $nullable = $col['is_nullable'] === 'YES' ? 'NULL' : 'NOT NULL';
        $default = $col['column_default'] ? " DEFAULT: {$col['column_default']}" : '';
        
        echo "• {$col['column_name']}: {$col['data_type']}{$length} {$nullable}{$default}\n";
    }
    echo "\n";
    
    // 4. Primary Keys dan Indexes
    echo "🔑 PRIMARY KEYS & INDEXES:\n";
    echo "========================================\n";
    $stmt = $pdo->query("
        SELECT 
            i.relname as index_name,
            ix.indisprimary as is_primary,
            ix.indisunique as is_unique,
            array_to_string(array_agg(a.attname), ', ') as columns
        FROM pg_class t
        JOIN pg_index ix ON t.oid = ix.indrelid
        JOIN pg_class i ON i.oid = ix.indexrelid
        JOIN pg_attribute a ON a.attrelid = t.oid AND a.attnum = ANY(ix.indkey)
        WHERE t.relname = 'mahasiswa'
        GROUP BY i.relname, ix.indisprimary, ix.indisunique
        ORDER BY ix.indisprimary DESC, i.relname
    ");
    
    $indexes = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($indexes as $idx) {
        $type = $idx['is_primary'] ? '[PRIMARY KEY]' : ($idx['is_unique'] ? '[UNIQUE]' : '[INDEX]');
        echo "• {$idx['index_name']} {$type}: {$idx['columns']}\n";
    }
    echo "\n";
    
    // 5. Foreign Keys
    echo "🔗 FOREIGN KEYS:\n";
    echo "========================================\n";
    $stmt = $pdo->query("
        SELECT 
            tc.constraint_name,
            tc.table_name,
            kcu.column_name,
            ccu.table_name AS foreign_table_name,
            ccu.column_name AS foreign_column_name
        FROM information_schema.table_constraints AS tc
        JOIN information_schema.key_column_usage AS kcu
            ON tc.constraint_name = kcu.constraint_name
        JOIN information_schema.constraint_column_usage AS ccu
            ON ccu.constraint_name = tc.constraint_name
        WHERE constraint_type = 'FOREIGN KEY'
        AND tc.table_name = 'mahasiswa'
    ");
    
    $fks = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if (empty($fks)) {
        echo "• Tidak ada foreign key pada tabel mahasiswa\n";
    } else {
        foreach ($fks as $fk) {
            echo "• {$fk['column_name']} → {$fk['foreign_table_name']}.{$fk['foreign_column_name']}\n";
        }
    }
    echo "\n";
    
    // 6. Data sample
    echo "📄 SAMPLE DATA (5 baris pertama):\n";
    echo "========================================\n";
    $stmt = $pdo->query("SELECT * FROM mahasiswa LIMIT 5");
    $samples = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    if (!empty($samples)) {
        // Header
        $headers = array_keys($samples[0]);
        echo implode(' | ', array_map(function($h) { return str_pad($h, 12); }, $headers)) . "\n";
        echo str_repeat('-', count($headers) * 15) . "\n";
        
        // Data
        foreach ($samples as $row) {
            echo implode(' | ', array_map(function($v) { 
                return str_pad(substr($v, 0, 12), 12); 
            }, $row)) . "\n";
        }
    }
    echo "\n";
    
    // 7. Lokasi file database PostgreSQL
    echo "📁 LOKASI FILE DATABASE:\n";
    echo "========================================\n";
    $stmt = $pdo->query("SHOW data_directory");
    $data_dir = $stmt->fetchColumn();
    echo "Data Directory: {$data_dir}\n";
    
    $stmt = $pdo->query("SELECT oid, datname FROM pg_database WHERE datname = 'siakad_uniman'");
    $db_info = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($db_info) {
        echo "Database OID: {$db_info['oid']}\n";
        echo "Database Files: {$data_dir}/base/{$db_info['oid']}/\n";
    }
    echo "\n";
    
    // 8. Informasi koneksi untuk Navicat
    echo "🔧 KONFIGURASI NAVICAT:\n";
    echo "========================================\n";
    echo "Connection Type: PostgreSQL\n";
    echo "Host: 127.0.0.1 (atau localhost)\n";
    echo "Port: 5432\n";
    echo "Database: siakad_uniman\n";
    echo "Username: postgres\n";
    echo "Password: \$H1+\$h1+\n";
    echo "Schema: public\n\n";
    
    echo "✅ Semua informasi database berhasil diambil!\n";
    
} catch (PDOException $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
}
