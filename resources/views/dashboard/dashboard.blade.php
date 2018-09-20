@extends('layout')


@section('extralink')
<style type="text/css">

.underlineinput{
  border: 0;
  outline: 0;
  background: #eeeeee;
  text-align: right;
}
</style>
@stop


@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">

  </section>

  <!-- Main content -->
  <section class="content container-fluid">
    @if(Session::has('status'))
    <div class="callout callout-success">
      <h4>{{Session::get('status')}}</h4>
    </div>
    @endif
    @if($errors->has())
    <div class="callout callout-warning">
      @foreach ($errors->all() as $error)
      <div>{{ $error }}</div>
      @endforeach
    </div>    
    @endif


    <div class="box box-widget widget-user-2">
      @if($user['email']=="")
         <p>Please add an email. It will be used for resetting passwords when you forget & sending you updates</p>
      @endif
      <!-- Add the bg color to the header using any of the bg-* classes -->
      <div class="widget-user-header">
        <!-- /.widget-user-image -->
        <h3 class="widget-user-username" style="margin-left: 0px; color: #000000; font-weight: bold;">{{$user['name']}}</h3>
      </div>
      <div class="box-footer no-padding">

        



        <form id="profileform" method="post" action="{{route('updateprofile')}}">
          {{csrf_field()}}
          <ul class="nav nav-stacked">
            <li>
              <a href="#">Phone<span class="pull-right"> <input class="underlineinput pull-right" type="text" name="phone" value="{{$user['phone']}}"> </span> </a>
            </li>
            <li>
              <a href="#">Email<span class="pull-right"> <input class="underlineinput pull-right" type="text" name="email" value="{{$user['email']}}"> </span> </a>
            </li>
            <li>
              <a href="#">Age<span class="pull-right"> <input class="underlineinput" type="number" name="age" value="{{$user['age']}}"></span> </a>
            </li>
            <li>
              <a href="#">Sex<span class="pull-right"> 
                <select id="sex" name="sex" class="select_with_style underlineinput" required>
                  <option value="male">Male</option>
                  <option value="female">Female</option>
                  <option value="other">Other</option>
                </select></span> </a>
              </li>
              <li>
                <a href="#">Blood Group<span class="pull-right"> 
                  <select id="blood_group" name="blood_group" class="select_with_style underlineinput" required>
                    <option value="A+">A+</option>
                    <option value="A-">A-</option>
                    <option value="B+">B+</option>
                    <option value="B-">B-</option>
                    <option value="AB+">AB+</option>
                    <option value="AB-">AB-</option>
                    <option value="O+">O+</option>
                    <option value="O-">O-</option>
                  </select></span> 
                </a>
              </li>
              <li>
                <a href="#">Address<span class="pull-right"> <input class="underlineinput" type="text" name="address" value="{{$user['address']}}"> </span></a>
              </li>
              <li>
                <a href="#">Action<span class="pull-right"><input type="submit"></span></a>
              </li>
            </ul>
          </form>


        </div>
      </div>



    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  @stop

  @section('extrascript')
  <script type="text/javascript">
    $(document).ready(function(){
      var user=<?php echo json_encode($user) ?>;
      var sex=document.getElementById('sex');
      sex.value=user['sex'];
      var blood_group=document.getElementById('blood_group');
      blood_group.value=user['blood_group'];
    });
  </script>
  @stop
