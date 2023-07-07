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
            <h1 class="m-0">Social Links</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Settings</a></li>
              <li class="breadcrumb-item active">Social Links</li>
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
                  <h3 class="card-title">Social Links Settings</h3>
                </div>
                <form method="POST" action="{{route('setting.social.links.form',['role' => \Auth::user()->role->slug])}}">
                    @csrf
                    <div class="card-body">
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1">Facebook</label>
                            <input type="text" class="form-control" name="social_facebook" value="{{old('social_facebook',$data[ "SOCIAL_FACEBOOK"])}}" @if(in_array('update',$active_permissions) || in_array('create',$active_permissions) ) @else readonly = "readonly" @endif id="facebook"  >
                        </div>
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1">Instagram</label>
                            <input type="text" class="form-control" name="social_instagram" value="{{old('social_instagram',$data["SOCIAL_INSTAGRAM"])}}" id="instagram"  @if(in_array('update',$active_permissions) || in_array('create',$active_permissions) ) @else readonly = "readonly" @endif >
                        </div>
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1">LinkedIn</label>
                            <input type="text" class="form-control" name="social_linkedin" value="{{old('social_linkedin',$data['SOCIAL_LINKEDIN'])}}" id="linkedin"  @if(in_array('update',$active_permissions) || in_array('create',$active_permissions) ) @else readonly = "readonly" @endif>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1">Twitter</label>
                            <input type="text" class="form-control" name="social_twitter" value="{{old('social_twitter',$data['SOCIAL_TWITTER'])}}" id="twitter"  @if(in_array('update',$active_permissions) || in_array('create',$active_permissions) ) @else readonly = "readonly" @endif>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1">SnapChat</label>
                            <input type="text" class="form-control" name="social_snapchat" value="{{old('social_snapchat',$data["SOCIAL_SNAPCHAT"])}}" id="snapchat"  @if(in_array('update',$active_permissions) || in_array('create',$active_permissions) ) @else readonly = "readonly" @endif>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1">Whatsapp</label>
                            <input type="text" class="form-control" name="social_whatsapp" value="{{old('social_whatsapp',$data["SOCIAL_WHATSAPP"])}}" id="whatsapp"  @if(in_array('update',$active_permissions) || in_array('create',$active_permissions) ) @else readonly = "readonly" @endif>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1">Youtube</label>
                            <input type="text" class="form-control" name="social_youtube" value="{{old('social_youtube',$data['SOCIAL_YOUTUBE'])}}" id="youtube"  @if(in_array('update',$active_permissions) || in_array('create',$active_permissions) ) @else readonly = "readonly" @endif>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1">Google Business</label>
                            <input type="text" class="form-control" name="social_google_business" value="{{old('social_google_business',$data['SOCIAL_GOOGLE_BUSSINESS'])}}" id="g_business"  @if(in_array('update',$active_permissions) || in_array('create',$active_permissions) ) @else readonly = "readonly" @endif>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1">Github</label>
                            <input type="text" class="form-control" name="social_github" value="{{old('social_github',$data['SOCIAL_GITHUB'])}}" id="github"  @if(in_array('update',$active_permissions) || in_array('create',$active_permissions) ) @else readonly = "readonly" @endif>
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