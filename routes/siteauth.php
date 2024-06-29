<?php


use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['guest:web'],'prefix'=>'web','as'=>'web.'],function(){

    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);



    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');

});

Route::group(['middleware' => ['auth:web'],'prefix'=>'web','as'=>'web.'],function(){
    Route::get('verify-email', [EmailVerificationPromptController::class, '__invoke'])
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');

    Route::get('/profile_1', [ProfileController::class, 'edit'])->name('edit_profile');
    Route::post('/profile_1', [ProfileController::class, 'update'])->name('update_profile');


    Route::post('/wishlist', [Web_siteController::class, 'add_to_wishlist'])->name('wishlist');
    Route::post('/remove_wishlist', [Web_siteController::class, 'remove_to_wishlist'])->name('remove_wishlist');
    Route::get('/user_wishlist', [ProfileController::class, 'user_wishlist'])->name('user_wishlist');


    Route::post('/add_cart', [CartController::class, 'add_cart'])->name('add_cart');
    Route::post('/remove_cart', [CartController::class, 'remove_cart'])->name('remove_cart');
    Route::get('/show_cart', [CartController::class, 'show_cart'])->name('cart');
    Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout');
    Route::get('/emptyCart', [CartController::class, 'emptyCart'])->name('emptyCart');


    Route::get('/my_order', [ProfileController::class, 'user_order'])->name('my_order');


    Route::post('reset-password', [PasswordController::class, 'update'])
        ->name('password_update');
});
