<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


use App\User;
use App\Tweet;
use App\Follow;

class TweetsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Tweet $tweet, Follow $follow)
    {
      // 認証済みのユーザーを全て取得する
      $user = Auth::user();

      // 関数を呼び出し$follow_ids配列に格納
      // followed_idのみを取り出し、関数に格納
      $follow_ids = $follow->followingIds($user->id);
      $following_ids = $follow_ids->pluck('followed_id')->toArray();


      $timelines = $tweet->getTimeLines($user->id, $following_ids);

      return view('home', [
        'user' => $user,
        'timelines' => $timelines
      ]);
    }

    // 投稿の新規作成
    public function create()
    {
      return view('create');
    }

    // 新規ツイートの保存
    public function store(Request $request)
    {
      $content = $request->validate(['tweet'=>'required|max:500']);
      $content = $content + array('user_id' => Auth::id());

      Tweet::create($content);

      return redirect()->route('home');


      // $user = Auth::id();
      // $content = $request->validate(['tweet'=>'required|max:140']);
      //
      // Tweet::create($user, $content);

       // $tweet = new Tweet;
       //
       // $tweet -> tweet = $request -> tweet;
       // $tweet -> user_id = Auth::id();
       //
       // $tweet -> save();
       //
    }
}
