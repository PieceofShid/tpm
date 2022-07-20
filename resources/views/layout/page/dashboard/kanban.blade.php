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
        <h4 class="text-center">Waiting</h4>
        <hr>
        @foreach ($waitings as $waiting)
          <div class="bg-white border p-2 mb-2">
            <p>Date : {{$waiting->date}}</p>
            <p>Operator : {{$waiting->user->name}}</p>
            <p>Tasks : {{$waiting->tasks}}</p>
          </div>
        @endforeach
      </div>
    </div>
    <div class="col-md-4">
      <div class="border border-danger p-4 rounded text-center">
        <h4>Delay</h4>
        <hr>
        @foreach ($delays as $delay)
          <div class="bg-white border p-2 mb-2">
            <p>Date : {{$delay->date}}</p>
            <p>Operator : {{$delay->user->name}}</p>
            <p>Tasks : {{$delay->tasks}}</p>
          </div>
        @endforeach
      </div>
    </div>
    <div class="col-md-4">
      <div class="border border-success p-4 rounded text-center">
        <h4>Done</h4>
        <hr>
        @foreach ($dones as $done)
          <div class="bg-white border p-2 mb-2">
            <p>Date : {{$done->date}}</p>
            <p>Operator : {{$done->user->name}}</p>
            <p>Tasks : {{$done->tasks}}</p>
          </div>
        @endforeach
      </div>
    </div>
  </div>
@endsection

@section('script')
  <script>
  </script>
@endsection