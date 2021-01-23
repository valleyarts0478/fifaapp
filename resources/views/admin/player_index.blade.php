@extends('layouts.admin')

@section('content')
<div class="container">

<table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">背番号</th>
        <th scope="col">プレイヤー名</th>
        <th scope="col">チーム名</th>
        <th scope="col">チームロゴ</th>
        <th scope="col">プレイヤー画像</th>
        <th scope="col">編集</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($players as $player)
      <tr>
        <th scope="row">{{ $player->player_no }}</th>
        <td>
            {{ $player->player_name }}
        </td>
        <td>
            {{ $player->team->team_name }}
        </td>
          <td>
            <img src="{{ asset(Storage::url($player->team->image_url)) }}" style="width: 10%"/>
          </td>
          <td>
            <img src="{{ asset(Storage::url($player->player_image_url)) }}" style="width: 10%"/>
          </td>
        <td>
            <form method="get" action="{{ route('admin.player_show', ['id' => $player->id]) }}">
                @csrf
            <button type="submit" class="btn btn-primary">
                詳細をみる
            </button>
            </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>


<form method="get" action="{{ route('admin.player_create') }}">
    @csrf
<button type="submit" class="btn btn-primary">
    新規登録
</button>
</form>
</div>
@endsection