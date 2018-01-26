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

Route::get('/api', 'ApiController@index');
Route::get('/api/regist', 'ApiController@regist');
Route::post('/api/regist', 'ApiController@registpost');

Route::get('/api/csv/regist', 'CsvController@api');
Route::post('/api/csv/regist', 'CsvController@apipost');


Route::get('/api/edit/{id}', 'ApiController@edit');
Route::post('/api/edit/{id}', 'ApiController@editpost');
Route::get('/api/delete/{id}', 'ApiController@delete');

Route::get('/admin', 'AccountController@admin');
Route::get('/admin/user/delete/{id}', 'AccountController@userdelete');

Route::get('/', function () {
	return view('welcome');
});
Route::get('/account/register', 'AccountController@index');
Route::post('/account/register', 'AccountController@post');
Route::get('/account/register/api', 'AccountController@apiregist');
Route::get('/account/register/api/return', 'AccountController@apireturn');
Route::get('/account/reapi/{id}', 'AccountController@reapi');
Route::get('/account/manage', 'AccountController@manage');
Route::get('/account/edit/{account_id}', 'AccountController@edit');
Route::post('/account/edit/{account_id}', 'AccountController@save');
Route::get('/account/statistic', 'AccountController@statistic');
Route::get('/account/delete/{account_id}', 'AccountController@delete');
Route::get('/account/csv', 'CsvController@csv');
Route::post('/account/csv', 'CsvController@csvregist');
Route::get('/account/export/csv', 'CsvController@exportcsv');


Route::get('/bot/rule', 'BotController@rule')->name('bot.rule');
Route::post('/bot/rule', 'BotController@rulecreate')->name('bot.rule.create');
Route::get('/bot/rule/edit/{botrule_id}', 'BotController@ruleedit')->name('bot.rule.edit');
Route::post('/bot/rule/edit/{botrule_id}', 'BotController@rulechange')->name('bot.rule.change');
Route::get('/bot/rule/delete/{botrule_id}', 'BotController@ruledelete')->name('bot.rule.delete');


Route::get('/bot/story', 'BotController@story');
Route::post('/bot/story', 'BotController@storycreate');
Route::get('/bot/story/edit/{botstory_id}', 'BotController@storyedit');
Route::post('/bot/story/edit/{botstory_id}', 'BotController@storyadd');
Route::post('/bot/story/edit/{botstory_id}/change', 'BotController@storyChange')->name('bot.story.change');
Route::get('/bot/story/delete/{botstory_id}', 'BotController@sdelete');
Route::get('/bot/story/copy/{botstory_id}', 'BotController@copy');
Route::post('/bot/story/copy/{botstory_id}', 'BotController@copyadd');
Route::get('/bot/story/edit/{botstory_id}/delete/{text_id}','BotController@storydelete');
Route::get('/bot/story/csv/{id}', 'CsvController@bottextcsv');
Route::post('/bot/story/csv/{id}', 'CsvController@bottextcsvimport');
Route::get('/bot/story/export/csv/{id}', 'CsvController@bottextexportcsv');

Route::get('/bot/setting', 'BotController@set');
Route::get('/bot/setting/edit/{account_id}', 'BotController@setedit');
Route::post('/bot/setting', 'BotController@setpost');


Route::get('/follow/rule', 'FollowController@rule');
Route::get('/follow/rule/{id}', 'FollowController@ruleedit');
Route::post('/follow/rule/{id}', 'FollowController@rulepost');
Route::get('/follow/target', 'FollowController@target');
Route::get('/follow/target/{id}', 'FollowController@targetedit');
Route::post('/follow/target/{id}', 'FollowController@targetpost');


Route::get('/unfollow', 'UnfollowController@index');
Route::get('/unfollow/rule/{id}', 'UnfollowController@ruleedit');
Route::post('/unfollow/rule/{id}', 'UnfollowController@rulepost');

Route::get('/dm/rule', 'DirectController@rule');
Route::post('/dm/rule', 'DirectController@rulecreate');
Route::get('/dm/rule/edit/{id}', 'DirectController@ruleedit');
Route::post('/dm/rule/edit/{id}', 'DirectController@rulechange');
Route::get('/dm/rule/delete/{id}', 'DirectController@delete');


Route::get('/dm/story', 'DirectController@story');
Route::post('/dm/story', 'DirectController@storycreate');
Route::get('/dm/story/edit/{id}', 'DirectController@storyedit');
Route::post('/dm/story/edit/{id}', 'DirectController@storyadd');
Route::post('/dm/story/edit/{id}/change', 'DirectController@storyChange')->name('dm.story.change');
Route::get('/dm/story/delete/{id}', 'DirectController@sdelete');
Route::get('/dm/story/edit/{id}/delete/{text_id}','DirectController@storydelete');

Route::get('/dm/setting', 'DirectController@set');
Route::get('/dm/setting/edit/{account_id}', 'DirectController@setedit');
Route::post('/dm/setting', 'DirectController@setpost');


Route::get('/reply', 'DirectController@reply');
Route::get('/reply/edit/{id}', 'DirectController@replyedit');
Route::post('/reply/edit/{id}', 'DirectController@replypost');

Route::get('/like', 'DirectController@like');
Route::get('/like/edit/{id}', 'DirectController@likeedit');
Route::post('/like/edit/{id}', 'DirectController@likepost');



