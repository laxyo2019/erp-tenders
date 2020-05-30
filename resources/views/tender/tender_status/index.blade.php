@extends('layouts.master')
@section('content')
	<main class="app-content">
		<div class="app-title">
			<div class="div">
				<h1><i class="fa fa-laptop"></i> Tender Status</h1>
			</div>
			<ul class="app-breadcrumb breadcrumb">
				<span class="ml-2">
					<a href="{{route('tender_status.create')}}" class="btn btn-outline-success" style="font-size: 13px">
					<span class="fa fa-plus"></span> Add New</a>
					</span>		
			</ul>
		</div>
		@if($message = Session::get('success'))
			<div class="alert alert-success">
				{{$message}}
			</div>
		@endif 
		@if($message = Session::get('error'))
			<div class="alert alert-danger">
				{{$message}}
			</div>
		@endif 
		<div class="row ">
			<div class="col-md-2 col-xl-2"></div>
			<div class="col-md-8 col-xl-8">
				<div class="card shadow-xs">
					
					<div class="card-body table-responsive">
						<table class="table table-striped table-bordered">
							<thead>
								<tr>
									<th>ID</th>
									<th>Name</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
							<?php $count = 0; ?>	
							@foreach($data as $status)
							<tr>
								<td>{{++$count}}</td>
								<td>{{$status->name}}</td>								
								<td class="d-flex text-center">
									<a href="{{route('tender_status.edit',$status->id)}}" class="btn btn-sm btn-outline-warning"><i class="fa fa-edit"></i> Edit</a>

									<a href="{{route('deletestatus',$status->id)}}" class="btn btn-sm btn-outline-danger"><i class="fa fa-trash"></i>Delete</a>
								</td>
							</tr>
							@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<div class="col-md-2 col-xl-2"></div>
		</div>

	</main>
@endsection