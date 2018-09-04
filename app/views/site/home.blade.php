@extends('layouts.master')

@section('title')
@parent
| Home
@stop

@section('content')
<div class="rotating-banner">
	<div class="container">
		<div class="about-us-one">
			<div class="row">
				<div class="col-sm-9">
					<h2>Virtual Chicago ARTCC</h2>
					<p>Welcome to the Chicago ARTCC website. Chicago ARTCC provides ATC Services for Chicago O'Hare, the world's 2nd busiest 
					airport and features a Class Bravo airport, Chicago O'Hare (KORD) as well as several Class Charlies and is a short hop away
					way from popular destinations like Saint Louis, Minneapolis, New York and Washington D.C. Come fly with us, and enjoy the 
					challenges or come control with us and join our training program! <strong>At no time, however, should a procedure, chart, or other information contained on this website be used
						for real world navigation.</strong>
					</p>
				</div>
				<div class="col-sm-3 online-sectors">
					<table class="table table-condensed">
						<tr>
							<th width="40%">Enroute</th>
							<td width="60%" class="<?= !empty($online->getCenter()) ? 'online' : 'offline' ?>">
								<span>
									@if(!empty($online->getCenter()))
									ONLINE
									@else
									OFFLINE
									@endif
								</span>
							</td>
						</tr>
						<tr>
							<th>F11 Tracon</th>
							<td class="<?= !empty($online->getF11()) ? 'online' : 'offline' ?>">
								<span>
									@if(!empty($online->getF11()))
									ONLINE
									@else
									OFFLINE
									@endif
								</span>
							</td>
						</tr>
						<tr>
							<th>MCO ATCT</th>
							<td class="<?= !empty($online->getMCO()) ? 'online' : 'offline' ?>">
								<span>
									@if(!empty($online->getMCO()))
									<?= implode("/", $online->getMCO()) ?>
									@else
									OFFLINE
									@endif
								</span>
							</td>
						</tr>
						<tr>
							<th>JAX ATCT</th>
							<td class="<?= !empty($online->getJAX()) ? 'online' : 'offline' ?>">
								<span>
									@if(!empty($online->getJAX()))
									<?= implode("/", $online->getJAX()) ?>
									@else
									OFFLINE
									@endif
								</span>
							</td>
						</tr>
						<tr>
							<th>CHS ATCT</th>
							<td class="<?= !empty($online->getCHS()) ? 'online' : 'offline' ?>">
								<span>
									@if(!empty($online->getCHS()))
									<?= implode("/", $online->getCHS()) ?>
									@else
									OFFLINE
									@endif
								</span>
							</td>
						</tr>
						<tr>
							<th>DAB ATCT</th>
							<td class="<?= !empty($online->getDAB()) ? 'online' : 'offline' ?>">
								<span>
									@if(!empty($online->getDAB()))
									<?= implode("/", $online->getDAB()) ?>
									@else
									OFFLINE
									@endif
								</span>
							</td>
						</tr>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="container">
		@if($announcements)
		<br />
			@foreach($announcements as $announcements)
				@if($announcements->class == 1)
				<div class="alert alert-success" role="alert">{{$announcements->message}}<p><b>{{$announcements->admin->full_name}}</b></div>
				@elseif($announcements->class == 2)
				<div class="alert alert-warning" role="alert">{{$announcements->message}}<p><b>{{$announcements->admin->full_name}}</b></div>
				@elseif($announcements->class == 3)
				<div class="alert alert-danger" role="alert">{{$announcements->message}}<p><b>{{$announcements->admin->full_name}}</b></div>
				@endif
			@endforeach
		<div class="divider-1"></div>
		@endif
	<div class="row">
		<div class="col">
			<h2><i class="fa fa-calendar"></i> Events</h2>
			@forelse ($events as $e)
				@if($e->banner_link == '')
				<h5><a href="/event/{{{$e->id}}}">{{{$e->title}}}</a></h5>
				@else
				<p><a href="/event/{{{$e->id}}}"><img width="100%" src="{{{$e->banner_link}}}"></a></p>
				@endif
			@empty
				<p>No Events Scheduled</p>
			@endforelse
		</div>
	</div>
	<div class="divider-1"></div>


	<div class="row" id="tableData">
		<div class="col-md-6 weather">
			<h2><i class="fa fa-cloud"></i> Weather</h2>
			<center><h2><i class="fa fa-refresh fa-spin"></i></h2></center>
		</div>
		<div class="col-md-6">
			<h2><i class="fa fa-search"></i> Who's Online?</h2>
			<center><h2><i class="fa fa-refresh fa-spin"></i></h2></center>
		</div>
	</div>
	<div class="divider-1"></div>
	<div class="row">
		<div class="col-md-6">
			<h2>Top 5 Last Month</h2>
			<div class="table-responsive">
				<table class="table table-bordered text-center">
					<thead>
						<th><center>Name</center></th>
						<th><center>Time</center></th>
					</thead>
					<tbody>
						@foreach($lastTop5 as $controller)
						<tr>
							<td>{{{ $controller->first_name . " " . $controller->last_name }}}</td>
							<td>{{{ $controller->duration_time }}}
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
		<div class="col-md-6">
			<h2>Top 5 Current Month</h2>
			<div class="table-responsive">
				<table class="table table-bordered text-center">
					<thead>
						<th><center>Name</center></th>
						<th><center>Time</center></th>
					</thead>
					<tbody>
						@foreach($currentTop5 as $controller)
						<tr>
							<td>{{{ $controller->first_name . " " . $controller->last_name }}}</td>
							<td>{{{ $controller->duration_time }}}
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<script src="/assets/front/tables.js"></script>

@stop
