<?php

use App\Http\Controllers\AlxController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EventController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::resource('post', PostController::class);
Route::get('teams', [TeamController::class, 'index'])->name('team.index');
Route::post('teams/{id}', [TeamController::class, 'update'])->name('team.update');
Route::resource('team', TeamController::class)->except('index', 'update');
Route::get('team/{id}/settings', [TeamController::class, 'settings'])->name('team.settings');
Route::post('team/{team}/join', [TeamController::class, 'join'])->name('team.joinRequest');

Route::resource('team/{id}/project', ProjectController::class)->except('index');
Route::get('team/{id}/project/{pid}/tasks', [ProjectController::class, 'task'])->name('project.task');
Route::get('team/{id}/project/{pid}/people', [ProjectController::class, 'people'])->name('project.people');

Route::post('pupload', [ProjectController::class, 'upload'])->name('project.upload');
Route::get('projects', [ProjectController::class, 'index'])->name('project.index');
Route::post('project/{project}/join', [ProjectController::class, 'join'])->name('project.join');

Route::post('board', [ProjectController::class, 'storeBoard'])->name('board.store');

Route::post('task', [ProjectController::class, 'storeTask'])->name('task.store');

Route::resource('alx', AlxController::class);

Route::get('user/{id}', [UserController::class, 'index'])->name('user');

Route::resource('event', EventController::class);

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');
