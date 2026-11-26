<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VaranController;

// Direct Root to Matrimony Portal or Login
Route::get('/', [VaranController::class, 'portal'])->name('home');
Route::get('/portal', [VaranController::class, 'portal']);

// Dedicated Common ID & Password Login
Route::get('/login', [VaranController::class, 'showLogin'])->name('matrimony.login');
Route::post('/login', [VaranController::class, 'doLogin'])->name('matrimony.doLogin');
Route::get('/logout', [VaranController::class, 'logout'])->name('matrimony.logout');

// Dedicated Matrimony Portal (Form + Boy/Girl Switch + Voice Mic + Saved Profiles List)
Route::get('/matrimony', [VaranController::class, 'portal'])->name('matrimony.portal');
Route::post('/matrimony/store', [VaranController::class, 'store'])->name('varans.store');
Route::post('/matrimony/bulk-delete', [VaranController::class, 'bulkDestroy'])->name('varans.bulkDestroy');
Route::delete('/matrimony/{varan}', [VaranController::class, 'destroy'])->name('varans.destroy');

// Yellow A4 Biodata Print View
Route::get('/varans/{varan}/print', [VaranController::class, 'print'])->name('varans.print');
Route::get('/matrimony/print-blank', [VaranController::class, 'printBlank'])->name('matrimony.printBlank');

// Smart Biodata Document Parsing & Sample Endpoints
Route::post('/matrimony/parse-document', [VaranController::class, 'parseDocument'])->name('varans.parseDocument');
Route::post('/parse-document', [VaranController::class, 'parseDocument']);
Route::get('/matrimony/sample-biodata/{type}', [VaranController::class, 'getSampleBiodata'])->name('varans.getSample');
Route::get('/sample-biodata/{type}', [VaranController::class, 'getSampleBiodata']);

// Master Dropdown Options Management (Admin Panel)
Route::get('/matrimony/master-options', [VaranController::class, 'getMasterOptions'])->name('matrimony.masterOptions.index');
Route::post('/matrimony/master-options', [VaranController::class, 'storeMasterOption'])->name('matrimony.masterOptions.store');
Route::put('/matrimony/master-options/{id}', [VaranController::class, 'updateMasterOption'])->name('matrimony.masterOptions.update');
Route::delete('/matrimony/master-options/{id}', [VaranController::class, 'destroyMasterOption'])->name('matrimony.masterOptions.destroy');

// Reg No Auto-Generation Configuration (Admin Panel)
Route::get('/matrimony/reg-no-setting', [VaranController::class, 'getRegNoSetting'])->name('matrimony.regNoSetting.get');
Route::post('/matrimony/reg-no-setting', [VaranController::class, 'updateRegNoSetting'])->name('matrimony.regNoSetting.update');

// Global Photo Print Setting (Admin Panel)
Route::get('/matrimony/photo-setting', [VaranController::class, 'getPhotoSetting'])->name('matrimony.photoSetting.get');
Route::post('/matrimony/photo-setting', [VaranController::class, 'updatePhotoSetting'])->name('matrimony.photoSetting.update');

// Print Styles & Typography Setting (Admin Panel - Cross-Device Sync)
Route::get('/matrimony/print-style-setting', [VaranController::class, 'getPrintStyleSetting'])->name('matrimony.printStyleSetting.get');
Route::post('/matrimony/print-style-setting', [VaranController::class, 'updatePrintStyleSetting'])->name('matrimony.printStyleSetting.update');

// Admin Login Credentials Management (Settings)
Route::get('/matrimony/admin-auth-setting', [VaranController::class, 'getAdminAuthSetting'])->name('matrimony.adminAuthSetting.get');
Route::post('/matrimony/admin-auth-setting', [VaranController::class, 'updateAdminAuthSetting'])->name('matrimony.adminAuthSetting.update');
Route::post('/matrimony/admin-auth-reset', [VaranController::class, 'resetAdminAuthSetting'])->name('matrimony.adminAuthSetting.reset');

// Forgot Password / ID Recovery via Email OTP
Route::post('/forgot-password/send-otp', [VaranController::class, 'sendForgotOtp'])->name('matrimony.forgot.sendOtp');
Route::post('/forgot-password/verify-otp', [VaranController::class, 'verifyForgotOtp'])->name('matrimony.forgot.verifyOtp');

// Emergency Cache & View Clear Endpoint (cPanel friendly)
Route::get('/matrimony/clear-cache', function () {
    try {
        \Illuminate\Support\Facades\Artisan::call('view:clear');
        \Illuminate\Support\Facades\Artisan::call('cache:clear');
        \Illuminate\Support\Facades\Artisan::call('config:clear');
        \Illuminate\Support\Facades\Artisan::call('route:clear');

        $viewDir = storage_path('framework/views');
        if (is_dir($viewDir)) {
            $files = glob($viewDir . '/*.php');
            if (is_array($files)) {
                foreach ($files as $file) {
                    if (is_file($file)) @unlink($file);
                }
            }
        }
        return response('<div style="font-family:sans-serif;padding:30px;text-align:center;max-width:550px;margin:40px auto;border:2px solid #15803d;border-radius:12px;background:#f0fdf4;"><h2 style="color:#15803d;margin-top:0;">✓ Cache & Blade Views Cleared Successfully!</h2><p style="color:#334155;font-size:15px;line-height:1.6;">Laravel-in compiled blade views mattrum cache-gal clean aga azhikka-pattana.<br>Ipo neenga portal & print page refresh seithu paarkkalam.</p><a href="/matrimony" style="display:inline-block;margin-top:12px;padding:10px 22px;background:#15803d;color:#fff;text-decoration:none;border-radius:8px;font-weight:bold;font-size:14px;">← Portal-kku Selga</a></div>');
    } catch (\Throwable $e) {
        return response('Cache Clear Error: ' . $e->getMessage(), 500);
    }
})->name('matrimony.clearCache');

// Legacy fallback redirect
Route::get('/matrimony/register', function() {
    return redirect()->route('matrimony.portal');
});
