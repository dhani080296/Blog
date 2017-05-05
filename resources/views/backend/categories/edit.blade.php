@extends('layout.backend.main')
@section('title','MyBlog| Edit Category')
@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Categories
      </h1>
      <small>Edit Categories</small>
      <ol class="breadcrumb">
        <li><a href="{{url('/home')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="{{route('categories.index')}}">Categories</a></li>
        <li class="active">Edit category</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
        {!! Form::model($category,[
              'method'=>'PUT',
              'route'=>['categories.update',$category->id],
              'files'=>TRUE,
              'id'=>'categories-form']) !!}
          @include('backend.categories.form')
          {!!Form::close()!!}
        </div>
      <!-- ./row -->
    </section>
    <!-- /.content -->
  </div>

@endsection
@include('backend.categories.script')