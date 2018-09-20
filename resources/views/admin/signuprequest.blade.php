@extends('layout')


@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    
  </section>

  <!-- Main content -->
  <section class="content container-fluid">


    <div class="row">

      <div class="col-xs-12">

        @if(Session::has('status'))
        <div class="callout callout-success">
          <h4>{{Session::get('status')}}</h4>
        </div>
        @endif
        @if(Session::has('error'))
        <div class="callout callout-danger">
          <h4>{{Session::get('error')}}</h4>
        </div>
        @endif
        <div class="box">

          <!-- /.box-header -->
          <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
              
              <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Phone</th>
                <th>Action</th>
              </tr>
              
              @foreach($users as $user)
              <tr>
                <td>{{$user['id']}}</td>
                <td>{{$user['name']}}</td>
                <td>{{$user['phone']}}</td>
                <td>
                  <a href="{{route('admin.useractivate', $user['id'])}}" class="btn btn-info btn-sm ad-click-event">Activate</a>
                  <a href="{{route('admin.userdelete', $user['id'])}}" class="btn btn-danger btn-sm ad-click-event">Delete</a>
                </td>
              </tr>
              @endforeach
            </table>
            {{$users->links()}}
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
    </div>



  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

@stop
