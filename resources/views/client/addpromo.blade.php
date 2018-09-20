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
            <h3 class="box-title">Add Promo Code</h3>
          </div>
          <form action="{{route('client.addpromo')}}" method="post">
            {{csrf_field()}}
            <div class="col-md-4">
              <input type="text" name="addpromo" class="form-control"  placeholder="promo" >  <br \>
            </div>
            <button type="submit" class="btn btn-primary">Add</button>
          </form>
          <br \>
          @if($promo)
          <table class="table table-hover">
           <tr>
            <th>Current Promo</th>
            <th>Discount</th>
            <th>Expire Date (yy/mm/dd)</th>
          </tr>
          <tr>
            <td>{{$promo['coupon']}}</td>
            <td>{{$promo['discount']}}</td>
            <td>{{$promo['end_date']}}</td>
          </tr>
        </table>
        @endif 
        <br \>              
      </div>
    </div>
    <!-- /.box -->
  </div>
</div>



</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->

@stop