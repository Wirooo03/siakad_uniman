# Project Cleanup Script
# Script untuk membersihkan project secara berkala

# Files yang bisa dihapus (duplikat atau tidak terpakai)
$filesToDelete = @(
    "d:\main\v1\experiment\bejir\test_github_copilot\src\lib\api_new.js",
    "d:\main\v1\experiment\bejir\src\"
)

# Folders yang bisa dihapus
$foldersToDelete = @(
    "d:\main\v1\experiment\bejir\test_github_copilot\.next\cache",
    "d:\main\v1\experiment\bejir\test_github_copilot\node_modules\.cache"
)

# Documentation files to move to docs folder
$docsToMove = @(
    "CHANGE_API_URL.md",
    "DATABASE_EXTENDED_SUMMARY.md", 
    "DATABASE_READY.md",
    "DATABASE_UPDATE_REPORT.md",
    "LIST_MAHASISWA_INTEGRATION.md",
    "MANUAL_DATABASE_UPDATE.md",
    "PROGRESS_REPORT.md",
    "SETUP_GUIDE.md",
    "STATUS.md",
    "TROUBLESHOOTING.md"
)

Write-Host "🧹 Starting Project Cleanup..." -ForegroundColor Green

# Delete duplicate files
foreach ($file in $filesToDelete) {
    if (Test-Path $file) {
        Remove-Item $file -Force
        Write-Host "✅ Deleted: $file" -ForegroundColor Yellow
    }
}

# Clean cache folders  
foreach ($folder in $foldersToDelete) {
    if (Test-Path $folder) {
        Remove-Item $folder -Recurse -Force
        Write-Host "✅ Cleaned: $folder" -ForegroundColor Yellow
    }
}

# Move documentation
$docsPath = "d:\main\v1\experiment\bejir\docs"
if (!(Test-Path $docsPath)) {
    New-Item -ItemType Directory -Path $docsPath
}

foreach ($doc in $docsToMove) {
    $sourcePath = "d:\main\v1\experiment\bejir\$doc"
    if (Test-Path $sourcePath) {
        Move-Item $sourcePath $docsPath -Force
        Write-Host "✅ Moved to docs: $doc" -ForegroundColor Cyan
    }
}

Write-Host "🎉 Project cleanup completed!" -ForegroundColor Green
Write-Host "📁 Documentation moved to: $docsPath" -ForegroundColor Blue
