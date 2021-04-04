@extends('admin/layouts/app')

@section('headSection')

<link rel="stylesheet" href="{{ asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">

@endsection
@section('main-content')


          <!-- Content Wrapper. Contains page content -->
          <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            @include('admin.layouts.pagehead')
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Blank Page</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Users</h3>
          <a class="offset-lg-5 btn btn-success"  href="{{ route('user.create') }}">Add New</a>
          @include('includes.messages')
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fas fa-times"></i></button>
          </div>
        </div>
        <div class="card-body">

        <div class="card">
              <div class="card-header">
                <h3 class="card-title">DataTable with default features</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>S.No</th>
                    <th>User Name</th>
                    <th>Assigned Roles</th>
                    <th>Status</th>
                    <th>Edit</th>
                    <th>Delete</th>
                  </tr>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($users as $user)

                    <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td>{{$user->name}}</td>
                    <td>@foreach($user->roles as $role)
                    {{ $role->name }},
                    @endforeach
                    </td>
                  <td>{{ $user->status? 'Active' : 'Not Active' }}</td>
                    <td><a href="{{route('user.edit',$user->id)}}"> <span class="far fa-edit" style="font-size: 20px;"></span></a></td>
                    <td>
                    <form id="delete-form-{{ $user->id }}" action="{{ route('user.destroy',$user->id)}}" method="post" class="display: none">
                    @csrf
                    {{ method_field('DELETE') }}
                    </form>
                    <a href="" onClick="if(confirm('Are you sure, You want to delete this ? '))
                    {
                        event.preventDefault();
                        document.getElementById('delete-form-{{ $user->id }}').submit();
                        }
                         else {
                             event.preventDefault();
                         }" ><span class="fas fa-trash" style="font-size: 20px;"></span></a>
                    </td>
                  </tr>

                    @endforeach

                  </tbody>
                  <tfoot>
                  <tr>
                    <th>S.No</th>
                    <th>User Name</th>
                    <th>Assigned Roles</th>
                    <th>Status</th>
                    <th>Edit</th>
                    <th>Delete</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
                <!-- /.card-body -->

        <div class="card-footer">
          Footer
        </div>
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<hr>

@endsection

@section('footerSection')

<script src="{{asset('admin/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>

<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
@endsection
