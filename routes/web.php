<?php

Route::get('/', [
    'uses' => 'SocialController@welcome',
    'as' => 'welcome'
]);


Route::get('/clear', function (){
    Artisan::call('config:cache');
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    echo 'clear';
});

Route::post('submit-phone', [
    'uses' => 'SocialController@submitPhone',
    'as' => 'submitPhone'
]);

Route::get('login/{provider}', [
    'uses' => 'SocialController@redirectToProvider',
    'as' => 'social.login'
]);

Route::get('login/{provider}/callback',[
    'uses' => 'SocialController@handleProviderCallback',
    'as' => 'login'
] );

Route::post('logout', [
    'as' => 'logout',
    'uses' => 'SocialController@logout'
]);

Route::get('interest', [
    'as' => 'interest',
    'uses' => 'UserController@interest'
]);

Route::any('my-interest', [
    'as' => 'submit.interest',
    'uses' => 'UserController@submitInterest'
]);

/*
Route::get('/interest', function () {
    return view('interest');
})->name('interest');*/

/*
Route::resource('cal', 'CalendarController');
Route::resource('user', 'UserController');
Route::get('oauth', 'CalendarController@oauth')->name('oauthCallback');*/


