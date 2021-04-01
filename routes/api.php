<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\NotesController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ProjectsController;
use App\Http\Controllers\VerificationApiController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\PasswordResetLinkController;


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
    //Public Notes
    Route::get('/publicNotes',[DashboardController::class,'publicNotes']);

    //Password Reset
    Route::post('/forgot-password', [PasswordResetLinkController::class, 'store']);
Route::middleware('auth:sanctum')->get('/getCurrentLoggedInUser', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/currentUserNotes',[DashboardController::class,'Notes']);
    Route::get('/currentUserProjects',[DashboardController::class,'Projects']);
    Route::get('/currentUserCategories',[DashboardController::class,'Categories']);

    //Notes Routes
    Route::post('/addNewNote',[NotesController::class,'store']);
    Route::put('/updatenote/{id}',[NotesController::class,'update']);
    Route::put('/deletenote/{id}',[NotesController::class,'destroy']);

    //Categories Routes
    Route::post('/addnewcategory',[CategoriesController::class,'store']);

    //Projects Routes
    Route::post('/addnewproject',[ProjectsController::class,'store']);
    

    //email ver
    Route::get('email/verify/{id}', [VerificationApiController::class , 'verify'])->name('verificationapi.verify');
    Route::get('email/resend', [VerificationApiController::class , 'resend'])->name('verificationapi.resend');
    Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store']);


});