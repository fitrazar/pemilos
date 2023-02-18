<?php

use App\Http\Livewire\Admin\AdminKandidat;
use App\Http\Livewire\Auth\Login;
use App\Http\Livewire\Product\ProductData;
use App\Http\Livewire\Auth\Register;
use App\Http\Livewire\Kandidat\KandidatData;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['login' => false, 'register' => false, 'verify' => true]);

route::middleware('guest')->group(function(){
    Route::get('/login', Login::class)->name('login');
    Route::get('/register', Register::class)->name('register');
});

route::middleware('auth')->group(function(){
    Route::get('/kandidat', KandidatData::class)->name('kandidat');
    Route::get('/admin/kandidat', AdminKandidat::class)->name('adminKandidat');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
