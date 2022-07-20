@extends('layout.index')

@section('title')
  Kanban Check
@endsection

@section('content')
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
  {{-- <div id="evoCalendar"></div> --}}
  {{$event}}
@endsection

@section('script')
  <script>

    $(document).ready(function(){
      $('#evoCalendar').evoCalendar({
        calendarEvents: events,
      })
    });
  </script>
@endsection