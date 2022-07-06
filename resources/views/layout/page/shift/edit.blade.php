@extends('layout.index')

@section('title')
  Edit Shift
@endsection

@section('content')
  <div class="card mb-4">
    <div class="card-body">
      <div class="d-flex justify-content-between align-items-center">
        <h5>Edit Shift</h5>
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-body">
      <form action="{{ route('shift.update', $shift->id)}}" method="post">
        @csrf
        @method('post')
        <div class="form-group">
          <label for="name">Nama</label>
          <input type="text" name="name" id="name" class="form-control" value="{{$shift->name}}" required>
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('shift.index')}}" class="btn btn-secondary">Kembali</a>
      </form>
    </div>
  </div>
@endsection