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
            <h1 class="m-0">Accounts</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Settings</a></li>
              <li class="breadcrumb-item active">Accounts</li>
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
            <form class="form-horizontal" enctype='multipart/form-data' method="POST" action="{{route('setting.accounts.form',['role' => \Auth::user()->role->slug])}}">
              @csrf
              <div class="card-body">
                <div class="form-group row">
                  <label for="title" class="col-sm-2 col-form-label">Business Name</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="business_name" id="business_name" value="{{old('business_name',$account_setting['business_name']??'')}}" @if(in_array('update',$active_permissions)) @else readonly = "readonly" @endif placeholder="Business Name">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="description" class="col-sm-2 col-form-label">Business Phone</label>
                  <div class="col-sm-10">
                    <input type="tel" class="form-control" name="business_phone_number" id="business_phone_number" value="{{old('business_phone_number',$account_setting['business_phone_number']??'')}}" @if(in_array('update',$active_permissions)) @else readonly = "readonly" @endif placeholder="Business Phone Number">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="description" class="col-sm-2 col-form-label">Whatsapp Number</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="business_whatsapp_number" id="business_whatsapp_number" value="{{old('business_whatsapp_number',$account_setting['business_whatsapp_number']??'')}}" @if(in_array('update',$active_permissions)) @else readonly = "readonly" @endif placeholder="Business Whatsapp">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="description" class="col-sm-2 col-form-label">Contact Email</label>
                  <div class="col-sm-10">
                    <input type="email" class="form-control" name="contact_email" id="contact_email" value="{{old('contact_email',$account_setting['contact_email']??'')}}" @if(in_array('update',$active_permissions)) @else readonly = "readonly" @endif placeholder="Contact Email">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="description" class="col-sm-2 col-form-label">Business Location</label>
                  <div class="col-sm-10">
                    <input type="text-area" class="form-control" name="business_location" id="business_location" value="{{old('business_location',$account_setting['business_location']??'')}}" @if(in_array('update',$active_permissions)) @else readonly = "readonly" @endif placeholder="Business Location">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="description" class="col-sm-2 col-form-label">Business Address</label>
                  <div class="col-sm-10">
                    <input type="text-area" class="form-control" name="business_address" id="business_address" value="{{old('business_address',$account_setting['business_address']??'')}}" @if(in_array('update',$active_permissions)) @else readonly = "readonly" @endif placeholder="Business Address">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="description" class="col-sm-2 col-form-label">Timings</label>
                  @foreach ($timings as $key => $item)
                    <div class="row">
                      <div class="col-sm-10">
                        <label for="description" class="col-sm-2 col-form-label">{{$key}}</label>
                      @foreach ($item as $key2 => $item)
                      <br>
                      <p>{{str_replace("_"," ",$key2)}}</p> <input type="time" class="form-control" name="{{$key.'_'.$key2}}" id="{{$key.'_'.$key2}}" @if(in_array('update',$active_permissions)) @else readonly = "readonly" @endif value="{{old($key.'_'.$key2,$account_setting[strtolower($key.'_'.$key2)]??'')}}">   
                        @endforeach
                      </div>
                    </div>
                  @endforeach
                  
                </div>

              </div>
              <!-- /.card-body -->
              @if(in_array('update',$active_permissions)) 
              <div class="card-footer">
                <button type="submit" class="btn btn-info">Update Account</button>
                <button type="reset" class="btn btn-default float-right">Reset</button>
              </div>
              @else  
              @endif
              <!-- /.card-footer -->
            </form>
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