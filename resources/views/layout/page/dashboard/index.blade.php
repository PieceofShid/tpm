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
  <div class="card mb-4 py-2 px-4">
    <div class="d-flex justify-content-center align-items-center">
      <div class="row">
        <div class="col-12 col-md-2 mb-2 text-center">
          <a class="nav-link text-primary" href="{{ route('kanban.monthly')}}">
            <i class="ti-calendar menu-icon icon-lg"></i>
            <br>
            <span class="menu-title">Monthly Kanban</span>
          </a>
        </div>
        <div class="col-12 col-md-2 mb-2 text-center">
          <a class="nav-link text-primary" href="{{ route('schedule.index')}}">
            <i class="ti-calendar menu-icon icon-lg"></i>
            <br>
            <span class="menu-title">Master Schedule</span>
          </a>
        </div>
        <div class="col-12 col-md-2 mb-2 text-center">
          <a class="nav-link text-primary" href="{{ route('kanban.index')}}">
            <i class="ti-notepad menu-icon icon-lg"></i>
            <br>
            <span class="menu-title">Kanban Check</span>
          </a>
        </div>
        <div class="col-12 col-md-2 mb-2 text-center">
          <a class="nav-link text-primary" href="{{ route('mesin.index')}}">
            <i class="ti-settings menu-icon icon-lg"></i>
            <br>
            <span class="menu-title">Data Mesin</span>
          </a>
        </div>
        <div class="col-12 col-md-2 mb-2 text-center">
          <a class="nav-link text-primary" href="{{ route('problem.index')}}">
            <i class="ti-bolt menu-icon icon-lg"></i>
            <br>
            <span class="menu-title">Temuan Problem</span>
          </a>
        </div>
        <div class="col-12 col-md-2 mb-2 text-center">
          <a class="nav-link text-primary" href="{{ route('shift.index')}}">
            <i class="ti-exchange-vertical menu-icon icon-lg"></i>
            <br>
            <span class="menu-title">Data Shift</span>
          </a>
        </div>
        <div class="col-12 col-md-2 mb-2 text-center">
          <a class="nav-link text-primary" href="{{ route('user.index')}}">
            <i class="ti-user menu-icon icon-lg"></i>
            <br>
            <span class="menu-title">Data Pengguna</span>
          </a>
        </div>
        <div class="col-12 col-md-2 mb-2 text-center">
          <a class="nav-link text-primary" href="{{ route('content.document')}}">
            <i class="ti-file menu-icon icon-lg"></i>
            <br>
            <span class="menu-title">Data Content</span>
          </a>
        </div>
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
    <div class="col-12 col-md-9">
      <div class="row">
        @foreach ($shifts as $shift)
          <div class="col-md-4 mb-4">
            <div class="border border-primary p-4 rounded">
              <h5 class="text-primary text-center">{{$shift->name}}</h5>
              <hr>
              @php
                $today = \Carbon\Carbon::now()->format('Y-m-d');
                $schedules = \App\Models\MasterSchedule::where('shift_id', $shift->id)->where('status', 'waiting')->where('date', $today)->get();
              @endphp
              @foreach ($schedules as $key => $schedule)
                <div class="card mb-2">
                  <div class="card-body">
                    <div class="row">
                      <div class="col">
                        <span class="font-weight-bold"><i class="ti-user"></i> :</span> {{$schedule->user->name}}
                        <br>
                        <span class="font-weight-bold"><i class="ti-settings"></i> :</span> {{$schedule->machine->name}}
                        <br>
                        <span class="font-weight-bold"><i class="ti-bolt"></i> :</span> {{$schedule->tasks}}
                      </div>
                    </div>
                    <hr>
                    <div class="row">
                      <div class="col text-left">
                        <button class="btn btn-sm btn-success" @if($schedule->user_id == auth()->id()|| auth()->user()->level_id == 1) onclick="done('{{$schedule->id}}')" @endif>Done</button>
                        <button class="btn btn-sm btn-info" @if($schedule->user_id == auth()->id()|| auth()->user()->level_id == 1) onclick="input('{{$schedule->id}}')" @endif>Input</button>
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
    <div class="col-12 col-md-3">
      <div class="card">
        <div class="card-body text-center">
          <div class="row">
            <div class="col">
              <h5>Delay Check</h5>
              <br>
              <h4><a href="{{ route('kanban.index')}}" class="btn btn-sm btn-danger count-indicator"><i class="ti-bell"></i> {{$delays}}</a></h4>
            </div>
            <div class="col">
              <h5>Finish Check</h5>
              <br>
              <h4><a href="{{ route('kanban.index')}}" class="btn btn-sm btn-success count-indicator"><i class="ti-bell"></i> {{$dones}}</a></h4>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col">
      <div class="card-body text-center">
        <h5>Document</h5>
        <hr>
        <div class="row">
          <div class="col-12 col-md-4">
            <h6>
              <a class="nav-link text-primary" href="{{ asset('assets/img/sop.pdf')}}" target="_blank">
                <img src="{{ asset('assets/img/pdf-file.png')}}" alt="" srcset="" width="120" height="120">
                <br>
                <br>
                SOP
              </a>
            </h6>
          </div>
          <div class="col-12 col-md-4">
            <h6>
              <a class="nav-link text-primary" href="{{ asset('assets/img/pm.pdf')}}" target="_blank">
                <img src="{{ asset('assets/img/pdf-file.png')}}" alt="" srcset="" width="120" height="120">
                <br>
                <br>
                FLOW PM
              </a>
            </h6>
          </div>
          <div class="col-12 col-md-4">
            <h6>
              <a class="nav-link text-primary" href="{{ asset('assets/img/cm.pdf')}}" target="_blank">
                <img src="{{ asset('assets/img/pdf-file.png')}}" alt="" srcset="" width="120" height="120">
                <br>
                <br>
                FLOW CM
              </a>
            </h6>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modalDone" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Complete Tasks</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="" method="post" id="formDone">
          @csrf
          @method('post')
          </form>
          <h4 class="text-center">Complete Tasks ?</h4>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success" id="btnDone">Complete</button>
          <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modalInput" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Input temuan problem</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="" method="post" id="formInput">
          @csrf
          @method('post')
          <input type="text" name="problem" id="problem" class="form-control" placeholder="Problem pada mesin" required>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success" id="btnInput">Submit</button>
          <button type="button" class="btn btn-light" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('script')
  <script>
    function done(id){
      var url = "{{ route('dashboard.done', ":id")}}";
      url = url.replace(':id', id);
      $('#formDone').attr('action', url);
      $('#modalDone').modal('show');
    }

    function input(id){
      var url = "{{ route('problem.create', ":id")}}";
      url = url.replace(':id', id);
      $('#formInput').attr('action', url);
      $('#modalInput').modal('show');
    }

    $('#btnDone').click(function(){
      $('#formDone').submit();
    });

    $('#btnInput').click(function(){
      $('#formInput').submit();
    });
  </script>
@endsection