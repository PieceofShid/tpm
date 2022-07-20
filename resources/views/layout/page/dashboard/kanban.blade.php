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
                    <p>Tasks : {{$waiting->tasks}}</p>
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
                    <p>Tasks : {{$delay->tasks}}</p>
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
                    <p>Tasks : {{$done->tasks}}</p>
                  </div>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
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
        info: false
      });
    })
  </script>
@endsection