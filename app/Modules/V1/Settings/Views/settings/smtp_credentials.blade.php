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
            <h1 class="m-0">SMTP</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Settings</a></li>
              <li class="breadcrumb-item active">SMTP</li>
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
                  <h3 class="card-title">SMTP Settings</h3>
                </div>
                <form method="POST" action="{{route('setting.smtp.credentials.view',['role' => \Auth::user()->role->slug])}}">
                    @csrf
                    <div class="card-body">
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1">User Name</label>
                            <input type="text" class="form-control" name="smtp_username" value="{{old('smtp_username',$data['SMTP_USERNAME'])}}" id="smtp_username" required @if(in_array('update',$active_permissions) || in_array('create',$active_permissions) ) @else readonly = "readonly" @endif>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1">Password</label>
                            <input type="text" class="form-control" name="smtp_password" value="{{old('smtp_password',$data['SMTP_PASSWORD'])}}" id="smtp_password" required @if(in_array('update',$active_permissions) || in_array('create',$active_permissions) ) @else readonly = "readonly" @endif>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1">Host</label>
                            <input type="text" class="form-control" name="smtp_host" value="{{old('smtp_host',$data['SMTP_PASSWORD'])}}"  id="smtp_host" required @if(in_array('update',$active_permissions) || in_array('create',$active_permissions) ) @else readonly = "readonly" @endif>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1">Port</label>
                            <input type="number" min="1" class="form-control" name="smtp_port" value="{{old('smtp_port',$data['SMTP_PORT'])}}" id="smtp_port" required @if(in_array('update',$active_permissions) || in_array('create',$active_permissions) ) @else readonly = "readonly" @endif>
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