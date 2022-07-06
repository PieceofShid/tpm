@extends('layout.index')

@section('title')
  Edit Mesin
@endsection

@section('content')
  <div class="card mb-4">
    <div class="card-body">
      <div class="d-flex justify-content-between align-items-center">
        <h5>Edit Mesin</h5>
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-body">
      <form action="{{ route('mesin.update', $machine->id)}}" method="post">
        @csrf
        @method('post')
        <div class="form-group">
          <label for="name">Nama</label>
          <input type="text" name="name" id="name" class="form-control" value="{{$machine->name}}" required>
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('mesin.index')}}" class="btn btn-secondary">Kembali</a>
      </form>
    </div>
  </div>
@endsection