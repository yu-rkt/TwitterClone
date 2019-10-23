@extends('layouts.app')

@section('content')

  <form class="create_tweet" action="/tweet/store" method="POST">
    @csrf
    <div class="form-group">
      <label for="exampleFormControlTextarea1">いまどうしてる？</label>
      <textarea class="form-control" id="exampleFormControlTextarea1" rows="4" name="tweet"></textarea>
    </div>

    <button type="submit" class="btn btn-outline-primary">Tweetする</button>

  </form>

@endsection
