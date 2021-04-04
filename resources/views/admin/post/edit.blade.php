@extends('admin.layouts.app')
@section('headSection')
<link rel="stylesheet" href="{{ asset('admin/plugins/select2/css/select2.min.css') }}">
@endsection
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
            <div class="card-header with-border">
                <h3 class="card-title">Titles</h3>
              </div><!-- /.card-header -->
                 @include('includes.messages')
                    <!-- form start -->
                <!-- posts jo he wo controller me edit me jo posts pass kiya wo he -->
                  <form role="form" action="{{ route('post.update',$posts->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                      {{ method_field('PATCH')}}
                     <div class="card-body">
                      <div class="row">
                        <div class="col-lg-6">
                          <div class="form-group">
                          <label for="title">Post Title</label>
                          <input type="text" class="form-control" id="title" name="title" placeholder="Title" value="{{$posts->title}} ">
                          </div>

                          <div class="form-group">
                          <label for="subtitle">Post SubTitle</label>
                          <input type="text" class="form-control" id="subtitle" name="subtitle" placeholder="Sub Title" value="{{$posts->subtitle}} ">
                          </div>
                          <div class="form-group">
                          <label for="slug">Post Slug</label>
                           <input type="text" class="form-control" id="slug" name="slug" placeholder="slug" value="{{$posts->slug}} ">
                          </div> <!--/.form-group -->
                        </div> <!--/.col -->
                        <div class="col-lg-6">
                       <br>
                          <div class="form-group">
                            <div class="float-right">
                                <label for="image">File Input</label>
                                <input type="file" name="image" id="image">
                            </div>
                            <div class="checkbox float-left">
                                <label>
                                    <input type="checkbox" name="status" value="1" @if ($posts->status==1)
                                    {{'checked'}}
                                    @endif>    Publish
                                </label>
                            </div>
                        </div><!-- /.form-group -->
                        <br>
                        <div class="form-group" style="margin-top:18px;">
                             <label>Select Tag</label>
                            <select class="form-control select2 select2-hidden-accessible" disable="disable" multiple=""
                            data-placeholder="Select a Tag" style="width: 100%;"
                            tabindex="-1" aria-hidden="true" name="tags[]">
                             @foreach ($tags as $tag)
                             <option value="{{ $tag->id }}"
                             @foreach($posts->tags as $postTag)
                              @if ($postTag->id == $tag->id)
                              selected
                              @endif
                             @endforeach
                             >{{ $tag->name }}</option>
                             @endforeach

                        </select>
                        </div><!-- /.form-group -->

                            <div class="form-group" style="margin-top:18px;">
                             <label>Select Category</label>
                            <select class="form-control select2 select2-hidden-accessible" disable="disable" multiple=""
                            data-placeholder="Select a Category" style="width: 100%;"
                            tabindex="-1" aria-hidden="true" name="categories[]">
                             @foreach ($categories as $category)
                             <option value="{{ $category->id }}"
                             @foreach($posts->categories as $postCategory)
                              @if ($postCategory->id == $category->id)
                              selected
                              @endif
                             @endforeach
                             >{{ $category->name }}</option>
                             @endforeach

                              </select>
                            </div><!-- /.form-group -->
                          </div> <!-- /.col -->
                        </div>  <!-- /.row -->
                      </div> <!-- /.card-body -->

                    <div class="card card-outline card-info col-lg-12">
                         <div class="card-header">
                           <h3 class="card-title">
                             Write Post Here
                           <small>Simple and fast</small>
                            </h3>
                          <!-- tools card -->
                      <div class="card-tools col px-3 py-3">
                        <button type="button" class="btn btn-tool btn-sm" data-card-widget="collapse" data-toggle="tooltip"
                          title="Collapse">
                        <i class="fas fa-minus"></i></button>
                      </div>
                        <!-- /. tools -->

                        <div class="card-body pad ">
                          <div class="mb-3">
                            <textarea name="body"
                              style="width: 100%; height: 500px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" id="editor1">{{ $posts->body}}</textarea>

                           </div>
                        </div>

                        <!-- /.card-header -->
                         <div class="card-footer">
                          <button type="submit" class="btn btn-primary">Update</button>
                          <a href="{{route('post.index')}}" class="btn btn-warning">Back</a>
                         </div>
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

@section('footerSection')

<script src="{{ asset('admin/ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('admin/plugins/select2/js/select2.full.min.js') }}"></script>
<script>
    $(function () {
      // Replace the <textarea id="editor1"> with a CKEditor
      // instance, using default configuration.
      CKEDITOR.replace('editor1');
      //bootstrap WYSIHTML5 - text editor
      $(".textarea").wysihtml5();
    });
</script>
<script>
    $(document).ready(function(){
        $('.select2').select2();

});
</script>
@endsection
