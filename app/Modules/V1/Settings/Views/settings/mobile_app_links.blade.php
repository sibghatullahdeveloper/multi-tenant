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
            <h1 class="m-0">Mobile App Links</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Settings</a></li>
              <li class="breadcrumb-item active">Mobile App Links</li>
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
          <div class="col-lg-12">
            @if (session()->has('error'))
              <div class="card-header" style="background-color: red;">  
                    @foreach ( json_decode(session()->get('error')) as $errors)
                        @foreach ($errors as $item)
                          <h3 class="card-title">{{ ($item) }}</h3><br>
                        @endforeach
                    @endforeach
              </div>
            @endif
            <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Mobile Application Links</h3>
                </div>
                <form method="POST" action="{{route('setting.application.links.form',['role' => \Auth::user()->role->slug])}}">
                    @csrf
                    <div class="card-body">
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1">Android Link</label>
                            <input type="text" class="form-control" name="android_link" value="{{old('android_link',$data['ANDROID_APP_LINK'])}}" id="android_link" required @if(in_array('update',$active_permissions) || in_array('create',$active_permissions) ) @else readonly = "readonly" @endif>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1">IOS Link</label>
                            <input type="text" class="form-control" name="ios_link" id="ios_link" value="{{old('ios_link',$data['IOS_APP_LINK'])}}" required @if(in_array('update',$active_permissions) || in_array('create',$active_permissions) ) @else readonly = "readonly" @endif>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    @if(in_array('update',$active_permissions) || in_array('create',$active_permissions)) 
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                    @endif
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
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
@endsection