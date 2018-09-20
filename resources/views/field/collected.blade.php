@extends('layout')


@section('extralink')



@stop


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
        @if($errors->has())
        @foreach ($errors->all() as $error)
        <div class="callout callout-danger">
          <h4>{{$error}}</h4>
        </div>
        @endforeach
        @endif
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Collected Orders</h3>
          </div>

          <!-- /.box-header -->
          <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
              <tr>
                <th>Order ID</th>
                <th>Patient</th>
                <th>Address</th>
                <th>Status</th>
                <th>Details</th>
                <th>Report info</th>
              </tr>

              @foreach($orders as $order)
              <tr>
                <td>{{$order['id']}}</td>
                <td>{{$order['patient']}}</td>
                <td>{{$order['address']}}</td>
                <td><span class="label label-success">{{$order['status']}}</span></td>
                <td>
                  <a href="{{route('field.details', $order['id'])}}" class="btn btn-info btn-sm ad-click-event">Details</a>
                </td>
                <td>
                  @if($order['status']=='collected')
                  <form action="{{route('field.confirmlabsubmit.post', $order['id'])}}" method="post">
                    {{csrf_field()}}
                    <input type="date" name="report_date" required>
                    <input type="time" name="report_time" required>
                    <input type="text" name="lab_reference" placeholder="lab_reference" required>
                    <input type="submit" class="btn btn-success" value="Confirm Lab Submit">                
                  </form>
                  @endif
                </td>
              </tr>
              @endforeach
            </table>
            {{$orders->links()}}
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

@section('extrascript')

<script type="text/javascript">

</script>

@stop

