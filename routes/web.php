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

Route::get('user/profile', function () {
  $blockedusers = App\User::find(Auth::id())->blockedusers;
  $coments = App\User::find(Auth::id())->coments()->with('commentauthor')->get();
  return view('home', ['blockedusers'=>$blockedusers, 'coments'=>$coments]);
})->name('userprofile')->middleware('auth');;

Route::get('user/{id}/profile', function ($id) {
  if ($id==Auth::id()) {return redirect()->route('userprofile');}
  $blockedusers = App\User::find($id)->blockedusers;
  $coments = App\User::find($id)->coments()->with('commentauthor')->get();
  return view('home', ['blockedusers'=>$blockedusers, 'coments'=>$coments]);
})->name('otherprofile')->middleware('auth');;

Route::post('block', function (Request $request) {
    App\User::find($request::all()['user_id'])
            ->blockedusers()->attach([$request::all()['blockeduser_id']]);
    return "Пользователь заблокирован";
})->name('blockuser')->middleware('auth');

Route::post('coment', 'ComentController@store')->name('storecomment')->middleware('auth');;