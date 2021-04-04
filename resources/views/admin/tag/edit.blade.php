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
                <h3 class="card-title">Title</h3>
              </div>

              @include('includes.messages')
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" action="{{ route('tag.update',$tag->id) }}" method="post">
              @csrf
              {{ method_field('PUT') }}
                <div class="card-body">
                    <div class="col-lg-offset-3 col-lg-6">
                    <div class="form-group">
                    <label for="name">Tag Title</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Tag Title" value="{{ $tag->name }}">
                  </div>

                  <div class="form-group">
                    <label for="slug">Tag Slug</label>
                    <input type="text" class="form-control" id="slug" name="slug" placeholder="slug" value="{{ $tag->slug }}">
                  </div>
                  <div class="form-group">
                  <button type="submit" class="btn btn-primary">Update</button>
                  <a href="{{route('tag.index')}}" class="btn btn-warning">Back</a>
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
