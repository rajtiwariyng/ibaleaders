<?php 

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\ApiVisitorController;
use App\Http\Controllers\Api\ApiUserProfileController;

Route::prefix('v1/')->group(function () {
   Route::post('login', [AuthController::class, 'login']);
   Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
   Route::post('signup', [AuthController::class, 'signup']);
   

   Route::middleware('auth:sanctum')->group(function () {
    Route::get('/users', [AuthController::class, 'userslist']);
    Route::post('/visitor-registration', [ApiVisitorController::class, 'store']);

    Route::get('/user/profile', [ApiUserProfileController::class, 'profile']);
    Route::get('/user/profiledetails', [ApiUserProfileController::class, 'profiledetails']);
    Route::post('/user/updateprofile', [ApiUserProfileController::class, 'updateProfile']);
    Route::post('/user/updateprofileimage', [ApiUserProfileController::class, 'updateProfileImage']);

    Route::post('/user/createpost', [ApiUserProfileController::class, 'createPost']);
    Route::get('/user/postlist', [ApiUserProfileController::class, 'postlist']);
    Route::get('/user/showconnections', [ApiUserProfileController::class, 'showConnections']);
   });
});

