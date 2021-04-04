@extends('admin.layouts.app')

@section('main-content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Text Editors</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Text Editors</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">


          <!-- general form elements -->
          <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Permissions</h3>
              </div>

              @include('includes.messages')
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" action="{{ route('permission.update',$permission->id) }}" method="post">
              @csrf
              {{ method_field('PUT') }}
                <div class="card-body">
                    <div class="offset-lg-3 col-lg-6">
                    <div class="form-group">
                    <label for="name">Permission</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="permission " value="{{$permission->name}}">
                  </div>
                  <div class="form-group">
                  <button type="submit" class="btn btn-primary">Submit</button>
                  <a href="{{route('permission.index')}}" class="btn btn-warning">Back</a>
                </div>
                </div>
                        <!-- /.card-body -->


              </form>
            </div>
            <!-- /.card -->


        </div>
        <!-- /.col-->
      </div>
      <!-- ./row -->
    </section>
    <!-- /.content -->
  </div>

@endsection
