<?php

use App\Http\Controllers\RTSContributionsController;
use App\Http\Controllers\RTSGroupController;
use App\Http\Controllers\RTSMemberController;
use App\Models\RTSMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


    Route::post('/joinRTS',[RTSMemberController::class,"joinGroup"]);
    Route::post('/createRTS',[RTSGroupController::class,"createGroup"]);
    Route::post('/listRTS',[RTSGroupController::class,"listUserGroup"]);
    Route::post('/listOtherGroup',[RTSGroupController::class,"listOtherGroup"]);
    Route::post('/createContributionAmount',[RTSContributionsController::class,"createContributionAmount"]);
    Route::post('/listContributionResult',[RTSContributionsController::class,"listContributionResult"]);
    Route::post('/sendContributionResponse',[RTSContributionsController::class,"sendContributionResponse"]);
    Route::post('/listMembers',[RTSMemberController::class,"listMembers"]);

