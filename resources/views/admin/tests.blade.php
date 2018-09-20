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
            <form action="{{route('admin.test.post')}}" method="post">
             {{csrf_field()}}
             <h4>Add New Test</h4>
             
            <div class="form-group">
              <select class="form-control select2" name="category_id" data-placeholder="roles"
              style="width: 100%;">
              @foreach($categories as $category)
              <option value="{{$category['id']}}">{{$category['category']}}</option>
              @endforeach
            </select>
            </div>
            <div>
              <input type="text" name="test" class="form-control"  placeholder="test"> <br \>
            </div>
            <div>
              <input type="number" name="price" class="form-control"  placeholder="price">  <br \>
            </div>
          
          <button type="submit" class="btn btn-primary">Add</button>
          
        </form>
      </div>

      <div class="col-md-4" style="margin: 40px">
            <form action="{{route('admin.test.update')}}" method="post">
             {{csrf_field()}}
             <h4>Update Test Price</h4>
             
            <div class="form-group">
              <select class="form-control select2" name="id" data-placeholder="roles"
              style="width: 100%;">
              @foreach($tests as $test)
              <option value="{{$test['id']}}">{{$test['test']}}</option>
              @endforeach
            </select>
            </div>
            <div>
              <input type="number" name="price" class="form-control"  placeholder="price">  <br \>
            </div>
          
          <button type="submit" class="btn btn-primary">Update</button>
          
        </form>
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
                <th>Test ID</th>
                <th>Test</th>
                <th>Price</th>
                <th>Category</th>
                <th>Action</th>
              </tr>

              @foreach($tests as $test)
              <tr>
                <td>{{$test['id']}}</td>
                <td>{{$test['test']}}</td>
                <td>{{$test['price']}}</td>
                <td>{{$test['category']->category}}</td>
                <td>
                @if($test['active']==0)
                <a href="{{route('admin.test.enable',$test['id'])}}" class="btn btn-success btn-sm ad-click-event">Enable</a>
                @else
                <a href="{{route('admin.test.disable',$test['id'])}}" class="btn btn-warning btn-sm ad-click-event">Disable</a>
                @endif
                <a href="{{route('admin.test.delete',$test['id'])}}" class="btn btn-danger btn-sm ad-click-event">Delete</a>
                </td>
              </tr>
              @endforeach
            </table>
            {{$tests->links()}}
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