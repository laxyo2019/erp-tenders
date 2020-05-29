@extends('layouts.master')

@section('content')

<?php
function display_priority_text($int){
	switch($int){
		case 1:
			return 'Very Low';
			break;
		case 2:
			return 'Low';
			break;
		case 3:
			return 'Medium';
			break;
		case 4:
			return 'High';
			break;
		case 5:
			return 'Very High';
			break;
	}
}
function display_priority_class($int){
	switch($int){
		case 1:
			return 'bg-dark';
			break;
		case 2:
			return 'bg-secondary';
			break;
		case 3:
			return 'bg-info';
			break;
		case 4:
			return 'bg-warning';
			break;
		case 5:
			return 'bg-danger';
			break;
	}
}
?>
	<main class="app-content">
		<div class="app-title">
			<div class="div">
				<h1><i class="fa fa-laptop"></i> Tenders BOQ Creation</h1>
			</div>			
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
		<div class="row">
			<div class="col-md-12 col-xl-12">
				<div class="card shadow-xs">
					
					<div class="card-body table-responsive">
						<table class="table table-striped table-hover">
							<thead>
								<tr class="text-center">
									<th>Tender No.</th>
									<th>Name</th>
									<th>Category</th>
									<th>Type</th>
									<th>Publish Date</th>
									<th>Priority</th>
									<th>Action</th>									
								</tr>
							</thead>
							<tbody>
								<?php $count = 0; ?>
								@foreach($data as $row)
									<tr class="text-center">
										<td>{{++$count}}</td>
										<td>{{$row->title}}</td>
										<td>{{$row->category->name}}</td>
										<td>{{$row->type->name}}</td>
										<td>{{$row->allotment_status}}</td>
										<td>{{$row->created_at}}</td>							
										<td class="d-flex">
											<span>
												<a href="{{route('tender_boq.edit',$row->id)}}" class="btn btn-sm btn-outline-primary">Create BOQ</a>
											</span>									
										</td>
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>

	</main>
@endsection

@push('scripts')
	<script src="{{ asset('themes/vali/js/plugins/bootstrap-datepicker.min.js') }}"></script>
	<script>
		$('#demoDate1').datepicker({
			format: "dd/mm/yyyy",
			autoclose: true,
			todayHighlight: true
		});
		$('#demoDate2').datepicker({
			format: "dd/mm/yyyy",
			autoclose: true,
			todayHighlight: true
		});
	</script>
@endpush