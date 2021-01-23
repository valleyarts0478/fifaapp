@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="card">
		<div class="card-header">チームの作成</div>
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
            <form method="POST" action="{{ route('admin.team_store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label>チーム名</label>
                <input class="form-control" type="text" name="team_name">
            </div>
            <div class="form-group">
                <label>チームロゴ</label>
            <input class="form-control" type="file" name="image">
            </div>
            <input type="submit" class="btn btn-primary" VALUE="登録する">
            </form>
        </div>
    </div>
</div>
@endsection