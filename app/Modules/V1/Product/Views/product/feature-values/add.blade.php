@extends('Commons::layouts.app')

@section('header-scripts')
<link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
<meta name="csrf-token" content="{{ csrf_token() }}">
<style>
  .select2-container--default .select2-selection--single{
    height: 110%;
  }
</style>
@endsection

@section('modals')   
         <div class="modal fade" id="modal-lg">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Product Features</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form name="" action="{{route('product.add.variable.feature-value.form',['role' => \Auth::user()->role->slug])}}" enctype="multipart/form-data" method="POST"  >
                      @csrf
                      <input type="hidden" name="product_id" id="product_id" value="{{$product_id}}">
                    <div class="modal-body">
                      @foreach ($selected_feature_value as $item)
                      <div class="col-md-12">
                          <div class="form-group">
                            <label>{{$item[0]->features->title}}</label>
                            <select name="feature_selected[]" class="form-control select2" >
                              @foreach ($item as $item1)
                                  <option value="{{$item1->id}}">{{($item1->title)}}</option>
                              @endforeach
                            </select>
                          </div> 
                      </div>
                    @endforeach
                         <div class="col-md-12">
                            <label>Quantity</label>
                            <input type="number" name="quantity" class="form-control" placeholder="Feature Value Quantity" required>
                        </div>
                        <div class="col-md-12">
                            <label>Price</label>
                            <input type="number" class="form-control" name="price" placeholder="Feature Value Price" required>
                        </div>
                        <div class="img-ctm col-md-12 mt-3">
                            <label for="exampleInputFile">Product Feature Value Image (400 x 400)</label>
                            <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="image" id="exampleInputFile">
                                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                            </div>
                            <div class="input-group-append">
                                <span class="input-group-text">Upload</span>
                            </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>

                  </form>
                   
                    </div>
                </div>
            </div> 
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
              <li class="breadcrumb-item active">Add Feature</li>
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
                
                <button type="button" class="btn btn-success " data-toggle="modal" data-target="#modal-lg">
                    <span class=""><i class="fas fa-plus-square"></i> &nbsp Add Feature Value</span>
                </button>
                <!-- /.card-header -->
                <!-- form start -->
              </div>
            </div>

        </div>
        <div class="row">
            <div class="card card-primary col-md-12">
              <div class="card-header">
                <h3 class="card-title">Feature Value Table</h3>
              </div>
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Target</th>
                    <th>Source</th>              
                    <th>Rate</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach ($product_combinations as $pc)
                  <tr>
                    test
                    {{-- <td>{{$pc->target->name}}</td>
                    <td>{{$pc->source->name}}</td>
                    <td>{{$pc->closing_rate}}</td> --}}
                  </tr>  
                  @endforeach
                  </tbody>
                </table>
              </div>
            </div>
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

</script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.min.js') }}"></script>

@endsection