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

          <div class="box-header">
            <h3 class="box-title">Pending Orders</h3>
          </div>

          <!-- /.box-header -->
          <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
              <tr>
                <th>Order ID</th>
                <th>Patient</th>
                <th>Age</th>
                <th>Sex</th>
                <th>Address</th>
                <th>Status</th>
                <th>Collection Information</th>               
                <th>Action</th>
                <th>Order Date</th>
              </tr>

              @foreach($orders as $order)
              <tr>
                <td>{{$order['id']}}</td>
                <td>{{$order['patient']}}</td>
                <td>{{$order['age']}}</td>
                <td>{{$order['sex']}}</td>
                <td>{{$order['address']}}</td>
                <td><span class="label label-warning">{{$order['status']}}</span></td>
                
                @if($order['status']=='operation' || $order['status']=='call_missed')
                <td>
                  <form action="{{route('operation.confirmcollectioninfo.post', $order['id'])}}" method="post">
                    {{csrf_field()}}
                    <input type="date" name="collection_date" required>
                    <input type="time" name="collection_time" required>
                    <input type="submit" class="btn btn-success" value="Send to field">                
                  </form>
                </td>
                @endif

                <td>
                  <a href="{{route('operation.details', $order['id'])}}" class="btn btn-info btn-sm ad-click-event">Details</a>
                  <a href="{{route('operation.setcallmissed', $order['id'])}}" class="btn btn-info btn-sm ad-click-event">Set Call Missed</a>
                </td>
                <td>{{$order['created_at']}}</td>

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
