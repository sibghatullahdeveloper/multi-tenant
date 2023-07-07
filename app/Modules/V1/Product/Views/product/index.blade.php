@extends('Commons::layouts.app')

@section('header-scripts')
<link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
<style>
  ul {
    position: relative;
  }

  li {
    list-style: none;
  }

  li.child::before {
    content: "┖";
    transform: scale(1, 1.8);
    position: absolute;
    left: 1em;
  }
  .info {
  border-color: #2196F3;
  color: dodgerblue
  }

  .info:hover {
    background: #2196F3;
    color: white;
  }

  .danger {
    border-color: #f44336;
    color: red
  }

  .danger:hover {
    background: #f44336;
    color: white;
  }
  .success {
    border-color: #04AA6D;
    color: green;
  }

  .success:hover {
    background-color: #04AA6D;
    color: white;
  }

  .warning {
    border-color: #ff9800;
    color: orange;
  }

  .warning:hover {
    background: #ff9800;
    color: white;
  }
</style>
@endsection

@section('modals') 
  @include('Commons::partials.delete_modal')  
@endsection

@section('content')
<div id="app"></div>
     <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Products</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Products</li>
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
              @if (in_array('create',$active_permissions))
              <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">
                      {{-- <a href="{{route('product.add.view',['role' => \Auth::user()->role->slug])}}">
                        <button class="btn success">
                          <i class="fas fa-plus-square"></i> Add Product
                        </button>
                      </a> --}}
                      <div class="btn-group">
                        <button type="button" class="btn btn-success dropdown-toggle dropdown-hover dropdown-icon" data-toggle="dropdown">
                          <span class=""><i class="fas fa-plus-square"></i> Add Product</span>
                        </button>
                        <div class="dropdown-menu" role="menu">
                          <a class="dropdown-item" href="{{route('product.add.view',['role' => \Auth::user()->role->slug])}}">Simple</a>
                          <a class="dropdown-item" href="{{route('product.add.variable.view',['role' => \Auth::user()->role->slug])}}">Variable</a>
                        </div>
                      </div>
                    </h3>
                  </div>
            @endif  
            @if (in_array('view',$active_permissions))
            <!-- /.card-header -->
            <div class="card-body">
             <table id="example1" class="table table-bordered table-striped">
               <thead>
               <tr>
                 <th>Id</th>
                 <th>Title</th>
                 <th>Type</th>
                 <th>Category</th>
                 <th>Sort Order</th>
                 @if (in_array('update',$active_permissions) || in_array('delete',$active_permissions))
                 <th>Actions</th>
                 @endif
                 <th>Values</th>
               </tr>
               </thead>
               <tbody>
               {{-- @foreach ($features as $feature)
               <tr>
                 <td>{{$loop->index + 1}}</td>
                 <td>{{$feature->title}}</td>
                 <td>{{$feature->display_type}}</td>
                 <td>
                    @foreach ($feature->categories as $item)
                    {{($item->title)}}
                    @endforeach
                 </td>
                 <td>{{$feature->sort_order}}</td>
                 <td>
                   @if (in_array('update',$active_permissions) || in_array('delete',$active_permissions))
                     @if (in_array('update',$active_permissions))
                       <a href="{{route('features.edit.view',['role' => \Auth::user()->role->slug, 'id' => $feature->id ])}}">
                         <button class="btn info">
                           <i class="far fa-edit"></i>
                         </button>
                       </a>
                     @endif
                     @if (in_array('delete',$active_permissions))
                       <a class="delete-confirmation" href="{{route('features.delete.form',['role' => \Auth::user()->role->slug, 'id' => $feature->id ])}}">
                         <button class="btn danger">
                           <i class="far fa-trash-alt"></i>
                         </button>
                       </a>
                     @endif
                   @endif
                 </td>
                 <td>
                  <a href="{{route('feature-value.view',['role' => \Auth::user()->role->slug, 'id' => $feature->id ])}}">
                    <button class="btn btn-success">
                      <i class="far fa-plus-alt"></i>
                      Values
                    </button>
                </a>
                 </td>
               </tr>  
               @endforeach --}}
               </tbody>
             </table>
           </div>
           <!-- /.card-body -->
       @endif
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

<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
<script src="{{ asset('dist/js/demo.js') }} "></script>
<script>
    $(document).ready(function(){
      $('.delete-confirmation').on('click',function(e){
          e.preventDefault();
          console.log( $(this).attr('href'));
          $('.modal-title').text('Delete Feature');
          $('.modal-body-p').text('Are You Sure to Delete Feature ?');
          $('#delete-href').prop('href',$(this).attr('href'));
          $('#modal-delete-warning').modal('show');
        });
    }); 
</script>


{{-- Vue JS SCRIPTS --}}
@endsection