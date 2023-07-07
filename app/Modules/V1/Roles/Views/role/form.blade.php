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
            <h1 class="m-0">Role</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Role</a></li>
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
                  <h3 class="card-title">Add Role</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form class="form-horizontal" method="POST" action="{{route('role.add.form',['role' => \Auth::user()->role->slug])}}">
                  @csrf
                  <div class="card-body">
                    <div class="form-group row">
                      <label for="title" class="col-sm-2 col-form-label">Title</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" name="title"  id="title" placeholder="Title" value="{!! old('title','') !!}">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="description" class="col-sm-2 col-form-label">Description</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" name="description" id="description" placeholder="Description">
                      </div>
                    </div>
                    <div class="form-group row" style="">
                      <label for="permissions" class="col-sm-2 col-form-label">Permissions</label>
                      <div class="col-sm-10">
                        @foreach ($menus as $menu)
                          <label class="col-sm-1">{{$menu->title}}</label>
                          <br>
                          @foreach ($permissions as $key => $permission)  
                            <label class="col-sm-1">{{$permission->title}}</label>
                            <input type="checkbox" name="permissions[][{{$menu->id}}]" value="{{$permission->id}}" 
                              @if (old('permissions',''))
                              @foreach (old('permissions','') as $item)  
                                @foreach ($item as $key => $item_l)
                                    @if($key == $menu->id)
                                      @if ($item_l == $permission->id)
                                          checked
                                      @endif
                                    @endif
                                  @endforeach
                              @endforeach
                            @endif 
                              data-bootstrap-switch>
                          @endforeach
                          <br>
                        @endforeach
                      </div>
                    </div>
                    <div class="form-group row" style="display: none">
                      <label for="type" class="col-sm-2 col-form-label">Type</label>
                      <div class="col-sm-10">
                        <input type="text" value="admin" name="type" class="form-control" id="type" placeholder="Type">
                      </div>
                    </div>
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer">
                    <button type="submit" class="btn btn-info">Add Role</button>
                    <button type="submit" class="btn btn-default float-right">Reset</button>
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
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('dist/js/demo.js') }}"></script>
<!-- Page specific script -->
<script>
  
   $("input[data-bootstrap-switch]").each(function(){
    if ($(this).prop('checked')==true){ 
            //do something
            console.log("checked");
            $(this).bootstrapSwitch('state', 'true');
        }else{
            $(this).bootstrapSwitch('state','');
        }
    })
</script>
@endsection