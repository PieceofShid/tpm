@extends('layout.index')

@section('title')
  Document
@endsection

@section('content')
  <div class="card mb-4">
    <div class="card-body">
      <div class="d-flex justify-content-between align-items-center">
        <h5>Manajemen Document</h5>
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
    <div class="row mb-4">
      <div class="col">
        <button class="btn btn-success" onclick="running()">Update Running Text</button>
      </div>
    </div>
    <div class="row">
      <div class="col-md-4 text-center">
        @if (count($sop))
          <div class="card">
            <div class="card-body">
              <h5>Document SOP</h5><br><hr>
              <a href="{{ asset('assets/img').'/'.$sop[0]->name}}" target="_blank"><i class="ti-file icon-lg"></i></a><br>
              View<br>
              <hr>
              <button class="btn btn-sm btn-primary" onclick="update('sop')">Update</button>
            </div>
          </div>
        @else
          <div class="card">
            <div class="card-body">
              <h5>Document SOP</h5><br><hr>
              <i class="ti-file icon-lg"></i><br>
              Empty<br>
              <hr>
              <button class="btn btn-sm btn-primary" onclick="upload('sop')">Upload</button>
            </div>
          </div>
        @endif
      </div>
      <div class="col-md-4 text-center">
        <div class="card">
          @if (count($pm))
            <div class="card-body">
              <h5>Document FLOW PM</h5><br><hr>
              <a href="{{ asset('assets/img').'/'.$pm[0]->name}}" target="_blank"><i class="ti-file icon-lg"></i></a><br>
              View<br>
              <hr>
              <button class="btn btn-sm btn-primary" onclick="update('pm')">Update</button>
            </div>
          @else
            <div class="card-body">
              <h5>Document FLOW PM</h5><br><hr>
              <i class="ti-file icon-lg"></i><br>
              Empty<br>
              <hr>
              <button class="btn btn-sm btn-primary" onclick="upload('pm')">Upload</button>
            </div>
          @endif
        </div>
      </div>
      <div class="col-md-4 text-center">
        @if (count($cm))
          <div class="card">
            <div class="card-body">
              <h5>Document FLOW CM</h5><br><hr>
              <a href="{{ asset('assets/img').'/'.$cm[0]->name}}" target="_blank"><i class="ti-file icon-lg"></i></a><br>
              View<br>
              <hr>
              <button class="btn btn-sm btn-primary" onclick="update('cm')">Update</button>
            </div>
          </div>
        @else
          <div class="card">
            <div class="card-body">
              <h5>Document FLOW CM</h5><br><hr>
              <i class="ti-file icon-lg"></i><br>
              Empty<br>
              <hr>
              <button class="btn btn-sm btn-primary" onclick="upload('cm')">Upload</button>
            </div>
          </div>
        @endif
      </div>
    </div>

  <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="Labelmodal" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="Labelmodal">Upload <span id="title"></span></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="" method="post" id="formModal" enctype="multipart/form-data">
          <div class="modal-body">
            @csrf
            @method('post')
            <label for="name">Upload Document</label>
            <input type="file" name="name" id="name" class="form-control" accept="application/pdf" required>
            <input type="hidden" name="type" id="type">
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Upload</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </form>
        <form action="" method="post" id="formRunning">
          <div class="modal-body">
            @csrf
            @method('post')
            <label for="text">Update Running Text</label>
            <textarea name="text" id="text" class="form-control" required>{{$text}}</textarea>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Update</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection

@section('script')
  <script>
    function upload(type){
      $('#formRunning').hide();
      $('#formModal').show();
      $('#formModal').attr('action', '{{ route("content.document.upload")}}');
      $('#type').val(type);
      if(type == 'sop'){
        $('#title').html('SOP');
        $('#modal').modal('show');
      }else if(type == 'pm'){
        $('#title').html('FLOW PM');
        $('#modal').modal('show');
      }else if(type == 'cm'){
        $('#title').html('FLOW CM');
        $('#modal').modal('show');
      }
    }

    function update(type){
      $('#formRunning').hide();
      $('#formModal').show();
      $('#formModal').attr('action', '{{ route("content.document.update")}}');
      $('#type').val(type);
      if(type == 'sop'){
        $('#title').html('SOP');
        $('#modal').modal('show');
      }else if(type == 'pm'){
        $('#title').html('FLOW PM');
        $('#modal').modal('show');
      }else if(type == 'cm'){
        $('#title').html('FLOW CM');
        $('#modal').modal('show');
      }
    }

    function running(){
      $('#formModal').hide();
      $('#formRunning').show();
      $('#formRunning').attr('action', '{{ route("content.document.text")}}');
      $('#title').html('Running Text');
      $('#modal').modal('show');
    }
  </script>
@endsection