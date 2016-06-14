<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::model('users', 'User');
Route::model('profile', 'Profile');

//Route::model('gallery', 'Gallery');

Route::auth();

Route::get('/', 'HomeController@recent')->name('home');

Route::get('errors/401', ['as' => '401', function() {
    return view('errors.401');
}]);

Route::group(['middleware' => ['auth']], function () {

    Route::group(['middleware' => ['id']], function ($id) {
        Route::get('users/{id}/editAccount', 'UserController@editAccount');
        Route::patch('users/{id}/updateAccount', 'UserController@updateAccount');
        Route::get('users/{id}/account', array('uses' => 'UserController@manageAccount', 'as' => 'user.account'));
        Route::get('users/{id}/changeMyPassword', array('uses' => 'UserController@changeAccountPassword', 'as' => 'user.accountPassword'));
        Route::patch('users/{id}/updatePassword', 'UserController@updatePassword');
    });

    Route::get('users/avatar', 'UserController@avatar');
    Route::post('users/avatar', 'UserController@uploadAvatar');

    Route::group(['middleware'=>'permission:role,Administrator'], function () {
        Route::resource('permissions', 'PermissionController');
        Route::resource('users', 'UserController');
        Route::resource('roles', 'RoleController');
        Route::get('users/{id}/avatar', 'UserController@avatarAdmin');
        Route::post('users/{id}/avatar', 'UserController@uploadAvatarAdmin');
    });

    Route::bind('users', function ($value, $route) {
        return \App\User::whereSlug(strtolower($value))->first();
    });


    Route::post('gallery/{g}/p/{p}/c/{c}', 'CommentController@storeChild');
    Route::patch('gallery/{g}/p/{p}/c/{c}', 'CommentController@updateChild');
    Route::delete('gallery/{g}/p/{p}/c/{c}', 'CommentController@destroyChild');

    Route::get('/submit', 'PieceController@newSubmission');
    Route::post('/submit', 'PieceController@submit');

});
Route::resource('gallery.p.c', 'CommentController');


Route::resource('profile', 'ProfileController');
Route::get('profile/{user}/gallery', 'ProfileController@gallery');
Route::get('profile/{user}/submissions', 'ProfileController@submissions');

Route::bind('profile', function ($value, $route) {
    return \App\User::whereSlug(strtolower($value))->first();
});

Route::resource('gallery', 'GalleryController');

Route::resource('gallery.p', 'PieceController');

Route::get('/home', 'HomeController@index');
//Route::get('/recent', ['uses'=> 'HomeController@recent', 'as'=>'recent']);
Route::get('/search/{terms}', ['uses'=> 'SearchController@searchAll', 'as'=>'searchAll']);
