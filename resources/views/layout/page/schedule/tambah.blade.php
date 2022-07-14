@extends('layout.index')

@section('title')
  Tambah Schedule
@endsection

@section('content')
  <div class="card mb-4">
    <div class="card-body">
      <div class="d-flex justify-content-between align-items-center">
        <h5>Tambah Schedule</h5>
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-body">
      <form action="{{ route('schedule.create')}}" method="post">
        @csrf
        @method('post')
        <div class="form-group">
          <label for="date">Tanggal</label>
          <input type="date" name="date" id="date" class="form-control" required>
        </div>
        <div class="form-group">
          <label for="user_id">Operator</label>
          <select name="user_id" id="user_id" class="form-control" required>
            <option value="">-- Pilih Data --</option>
            @foreach ($users as $user)
              <option value="{{$user->id}}">{{$user->name}}</option>
            @endforeach
          </select>
        </div>
        <div class="form-group">
          <label for="machine_id">Mesin</label>
          <select name="machine_id" id="machine_id" class="form-control" required>
            <option value="">-- Pilih Data --</option>
            @foreach ($machines as $machine)
              <option value="{{$machine->id}}">{{$machine->name}}</option>
            @endforeach
          </select>
        </div>
        <div class="form-group">
          <label for="shift_id">Shift</label>
          <select name="shift_id" id="shift_id" class="form-control" required>
            <option value="">-- Pilih Data --</option>
            @foreach ($shifts as $shift)
              <option value="{{$shift->id}}">{{$shift->name}}</option>
            @endforeach
          </select>
        </div>
        <div class="form-group">
          <label for="kanban_id">Kanban</label>
          <select name="kanban_id" id="kanban_id" class="form-control" required>
            <option value="">-- Pilih Data --</option>
            @foreach ($kanbans as $kanban)
              <option value="{{$kanban->id}}">{{$kanban->name}}</option>
            @endforeach
          </select>
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('schedule.index')}}" class="btn btn-secondary">Kembali</a>
      </form>
    </div>
  </div>
@endsection