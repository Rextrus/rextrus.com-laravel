<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\cod4\MapsController;
use App\Http\Controllers\cod4\RoutesController;
use App\Http\Controllers\cod4\PlayersController;
use App\Http\Controllers\cod4\ServersController;

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

Route::resource('/', ServersController::class)->only([
    'index'
]);

Route::resource('/cod4/serverlist', ServersController::class)->only([
    'index'
]);

Route::get('/cod4/map/download/{map}', [MapsController::class, 'downloadMap']);

Route::resource('/cod4/map', MapsController::class)->only([
    'index', 'show'
]);

Route::resource('/cod4/route', RoutesController::class)->only([
    'show'
]);

Route::resource('/cod4/player', PlayersController::class)->only([
    'index', 'show'
]);

Route::post('/cod4/player/search',[PlayersController::class,'findPlayer'])->name('player.search');