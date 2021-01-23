@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="card">
		<div class="card-header">プレイヤー登録</div>
		<div class="card-body">
			@if ($errors->any())
			<div style="color:red;">
			<ul>
				@foreach ($errors->all() as $error)
				<li>{{ $error }}</li>
				@endforeach
			</ul>
			</div>
            @endif
            <div class="form-group">
                <label>チームID:{{ $player->team->id }}</label>
            </div>
            <div class="form-group">
                <label>チーム名:</label>
                {{ $player->team->team_name }}
            </div>
            <div class="form-group">
                @if($player->team->image_url)
                <img src="{{ asset(Storage::url($player->team->image_url)) }}" style="width: 50%"/>
                @endif
            </div>
            <div class="form-group">
                <label>背番号:</label>
                {{ $player->player_no }}
            </div>
            <div class="form-group">
                <label>プレイヤー名:</label>
                {{ $player->player_name }}
            </div>
            <div class="form-group">
                <label>プレイヤー画像:</label>
                @if($player->player_image_url)
                <img src="{{ asset(Storage::url($player->player_image_url)) }}" style="width: 50%"/>
                @endif
            </div>
            <form method="get" action="{{ route('admin.player_edit', ['id' => $player->id]) }}">
                @csrf
            <button type="submit" class="btn btn-primary col-sm mb-1">
                修正する
            </button>
            </form>
        </div>
    </div>
</div>
@endsection