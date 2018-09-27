<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'admin', 'namespace' => 'Auth', 'middleware' => 'web'], function() {
    Route::get('login',  'LoginController@showLoginForm')->name('login');
    Route::post('login', 'LoginController@login');
    Route::get('logout', 'LoginController@logout')->name('logout');
});

// Front end
Route::group(['prefix' => '/'], function() {
    Route::get('', function() { return view("Frontend.Contents.index"); })->name('home');

    Route::get('category/{id}-{slug}', 'Frontend\CategoryController@detail')->name('category');

    Route::get('news/{id}-{slug}', 'Frontend\NewController@detail')->name('newDetail');

    Route::get('magazines', 'Frontend\MagazineController@index')->name('magazine');

    Route::get('magazine-detail/{id}-{slug}', 'Frontend\MagazineController@detail')->name('magazine.detail');

    Route::get('sreach', 'Frontend\NewController@search')->name('search');
});

Route::group(['prefix' => 'admin/users'], function() {
    Route::get('user-permission/{id}', '\DangKien\RolePer\Controllers\UserRoleController@index')->name('user-permission.index');
    Route::post('user-permission/{id}', '\DangKien\RolePer\Controllers\UserRoleController@store')->name('user-permission.store');
    Route::get('role-permission/{id}', '\DangKien\RolePer\Controllers\RolePermissionController@index')->name('roles-permission.index');
    Route::post('role-permission/{id}', '\DangKien\RolePer\Controllers\RolePermissionController@store')->name('roles-permission.store');
});

Route::resource('admin/roles', '\DangKien\RolePer\Controllers\RoleController');
Route::resource('admin/permissions', '\DangKien\RolePer\Controllers\PermissionController');
Route::resource('admin/permissions-group', '\DangKien\RolePer\Controllers\PermissionGroupController');

Route::group(['prefix' => 'admin', 'namespace' => 'Backend', 'middleware'=>'auth'], function() {
    Route::resource('users', 'UserController');

    Route::get('user/profile', 'UserController@show')->name('users.profile');
    Route::post('user/profile', 'UserController@updateSeft')->name('users.updateProfile');

    Route::get('user/change-password', 'UserController@change')->name('users.change');
    Route::post('user/change-password', 'UserController@changePassword')->name('users.changePassword');

    Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
        Route::get('/', '\UniSharp\LaravelFilemanager\Controllers\LfmController@show');
        Route::post('/upload', '\UniSharp\LaravelFilemanager\Controllers\UploadController@upload');
    });

    Route::resource('languages', 'LanguagesController', ['except'=>['destroy']]);

    Route::resource('categories', 'CategoryController', ['except'=>['destroy']]);

    Route::resource('tags', 'TagController', ['except'=>['destroy']]);

    Route::resource('slides', 'SlideController', ['except'=>['destroy']]);

    Route::resource('news', 'NewController', ['except'=>['destroy']]);

    Route::resource('menu', 'MenuController', ['except'=>['destroy']]);

    Route::resource('widget', 'WidgetController', ['except'=>['destroy']]);

    Route::resource('magazines', 'FlipbookController', ['except'=>['destroy']]);

    Route::get('setting', 'SettingController@index')->name('setting.index');


});

Route::group(['prefix' => 'rest/admin', 'namespace'=> 'Backend'], function() {
    Route::get('users', 'UserController@getList');
    Route::delete('users/{id}', 'UserController@destroy');

    Route::get('languages', 'LanguagesController@list');
    Route::delete('languages/{id}', 'LanguagesController@destroy');

    Route::get('categories', 'CategoryController@list');
    Route::delete('categories/{id}', 'CategoryController@destroy');

    Route::get('tags', 'TagController@list');
    Route::delete('tags/{id}', 'TagController@destroy');
    Route::post('tags/delete-multi', 'TagController@destroyMulti');

    Route::get('slides', 'SlideController@list');
    Route::delete('slides/{id}', 'SlideController@destroy');
    Route::post('slides/delete-multi', 'SlideController@destroyMulti');

    Route::get('magazines', 'FlipbookController@list');
    Route::delete('magazines/{id}', 'FlipbookController@destroy');
    Route::post('magazines/delete-multi', 'FlipbookController@destroyMulti');

    Route::get('news', 'NewController@list');
    Route::delete('news/{id}', 'NewController@destroy');
    Route::post('news/delete-multi', 'NewController@destroyMulti');
    Route::post('news/hot-new/{id}', 'NewController@hotNew');   
    Route::post('news/prioritize-new/{id}', 'NewController@prioritizeNew');

    Route::delete('menu/{id}', 'MenuController@destroy');
    Route::post('menu/update-detail/{id}', 'MenuController@updateDetail');

    Route::get('setting', 'SettingController@getSetting');
    Route::post('insertSetting', 'SettingController@insertSetting');

    Route::get('widget-item', 'WidgetController@list');

    Route::get('widget-modal/{view}', 'WidgetController@modal');

});