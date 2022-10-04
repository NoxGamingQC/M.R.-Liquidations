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

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
Route::get('/', function () {
    return redirect(app()->getLocale() . '/');
});
Route::get('language/set/{language}', 'LanguageController@index');
Route::post('/store/item/add', 'StoreController@addItem');
Route::post('/store/item/edit', 'StoreController@editItem');
Route::get('/store/item/search', 'SearchController@item');

Route::post('/management/item/edit', 'Management\ItemController@edit');
Route::post('/management/item/picture/delete', 'Management\ItemController@deletePicture');

Route::get('/store/item/{id}', function ($id) {
    return redirect(app()->getLocale() . '/store/item/' . $id);
});

Route::get('/management/item/{id}', function ($id) {
    return redirect(app()->getLocale() . '/management/item/' . $id);
});

Route::group(
    [
    'prefix' => '{locale}',
    'where' => ['locale' => '[a-z]{2}-[a-z]{2}'],
    'middleware' => 'setlocale'],
    function () {
        Route::get('/', 'WelcomeController@index');
        Route::get('/store/{page}', 'StoreController@index');
        Route::get('/store/item/{id}', 'StoreController@showItem');
        Route::get('/contact_us', 'ContactUsController@index');
        Route::get('/privacy_policy', 'PrivacyPolicyController@index');
        Route::get('/profile/edit', 'ProfileController@index');

        
        Route::get('/management/logs', 'Management\LogController@index');
        Route::get('/management/logs/download', 'Management\LogController@download');
        Route::get('/management/item/{id}', 'Management\ItemController@index');
        Route::get('/management/items', 'Management\ItemsController@index');
    }
);

