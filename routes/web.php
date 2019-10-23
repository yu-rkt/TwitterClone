<?php
use Illuminate\Http\Request;
use App\Tweet;
use App\User;
use App\Follow;




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
// ホームでまずログインページを表示する
Route::redirect('/', 'login');

Route::get('/login', function () {
    return view('login');
});

Auth::routes();

// ログインしている場合
Route::group(['middleware' => 'auth'], function(){

  // ツイート一覧
  Route::get('/tweets', 'TweetsController@index')->name('home');

  // ユーザー一覧
  Route::get('/users', 'UsersController@index')->name('user_list');
  // フォローとフォロー解除
  Route::post('/users/{user}/follow', 'UsersController@follow')->name('follow');
  Route::delete('/users/unfollow', 'UsersController@unfolloe')->name('unfollow');

  // ツイートの新規作成
  Route::get('/tweet', 'TweetsController@create')->name('create');
  Route::post('/tweet/store', 'TweetsController@store')->name('store');
});
