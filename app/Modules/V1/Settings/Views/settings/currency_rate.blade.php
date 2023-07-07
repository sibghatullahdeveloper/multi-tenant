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
            <h1 class="m-0">Currencies</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Settings</a></li>
              <li class="breadcrumb-item active">Currencies</li>
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
          <div class="col-md-12">
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
                <h3 class="card-title">Default Currency</h3>
              </div>
              <form method="GET" enctype="multipart/form-data" action="{{route('setting.currency.default',['role' => \Auth::user()->role->slug])}}">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Select Currency</label>
                    <select class="form-control select2" name="currency" style="width: 100%;">
                      <option value="">Select Currency</option>
                      @foreach ($currencies as $currency)
                        <option value="{{old('currency',$currency->id)}}" @if ($currency->id == $default_currency) selected @endif >{{$currency->symbol}} {{$currency->name}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <!-- /.card-body -->
                @if(in_array('update',$active_permissions) || in_array('create',$active_permissions)) 
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Set Default Currency</button>
                </div>
                @endif
              </form>
            </div> 
          </div>
        </div>
        <!-- /.row -->
        <div class="row">
          <div class="col-md-12">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Set Conversion Rate</h3>
              </div>
              <form method="POST" action="{{route('setting.currency.rate.form',['role' => \Auth::user()->role->slug])}}">
                @csrf
                <div class="card-body">
                  <div class="form-group col-md-12">
                    <label for="exampleInputEmail1">Source Currency</label>
                    <select class="form-control select2" name="source_currency" id="source_currency" style="">
                      @foreach ($currencies as $currency)
                        @if ($currency->id == $default_currency)
                        <option value="{{old('source_currency',$default_currency)}}" selected="selected" >{{$currency->symbol}} {{$currency->name}}</option>
                        @endif
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group col-md-12">
                    <label for="exampleInputEmail1">Select Target Currency</label>
                    <select class="form-control select2" name="target_currency" id="target_currency" style="">
                      <option value="">Select Target Currency</option>
                      @foreach ($currencies as $currency)
                        @if ($currency->id != $default_currency)
                        <option value="{{old('target_currency',$currency->id)}}" @if ($currency->id == $default_currency) selcted="selected" @endif>{{$currency->symbol}} {{$currency->name}}</option>
                        @endif
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group col-md-12">
                    <label for="exampleInputEmail1">Enter Conversion Rate</label>
                    <input class="form-control" type="number" step="0.01" min="0.00" name="closing_rate" id="closing_rate" placeholder="0.00" @if(in_array('update',$active_permissions) || in_array('create',$active_permissions) ) @else readonly = "readonly" @endif>
                  </div>
                </div>
                <!-- /.card-body -->
                @if(in_array('update',$active_permissions) || in_array('create',$active_permissions)) 
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Set Conversation Rate</button>
                </div>
                @endif
              </form>
            </div> 
          </div>
        </div>
        <div class="row">
          <div class="card card-primary col-md-12">
            <div class="card-header">
              <h3 class="card-title">Conversion Table</h3>
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
                @foreach ($conversion_rate as $cr)
                <tr>
                  <td>{{$cr->target->name}}</td>
                  <td>{{$cr->source->name}}</td>
                  <td>{{$cr->closing_rate}}</td>
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
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script>
  var currency_ajax = "{{route('setting.get.currency.rate.ajax')}}";
  console.log(currency_ajax);
</script>
<script src="{{ asset('custom-js/currency.js') }}"></script>
@endsection