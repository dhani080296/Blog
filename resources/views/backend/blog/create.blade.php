@extends('layout.backend.main')
@section('title','MyBlog| Add new post')
@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Blog
      </h1>
      <small>Add new post</small>
      <ol class="breadcrumb">
        <li><a href="{{url('/home')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="{{route('blog.index')}}">Blog</a></li>
        <li class="active">Add new</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
        {!! Form::model($post,[
              'method'=>'POST',
              'route'=>'blog.store',
              'files'=>TRUE,
              'id'=>'post-form']) !!}
          @include('backend.blog.form')
          {!!Form::close()!!}
        </div>
      <!-- ./row -->
    </section>
    <!-- /.content -->
  </div>

@endsection
@include('backend.blog.script')