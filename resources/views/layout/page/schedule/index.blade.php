@extends('layout.index')

@section('title')
  Master Schedule
@endsection

@section('content')
  <div class="card mb-4">
    <div class="card-body">
      <div class="d-flex justify-content-between align-items-center">
        <h5>Master Schedule</h5>
        <a href="{{ route('schedule.add')}}" class="btn btn-primary">Tambah</a>
      </div>
    </div>
  </div>
  @php
    if(session('success')){
      echo '  <div class="alert alert-success alert-dismissable fade show" role="alert">
                '.session('success').'
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>';
    }elseif(session('error')){
      echo '  <div class="alert alert-danger alert-dismissable fade show" role="alert">
                '.session('error').'
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>';
    }
  @endphp
  <div class="card">
    <div class="card-body">
      <div class="table-responsive text-nowrap">
        <table class="table" id="table">
          <thead>
            <tr>
              <th>#</th>
              <th>Tanggal</th>
              <th>Operator</th>
              <th>Mesin</th>
              <th>Shift</th>
              {{-- <th>Kanban</th> --}}
              <th>Item Check</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($schedules as $schedule)
              <tr>
                <td></td>
                <td>{{$schedule->date}}</td>
                <td>{{$schedule->user->name}}</td>
                <td>{{$schedule->machine->name}}</td>
                <td>{{$schedule->shift->name}}</td>
                {{-- <td>{{$schedule->kanban->name}}</td> --}}
                <td>{{$schedule->tasks}}</td>
                <td>
                  @php
                    if ($schedule->status == 'waiting') {
                      echo '<label class="badge badge-warning">Waiting</label>';
                    }elseif ($schedule->status == 'delay') {
                      echo '<label class="badge badge-danger">Delay</label>';
                    }elseif ($schedule->status == 'done') {
                      echo '<label class="badge badge-info">Done</label>';
                    }elseif ($schedule->status == 'complete') {
                      echo '<label class="badge badge-success">Finish</label>';
                    }
                  @endphp
                </td>
                <td>
                  <a href="{{ route('schedule.edit', $schedule->id)}}" class="btn btn-sm text-warning"><i class="ti-pencil"></i></a>
                  <button class="btn btn-sm text-danger" onclick="hapus('{{$schedule->id}}')"><i class="ti-trash"></i></button>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="Labelmodal" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="Labelmodal">Hapus Schedule</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="" method="post" id="formModal">
          <div class="modal-body">
            @csrf
            @method('delete')
            <h5 class="text-center">Apakah anda yakin ?</h5>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-danger">Delete</button>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection

@section('script')
  <script>
    $(document).ready(function(){
      $('#table').DataTable();
    })

    function hapus(id){
      var url = "{{ route('schedule.delete', ":id")}}";
      url = url.replace(':id', id);
      $('#formModal').attr('action', url);
      $('#modal').modal('show');
    }
  </script>
@endsection