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
        @if($errors->has())
        @foreach ($errors->all() as $error)
        <div class="callout callout-danger">
          <h4>{{ $error }}</h4>
        </div>
        @endforeach
        @endif


        <div class="box">

          <!-- /.box-header -->
          <div class="box-body table-responsive no-padding">
           <div class="col-md-4" style="margin: 40px">
            <form action="{{route('admin.coupon')}}" method="post">
             {{csrf_field()}}
             <h4>Add Coupon</h4>
            <div>
              <input type="text" name="coupon" class="form-control"  placeholder="coupon">  <br \>
            </div>
            <div>
              <input type="number" name="discount" class="form-control"  placeholder="discount">  <br \>
            </div>
            <div>
              <input type="date" name="end_date" class="form-control"  placeholder="end date">  <br \>
            </div>
          
          <button type="submit" class="btn btn-primary">Add</button>
          
        </form>
      </div>

      <div class="col-md-4" style="margin: 40px">
            <form action="{{route('admin.coupon.update')}}" method="post">
             {{csrf_field()}}
             <h4>Update Coupon</h4>
             
            <div class="form-group">
              <select class="form-control select2" name="id" data-placeholder="roles"
              style="width: 100%;">
              @foreach($coupons as $coupon)
              <option value="{{$coupon['id']}}">{{$coupon['coupon']}}</option>
              @endforeach
            </select>
            </div>
            <div>
              <input type="date" name="end_date" class="form-control">  <br \>
            </div>
          
          <button type="submit" class="btn btn-primary">Update</button>
          
        </form>
      </div>

    </div>
    </div>


        <div class="box">

          <div class="box-header">
            <h3 class="box-title">Tests</h3>
          </div>

          <!-- /.box-header -->
          <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
              <tr>
                <th>Coupon Name</th>
                <th>Discount</th>
                <th>End Date</th>
                <th>Action</th>
              </tr>

              @foreach($coupons as $coupon)
              <tr>
                <td>{{$coupon['coupon']}}</td>
                <td>{{$coupon['discount']}}</td>
                <td>{{$coupon['end_date']}}</td>
                <td><a href="{{route('admin.coupon.delete',$coupon['id'])}}" class="btn btn-danger btn-sm ad-click-event">Delete</a></td>
              </tr>
              @endforeach
            </table>
            {{$coupons->links()}}
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