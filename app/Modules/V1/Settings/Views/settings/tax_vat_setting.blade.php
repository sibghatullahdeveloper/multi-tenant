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
            <h1 class="m-0">Tax Vat</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Settings</a></li>
              <li class="breadcrumb-item active">Tax Vat</li>
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
            <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Vat Settings</h3>
                </div>
                <form method="POST" action="{{route('setting.tax.vat.form',['role' => \Auth::user()->role->slug])}}">
                    @csrf
                    <div class="card-body">
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1">Tax %</label>
                            <input type="number" step="0.01" min="1.00" class="form-control" value="{{old('tax',$data['TAX'])}}" name="tax" id="tax" @if(in_array('update',$active_permissions) || in_array('create',$active_permissions) ) @else readonly = "readonly" @endif required>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1">VAT %</label>
                            <input type="number" step="0.01" min="1.00" class="form-control" value="{{old('vat',$data['VAT'])}}" name="vat" id="vat" @if(in_array('update',$active_permissions) || in_array('create',$active_permissions) ) @else readonly = "readonly" @endif  required>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    @if(in_array('update',$active_permissions) || in_array('create',$active_permissions)) 
                      <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                    @else  
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