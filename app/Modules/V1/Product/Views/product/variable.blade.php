@extends('Commons::layouts.app')

@section('header-scripts')
<link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">

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
            <h1 class="m-0">Product</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Product</a></li>
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
                  <h3 class="card-title">Add Variable Product</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
              </div>
            </div>
        </div>
        <!-- /.row -->
        {{-- @dd($parent_categories); --}}
        <div id="app">
              {{-- <mainform/>      --}}
              <Variable></Variable>
        </div>
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
  var CONST_MAIN_CATEGORIES = "{{($parent_categories)}}";
  var CONST_GET_SUBCATEGORY_ROUTE = "{{route('product.get.category.data',['role' => \Auth::user()->role->slug])}}"; 
  var CONST_GET_FEATURE_ROUTE = "{{route('product.get.feature.data',['role' => \Auth::user()->role->slug])}}"; 
  var CONST_GET_VARIABLE_PRODUCT_ADD_ROUTE = "{{route('product.add.variable.form',['role' => \Auth::user()->role->slug])}}"; 
  var CONST_GET_PRODUCT_INDEXING_ROUTE = "{{route('product.view',['role' => \Auth::user()->role->slug])}}"; 
  var CONST_GET_VARIABLE_PRODUCT_FEATURE_ROUTE = "{{route('product.add.variable.feature-value.view',['role' => \Auth::user()->role->slug])}}"; 
</script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
<!-- Page specific script -->
<script src="{{ mix('dist/js/app.js') }}" type="text/javascript"></script>

@endsection