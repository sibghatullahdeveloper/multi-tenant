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
            <h1 class="m-0">Pages</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Pages</li>
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
                        <a href="{{route('pages.add.view',['role' => \Auth::user()->role->slug])}}">
                          <button class="btn success">
                            <i class="fas fa-plus-square"></i> Add Page
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
                        @if (in_array('update',$active_permissions) || in_array('delete',$active_permissions))
                        <th>Actions</th>
                        @endif
                      </tr>
                      </thead>
                      <tbody>
                      @foreach ($pages as $page)
                      <tr>
                        <td>{{$loop->index + 1}}</td>
                        <td>{{$page->title}}</td>
                        <td>{{$page->slug}}</td>
                        <td>
                          @if (in_array('update',$active_permissions) || in_array('delete',$active_permissions))
                            @if (in_array('update',$active_permissions))
                              <a href="{{route('pages.edit.view',['role' => \Auth::user()->role->slug, 'id' => $page->id ])}}">
                                <button class="btn info">
                                  <i class="far fa-edit"></i>
                                </button>
                              </a>
                            @endif
                            @if (in_array('delete',$active_permissions))
                              <a class="delete-confirmation" href="{{route('page.delete.form',['role' => \Auth::user()->role->slug, 'id' => $page->id ])}}">
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
          $('.modal-title').text('Delete Pages');
          $('.modal-body-p').text('Are You Sure to Delete Pages');
          $('#delete-href').prop('href',$(this).attr('href'));
          $('#modal-delete-warning').modal('show');

        });
    }); 
  </script>
@endsection