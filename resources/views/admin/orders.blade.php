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
            <h3 class="box-title">Orders</h3>
          </div>

          <!-- /.box-header -->
          <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
              <form action="{{route('admin.orders')}}">
              <tr>
                <td></td>
                <td> <input type="text" placeholder="lab_reference" name="lab_reference" @if(isset($inputs['lab_reference'])) value="{{$inputs['lab_reference']}}" @endif> </td>
                <td> <input type="text" placeholder="patient" name="patient" @if(isset($inputs['patient'])) value="{{$inputs['patient']}}" @endif> </td>
                <td> <input type="text" placeholder="report_date" name="report_date" @if(isset($inputs['report_date'])) value="{{$inputs['report_date']}}" @endif> </td>
                <td> <input type="text" placeholder="report_time" name="report_time" @if(isset($inputs['report_time'])) value="{{$inputs['report_time']}}" @endif> </td>
                <td> <input type="text" placeholder="collection_date" name="collection_date" @if(isset($inputs['collection_date'])) value="{{$inputs['collection_date']}}" @endif> </td>
                <td> <input type="text" placeholder="collection_time" name="collection_time" @if(isset($inputs['collection_time'])) value="{{$inputs['collection_time']}}" @endif> </td>
                <td> <input type="text" placeholder="address" name="address" @if(isset($inputs['address'])) value="{{$inputs['address']}}" @endif> </td>
                <td> <input type="text" placeholder="status" name="status" @if(isset($inputs['status'])) value="{{$inputs['status']}}" @endif> </td>
                <td><input class="btn btn-primary btn-sm ad-click-event" value="Filter" type="submit" /></td>
              </tr>
              </form>
              <tr>
                <th>Order ID</th>
                <th>Lab Reference</th>
                <th>Patient</th>
                <th>Report Date</th>
                <th>Report Time</th>
                <th>Collection Date</th>
                <th>Collection Time</th>
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
                <td>{{$order['collection_date']}}</td>
                <td>{{$order['collection_time']}}</td>
                <td>{{$order['address']}}</td>
                <td><span class="label label-primary">{{$order['status']}}</span></td>
                <td><a href="{{route('client.order.detail', $order['id'])}}" class="btn btn-info btn-sm ad-click-event">
                  Details
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