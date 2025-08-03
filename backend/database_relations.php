<?php
echo "=== ANALISIS RELASI DATABASE ===\n\n";

try {
    $pdo = new PDO('pgsql:host=127.0.0.1;port=5432;dbname=siakad_uniman', 'postgres', '$H1+$h1+');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // 1. Semua Foreign Key dalam database
    echo "🔗 SEMUA FOREIGN KEY CONSTRAINTS:\n";
    echo "========================================\n";
    $stmt = $pdo->query("
        SELECT 
            tc.table_name as from_table,
            kcu.column_name as from_column,
            ccu.table_name AS to_table,
            ccu.column_name AS to_column,
            tc.constraint_name,
            rc.update_rule,
            rc.delete_rule
        FROM information_schema.table_constraints AS tc
        JOIN information_schema.key_column_usage AS kcu
            ON tc.constraint_name = kcu.constraint_name
        JOIN information_schema.constraint_column_usage AS ccu
            ON ccu.constraint_name = tc.constraint_name
        JOIN information_schema.referential_constraints AS rc
            ON tc.constraint_name = rc.constraint_name
        WHERE constraint_type = 'FOREIGN KEY'
        ORDER BY tc.table_name, kcu.column_name
    ");
    
    $foreign_keys = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if (empty($foreign_keys)) {
        echo "• Tidak ada foreign key yang ditemukan dalam database\n";
    } else {
        foreach ($foreign_keys as $fk) {
            echo "• {$fk['from_table']}.{$fk['from_column']} → {$fk['to_table']}.{$fk['to_column']}\n";
            echo "  Constraint: {$fk['constraint_name']}\n";
            echo "  On Update: {$fk['update_rule']} | On Delete: {$fk['delete_rule']}\n\n";
        }
    }
    
    // 2. Semua tabel dengan jumlah record
    echo "📊 JUMLAH RECORD PER TABEL:\n";
    echo "========================================\n";
    $stmt = $pdo->query("
        SELECT table_name 
        FROM information_schema.tables 
        WHERE table_schema = 'public' 
        AND table_type = 'BASE TABLE'
        ORDER BY table_name
    ");
    
    $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);
    foreach ($tables as $table) {
        try {
            $count_stmt = $pdo->query("SELECT COUNT(*) FROM {$table}");
            $count = $count_stmt->fetchColumn();
            echo "• {$table}: {$count} records\n";
        } catch (Exception $e) {
            echo "• {$table}: Error counting records\n";
        }
    }
    echo "\n";
    
    // 3. Struktur semua tabel yang memiliki data
    echo "🏗️ STRUKTUR TABEL DENGAN DATA:\n";
    echo "========================================\n";
    foreach ($tables as $table) {
        try {
            $count_stmt = $pdo->query("SELECT COUNT(*) FROM {$table}");
            $count = $count_stmt->fetchColumn();
            
            if ($count > 0) {
                echo "\n📋 TABEL: {$table} ({$count} records)\n";
                echo str_repeat('-', 50) . "\n";
                
                $struct_stmt = $pdo->query("
                    SELECT 
                        column_name, 
                        data_type, 
                        is_nullable, 
                        column_default,
                        character_maximum_length
                    FROM information_schema.columns 
                    WHERE table_name = '{$table}' 
                    ORDER BY ordinal_position
                ");
                
                $columns = $struct_stmt->fetchAll(PDO::FETCH_ASSOC);
                foreach ($columns as $col) {
                    $length = $col['character_maximum_length'] ? "({$col['character_maximum_length']})" : '';
                    $nullable = $col['is_nullable'] === 'YES' ? 'NULL' : 'NOT NULL';
                    $default = $col['column_default'] ? " [DEFAULT: {$col['column_default']}]" : '';
                    
                    echo "  • {$col['column_name']}: {$col['data_type']}{$length} {$nullable}{$default}\n";
                }
                
                // Sample data untuk tabel dengan records < 10
                if ($count <= 10 && $count > 0) {
                    echo "\n  📄 Sample Data:\n";
                    $sample_stmt = $pdo->query("SELECT * FROM {$table} LIMIT 3");
                    $samples = $sample_stmt->fetchAll(PDO::FETCH_ASSOC);
                    
                    if (!empty($samples)) {
                        foreach ($samples as $i => $row) {
                            echo "    Row " . ($i + 1) . ": ";
                            $row_data = [];
                            foreach ($row as $key => $value) {
                                $row_data[] = "{$key}=" . (strlen($value) > 20 ? substr($value, 0, 20) . '...' : $value);
                            }
                            echo implode(', ', $row_data) . "\n";
                        }
                    }
                }
            }
        } catch (Exception $e) {
            echo "• Error analyzing table {$table}: " . $e->getMessage() . "\n";
        }
    }
    
    // 4. PostgreSQL specific info
    echo "\n\n🔧 INFORMASI POSTGRESQL:\n";
    echo "========================================\n";
    
    // Size database
    $stmt = $pdo->query("SELECT pg_size_pretty(pg_database_size('siakad_uniman')) as database_size");
    $size = $stmt->fetchColumn();
    echo "Database Size: {$size}\n";
    
    // Connection info
    $stmt = $pdo->query("SELECT COUNT(*) FROM pg_stat_activity WHERE datname = 'siakad_uniman'");
    $connections = $stmt->fetchColumn();
    echo "Active Connections: {$connections}\n";
    
    // Encoding
    $stmt = $pdo->query("SHOW server_encoding");
    $encoding = $stmt->fetchColumn();
    echo "Server Encoding: {$encoding}\n";
    
    $stmt = $pdo->query("SHOW timezone");
    $timezone = $stmt->fetchColumn();
    echo "Timezone: {$timezone}\n";
    
    echo "\n✅ Analisis relasi database selesai!\n";
    
} catch (PDOException $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
}
