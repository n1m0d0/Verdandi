<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;

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

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::controller(PageController::class)->group(function() {
    Route::get('document', 'document')->name('page.document')->middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified']);
    Route::get('entity', 'entity')->name('page.entity')->middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified']);
    Route::get('user', 'user')->name('page.user')->middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified']);
    Route::get('position/{id}', 'position')->name('page.position')->middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified']);
    Route::get('assignment/{id}', 'assignment')->name('page.assignment')->middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified']);
    Route::get('correspondence', 'correspondence')->name('page.correspondence')->middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified']);
    Route::get('diagram', 'diagram')->name('page.diagram')->middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified']);
    Route::get('roadmap', 'roadmap')->name('page.roadmap')->middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified']);
});