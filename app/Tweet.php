<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tweet extends Model
{
    protected $fillable = [
      'string'
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

    
}
