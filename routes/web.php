<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ClientController;
use App\Livewire\EnregLivewire;
use App\Livewire\ValideLivewire;
use App\Livewire\ArchiveLivewire;
use App\Livewire\CreateEnregLivewire;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/dashboard', [HomeController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');



    Route::get('/enreg', EnregLivewire::class)->name('enreg.crud');
    Route::get('/valide', ValideLivewire::class)->name('valide.crud');
    Route::get('/archive', ArchiveLivewire::class)->name('archive.crud');
    Route::get('/create-enreg', CreateEnregLivewire::class)->name('create-enreg.crud');


    Route::resource('/users', UserController::class);
    Route::resource('/clients', ClientController::class);
	Route::get('/users/statut/{id}', [UserController::class, "statut"])->name("user_statut");
    Route::get('/clients/statut/{id}', [ClientController::class, "statut"])->name("client_statut");

    // Route::get('/users-list', UserController::class)->name('users-list');
    // Route::get('/users-create', UserController::class)->name('user-create');
    // Route::get('/users-update', UserController::class)->name('user-update');
    // Route::get('/users-delete', UserController::class)->name('user-delete');


    // Route::get('/clients-list', EnregLivewire::class)->name('UserController.crud');



});

require __DIR__.'/auth.php';
