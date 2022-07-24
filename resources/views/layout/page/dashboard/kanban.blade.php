@extends('layout.index')

@section('title')
  Kanban Check
@endsection

@section('content')
  <div class="card mb-4">
    <div class="card-body">
      <div class="d-flex justify-content-between align-items-center">
        <h5>Kanban Check</h5>
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
  <div class="row">
    <div class="col-md-4">
      <div class="border border-warning p-4 rounded">
        <table class="table table-sm table-borderless" id="table">
          <thead>
            <tr>
              <td class="text-center">Waiting</td>
            </tr>
          </thead>
          <tbody>
            @foreach ($waitings as $waiting)
              <tr>
                <td>
                  <div class="bg-white border p-2 mb-2">
                    <p>{{$waiting->date}} - {{$waiting->user->name}}</p>
                    <p><i class="ti-settings"></i> : {{$waiting->machine->name}}</p>
                    <p><i class="ti-bolt"></i> : {{$waiting->tasks}}</p>
                  </div>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
    <div class="col-md-4">
      <div class="border border-danger p-4 rounded">
        <table class="table table-sm table-borderless" id="table">
          <thead>
            <tr>
              <td class="text-center">Delay</td>
            </tr>
          </thead>
          <tbody>
            @foreach ($delays as $delay)
              <tr>
                <td>
                  <div class="bg-white border p-2 mb-2">
                    <p>{{$delay->date}} - {{$delay->user->name}}</p>
                    <p><i class="ti-settings"></i> : {{$delay->machine->name}}</p>
                    <p><i class="ti-bolt"></i> : {{$delay->tasks}}</p>
                    <p><button class="btn btn-sm btn-primary" onclick="reschedule('{{$delay->id}}')">Reschedule</button></p>
                  </div>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
    <div class="col-md-4">
      <div class="border border-success p-4 rounded">
        <table class="table table-sm table-borderless" id="table">
          <thead>
            <tr>
              <td class="text-center">Done</td>
            </tr>
          </thead>
          <tbody>
            @foreach ($dones as $done)
              <tr>
                <td>
                  <div class="bg-white border p-2 mb-2">
                    <p>{{$done->date}} - {{$done->user->name}}</p>
                    <p><i class="ti-settings"></i> : {{$done->machine->name}}</p>
                    <p><i class="ti-bolt"></i> : {{$done->tasks}}</p>
                  </div>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Reschedule</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form action="" method="post" id="form">
          <div class="modal-body">
            @csrf
            @method('post')
            <input type="date" name="date" id="date" class="form-control" required>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-success">Reschedule</button>
            <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection

@section('script')
  <script>
    $(document).ready(function(){
      $('.table').DataTable({
        searching: false,
        ordering: false,
        lengthChange: false,
        info: false,
        lengthMenu: [2],
      });
    })

    function reschedule(id){
      var url = "{{ route('kanban.reschedule', ":id")}}";
      url = url.replace(':id', id);
      $('#form').attr('action', url);
      $('#modal').modal('show');
    }
  </script>
@endsection