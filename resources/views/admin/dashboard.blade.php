@extends('layout')
@section('content')

<div class="content-wrapper">
	<!-- Content Header (Page header) -->


	<!-- Main content -->
	<section class="content">
		<!-- Info boxes -->
		<div class="row">
			<div class="col-lg-3 col-xs-6">
				<!-- small box -->
				<div class="small-box bg-aqua">
					<div class="inner">
						<h3>{{$orders}}</h3>

						<p>Orders</p>
					</div>
					<div class="icon">
						<i class="ion ion-bag"></i>
					</div>

				</div>
			</div>
			<!-- ./col -->
			<div class="col-lg-3 col-xs-6">
				<!-- small box -->
				<div class="small-box bg-green">
					<div class="inner">
						<h3>{{$delivered}}</h3>

						<p>Delivered</p>
					</div>
					<div class="icon">
						<i class="ion ion-stats-bars"></i>
					</div>

				</div>
			</div>
			<!-- ./col -->
			<div class="col-lg-3 col-xs-6">
				<!-- small box -->
				<div class="small-box bg-yellow">
					<div class="inner">
						<h3>{{$clients['users_count']}}</h3>

						<p>Clients</p>
					</div>
					<div class="icon">
						<i class="ion ion-person-add"></i>
					</div>

				</div>
			</div>
			<!-- ./col -->
			<div class="col-lg-3 col-xs-6">
				<!-- small box -->
				<div class="small-box bg-red">
					<div class="inner">
						<h3>{{$tests}}</h3>

						<p>Tests</p>
					</div>
					<div class="icon">
						<i class="ion ion-pie-graph"></i>
					</div>

				</div>
			</div>
		</div>

		<div class="row">
			
			<!-- ./col -->
		
			<div class="col-lg-3 col-xs-6">
				<!-- small box -->
				<div class="small-box bg-navy">
					<div class="inner">
						<h3>{{$call_missed}}</h3>

						<p>Call Misssed</p>
					</div>
					<div class="icon">
						<i class="fa fa-bell-slash-o"></i>
					</div>

				</div>
			</div>
			<!-- ./col -->
			<div class="col-lg-3 col-xs-6">
				<!-- small box -->
				<div class="small-box bg-teal">
					<div class="inner">
						<h3>{{$inlab}}</h3>

						<p>In Lab</p>
					</div>
					<div class="icon">
						<i class="fa fa-briefcase"></i>
					</div>

				</div>
			</div>
			<div class="col-lg-3 col-xs-6">
				<!-- small box -->
				<div class="small-box bg-maroon">
					<div class="inner">
						<h3>{{$pending}}</h3>

						<p>Pending</p>
					</div>
					<div class="icon">
						<i class="fa fa-cloud-download"></i>
					</div>

				</div>
			</div>
			<!-- ./col -->
				<div class="col-lg-3 col-xs-6">
				<!-- small box -->
				<div class="small-box bg-purple">
					<div class="inner">
						<h3>{{$field}}</h3>

						<p>Field</p>
					</div>
					<div class="icon">
						<i class="fa fa-truck"></i>
					</div>

				</div>
			</div>
			
		</div>
	
		
	</section>



	@stop