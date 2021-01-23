@extends('layouts.admin')

@section('content')
<div class="container">

<table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">id</th>
        <th scope="col">チーム名</th>
        <th scope="col">ロゴ</th>
        <th scope="col">編集</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($teams as $team)
      <tr>
        <th scope="row">{{ $team->id }}</th>
        <td>{{ $team->team_name }}</td>
        <td>
            @if($team->image_url)
                <img src="{{ asset(Storage::url($team->image_url)) }}" style="width: 10%"/>
            @endif    
        </td>
        <td>
            <form method="get" action="{{ route('admin.team_show', ['id' => $team->id]) }}">
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


<form method="get" action="{{ route('admin.team_create') }}">
    @csrf
<button type="submit" class="btn btn-primary">
    新規登録
</button>
</form>
</div>
@endsection