@extends('layout.backend.main')
@section('title','MyBlog| Edit User')
@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        User
      </h1>
      <small>Edit Users</small>
      <ol class="breadcrumb">
        <li><a href="{{url('/home')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="{{route('users.index')}}">Users</a></li>
        <li class="active">Edit Users</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
        {!! Form::model($user,[
              'method'=>'PUT',
              'route'=>['users.update',$user->id],
              'files'=>TRUE,
              'id'=>'users-form']) !!}
          @include('backend.users.form')
          {!!Form::close()!!}
        </div>
      <!-- ./row -->
    </section>
    <!-- /.content -->
  </div>

@endsection
@include('backend.users.script')