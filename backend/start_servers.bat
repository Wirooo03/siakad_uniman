@echo off
echo ====================================
echo     STARTING DEVELOPMENT SERVERS
echo ====================================
echo.

echo Starting Laravel backend server...
start "Laravel Server" cmd /k "cd /d %~dp0 && php artisan serve --host=127.0.0.1 --port=8000"

timeout /t 3

echo Starting Next.js frontend server...
start "Next.js Server" cmd /k "cd /d %~dp0.. && npm run dev"

echo.
echo ====================================
echo     SERVERS STARTED!
echo ====================================
echo.
echo Laravel Backend: http://127.0.0.1:8000
echo Next.js Frontend: http://localhost:3000
echo Test Page: http://localhost:3000/test
echo API Health: http://127.0.0.1:8000/api/health
echo.
echo Press any key to close this window...
pause >nul
