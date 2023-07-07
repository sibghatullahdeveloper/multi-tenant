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
            <h1 class="m-0">Paypal</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Settings</a></li>
              <li class="breadcrumb-item active">Paypal</li>
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
                    <h3 class="card-title">Paypal Credentials</h3>
                  </div>
                  <form method="POST" action="{{route('setting.paypal.credentials.form',['role' => \Auth::user()->role->slug])}}">
                      @csrf
                      <div class="card-body">
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1">Paypal Mode</label>
                            <select class="form-control select2" name="paypal_mode" id="paypal_mode" style="">
                                <option value="">Select Mode</option>
                                <option value="{{old('paypal_mode','live')}}" @if ( $data['PAYPAL_MODE'] == 'live')
                                    selected
                                @endif>Live</option>
                                <option value="old('paypal_mode','sandbox')" @if ($data['PAYPAL_MODE'] == 'sandbox')
                                selected
                                @endif >SandBox</option>
                            </select>
                          </div>
                          <div class="form-group col-md-12">
                              <label for="exampleInputEmail1">Client ID</label>
                              <input type="text" class="form-control" name="paypal_api_client_id" value="{{old('paypal_api_client_id',$data['PAYPAL_API_CLIENT_ID'])}}" id="android_link" required @if(in_array('update',$active_permissions) || in_array('create',$active_permissions) ) @else readonly = "readonly" @endif>
                          </div>
                          <div class="form-group col-md-12">
                              <label for="exampleInputEmail1">Client Secret</label>
                              <input type="text" class="form-control" name="paypal_api_client_secret" id="paypal_api_client_secret" value="{{old('paypal_api_client_secret',$data['PAYPAL_API_SECRET'])}}" required @if(in_array('update',$active_permissions) || in_array('create',$active_permissions) ) @else readonly = "readonly" @endif>
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