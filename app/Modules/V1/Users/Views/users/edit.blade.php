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
            <h1 class="m-0">Users</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Add</a></li>
              <li class="breadcrumb-item active">Users</li>
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
                        <h3 class="card-title">{{ ($item) }}</h3><br>
                      @endforeach
                  @endforeach
                    </div>
                @endif
                <div class="card-header">
                  <h3 class="card-title">Update User</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form class="form-horizontal" method="POST" enctype='multipart/form-data' action="{{route('user.edit.form',['role' => \Auth::user()->role->slug])}}">
                  @csrf
                  <input type="hidden" name="id" value="{{$user->uuid}}">
                  <div class="card-body">
                    <div class="form-group row">
                      <label for="title" class="col-sm-2 col-form-label">First Name</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" value="{{old('first_name',$user->first_name)}}" name="first_name" id="first_name" placeholder="First Name">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="description" class="col-sm-2 col-form-label">Last Name</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" value="{{old('last_name',$user->last_name)}}" name="last_name" id="last_name" placeholder="Last Name">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="description" class="col-sm-2 col-form-label">Email</label>
                      <div class="col-sm-10">
                        <input type="email" class="form-control" value="{{old('email',$user->email)}}" name="email" id="email" placeholder="Email">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="description" class="col-sm-2 col-form-label">Role</label>
                      <div class="col-sm-10">
                        <select class="form-control select2" name="role" style="width: 100%;">
                          <option>Select Role</option>
                          @foreach ($roles as $role)
                            <option value="{{old('role',$role->id)}}" @if (old('role',$user->role_id) == $user->role->id) selected="selected" @endif>{{$role->title}}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    {{-- <div class="form-group row">
                      <label for="description" class="col-sm-2 col-form-label">Password</label>
                      <div class="col-sm-10">
                        <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                      </div>
                    </div> --}}
                    <div class="form-group row">
                      <label for="description" class="col-sm-2 col-form-label">Phone Number</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" name="phone_number" value="{{old('phone_number',$user->phone_number)}}" id="phone_number" placeholder="Phone Number">
                      </div>
                    </div>
                    <div class="form-group row" style="">
                      <label for="type" class="col-sm-2 col-form-label">Type</label>
                      <div class="col-sm-10">
                        <select class="form-control select2" name="type" style="width: 100%;">
                          <option value="{{old('type','admin')}}" @if (old('type','') == 'admin') selected="selected" @endif>Admin</option>
                          <option value="{{old('type','user')}}" @if (old('type','') == 'user') selected="selected" @endif>User</option>
                          <option value="{{old('type','pharmacy')}}" @if (old('type','') == 'pharmacy') selected="selected" @endif>Pharmacy</option>
                        </select>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="exampleInputFile" class="col-sm-2 col-form-label">File input</label>
                      <div class="col-sm-10">
                        <div class="custom-file">
                          <input type="file" class="custom-file-input" name="profile_image" value="{{old('profile_image',$user->image_path)}}" id="exampleInputFile">
                          <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                        </div>
                      </div>
                    </div>

                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer">
                    <button type="submit" class="btn btn-info">Update User</button>
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
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->

@endsection