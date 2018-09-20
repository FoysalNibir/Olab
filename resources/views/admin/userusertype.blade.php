@extends('layout')
@section('extralink')
<link rel="stylesheet" href="{{asset('bower_components/select2/dist/css/select2.min.css')}}">
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
        <div class="box">

          <!-- /.box-header -->
          <div class="box-body table-responsive no-padding">
           <div class="col-md-6" style="margin: 40px">
            <form action="{{route('admin.user.usertype.post', $userusertypes['id'])}}" method="post">
             {{csrf_field()}}
             <h4>Add New Role</h4>
             
             <div class="form-group">
              <select class="form-control select2" multiple="multiple" name="usertypes[]" data-placeholder="roles"
              style="width: 100%;">
              @foreach($usertypes as $usertype)
              <option value="{{$usertype['id']}}">{{$usertype['type']}}</option>
              @endforeach
            </select>
          </div>
          
          <button type="submit" class="btn btn-primary">Submit</button>
          
        </form>
      </div>
    </div>
    <!-- /.box-body -->
  </div>
  <div class="box">

    <!-- /.box-header -->
    <div class="box-body table-responsive no-padding">
      <table class="table table-hover">

        <tr>
          <th>ID</th>
          <th>Type</th>
          <th>Action</th>
        </tr>

        @foreach($userusertypes['usertypes'] as $usertype)
        <tr>
          <td>{{$usertype['id']}}</td>
          <td>{{$usertype['type']}}</td>
          <td><a href="{{route('admin.user.usertype.delete',  ['user'=>$usertype['pivot']->user_id,'usertype'=>$usertype['pivot']->user_type_id])}}" class="btn btn-danger btn-sm ad-click-event">Delete</a></td>
        </tr>
        @endforeach
      </table>

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
<script src="{{asset('bower_components/select2/dist/js/select2.full.min.js')}}"></script>
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()

    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({ timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A' })
    //Date range as a button
    $('#daterange-btn').daterangepicker(
    {
      ranges   : {
        'Today'       : [moment(), moment()],
        'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
        'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
        'This Month'  : [moment().startOf('month'), moment().endOf('month')],
        'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
      },
      startDate: moment().subtract(29, 'days'),
      endDate  : moment()
    },
    function (start, end) {
      $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
    }
    )

    //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    })

    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass   : 'iradio_minimal-blue'
    })
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass   : 'iradio_minimal-red'
    })
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass   : 'iradio_flat-green'
    })

    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    //Timepicker
    $('.timepicker').timepicker({
      showInputs: false
    })
  })
</script>
@stop
