@extends('layouts.admin')

@section('content')
<div class="container">
    
   <div class="card" style="width: 20rem;">
             @if($team->image_url)
            <img src="{{ asset(Storage::url($team->image_url)) }}" class="card-img-top" style="width: 100%"/>
            @endif
    <div class="card-body">
    <p class="card-text">チームID：{{ $team->id }}</p>
    <h4 class="card-title">{{ $team->team_name }}</h4>
    
    <form method="get" action="{{ route('admin.team_edit', ['id' => $team->id]) }}">
        @csrf
    <button type="submit" class="btn btn-primary col-sm mb-1">
        修正する
    </button>
    </form>

    <form method="get" action="{{ route('admin.team_index', ['id' => $team->id]) }}">
        @csrf
    <button type="submit" class="btn btn-success col-sm mb-1">
        一覧へ戻る
    </button>
    </form>

@endsection