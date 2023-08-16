<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\cod4\MapsController;
use App\Http\Controllers\cod4\RoutesController;
use App\Http\Controllers\cod4\PlayersController;
use App\Http\Controllers\cod4\StatisticsController;
use App\Http\Controllers\cod4\ServersController;
use App\Http\Controllers\cod4\LeaderboardController;
// use App\Http\Controllers\Auth\RegisterController;

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

Route::get('/aboutme/timeline', function () {
    return view('pages/aboutme/timeline');
});

Route::get('/timeline', function () {
    return view('pages/aboutme/references');
});

Route::get('/', [ServersController::class, 'index'])->name('servers.index');
Route::get('/cod4/serverlist', [ServersController::class, 'index']);
Route::get('/cod4/map/download/{map}', [MapsController::class, 'downloadMap']);

Route::resource('/cod4/map', MapsController::class)->only([
    'index', 'show'
]);
Route::resource('/cod4/route', RoutesController::class)->only('show');
Route::resource('/cod4/runs', PlayersController::class)->only('show');
Route::resource('/cod4/leaderboard', LeaderboardController::class)->only('index');

Route::get('/cod4/player', [PlayersController::class, 'index']);

Route::post('/cod4/player/search',[PlayersController::class,'findPlayer'])->name('player.search');

Route::resource('/cod4/statistics', StatisticsController::class)->only([
    'index', 'show'
]);

// Register Stuff 
Route::get('/register', 'RegisterController@create');
Route::post('register', 'RegisterController@store');

Route::get('/login', 'SessionsController@create');
Route::post('/login', 'SessionsController@store');
Route::get('/logout', 'SessionsController@destroy');