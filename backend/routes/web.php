<?php

use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Passport\Passport;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\FootballController;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PassportAuthController;

// Web routes

// API routes
Route::prefix('api')->group(function () {
    Route::get('/competitions', [FootballController::class, 'getAllCompetitions']);
    Route::get('/competitions/{id}', [FootballController::class, 'getCompetition']);
    Route::get('/team', [FootballController::class, 'getAllTeams']);
    Route::get('/team/{id}', [FootballController::class, 'getTeam']);
    Route::get('/players', [FootballController::class, 'getAllPlayers']);
    Route::get('/players/{id}', [FootballController::class, 'getPlayer']);
});


// Authentication
Route::post('register', [PassportAuthController::class, 'register']);
Route::post('login', [PassportAuthController::class, 'login'])->name('login');
Route::post('logout', [PassportAuthController::class, 'logout']);
Route::get('/', function () {
    return view('welcome');
});