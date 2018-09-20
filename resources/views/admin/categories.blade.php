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
           <div class="col-md-6" style="margin: 40px">
            <form action="{{route('admin.category')}}" method="post">
             {{csrf_field()}}
             <h4>Add Category</h4>
            <div>
              <input type="text" name="category" class="form-control"  placeholder="category">  <br \>
            </div>
          
          <button type="submit" class="btn btn-primary">Add</button>
          
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
                <th>Category ID</th>
                <th>Category</th>
              </tr>

              @foreach($categories as $category)
              <tr>
                <td>{{$category['id']}}</td>
                <td>{{$category['category']}}</td>
              </tr>
              @endforeach
            </table>
            {{$categories->links()}}
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