<?php

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
    if(!auth()->check()) {
        return view('welcome');
    } else {
        return redirect("/links");
    }
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return redirect("/links");
})->name('dashboard');


Route::resource("links", \App\Http\Controllers\LinkController::class)->middleware('auth');
