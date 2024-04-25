<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::view('/','welcome')->name('welcome');

Route::get('/chirps', function(){
    return 'Welcome to our chirps page';
})->name('chirps.index');

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
