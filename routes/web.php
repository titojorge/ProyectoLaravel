<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ChirpController;
use Illuminate\Support\Facades\Route;

// DB::listen(function($query){
//     dump($query->sql);
// });

Route::view('/','welcome')->name('welcome');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/chirps', [ChirpController::class, 'index'])->name('chirps.index');
    Route::post('/chirps', [ChirpController::class, 'store'])->name('chirps.store');
    Route::get('/chirps/{chirp}/edit',[ChirpController::class,'edit'])->name('chirps.edit');
    Route::put('/chirps/{chirp}',[ChirpController::class,'update'])->name('chirps.update');
    Route::delete('/chirps/{chirp}',[ChirpController::class,'destroy'])->name('chirps.destroy');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// Route::get('/tweets', function () {
//     return "Welcome to our tweets page ";
// })->name('chirps.index');

// Route::get('/chirps/{chirp?}', function ($chirp = null) {
//     if ($chirp === '0'){
//         // return redirect()->route('chirps.index'); HACE LO MISMO QUE LA FUNCION TO_ROUTE
//         return to_route('chirps.index');
//     }
//     return "Chirp detail " . $chirp;
// });
