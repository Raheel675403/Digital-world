<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use \App\Http\Controllers\loginController;
use \App\Http\Controllers\PurchaseController;
use \App\Http\Controllers\HistoryController;
use Illuminate\Support\Facades\Log;
use Laravel\Cashier\Http\Controllers\WebhookController;
use Illuminate\Http\Request;
Route::get('/', function () {
    return view('welcome');
});
Route::get('register-purchase/{id}',[RegisterController::class,'registerPurchase'])->name('register-purchase');
Route::get('register-viewer/{id}',[RegisterController::class,'registerViewer'])->name('register-viewer');
Route::any('register',[RegisterController::class,'registerUser'])->name('register');
Route::get('login',[loginController::class,'index'])->name('login');
Route::Post('login/check',[loginController::class,'check'])->name('check');
Route::get('logout',[loginController::class,'logout'])->name('logout');
Route::get('dashboard',[loginController::class,'dashboard'])->name('dashboard');
Route::get('page/purchase',[PurchaseController::class,'index'])->name('purchase-coins');
Route::Post('purchase/coins',[PurchaseController::class,'purchaseCoin'])->name('save-purchase-coins');
Route::get('/coin/success', [PurchaseController::class, 'success'])->name('coin.success');
Route::get('apply/video',[PurchaseController::class,'applyVideo'])->name('apply-video');
Route::any('request/video',[PurchaseController::class,'requestVideo'])->name('request-video');
Route::any('save/video/detail',[PurchaseController::class,'saveRequestVideo'])->name('save-request-video');
Route::get('video/history',[HistoryController::class,'applyVideoHistory'])->name('video-history');
Route::post('/stripe/webhook', [WebhookController::class, 'handleWebhook'])->name('cashier.webhook');
