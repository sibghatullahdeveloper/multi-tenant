@extends('Commons::layouts.app')

@section('header-scripts')
<link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
<style>
  .select2-container--default .select2-selection--single{
    height: 110%;
  }
</style>
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
            <h1 class="m-0">Features</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Features</a></li>
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
                  <h3 class="card-title">Edit Feature</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form class="form-horizontal" method="POST" action="{{route('features.edit.form',['role' => \Auth::user()->role->slug])}}">
                  @csrf
                  <input type="hidden" name="id" value="{{$id}}">
                  <div class="card-body">
                    <div class="form-group row">
                      <label for="title" class="col-sm-2 col-form-label">Title</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" name="title"  id="title" placeholder="Title" value="{!! old('title',$data->title) !!}">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="description" class="col-sm-2 col-form-label">Display Type</label>
                      <div class="col-sm-10">
                        <select class="form-control select2" name="display_type" style="width: 100%;">
                          <option selected="selected" value="">Select Display Type</option>
                          @foreach ($input_field_types as $input_field_type)
                            <option value="{{$input_field_type}}" @if (old('display_type',$input_field_type) == $data->display_type) selected="selected" @endif>{{$input_field_type}}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="description" class="col-sm-2 col-form-label">Category</label>
                      <div class="col-sm-10">
                        <select class="form-control select2"  multiple="multiple" name="category[]" style="width: 100%;">
                          {{-- <option selected="selected" value="">Select Category</option> --}}
                          @foreach ($categories as $category)
                            <option value="{{$category->id}}" @if (old('category'.$loop->index,'') == $category->id || in_array($category->id,$data->categories_id)) selected="selected" @endif>{{$category->title}}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="title" class="col-sm-2 col-form-label">Sort Order</label>
                      <div class="col-sm-10">
                        <input type="number" class="form-control" min="1" name="sort_order"  id="sort_order" placeholder="Sort Order" value="{!! old('sort_order',$data->sort_order) !!}">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="title" class="col-sm-2 col-form-label">Description</label>
                      <div class="col-sm-10">
                        <input type="text" class="form-control" name="description"  id="description" placeholder="Description" value="{!! old('description',$data->description) !!}">
                      </div>
                    </div>
                    </div>
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer">
                    <button type="submit" class="btn btn-info">Update Feature</button>
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
<script src="{{ asset('plugins/select2/js/select2.full.min.js')}}"></script>
<script>
  $('.select2').select2();
</script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
<!-- Page specific script -->

@endsection