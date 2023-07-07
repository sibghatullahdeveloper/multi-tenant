@extends('Commons::layouts.app')

@section('header-scripts')
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
            <h1 class="m-0">SEO</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">SEO</a></li>
              <li class="breadcrumb-item active">Edit</li>
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
                  <h3 class="card-title">Edit SEO</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form class="form-horizontal" method="POST" action="{{route('seo.edit.form',['role' => \Auth::user()->role->slug])}}">
                  @csrf
                  <input type="hidden" name="id" value="{{$data['id']}}"> 
                  <div class="card-body">
                    <div class="form-group row">
                      <label for="title" class="col-sm-2 col-form-label">URL</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" name="url"  id="url" placeholder="URL" value="{!! old('url',$data['url']) !!}">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="title" class="col-sm-2 col-form-label">Page Title</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" name="title"  id="title" placeholder="Title" value="{!! old('title',$data['title']) !!}">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="title" class="col-sm-2 col-form-label">Meta Keywords</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" name="keywords"  id="keywords" placeholder="Keyword,Keyword,Keyword" value="{!! old('keywords',$data['meta_keywords']) !!}">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="title" class="col-sm-2 col-form-label">Meta Description</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" name="description"  id="description" placeholder="Description" value="{!! old('description',$data['meta_description']) !!}">
                      </div>
                    </div>
                    </div>
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer">
                    <button type="submit" class="btn btn-info">Update SEO</button>
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

@endsection