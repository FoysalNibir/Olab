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

      <div class="col-xs-12 col-md-6">

        @if(Session::has('status'))
        <div class="callout callout-info">
          <h4>{{Session::get('status')}}</h4>
        </div>
        @endif
        @if(Session::has('error'))
        <div class="callout callout-warning">
          <h4>{{Session::get('error')}}</h4>
        </div>
        @endif
        @if($errors->has())
        <div class="callout callout-warning">
          @foreach ($errors->all() as $error)
          <div>{{ $error }}</div>
          @endforeach
        </div>
        @endif

        
        <!-- /.box-body -->
        <div class="box box-primary">

          <!-- /.box-header -->
          <!-- form start -->
          <form role="form" method="post" action="{{route('changepassword.post')}}">
            {{csrf_field()}}
            <div class="box-body">
              <div class="form-group">

                <div>
                  <label>Old Password</label>
                  <input type="text" name="password" class="form-control">
                </div>

                <div>
                  <label>New Password</label>
                  <input type="text" name="newpassword" class="form-control">
                </div>

                <div>
                  <label>Confirm New Password</label>
                  <input type="text" name="confirmnewpassword" class="form-control">
                </div>
                
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>

          <!-- /.box -->
        </div>
      </div>



    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  @stop
