@extends('layout.index')

@section('title')
  Edit Pengguna
@endsection

@section('content')
  <div class="card mb-4">
    <div class="card-body">
      <div class="d-flex justify-content-between align-items-center">
        <h5>Edit Pengguna</h5>
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-body">
      <form action="{{ route('user.update', $user->id)}}" method="post">
        @csrf
        @method('post')
        <div class="form-group">
          <label for="name">Nama</label>
          <input type="text" name="name" id="name" class="form-control" value="{{$user->name}}" required>
        </div>
        <div class="form-group">
          <label for="username">Username</label>
          <input type="text" name="username" id="username" class="form-control" value="{{$user->username}}" required>
        </div>
        <div class="form-group">
          <label for="level">Level</label>
          <select name="level" id="level" class="form-control" required>
            <option value="">-- Pilih Data --</option>
            @foreach ($levels as $level)
              <option value="{{$level->id}}" @if ($user->level_id == $level->id) selected @endif>{{$level->name}}</option>
            @endforeach
          </select>
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" name="password" id="password" class="form-control">
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('user.index')}}" class="btn btn-secondary">Kembali</a>
      </form>
    </div>
  </div>
@endsection