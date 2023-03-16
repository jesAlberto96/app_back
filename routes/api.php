<?php

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

Route::get('/orc/{orcid}', [App\Http\Controllers\Api\V1\OrcController::class, 'getORCID']);
Route::get('/orcid/list', [App\Http\Controllers\Api\V1\OrcController::class, 'list']);
Route::post('/orcid/create/{orcid}', [App\Http\Controllers\Api\V1\OrcController::class, 'store']);
Route::delete('/orcid/delete/{orcid}', [App\Http\Controllers\Api\V1\OrcController::class, 'delete']);
Route::get('/orcid/{orcid}', [App\Http\Controllers\Api\V1\OrcController::class, 'detail']);