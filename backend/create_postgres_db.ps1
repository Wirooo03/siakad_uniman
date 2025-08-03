$env:PGPASSWORD = ""
psql -h 127.0.0.1 -p 5432 -U postgres -c "DROP DATABASE IF EXISTS siakad_uniman;"
psql -h 127.0.0.1 -p 5432 -U postgres -c "CREATE DATABASE siakad_uniman;"
Write-Host "Database PostgreSQL siakad_uniman berhasil dibuat!"
