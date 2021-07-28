<?php

use App\Http\Controllers\CustomerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::resource('customer', CustomerController::class)->except([
    'create', 'edit'
]);

Route::get('customer/{customer}/groups', [CustomerController::class, 'groups']);
Route::put('customer/{customer}/groups', [CustomerController::class, 'assignGroups']);
