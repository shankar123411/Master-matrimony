@echo off
title Master Matrimony - Local Server
echo Starting Master Matrimony on http://127.0.0.1:8000 ...
D:\xampp\php\php.exe artisan serve --host=127.0.0.1 --port=8000
pause
