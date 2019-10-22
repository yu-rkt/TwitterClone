@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <!-- @FIXME ユーザーデータの存在チェック -->
            <div class="card">
                <div class="card-header">ユーザ一覧</div>

                <!-- @FIXME ユーザーデータを表示 -->
                  @foreach($all_users as $user)
                    <div class="card-body">
                        <!-- @FIXME ユーザー名を表示 -->
                        {{ $user->name }}
                        <div style="float:right">
                              <!-- やりたいことは、フォローしているかどうかでユーザーを判別すること
                              User.phpのisFollowing関数で値が存在しなければという条件をつける -->
                              @if(!(Auth::user()->isFollowing($user->id)))
                                <!-- @FIXME 未フォロー時の表示 -->
                                <form action="{{ route('follow', ['id' => $user->id]) }}" method="POST">
                                       {{ csrf_field() }}

                                       <button type="submit" class="btn btn-primary">フォローする</button>
                                   </form>
                              @else
                                <!-- @FIXME フォロー中の表示 -->
                                フォロー中
                              @endif
                        </div>
                    </div>

                    <hr>
                  @endforeach
                <!-- @FIXME ページングを表示 -->

            </div>
        </div>
    </div>
</div>
@endsection
