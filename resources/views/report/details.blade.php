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
            <h3 class="box-title" style="font-weight: bold">Order ID: {{$order['id']}}</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body table-responsive no-padding">

            <div class="box-footer">

              <div class="col-sm-4 border-right">
                <div class="description-block">
                  <span class="description-text">Patient</span>
                  <h5 class="description-header">{{$order['patient']}}</h5>
                  <h5 class="description-header">Age: {{$order['age']}}</h5>
                  <h5 class="description-header">Sex: {{$order['sex']}}</h5>                   
                </div>
                <!-- /.description-block -->
              </div>
              <!-- /.col -->
              <div class="col-sm-4 border-right">
                <div class="description-block">
                  <span class="description-text">Address & Phone</span>
                  <h5 class="description-header">{{$order['address']}}</h5>
                  <h5 class="description-header">{{$order['phone']}}</h5>
                </div>
                <!-- /.description-block -->
              </div>
              <!-- /.col -->
              <div class="col-sm-4">
                <div class="description-block">
                  <span class="description-text">Order Price</span>
                  <h5 class="description-header">BDT: {{$total}}</h5>
                  <span class="description-text">Lab Reference</span>
                  <h5 class="description-header">{{$order['lab_reference']}}</h5>

                </div>
                <!-- /.description-block -->
              </div>

            </div>


            <table class="table table-hover" style="margin-top: 80px">
              <tr>
                <th>Test</th>
                <th>Price (bdt)</th>
              </tr>

              @foreach($order['tests'] as $test)
              <tr>
                <td>{{$test['test']}}</td>
                <td>{{$test['price']}}</td>
              </tr>
              @endforeach
              <tr>
                <th>Total</th>
                <th>{{$total}}</th>
              </tr>

            </table>
            <div class="box-footer" style="margin-top: 80px; margin-bottom: 80px">

              <div class="col-sm-4 border-right">
                <div class="description-block" style="margin-top: 80px">
                  <span class="description-text">-----------</span>
                  <h5 class="description-header">Service on a scale of 5</h5>                
                </div>
                <!-- /.description-block -->
              </div>
              <!-- /.col -->
              <div class="col-sm-4 border-right">
                <div class="description-block" style="margin-top: 80px">
                  <h5 class="description-header">--------------------</h5>
                  <span class="description-text">Any Recommendation</span>
                  
                </div>
                <!-- /.description-block -->
              </div>
              <!-- /.col -->
              <div class="col-sm-4">
                <div class="description-block" style="margin-top: 80px">
                  <span class="description-text">-----------</span>
                  <h5 class="description-header">Signature of receiver</h5>

                </div>
                <!-- /.description-block -->
              </div>

            </div>
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
