<?php

use App\Http\Controllers\FrontendLoginController;
use App\Http\Controllers\VisitorController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\ConnectionController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use Spatie\Permission\Models\Role;

// Redirect to home if the user is logged in, otherwise show login form
/*Route::get('/', [FrontendLoginController::class, 'showLoginForm'])
    ->name('front.login')
    ->middleware('redirectIfAuthenticated');*/
	
Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('config:clear');
    Artisan::call('view:clear');
    Artisan::call('optimize');
    Artisan::call('route:cache');
    Artisan::call('config:cache');

    return response()->json(['message' => 'All caches cleared and optimized.']);
});

Route::middleware('redirectIfAuthenticated')->group(function () {
    Route::get('/', [FrontendLoginController::class, 'showLoginForm'])->name('front.login');
});

Route::post('/login', [FrontendLoginController::class, 'login'])->name('front.login.submit');
Route::get('/logout', [FrontendLoginController::class, 'logout'])->name('front.logout');

// Password Reset Routes
Route::get('/reset-password', [FrontendLoginController::class, 'resetpassword'])->name('front.resetpassword');
Route::post('/reset-password-post', [FrontendLoginController::class, 'resetPasswordPost'])->name('front.resetpasswordpost');
Route::get('/forget-password', [FrontendLoginController::class, 'forgetpassword'])->name('front.forgetpassword');

Route::post('/forget-password-mail', [FrontendLoginController::class, 'forgetPasswordPostMail'])->name('front.reset.password.mail');

Route::get('/change-password/{token}', [FrontendLoginController::class, 'changePassword'])->name('front.changepassword');
Route::post('/change-password-mail', [FrontendLoginController::class, 'postChangePassword'])->name('front.changepasswordpost');


// Group routes for authenticated frontend users
Route::middleware(['user_auth:user'])->group(function () {
    Route::get('/dashboard', [FrontendLoginController::class, 'dashboard'])->name('front.dashboard');
    Route::get('/home', [FrontendLoginController::class, 'home'])->name('front.home');
    
    // Public Information Routes
	Route::get('/alliance', [FrontendLoginController::class, 'alliance'])->name('front.alliance');
	Route::get('/aboutus', [FrontendLoginController::class, 'aboutus'])->name('front.aboutus');
	Route::get('/reports', [FrontendLoginController::class, 'reports'])->name('front.reports');
	Route::get('/browser-policy', [FrontendLoginController::class, 'browserpolicy'])->name('front.browserpolicy');
	Route::get('/privacy-policy', [FrontendLoginController::class, 'privacypolicy'])->name('front.privacypolicy');
	Route::get('/privacy-settings', [FrontendLoginController::class, 'privacysettings'])->name('front.privacysettings');
	Route::get('/terms-of-use', [FrontendLoginController::class, 'termsofuse'])->name('front.termsofuse');

	Route::get('/notifications', [FrontendLoginController::class, 'notifications'])->name('front.notifications');
	Route::get('/chats', [FrontendLoginController::class, 'chats'])->name('front.chats');

	// Visitor Registration Route
	Route::post('/visitor/register', [VisitorController::class, 'store'])->name('visitor.register');

	// User Search Route
	Route::get('/user/search', [FrontendLoginController::class, 'search'])->name('user.search');

	//user profile
	Route::get('/profile', [UserProfileController::class, 'profile'])->name('user.profile');
	Route::put('/profile', [UserProfileController::class, 'updateProfile'])->name('profile.update');
	Route::post('/profile/update-image', [UserProfileController::class, 'updateProfileImage'])->name('profile.updateImage');
	Route::get('/profile-details', [UserProfileController::class, 'profiledetails'])->name('user.profiledetails');
	Route::get('/connections', [UserProfileController::class, 'connections'])->name('user.connections');
	Route::get('/edit-bio', [UserProfileController::class, 'editbio'])->name('user.editbio');
	Route::get('/events', [UserProfileController::class, 'events'])->name('user.events');
	Route::get('/testimonials', [UserProfileController::class, 'testimonials'])->name('user.testimonials');
	Route::get('/groups-join', [UserProfileController::class, 'groupsjoined'])->name('user.groupsjoined');

	
	//connections
	Route::get('/connections', [ConnectionController::class, 'showConnections'])->name('user.connections');
	Route::post('/connections/send', [ConnectionController::class, 'sendConnectionRequest'])->name('user.sendConnection');
    Route::post('/connections/approve', [ConnectionController::class, 'approveConnectionRequest'])->name('user.approveConnection');
    Route::post('/connections/reject', [ConnectionController::class, 'rejectConnectionRequest'])->name('user.rejectConnection');
	
	Route::get('/create-post', [UserProfileController::class, 'createPost'])->name('user.createpost');

	// Route::post('/create-event-post', [ConnectionController::class, 'createEventPost'])->name('user.createeventpost');

	Route::post('/create-post', [UserProfileController::class, 'createPostPost'])->name('user.createpostpost');
	Route::get('/create-event', [UserProfileController::class, 'createEvent'])->name('user.createevent');

	// Route::post('/create-event-post', [ConnectionController::class, 'createEventPost'])->name('user.createeventpost');

	Route::post('/create-event', [UserProfileController::class, 'createEventPost'])->name('user.createeventpost');

	Route::get('/send-testimonial/{id}', [UserProfileController::class, 'createTestimonial'])->name('user.createtestimonial');

	// Route::post('/create-event-post', [ConnectionController::class, 'createEventPost'])->name('user.createeventpost');

	Route::post('/create-testimonial', [UserProfileController::class, 'createTestimonialPost'])->name('user.createtestimonialpost');

	// user connection
	Route::get('/connection/userprofile/{id}', [ConnectionController::class, 'userConnectionProfile'])->name('user.connection.userprofile');

	Route::post('/user-list-referral-type', [FrontendLoginController::class, 'userListReferralType'])->name('user.userListReferralType');

	Route::post('/post-referral', [FrontendLoginController::class, 'postReferral'])->name('user.postReferral');
	Route::post('/post-tyfcbreferral', [FrontendLoginController::class, 'tyfcdPostReferral'])->name('user.tyfcbpostReferral');
	Route::post('/post-onereferral', [FrontendLoginController::class, 'onePostReferral'])->name('user.onepostReferral');

	
	Route::get('/create-post', [UserProfileController::class, 'createPost'])->name('user.createpost');
	Route::post('/create-post', [UserProfileController::class, 'createPostPost'])->name('user.createpostpost');
	Route::get('/create-event', [UserProfileController::class, 'createEvent'])->name('user.createevent');
	Route::post('/create-event', [UserProfileController::class, 'createEventPost'])->name('user.createeventpost');
	Route::get('/send-testimonial/{id}', [UserProfileController::class, 'createTestimonial'])->name('user.createtestimonial');
	Route::post('/create-testimonial', [UserProfileController::class, 'createTestimonialPost'])->name('user.createtestimonialpost');

	// user connection
	Route::get('/connection/userprofile/{id}', [ConnectionController::class, 'userConnectionProfile'])->name('user.connection.userprofile');

	
});



// Include admin routes file
require __DIR__.'/admin.php';
require __DIR__.'/api.php';

