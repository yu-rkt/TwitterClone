<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Userモデルは多数のTweetモデルを持つ
    public function tweet()
    {
      return $this->hasMany('App\Tweet');
    }

    // フォローする側とフォローされる側は多対多の関係のため、多対多のリレーションを設定する。
    // belongsToMany('', '', '', '');
    // 第一引数・・関連するモデル名。ここではUserモデル
    // 第二引数・・中間テーブル名
    // 第三、第四引数・・外部キー
    public function follow()
    {
      return $this->belongsToMany(self::class, 'follows', 'following_id', 'followed_id');
    }



    // ログインしているユーザー以外の全てのユーザーを10人取得する
    public function getAllUsers(Int $user_id)
    {
      return $this->where('id', '<>', $user_id)->paginate(10);
    }

    // フォローしているかを判断する。
    // followed_idの中から引数の$user_idを探し,複数あるので最初のidのみ取得する
    public function isFollowing(Int $user_id)
    {
      return $this->follow()->where('followed_id', $user_id)->first(['id']);
    }

    // フォローする。
    // followメソッドにアクセス→引数で受け取った$user_idをattachする
    public function follows(Int $user_id)
    {
      $this->follow()->attach($user_id);
    }

    // フォロー解除する。
    public function unfollow(Int $user_id)
    {
      $this->follow()->detach($user_id);
    }

}
