<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Github\ListRepositoriesController;
use App\Http\Controllers\Github\ListUsersController;
use App\Http\Controllers\Github\ShowRepositoryContributorsController;
use App\Http\Controllers\Github\ShowRepositoryController;
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

Route::post('/auth', AuthController::class)->name('auth');
Route::get('/repositories', ListRepositoriesController::class)->name('list.repositories');
Route::post('/show', ShowRepositoryController::class)->name('repositories.show');
Route::post('/contributors', ShowRepositoryContributorsController::class)->name('repositories.contributors');
Route::get('/users', ListUsersController::class)->name('list.users');
