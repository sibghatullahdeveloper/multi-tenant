@extends('Commons::layouts.app')

@section('header-scripts')
<link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.min.css')}}">
  <!-- CodeMirror -->
<link rel="stylesheet" href="{{ asset('plugins/codemirror/codemirror.css')}}">
<link rel="stylesheet" href="{{ asset('plugins/codemirror/theme/monokai.css')}}">
  <!-- SimpleMDE -->
<link rel="stylesheet" href="{{ asset('plugins/simplemde/simplemde.min.css')}}">
@endsection

@section('modals')   
@endsection

@section('content')
     <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Pages</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Pages</a></li>
              <li class="breadcrumb-item active">Add</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-12">
              <div class="card card-info">
                @if (session()->has('error'))
                    <div class="card-header" style="background-color: red;">
                      @foreach ( json_decode(session()->get('error')) as $errors)
                        @foreach ($errors as $item)
                            <h3 class="card-title">{{ ($item) }}</h3> <br>
                        @endforeach
                      @endforeach
                      </div> 
                @endif
                <div class="card-header">
                  <h3 class="card-title">Add Pages</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form class="form-horizontal" method="POST" action="{{route('pages.add.form',['role' => \Auth::user()->role->slug])}}">
                  @csrf
                  <div class="card-body">
                    <div class="form-group row">
                      <label for="title" class="col-sm-2 col-form-label">Title</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" name="title"  id="title" placeholder="Title" value="{!! old('title','') !!}">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="description" class="col-sm-2 col-form-label">Content</label>
                      <div class="col-sm-10">
                          <textarea id="summernote" name="content">
                            {!! old('content','') !!}
                          </textarea>
                      </div>
                    </div>
                    </div>
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer">
                    <button type="submit" class="btn btn-info">Add Page</button>
                    <button type="reset" class="btn btn-default float-right">Reset</button>
                  </div>
                  <!-- /.card-footer -->
                </form>
              </div>
            </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection


@section('footer-scripts')
<script src="{{ asset('plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
<!-- Page specific script -->

<script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script>
<!-- CodeMirror -->
<script src="{{ asset('plugins/codemirror/codemirror.js') }}"></script>
<script src="{{ asset('plugins/codemirror/mode/css/css.js') }}"></script>
<script src="{{ asset('plugins/codemirror/mode/xml/xml.js') }}"></script>
<script src="{{ asset('plugins/codemirror/mode/htmlmixed/htmlmixed.js') }}"></script>
<script>
  $(function () {
    // Summernote
    $('#summernote').summernote()

    // CodeMirror
    CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
      mode: "htmlmixed",
      theme: "monokai"
    });
  })
</script>

@endsection