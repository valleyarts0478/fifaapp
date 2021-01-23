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
        <form method="POST" action="{{ route('admin.player_update', ['id' => $player->id]) }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label>チーム名</label>
                <select class="form-control" name="team_id">
                    @foreach ($teams as $team)
                    <option value="{{ old('team_id') }}" selected>{{ $team->team_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>背番号</label>
            <input class="form-control" type="text" name="player_no" value="{{ old('player_no', $player->player_no) }}">
            </div>
            <div class="form-group">
                <label>プレイヤー名</label>
            <input class="form-control" type="text" name="player_name" value="{{ old('player_name', $player->player_name) }}">
            </div>
        
            <div class="form-group">
                <label>プレイヤー画像</label>
            <input class="form-control" type="file" name="player_image_url">
            </div>

            <input type="submit" class="btn btn-primary" VALUE="更新する">
        </form>
        <form method="get" action="{{ route('admin.player_destroy', ['id' => $player->id]) }}">
            @csrf
            <button type="submit" class="btn btn-success mt-1">
              選手を削除
            </button>
        </div>
    </div>
</div>
@endsection