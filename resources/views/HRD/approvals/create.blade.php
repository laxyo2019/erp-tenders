@extends('layouts.master')
@section('content')
	<main class="app-content">
		<div class="row">
			<div class="col-md-12 col-xl-12">
				<h1 style="font-size: 20px">Add Stage For Approval</h1>
				<hr>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 col-xl-12">
				<div class="card shadow-xs">
					<div class="card-body">
						<form action="{{route('approvals.store')}}" method="post">
							@csrf
							<div class="row">
						{{--<div class="col-4 form-group">
							<label for="activity">Activity</label>
							<select name="activity" id="activity" class="form-control">
								<option value=""> Select activity </option>
								@foreach($activities as $activity)
								<option value="{{$activity->id}}">{{$activity->name}}</option>
								@endforeach
							</select>
							@error('activity')
							<span class="text-danger" role="alert">
								<strong>* {{ $message }}</strong>
							</span>
							@enderror
						</div>--}}
					<div class="col-5 form-group">
						<label for="">Title</label>
						<input type="text" class="form-control" name="title" value="{{ old('title') }}">
						@error('title')
				          <span class="text-danger" role="alert">
				            <strong>* {{ $message }}</strong>
				          </span>
				      	@enderror
					</div>
					{{-- <div class="col-4 form-group">
						<label for="">Nominee's Aadhaar no.</label>
						<input type="text" class="form-control" name="aadhaar_no" value="{{ old('aadhaar_no') }}">
						@error('aadhaar_no')
		          <span class="text-danger" role="alert">
		            <strong>* {{ $message }}</strong>
		          </span>
		      	@enderror
					</div> --}}
					<div class="col-4 form-group">
						<label for="departments">Select department</label>
						<select name="departments" id="departments" class="form-control">
							<option value="">Department</option>
							@foreach($department as $departments)
							<option value="{{$departments->id}}">{{$departments->name}}</option>
							@endforeach
						</select>
						@error('departments')
						<span class="text-danger" role="alert">
							<strong>* {{ $message }}</strong>
						</span>
						@enderror
					</div>
						<div class="col-4">
						<div class="form-group">
							<label for="">Employee</label>
							<input type="text" class="form-control" name="relation" value="{{ old('relation') }}">
							@error('relation')
				          <span class="text-danger" role="alert">
				            <strong>* {{ $message }}</strong>
				          </span>
			      			@enderror
						</div>
					</div>
					<div class="col-12 form-group text-center">
						<button class="btn btn-info btn-sm">Update</button>
						<a class="btn btn-danger btn-sm" href="javascript:location.reload()">Cancel</a>
						</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</main>
@endsection