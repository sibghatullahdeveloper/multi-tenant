@extends('Commons::layouts.app')

@section('header-scripts')
<link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
<style>
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
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Role</li>
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
                        <a href="{{route('role.add.view',['role' => \Auth::user()->role->slug])}}">
                          <button class="btn success">
                            <i class="fas fa-plus-square"></i> Add Role
                          </button>
                        </a>
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
                        <th>Slug</th>
                        <th>Description</th>
                        <th>Permissions</th>
                        @if (in_array('update',$active_permissions) || in_array('delete',$active_permissions))
                        <th>Actions</th>
                        @endif
                      </tr>
                      </thead>
                      <tbody>
                      @foreach ($roles as $role)
                      <tr>
                       <td>{{$loop->index+1}}</td>
                       <td>{{$role->title}}</td>
                       <td>{{$role->slug}}</td>
                       <td>{{$role->description}}</td>
                       <td>
                       @if ($role->role_menu_permissions)
                          @foreach ($role->role_menu_permissions as $menus)
                            @if($menus->permission->type == 'create')
                            <button class="btn success btn-xs">{{$menus->menu->title}} <i class="fas fa-plus"></i></button><br>
                            @endif
                            @if($menus->permission->type == 'view')
                            <button class="btn info btn-xs">{{$menus->menu->title}} <i class="fas fa-eye"></i></button><br>
                            @endif
                            @if ($menus->permission->type == 'update')
                            <button class="btn warning btn-xs">{{$menus->menu->title}} <i class="far fa-edit"></i></button><br>
                            @endif
                            @if($menus->permission->type == 'delete')
                            <button class="btn danger btn-xs">{{$menus->menu->title}} <i class="far fa-trash-alt"></i></button><br>    
                            @endif
                          @endforeach
                       @else
                          No Permissions Granted
                       @endif
                       </td>
                        <td>
                          @if (in_array('update',$active_permissions) || in_array('delete',$active_permissions))
                            @if (in_array('update',$active_permissions) && $role->id != 1 && $role->id != \Auth::user()->role_id)
                              <a href="{{route('role.edit.view',['role' => \Auth::user()->role->slug,'id' => $role->uuid])}}">
                                <button class="btn info">
                                  <i class="far fa-edit"></i>
                                </button>
                              </a>
                            @endif
                            @if (in_array('delete',$active_permissions) &&  $role->id != 1 && $role->id != \Auth::user()->role_id)
                              <a class="delete-confirmation" href="{{route('role.delete',['role' => \Auth::user()->role->slug,'id' => $role->uuid])}}">
                                <button class="btn danger">
                                  <i class="far fa-trash-alt"></i>
                                </button>
                              </a>
                            @endif
                          @endif
                        </td>
                      </tr>  
                      @endforeach
                      </tbody>
                      <tfoot>
                      <tr>
                        <th>Id</th>
                        <th>Title</th>
                        <th>Slug</th>
                        <th>Description</th>
                        <th>Permissions</th>
                        @if (in_array('update',$active_permissions) || in_array('delete',$active_permissions))
                        <th>Actions</th>
                        @endif
                        </tr>
                      </tr>
                      </tfoot>
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
    $(function () {
      $("#example1").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });


      // delete confirmation modak
    });
    $(document).ready(function(){
      $('.delete-confirmation').on('click',function(e){
          e.preventDefault();
          console.log( $(this).attr('href'));
          $('.modal-title').text('Delete Role');
          $('.modal-body-p').text('Are You Sure to Delete Role');
          $('#delete-href').prop('href',$(this).attr('href'));
          $('#modal-delete-warning').modal('show');

        });
    }); 
  </script>
@endsection