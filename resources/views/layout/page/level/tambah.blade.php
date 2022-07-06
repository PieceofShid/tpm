@extends('layout.index')

@section('title')
  Tambah Level
@endsection

@section('content')
  <div class="card mb-4">
    <div class="card-body">
      <div class="d-flex justify-content-between align-items-center">
        <h5>Tambah Level</h5>
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-body">
      <form action="{{ route('level.create')}}" method="post">
        @csrf
        @method('post')
        <div class="form-group">
          <label for="name">Nama</label>
          <input type="text" name="name" id="name" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('level.index')}}" class="btn btn-secondary">Kembali</a>
      </form>
    </div>
  </div>
@endsection