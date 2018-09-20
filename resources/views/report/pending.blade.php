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
                <th>Lab Reference</th>
                <th>Patient</th>
                <th>Report Date</th>
                <th>Report Time</th>
                <th>Address</th>
                <th>Status</th>
                <th>Action</th>
              </tr>

              @foreach($orders as $order)
              <tr>
                <td>{{$order['id']}}</td>
                <td>{{$order['lab_reference']}}</td>
                <td>{{$order['patient']}}</td>
                <td>{{$order['report_date']}}</td>
                <td>{{$order['report_time']}}</td>
                <td>{{$order['address']}}</td>
                <td><span class="label label-primary">{{$order['status']}}</span></td>
                <td><a href="{{route('report.details', $order['id'])}}" class="btn btn-info btn-sm ad-click-event">
                  Details
                </a></td>
                <td><a href="{{route('report.confirmdelivery', $order['id'])}}" class="btn btn-success btn-sm ad-click-event">
                  Confirm Delivery
                </a></td>

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
