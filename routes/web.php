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
Route::post('/store/item/edit', 'StoreController@editItem');

Route::group(
    [
    'prefix' => '{locale}',
    'where' => ['locale' => '[a-z]{2}-[a-z]{2}'],
    'middleware' => 'setlocale'],
    function () {
        Route::get('/', 'WelcomeController@index');
        Route::get('/store', 'StoreController@index');
        Route::get('/contact_us', 'ContactUsController@index');
        Route::get('/privacy_policy', 'PrivacyPolicyController@index');
        Route::get('/profile/edit', 'ProfileController@index');
    }
);

