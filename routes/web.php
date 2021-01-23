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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//管理側
Route::group(['middleware' => ['auth.admin']], function () {
	
	//管理側トップ
	Route::get('/admin', 'admin\AdminTopController@show');
	//ログアウト実行
	Route::post('/admin/logout', 'admin\AdminLogoutController@logout');
	//ユーザー一覧
	Route::get('/admin/user_list', 'admin\ManageUserController@showUserList');
	//ユーザー詳細
    Route::get('/admin/user/{id}', 'admin\ManageUserController@showUserDetail');
    //チームリスト表示
    Route::get('/admin/team_index', 'admin\TeamController@team_index')->name('admin.team_index');
    Route::get('/admin/team_create', 'admin\TeamController@team_create')->name('admin.team_create');
    Route::post('/admin/team_store', 'admin\TeamController@team_store')->name('admin.team_store');
    //チーム詳細・編集・更新・削除
    Route::get('/admin/team_show/{id}', 'admin\TeamController@team_show')->name('admin.team_show');
    Route::get('/admin/team_edit/{id}', 'admin\TeamController@team_edit')->name('admin.team_edit');
    Route::post('/admin/team_update/{id}', 'admin\TeamController@team_update')->name('admin.team_update');
    Route::get('/admin/team_destroy/{id}', 'admin\TeamController@team_destroy')->name('admin.team_destroy');
    //プレイヤーCRUD
    Route::get('/admin/player_index', 'admin\PlayersController@index')->name('admin.player_index');
    Route::get('/admin/player_create', 'admin\PlayersController@create')->name('admin.player_create');
    Route::post('/admin/player_store', 'admin\PlayersController@store')->name('admin.player_store');
    Route::get('/admin/player_show/{id}', 'admin\PlayersController@show')->name('admin.player_show');
    Route::get('/admin/player_edit/{id}', 'admin\PlayersController@edit')->name('admin.player_edit');
    Route::post('/admin/player_update/{id}', 'admin\PlayersController@update')->name('admin.player_update');
    Route::get('/admin/player_destroy/{id}', 'admin\PlayersController@destroy')->name('admin.player_destroy');



});

//管理側ログイン
Route::get('/admin/login', 'admin\AdminLoginController@showLoginform');
Route::post('/admin/login', 'admin\AdminLoginController@login');
