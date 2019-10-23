<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;


class Tweet extends Model
{
    protected $fillable = [
      'user_id',
      'tweet',
    ];

    // UserモデルとTweetモデルは、１対多の関係
    public function user()
    {
      return $this->belongsTo('App\User');
    }


    // ツイートの一覧を表示
    public function getTimeLines(Int $user_id, Array $follow_ids)
    {
      // 自分とフォローしているユーザーを配列に合わせて格納する
      $follow_ids[] = $user_id;
      // $follow_ids配列の中からtweetsテーブルのuser_idカラムと合致するものを取り出し、作成順に取り出す
      return $this->whereIn('user_id', $follow_ids)->orderBy('created_at', 'desc')->paginate(20);
    }

    // 新規ツイートをDBに保存
    // ユーザーのidとツイートの内容を引数で受け取る
    // public function tweetStore(Int $user_id, Array $tweetData)
    // {
    //     $this->user_id = $user_id;
    //     $this->tweet = $tweetData['tweet'];
    //
    //     $this->save();
    //
    //     return;
    // }

}
