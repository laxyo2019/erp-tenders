@extends('layouts.master')
@section('content')
	<main class="app-content">
		<div class="row">
			<div class="col-md-12 col-xl-12">
				<h1 style="font-size: 20px">Add Item</h1>
				<hr>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 col-xl-12">
				<div class="card shadow-xs">
					<div class="card-body">
							<a href="{{route('tender_item.index')}}" style="color: white;background-color: #607fd7;" class="btn btn-sm btn-outline-default float-right">Back</a>
						<form action="{{route('tender_item.update',$data->id)}}" method="post">
							@csrf
							@method('PATCH')
							<div class="row form-group">
								<div class="col-md-4 col-lg-4 col-xl-4 mt-2 offset-4">
									<label for="name"><b>Name <span class="text-danger">*</span></b> </label>
														
										<input type="text" name="name" class="form-control" value="{{old('name') ?? $data->name}}">
										@error('name')
					                    <span class="text-danger" role="alert">
					                        <strong>{{ $message }}</strong>
					                    </span>
					                	@enderror								
								</div>

								<div class="col-md-4 col-lg-4 col-xl-4 mt-2 offset-4">
									<label for="name"><b>Unit Name <span class="text-danger">*</span></b> </label>
									<select name="unit_id" class="form-control">
										<option><-- Select --></option>
										@foreach($unit as $units)
											<option value ="{{$units->id}}" <?php if ($units->id == $data->unit_id){ echo 'selected'; } ?> >{{$units->name}}</option>
										@endforeach	
									</select>			
										
									@error('unit_id')
				                    <span class="text-danger" role="alert">
				                        <strong>{{ $message }}</strong>
				                    </span>
				                	@enderror								
								</div>									
							
								<div class="col-md-4 col-lg-4 col-xl-4 mt-2 offset-4">
									<label for="name"><b>Remarks</b> </label>
									<textarea class="form-control" name="remarks" id="" cols="30" rows="5">{{$data->remarks}}</textarea>
									@error('remarks')
				                    <span class="text-danger" role="alert">
				                        <strong>{{ $message }}</strong>
				                    </span>
				                	@enderror
								</div>										
							</div>
							<div class="col-md-12 mt-3 text-center">
								<button class="btn btn-md btn-success" type="submit"><span class="fa fa-save"></span> Submit</button>
								<span class="ml-2" ><a href="{{route('tender_item.index')}}" class="btn btn-md btn-default" style="background-color: #f4f4f4;color: #444;    border-color: #ddd;"><span class="fa fa-times-circle"></span> Cancel</a></span>
							</div>
							</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</main>
@endsection