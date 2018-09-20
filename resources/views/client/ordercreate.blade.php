@extends('layout')


@section('extralink')
<link rel="stylesheet" href="{{asset('bower_components/select2/dist/css/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('plugins/iCheck/all.css')}}">
<style type="text/css">
.select-editable {
 position:relative;
 background-color:white;
 border:solid grey 1px;
 width:100%;
 height:30px;
}
.select-editable select {
 position:absolute;
 top:0px;
 left:0px;
 font-size:14px;
 border:none;
 width:100%;
 margin:0;
}
.select-editable input {
 position:absolute;
 top:0px;
 left:0px;
 width:100px;
 padding:1px;
 font-size:12px;
 border:none;
}
.select-editable select:focus, .select-editable input:focus {
 outline:none;
}
</style>

<style type="text/css">
/*custom font*/
@import url(https://fonts.googleapis.com/css?family=Montserrat);

/*basic reset*/
* {
  margin: 0;
  padding: 0;
}


/*form styles*/
#msform {
  max-width: 500px;
  text-align: center;
  position: relative;
  margin-top: 0px;
  margin: 0 auto;
}

#msform fieldset {
  background: white;
  border: 0 none;
  border-radius: 0px;
  box-shadow: 0 0 15px 1px rgba(0, 0, 0, 0.4);
  padding: 20px 30px;
  box-sizing: border-box;
  width: 80%;
  margin: 0 10%;

  /*stacking fieldsets above each other*/
  position: relative;
}

/*Hide all except first fieldset*/
#msform fieldset:not(:first-of-type) {
  display: none;
}

/*inputs*/
#msform textarea {
  padding: 15px;
  border: 1px solid #ccc;
  border-radius: 0px;
  margin-bottom: 10px;
  width: 100%;
  box-sizing: border-box;
  font-family: montserrat;
  color: #2C3E50;
  font-size: 13px;
}
.toitoi{
  padding: 15px;
  border: 1px solid #ccc;
  border-radius: 0px;
  margin-bottom: 10px;
  width: 100%;
  box-sizing: border-box;
  font-family: montserrat;
  color: #2C3E50;
  font-size: 13px;
}

.select_with_style{
  padding: 15px;
  border: 1px solid #ccc;
  border-radius: 0px;
  margin-bottom: 10px;
  width: 100%;
  box-sizing: border-box;
  font-family: montserrat;
  color: #2C3E50;
  font-size: 13px;
}
.select2-search__field .select2-search .select2-search--inline{
  width: 418px !important;
}


#msform textarea:focus {
  -moz-box-shadow: none !important;
  -webkit-box-shadow: none !important;
  box-shadow: none !important;
  border: 1px solid #ee0979;
  outline-width: 0;
  transition: All 0.5s ease-in;
  -webkit-transition: All 0.5s ease-in;
  -moz-transition: All 0.5s ease-in;
  -o-transition: All 0.5s ease-in;
}

.toitoi:focus{
  -moz-box-shadow: none !important;
  -webkit-box-shadow: none !important;
  box-shadow: none !important;
  border: 1px solid #ee0979;
  outline-width: 0;
  transition: All 0.5s ease-in;
  -webkit-transition: All 0.5s ease-in;
  -moz-transition: All 0.5s ease-in;
  -o-transition: All 0.5s ease-in;
}

.select2-container--default .select2-selection--multiple .select2-selection__choice{
  color: #000;
}

/*buttons*/
#msform .action-button {
  width: 100px;
  background: #605ca8;
  font-weight: bold;
  color: white;
  border: 0 none;
  border-radius: 25px;
  cursor: pointer;
  padding: 10px 5px;
  margin: 10px 5px;
}

#msform .action-button:hover, #msform .action-button:focus {
  box-shadow: 0 0 0 2px white, 0 0 0 3px #605ca8;
}

#msform .action-button-previous {
  width: 100px;
  background: #C5C5F1;
  font-weight: bold;
  color: white;
  border: 0 none;
  border-radius: 25px;
  cursor: pointer;
  padding: 10px 5px;
  margin: 10px 5px;
}

#msform .action-button-previous:hover, #msform .action-button-previous:focus {
  box-shadow: 0 0 0 2px white, 0 0 0 3px #C5C5F1;
}

/*headings*/
.fs-title {
  font-size: 18px;
  text-transform: uppercase;
  color: #2C3E50;
  margin-bottom: 10px;
  letter-spacing: 2px;
  font-weight: bold;
}

.fs-subtitle {
  font-weight: normal;
  font-size: 13px;
  color: #666;
  margin-bottom: 20px;
}

/*progressbar*/
#progressbar {
  margin-bottom: 30px;
  overflow: hidden;
  /*CSS counters to number the steps*/
  counter-reset: step;
}

#progressbar li {
  list-style-type: none;
  color: white;
  text-transform: uppercase;
  font-size: 9px;
  width: 33.33%;
  float: left;
  position: relative;
  letter-spacing: 1px;
}

#progressbar li:before {
  content: counter(step);
  counter-increment: step;
  width: 24px;
  height: 24px;
  line-height: 26px;
  display: block;
  font-size: 12px;
  color: #333;
  background: white;
  border-radius: 25px;
  margin: 0 auto 10px auto;
  position: relative;
  z-index: 1;
}

/*progressbar connectors*/
#progressbar li:after {
  content: '';
  width: 100%;
  height: 2px;
  background: white;
  position: absolute;
  left: -50%;
  top: 9px;
}

#progressbar li:first-child:after {
  /*connector not needed before the first step*/
  content: none;
}

/*marking active/completed steps green*/
/*The number of the step and the connector before it = green*/
#progressbar li.active:before, #progressbar li.active:after {
  background: #605ca8;;
  color: white;
}


/* Not relevant to this form */
.dme_link {
  margin-top: 30px;
  text-align: center;
}
.dme_link a {
  background: #FFF;
  font-weight: bold;
  color: #ee0979;
  border: 0 none;
  border-radius: 25px;
  cursor: pointer;
  padding: 5px 25px;
  font-size: 12px;
}
</style>
@stop



@section('content')

<div class="content-wrapper">

  <section class="content container-fluid">

    <div class="row">
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
      <div class="">

        <form id="msform" method="post" action="{{route('client.order.create.post')}}">

          {{csrf_field()}}
          <!-- progressbar -->
          <ul id="progressbar">
            <li class="active" style="color: #605ca8">Name</li>
            <li style="color: #605ca8">Test</li>
            <li style="color: #605ca8">Info</li>
          </ul>
          <!-- fieldsets -->
          <fieldset>
            <h3 class="fs-subtitle">Patient Info</h3>
            <select id="patient_select" name="patient_select" class="select_with_style" required>
              <option value="" disabled selected>Select Patient Option</option>
              <option value="self">Self</option>
              <option value="new">New</option>
              @foreach($patients as $patient)
              <option value="{{$patient['patient']}}">{{$patient['patient']}}</option>
              @endforeach
            </select>
            <input class="toitoi" type="text" id="patient" name="patient" placeholder="Name" required/>
            <input class="toitoi" type="number" id="age" name="age" min="0" max="120" placeholder="Age" required/>
            <select id="sex" name="sex" class="select_with_style" required>
              <option value="male">Male</option>
              <option value="female">Female</option>
              <option value="other">Other</option>
            </select>
            <input type="button" name="next" class="next action-button" value="Next"/>
          </fieldset>
          <fieldset>
            <h3 class="fs-subtitle">Tests</h3>
            <div class="form-group">
              <select class="form-control select2" multiple="multiple" id="opciones" name="tests[]" data-placeholder="Select tests"
              style="width: 100%;">
              @foreach($tests as $test)
              <option value="{{$test['id']}}">{{$test['test']}}-BDT {{$test['price']}} </option>
              @endforeach
            </select>
          </div>
          <input type="button" name="previous" class="toitoi previous action-button-previous" value="Previous"/>
          <input type="button" name="next" class="toitoi next action-button" value="Next"/>
        </fieldset>
        <fieldset>
          <h3 class="fs-subtitle">Contact</h3>
          <input type="text" id="phone" name="phone" class="toitoi" placeholder="Phone" required/>
          <textarea name="address" id="address" placeholder="Address" required></textarea>
          <input type="button" name="previous" class="previous action-button-previous" value="Previous"/>
          <input type="submit" name="submit" class="submit action-button" value="Submit Order"/>
        </fieldset>
      </form>
      <!-- link to designify.me code snippets -->
      <!-- /.link to designify.me code snippets -->
    </div>
  </div>  


</section>
</div>
@stop

@section('extrascript')
<script src="{{asset('bower_components/select2/dist/js/select2.full.min.js')}}"></script>
<script src="{{asset('plugins/iCheck/icheck.min.js')}}"></script>
<script src="{{asset('firstpage/lib/easing/easing.min.js')}}"></script>
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
<script type="text/javascript">
      //jQuery time
var current_fs, next_fs, previous_fs; //fieldsets
var left, opacity, scale; //fieldset properties which we will animate
var animating; //flag to prevent quick multi-click glitches

$(".next").click(function(){
  if(animating) return false;
  animating = true;

  current_fs = $(this).parent();
  next_fs = $(this).parent().next();

    //activate next step on progressbar using the index of next_fs
    $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
    
    //show the next fieldset
    next_fs.show(); 
    //hide the current fieldset with style
    current_fs.animate({opacity: 0}, {
      step: function(now, mx) {
            //as the opacity of current_fs reduces to 0 - stored in "now"
            //1. scale current_fs down to 80%
            scale = 1 - (1 - now) * 0.2;
            //2. bring next_fs from the right(50%)
            left = (now * 50)+"%";
            //3. increase opacity of next_fs to 1 as it moves in
            opacity = 1 - now;
            current_fs.css({
              'transform': 'scale('+scale+')',
              'position': 'absolute'
            });
            next_fs.css({'left': left, 'opacity': opacity});
          }, 
          duration: 800, 
          complete: function(){
            current_fs.hide();
            animating = false;
          }, 
        //this comes from the custom easing plugin
        easing: 'easeInOutBack'
      });
  });

$(".previous").click(function(){
  if(animating) return false;
  animating = true;

  current_fs = $(this).parent();
  previous_fs = $(this).parent().prev();

    //de-activate current step on progressbar
    $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");
    
    //show the previous fieldset
    previous_fs.show(); 
    //hide the current fieldset with style
    current_fs.animate({opacity: 0}, {
      step: function(now, mx) {
            //as the opacity of current_fs reduces to 0 - stored in "now"
            //1. scale previous_fs from 80% to 100%
            scale = 0.8 + (1 - now) * 0.2;
            //2. take current_fs to the right(50%) - from 0%
            left = ((1-now) * 50)+"%";
            //3. increase opacity of previous_fs to 1 as it moves in
            opacity = 1 - now;
            current_fs.css({'left': left});
            previous_fs.css({'transform': 'scale('+scale+')', 'opacity': opacity});
          }, 
          duration: 800, 
          complete: function(){
            current_fs.hide();
            animating = false;
            previous_fs.css({'position': 'relative'});
          }, 
        //this comes from the custom easing plugin
        easing: 'easeInOutBack'
      });
  });
</script>

<script type="text/javascript">
  var select = document.getElementById('patient_select');
  var patient_array = <?php echo json_encode($patients) ?>;
  console.log(patient_array);
  var user=<?php echo json_encode($user) ?>;
  select.addEventListener('change', function () {
    var selected=select.options[select.selectedIndex].value;
    var patient=document.getElementById('patient');
    var age=document.getElementById('age');
    var sex=document.getElementById('sex');
    if(selected=='self'){
      patient.value=user['name'];
      age.value=user['age'];
      sex.value=user['sex'];
      phone.value=user['phone'];
      address.value=user['address'];
    }
    else if (selected=='new') {
      patient.value="";
      age.value="";
      phone.value=user['phone'];
      sex.value="male";
      address.value=user['address'];
    }
    else if(selected!=''){
      for(var i=0;i<=patient_array.length;i++){
        if(selected==patient_array[i]['patient']){
          patient.value=patient_array[i]['patient'];
          age.value=patient_array[i]['age'];
          sex.value=patient_array[i]['sex'];
          phone.value=patient_array[i]['phone'];
          address.value=patient_array[i]['address'];
          break;
        }
      }
    }
    

  });
</script>
@stop
