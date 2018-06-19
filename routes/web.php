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

//全ユーザー
Route::group(['middleware' => ['auth','can:user-higher']],function()
{
    Route::get('/entry/{type?}', 'HomeController@model')->name('entry');
	Route::get('/userentry/', 'HomeController@show')->name('userentry');
	Route::post('/userentry/edit/', 'HomeController@edit')->name('edit');
	Route::post('/userentry/update/', 'HomeController@update')->name('update');
	Route::post('/userentry/delete/', 'HomeController@delete')->name('delete');
	Route::get('/article/register', 'HomeController@insert')->name('regist');
	Route::post('/article/comfirm', 'HomeController@comfirm')->name('comfirm');

	Route::get('/account/edit/','HomeController@userEdit')->name('user.account.edit');
	Route::post('/account/edit/','HomeController@userUpdate')->name('user.account.edit');
	Route::get('/account','HomeController@users')->name('users');
	Route::get('/account/pedit','HomeController@passedit')->name('passedit');
	Route::post('/account/pedit','HomeController@userspass')->name('upass');
});

//管理者以上
Route::group(['middleware' => ['auth','can:admin-higher']], function() {
    //
	Route::get('/admin/account', 'AdminController@account')->name('account.index');
    Route::get('/admin/account/regist','AdminController@regist')->name('account.regist');
    Route::post('/admin/account/regist','AdminController@createData')->name('account.regist');

    Route::get('/admin/account/edit/{user_id?}','AdminController@edit')->name('account.edit');
    Route::post('/admin/account/edit/{user_id?}','AdminController@updateData')->name('account.edit');

    Route::post('/admin/account/delete/{user_id}','AdminController@deleteData');
    Route::get('/admin/account/delete/{user_id}','AdminController@val');

    Route::get('/admin','AdminController@index')->name('admin');
    Route::get('/admin/entry','AdminController@entryView')->name('entry.view');
    Route::get('/admin/entry/edit/{article_id}','AdminController@entryEdit')->name('entry.edit');
    Route::post('/admin/entry/edit/{article_id?}','AdminController@entryUpdate')->name('entry.edit');

    Route::post('/admin/entry/delete/{article_id?}','AdminController@entryDel')->name('entry.del');
});

//システム管理者のみ
Route::group(['middleware' => ['auth','can:system-only']],function()
{	
	Route::get('/admin/account/edit/1','AdminController@edit');
	Route::get('/admin/account/pw/{user_id?}','AdminController@userpass')->name('userpass');
	Route::post('/admin/account/pw/{user_id?}','AdminController@pwup')->name('userpass');
	Route::post('/admin/account/delete/','AdminController@userdel')->name('udel');

});

Route::get('test', 'TestController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


