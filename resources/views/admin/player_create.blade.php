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
        <form method="POST" action="{{ route('admin.player_store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label>チーム名</label>
                <select class="form-control" name="team_id">
                    <option value="" selected>選択してください</option>
                    @foreach ($teams as $team)
                            <option value="{{ $team->id }}">{{ $team->team_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>背番号</label>
            <input class="form-control" type="text" name="player_no">
            </div>
            <div class="form-group">
                <label>プレイヤー名</label>
            <input class="form-control" type="text" name="player_name">
            </div>
            <div class="form-group">
                <label>プレイヤー画像</label>
            <input class="form-control" type="file" name="player_image_url">
            </div>
            <input type="submit" class="btn btn-primary" VALUE="登録する">
            </form>
        </div>
    </div>
</div>
@endsection