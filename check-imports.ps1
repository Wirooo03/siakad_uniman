# Update Import Paths Script
# Script untuk mengupdate import paths yang menggunakan UI components

$projectPath = "d:\main\v1\experiment\bejir\test_github_copilot\src"

# Find all .tsx and .jsx files
$files = Get-ChildItem -Path $projectPath -Recurse -Include "*.tsx", "*.jsx" | Where-Object { $_.FullName -notlike "*node_modules*" }

foreach ($file in $files) {
    $content = Get-Content $file.FullName -Raw
    $updated = $false
    
    # Replace hardcoded button classes with Button component
    if ($content -match 'className="[^"]*bg-blue-600[^"]*"') {
        Write-Host "📝 Found hardcoded button styles in: $($file.Name)" -ForegroundColor Yellow
    }
    
    # Replace hardcoded input classes with Input component  
    if ($content -match 'className="[^"]*border border-gray-300[^"]*"') {
        Write-Host "📝 Found hardcoded input styles in: $($file.Name)" -ForegroundColor Yellow
    }
    
    # Add UI imports if components are being used manually
    if ($content -match '<button[^>]*className="[^"]*btn-' -and $content -notmatch 'import.*Button.*from') {
        Write-Host "📝 Could benefit from Button component: $($file.Name)" -ForegroundColor Cyan
    }
}

Write-Host "🔍 Import analysis completed!" -ForegroundColor Green
Write-Host "💡 Consider using UI components from @/components/ui for consistent styling" -ForegroundColor Blue
