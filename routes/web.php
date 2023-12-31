<?php

use App\Http\Controllers\CampaignController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QrCodeController;
use App\Http\Controllers\TrackQRController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/




Route::middleware('splade')->group(function () {
    // Registers routes to support the interactive components...
    Route::spladeWithVueBridge();

    // Registers routes to support password confirmation in Form and Link components...
    Route::spladePasswordConfirmation();

    // Registers routes to support Table Bulk Actions and Exports...
    Route::spladeTable();

    // Registers routes to support async File Uploads with Filepond...
    Route::spladeUploads();

    Route::get('/', function () {
        return view('welcome');
    });

    Route::middleware('auth')->group(function () {
        Route::get('/dashboard', function () {
            return view('dashboard');
        })->middleware(['verified'])->name('dashboard');

        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

        Route::get('my-campaigns', [CampaignController::class, 'index'])->name('mycampaigns');

        Route::get('my-campaign/add', [CampaignController::class, 'create'])->name('mycampaigns.create');
        Route::get('my-campaign/delete/{campaign}', [CampaignController::class, 'destroy'])->name('mycampaigns.create');
        Route::post('my-campaigns', [CampaignController::class, 'store'])->name('mycampaigns.store');
        Route::get('my-campaign/{campaign}', [CampaignController::class, 'show'])->name('mycampaigns.show');

        Route::post('/qr-code', [QrCodeController::class, 'store'])->name('qrcode.store');
        Route::get('/qr-code/create/{id}', [QrCodeController::class, 'create'])->name('qrcode.create');
        Route::get('/qr-code/{id}', [QrCodeController::class, 'show']);

        

    });

    Route::get('/track/qr/{campaign}/{qrcode}', [TrackQRController::class, 'qr']);

    require __DIR__.'/auth.php';
});
