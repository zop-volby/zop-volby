<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ElectionController;
use App\Http\Controllers\NomineeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ElectionListController;
use App\Http\Controllers\QrCodeController;
use App\Http\Controllers\VoterController;
use App\Http\Controllers\VotingController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('i', function () {
    phpinfo(); 
});

Route::get('/', function () {
    return User::count() == 0 ? redirect('register') : view('welcome');
})->name('welcome');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/election', [ElectionController::class, 'edit'])->name('election.edit');
    Route::put('/election', [ElectionController::class, 'update'])->name('election.update');

});

Route::post('users/{user}/activate', [UserController::class, 'activate'])->name('users.activate')->middleware('auth');
Route::resource('users', UserController::class)->middleware('auth');

Route::resource('nominees', NomineeController::class)->middleware('auth');

Route::get('lists/{list}/nominees', [ElectionListController::class, 'get_nominees'])->name('lists.nominees')->middleware('auth');
Route::put('lists/{list}/nominees', [ElectionListController::class, 'put_nominees'])->name('lists.nominees')->middleware('auth');
Route::resource('lists', ElectionListController::class)->middleware('auth');

Route::get('voters/activate/{voter}', [VoterController::class, 'activate'])->name('voters.activate')->middleware('auth');
Route::get('voters/load', [VoterController::class, 'get_load'])->name('voters.load')->middleware('auth');
Route::post('voters/load', [VoterController::class, 'post_load'])->name('voters.load')->middleware('auth');
Route::get('voters/scan', [VoterController::class, 'get_scan'])->name('voters.scan')->middleware('auth');
Route::post('voters/scan', [VoterController::class, 'post_scan'])->name('voters.scan')->middleware('auth');
Route::resource('voters', VoterController::class)->middleware('auth');

Route::get('voting', [VotingController::class, 'index'])->name('voting.index');
Route::post('voting', [VotingController::class, 'store'])->name('voting.store');

Route::get('qr/{id}', [QrCodeController::class, 'index'])->name('qrcode');

require __DIR__.'/auth.php';
