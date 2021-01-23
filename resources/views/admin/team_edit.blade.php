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
                    <form method="POST" action="{{ route('admin.team_update', ['id' => $team->id]) }}" enctype="multipart/form-data">
                      @csrf
                      <div class="form-group">
                        <label>チーム名</label>
                        <input class="form-control" type="text" name="team_name" value="{{old('team_name', $team->team_name)}}">
                      </div>
                      <div class="form-group">
                        <label>チームロゴ</label>
                        <input class="form-control" type="file" name="image">
                      </div>
                        <input type="submit" class="btn btn-primary" VALUE="更新する">
                    </form>

                    <form method="get" action="{{ route('admin.team_index', ['id' => $team->id]) }}">
                      @csrf
                      <button type="submit" class="btn btn-success mt-1">
                        更新をやめて一覧へ戻る
                      </button>
                    </form>
                    <form method="get" action="{{ route('admin.team_destroy', ['id' => $team->id]) }}" id="delete_{{ $team->id }}">
                      @csrf
                      <a href="#" class="btn btn-danger" data-id="{{ $team->id }}" onclick="deletePost(this);">削除する</a>
                  </form>
              </div>
              <script>
              function deletePost(e) {
                  'use strict';
                  if (confirm('本当に削除しますか？')) {
                      document.getElementById('delete_' + e.dataset.id).submit();
                  }
              }
              </script>
        </div>
    </div>
</div>
@endsection