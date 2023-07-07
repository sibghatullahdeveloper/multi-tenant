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
            <h1 class="m-0">Orders</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Settings</a></li>
              <li class="breadcrumb-item active">Orders</li>
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
                  <h3 class="card-title">Order Settings</h3>
                </div>
                <form method="POST" action="{{route('setting.order.form',['role' => \Auth::user()->role->slug])}}">
                    @csrf
                    <div class="card-body">
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1">Minimum Order Amount</label>
                            <input type="number" step="0.01" value="{{old('minimum_order_amount',$data['MINIMUM_ORDER_AMOUNT'])}}" min="0.00" class="form-control" name="minimum_order_amount" id="minimum_order_amount" required @if(in_array('update',$active_permissions) || in_array('create',$active_permissions) ) @else readonly = "readonly" @endif>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1">Minimum Order Amount Free Delivery</label>
                            <input type="number" step="0.01" min="0.00" value="{{old('minimum_order_amount_free_delivery',$data['MINIMUM_ORDER_AMOUNT_FREE_DELIVERY'])}}" class="form-control" name="minimum_order_amount_free_delivery" id="minimum_order_amount_free_delivery" required @if(in_array('update',$active_permissions) || in_array('create',$active_permissions) ) @else readonly = "readonly" @endif>
                        </div>
                    </div>
                    
                    <div class="card">
                        <div class="card-header">
                                <h3 class="card-title">Order Payment Method</h3>
                        </div>
                        <div class="card-body">
                            {{-- Payment Methods --}}
                            <div class="form-group col-md-4">
                            <label for="exampleInputEmail1">Cash On Delivery</label>
                            <br>
                            <input type="checkbox" name="payment_method_cash_on_delivery" @if (old('payment_method_cash_on_delivery',$data['PAYMENT_METHOD_CASH_ON_DELIVERY']) == 'on')
                                checked
                            @endif data-bootstrap-switch data-off-color="danger" data-on-color="success">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="exampleInputEmail1">Paypal</label>
                            <br>
                            <input type="checkbox" @if (old('payment_method_paypal',$data['PAYMENT_METHOD_PAYPAL']) == 'on')
                            checked
                            @endif name="payment_method_paypal" data-bootstrap-switch data-off-color="danger" data-on-color="success">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="exampleInputEmail1">Stripe</label>
                            <br>
                            <input type="checkbox" @if (old('payment_method_stripe',$data['PAYMENT_METHOD_STRIPE']) == 'on')
                            checked
                            @endif  name="payment_method_stripe" data-bootstrap-switch data-off-color="danger" data-on-color="success">
                        </div>
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
<script src="{{ asset('plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}"></script>
<script>
    $("input[data-bootstrap-switch]").each(function(){
      $(this).bootstrapSwitch('state', $(this).prop('checked'));
    })

</script>
@endsection