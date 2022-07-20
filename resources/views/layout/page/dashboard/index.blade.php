@extends('layout.index')

@section('title')
  Dashboard
@endsection

@section('content')
  <div class="card mb-4">
    <div class="card-body">
      <div class="d-flex justify-content-between align-items-center">
        <h5>Dashboard</h5>
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
    <div class="col-md-9">
      <div class="row">
        @foreach ($shifts as $shift)
          <div class="col-4 mb-4">
            <div class="border border-primary p-4 rounded text-center">
              <h5 class="text-primary">{{$shift->name}}</h5>
              <hr>
              @php
                // $schedules = \App\Models\MasterSchedule::where('shift_id', $shift->id)->where('date', 'CURRENT_DATE()')->get();
                $schedules = \App\Models\MasterSchedule::where('shift_id', $shift->id)->get();
              @endphp
              @foreach ($schedules as $key => $schedule)
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col">
                        {{$schedule->user->name}}
                      </div>
                      <div class="col">
                        {{$schedule->tasks}}
                      </div>
                    </div>
                    <hr>
                    <div class="row">
                      <div class="col text-left">
                        <button class="btn btn-sm btn-success">Done</button>
                        <button class="btn btn-sm btn-info">Input</button>
                      </div>
                    </div>
                  </div>
                </div>
              @endforeach
            </div>
          </div>
        @endforeach
      </div>
    </div>
    <div class="col-md-3">
      <div class="card">
        <div class="card-body text-center">
          <h5>Document</h5>
          <hr>
          <h6><i class="ti-file"></i> SOP</h6>
          <h6><i class="ti-file"></i> FLOW PM</h6>
          <h6><i class="ti-file"></i> FLOW CM</h6>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('script')
  <script>
  </script>
@endsection