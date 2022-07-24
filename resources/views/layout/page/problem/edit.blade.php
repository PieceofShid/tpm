@extends('layout.index')

@section('title')
  Edit temuan problem
@endsection

@section('content')
  <div class="card mb-4">
    <div class="card-body">
      <div class="d-flex justify-content-between align-items-center">
        <h5>Edit temuan problem</h5>
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-body">
      <form action="{{ route('problem.update', $problem->id)}}" method="post">
        @csrf
        @method('post')
        <div class="row">
          <div class="col">
            <div class="form-group">
              <label for="date">Tanggal</label>
              <input type="date" id="date" class="form-control" value="{{$problem->schedule->date}}" readonly>
            </div>
          </div>
          <div class="col">
            <div class="form-group">
              <label for="machine">Mesin</label>
              <input type="text" id="machine" class="form-control" value="{{$problem->schedule->machine->name}}" readonly>
            </div>
          </div>
        </div>
        <div class="form-group">
          <label for="problem">Problem</label>
          <input type="text" name="problem" id="problem" class="form-control" value="{{$problem->problem}}" required>
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('problem.index')}}" class="btn btn-secondary">Kembali</a>
      </form>
    </div>
  </div>
@endsection