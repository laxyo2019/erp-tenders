@extends('layouts.master')
@section('content')

	<main class="app-content">
		<div class="row">
			<div class="col-md-12 col-xl-12">
				<h1 style="font-size: 20px">Edit Tender type</h1>
				<hr>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 col-xl-12">
				<div class="card shadow-xs">
					<div class="card-body">
						<a href="{{route('tender_category.index')}}" style="color: white;background-color: #607fd7;" class="btn btn-sm btn-outline-default float-right">Back</a>
						<form action="{{route('tender_category.update', ['id'=>$tender_category->id])}}" method="post">
							@csrf
							@method('PATCH')
							<div class="row form-group">
									<div class="col-md-6 col-lg-6 col-xl-6 mt-2 offset-3">
										<label for="name"><b>Title <span class="text-danger">*</span></b> </label>
										<div class="input-group">
											<div class="input-group-prepend">
												<span class="input-group-text">
													<i class="fa fa-id-card-o"></i>	
												</span>
											</div>
											<input type="text" name="name" class="form-control" value="{{old('name',$tender_category->name)}}">
										</div>
										@error('name')
						                    <span class="text-danger" role="alert">
						                        <strong>{{ $message }}</strong>
						                    </span>
						                @enderror
									</div>
									<div class="col-md-6 col-lg-6 col-xl-6 mt-2 offset-3">
										<label for="name"><b>Description <span class="text-danger">*</span></b> </label>
										<div class="input-group">
											<div class="input-group-prepend">
												<span class="input-group-text">
													<i class="fa fa-asterisk"></i>	
												</span>
											</div>
											<textarea class="form-control" name="description" id="" cols="30" rows="5">{{old('description',$tender_category->description)}}</textarea>
										</div>
										@error('description')
						                    <span class="text-danger" role="alert">
						                        <strong>{{ $message }}</strong>
						                    </span>
						                @enderror
									</div>
									<div class="col-md-12 mt-3 text-center">
										<input type="hidden" name="grp_code" value="1">
										<button class="btn btn-md btn-success" type="submit"><span class="fa fa-save"></span> Submit</button>
										<span class="ml-2" ><a href="{{route('tender_category.index')}}" class="btn btn-md btn-default" style="background-color: #f4f4f4;color: #444;    border-color: #ddd;"><span class="fa fa-times-circle"></span> Cancel</a></span>
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