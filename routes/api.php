<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\ApiVisitorController;
use App\Http\Controllers\Api\ApiUserProfileController;
use App\Http\Controllers\Api\ApiConnectionController;

Route::prefix('v1/')->group(function () {
   Route::post('login', [AuthController::class, 'login']);
   Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
   Route::post('signup', [AuthController::class, 'signup']);
   Route::post('send-otp', [AuthController::class, 'sendOtp']);
   Route::post('validate-otp', [AuthController::class, 'validateOtp']);  
   Route::post('reset-password', [AuthController::class, 'resetPassword']);   


   Route::middleware('auth:sanctum')->group(function () {
      Route::get('/users', [AuthController::class, 'userslist']);
      Route::get('/user/search', [AuthController::class, 'searchUser']);
      Route::post('/visitor-registration', [ApiVisitorController::class, 'store']);

      Route::get('/videos', [ApiVisitorController::class, 'getVideos']);

      Route::get('/user/profile', [ApiUserProfileController::class, 'profile']);
      Route::get('/user/profiledetails', [ApiUserProfileController::class, 'profiledetails']);
      Route::post('/user/updateprofile', [ApiUserProfileController::class, 'updateProfile']);
      Route::post('/user/updateprofileimage', [ApiUserProfileController::class, 'updateProfileImage']);

      Route::post('/user/createpost', [ApiUserProfileController::class, 'createPost']);
      Route::get('/user/postlist', [ApiUserProfileController::class, 'postlist']);

      Route::get('/user/showconnections', [ApiConnectionController::class, 'showConnections']);
      Route::post('/user/sendconnectionrequest', [ApiConnectionController::class, 'sendConnectionRequest']);
      Route::post('/user/approveconnectionrequest', [ApiConnectionController::class, 'approveConnectionRequest']);
      Route::post('/user/rejectconnectionrequest', [ApiConnectionController::class, 'rejectConnectionRequest']);
      Route::get('/user/pendingrequestlist', [ApiConnectionController::class, 'pendingRequestList']);
      Route::get('/user/sendrequestlist', [ApiConnectionController::class, 'sendRequestList']);
      Route::post('/user/sendpostreact', [ApiUserProfileController::class, 'sendPostReact']);
      Route::get('/user/eventlist', [ApiUserProfileController::class, 'eventlist']);
      Route::post('/user/addevent', [ApiUserProfileController::class, 'addEvent']);
      Route::get('/user/notificationslist', [ApiUserProfileController::class, 'notificationslists']);
      Route::get('/user/viewprofile', [ApiUserProfileController::class, 'viewProfile']);
      Route::post('/user/changepassword', [ApiUserProfileController::class, 'changePassword']);
      Route::get('/user/referral/report', [ApiUserProfileController::class, 'referralReport']);


      
     /*********************************************** Caht  ***************** */
     
   });
});
