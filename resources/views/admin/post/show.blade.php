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
          <h3 class="card-title">Title</h3>
          @can('posts.create',Auth::user())
          <a class="offset-lg-5 btn btn-success"  href="{{route('post.create')}}">Add New</a>
            @endcan
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fas fa-times"></i></button>
          </div>
        </div>
        <div class="card-body">
        <div class="card-header">
                <h3 class="card-title">DataTable with default features</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>S.No</th>
                    <th>Title</th>
                    <th>Sub Title</th>
                    <th>Slug</th>
                    <th>Created At</th>
                    @can('posts.update',Auth::user())
                    <th>Edit</th>
                    @endcan
                    @can('posts.delete',Auth::user())
                    <th>Delete</th>
                    @endcan
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($posts as $post)

                    <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td>{{$post->title}}</td>
                    <td>{{$post->subtitle}}</td>
                    <td>{{$post->slug}}</td>
                    <td>{{$post->created_at}}</td>
                    @can('posts.update',Auth::user())
                    <td><a href="{{route('post.edit',$post->id)}}"> <span class="far fa-edit" style="font-size: 20px;"></span></a></td>
                    @endcan
                    @can('posts.delete',Auth::user())
                    <td>
                    <form id="delete-form-{{ $post->id }}" action="{{ route('post.destroy',$post->id)}}" method="post" class="display: none">
                    @csrf
                    {{ method_field('DELETE') }}
                    </form>
                    <a href="" onClick="if(confirm('Are you sure, You want to delete this ? '))
                    {
                        event.preventDefault();
                        document.getElementById('delete-form-{{ $post->id }}').submit();
                        }
                         else {
                             event.preventDefault();
                         }" ><span class="fas fa-trash" style="font-size: 20px;"></span></a>
                    </td>
                    @endcan
                  </tr>
                    @endforeach

                  </tbody>
                  <tfoot>
                  <tr>
                  <th>S.No</th>
                    <th>Title</th>
                    <th>Sub Title</th>
                    <th>Slug</th>
                    <th>Created At</th>
                    @can('posts.update',Auth::user())
                    <th>Edit</th>
                    @endcan
                    @can('posts.delete',Auth::user())
                    <th>Delete</th>
                    @endcan
                   </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
                <!-- /.card-body -->
        </div>
                <!-- /.card-body -->
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
