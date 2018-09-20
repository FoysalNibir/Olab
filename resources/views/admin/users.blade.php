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

          <!-- /.box-header -->
          <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
              <form action="{{route('admin.users')}}">
              <tr>
                <td></td>
                <td> <input type="text" placeholder="name" name="name" @if(isset($inputs['name'])) value="{{$inputs['name']}}" @endif> </td>
                <td> <input type="text" placeholder="phone" name="phone" @if(isset($inputs['phone'])) value="{{$inputs['phone']}}" @endif></td>
                <td> <input type="text" placeholder="email" name="email" @if(isset($inputs['email'])) value="{{$inputs['email']}}" @endif></td>
                <td>
                  <select id="sex" name="sex" class="select_with_style">
                    <option value=""></option>
                    <option @if(isset($inputs['sex']) && ($inputs['sex']=='male')) selected @endif value="male">Male</option>
                    <option @if(isset($inputs['sex']) && ($inputs['sex']=='female')) selected @endif value="female">Female</option>
                    <option @if(isset($inputs['sex']) && ($inputs['sex']=='other')) selected @endif value="other">Other</option>
                  </select>
                </td>
                <td><input type="text" placeholder="age" name="age" @if(isset($inputs['age'])) value="{{$inputs['age']}}" @endif></td>
                <td><input type="text" placeholder="address" name="address" @if(isset($inputs['address'])) value="{{$inputs['address']}}" @endif"></td>
                <td>
                  <select id="blood_group" name="blood_group" class="select_with_style">
                    <option value=""></option>
                    <option @if(isset($inputs['blood_group']) && ($inputs['blood_group']=='A+')) selected @endif value="A+">A+</option>
                    <option @if(isset($inputs['blood_group']) && ($inputs['blood_group']=='A-')) selected @endif value="A-">A-</option>
                    <option @if(isset($inputs['blood_group']) && ($inputs['blood_group']=='B+')) selected @endif value="B+">B+</option>
                    <option @if(isset($inputs['blood_group']) && ($inputs['blood_group']=='B-')) selected @endif value="B-">B-</option>
                    <option @if(isset($inputs['blood_group']) && ($inputs['blood_group']=='AB+')) selected @endif value="AB+">AB+</option>
                    <option @if(isset($inputs['blood_group']) && ($inputs['blood_group']=='AB-')) selected @endif value="AB-">AB-</option>
                    <option @if(isset($inputs['blood_group']) && ($inputs['blood_group']=='O+')) selected @endif value="O+">O+</option>
                    <option @if(isset($inputs['blood_group']) && ($inputs['blood_group']=='O-')) selected @endif value="O-">O-</option>
                  </select>
                </td>
                <td>
                  <select id="user_type" name="user_type" class="select_with_style">
                    <option value=""></option>
                    @foreach($usertypes as $usertype)
                    <option @if(isset($inputs['user_type']) && ($inputs['user_type']==$usertype['id'])) selected @endif value="{{$usertype['id']}}">{{$usertype['type']}}</option>
                    @endforeach
                  </select>
                  
                </td>
                <td><input class="btn btn-primary btn-sm ad-click-event" value="Filter" type="submit" /></td>
              </tr>
              </form>
             
              <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Sex</th>
                <th>Age</th>
                <th>Address</th>
                <th>Blood Group</th>
                <th>Roles</th>
                <th>Action</th>
              </tr>
              


              @foreach($users as $user)
              <tr>
                <td>{{$user['id']}}</td>
                <td>{{$user['name']}}</td>
                <td>{{$user['phone']}}</td>
                <td>{{$user['email']}}</td>
                <td>{{$user['sex']}}</td>
                <td>{{$user['age']}}</td>
                <td>{{$user['address']}}</td>
                <td>{{$user['blood_group']}}</td>
                <td>
                  @foreach($user['usertypes'] as $usertype)
                    {{$usertype['type']}} ,
                  @endforeach
                </td>
                <td><a href="{{route('admin.user.usertype', $user['id'])}}" class="btn btn-info btn-sm ad-click-event">Edit Role</a></td>
                @if($user['ban']==0)
                <td><a href="{{route('admin.userban',$user['id'])}}" class="btn btn-danger btn-sm ad-click-event">Ban</a></td>
                @else
                <td><a href="{{route('admin.userunban',$user['id'])}}" class="btn btn-warning btn-sm ad-click-event">Unban</a></td>
                @endif
              </tr>
              @endforeach
            </table>
            {{$users->appends(Illuminate\Support\Facades\Input::except('page'))->links()}}
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
