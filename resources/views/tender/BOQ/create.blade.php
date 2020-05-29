<script src="{{ asset('js/jquery.validate.js') }}"></script>
@extends('layouts.master')

@section('content')
	<main class="app-content">
		<div class="app-title">
			<div class="div">
				<h1><i class="fa fa-laptop"></i> Tenders BOQ Creation</h1>
			</div>
			<ul class="app-breadcrumb breadcrumb">
				<span class="ml-2">
					<a class="btn btn-outline-success" id="add_item">
						<span class="fa fa-plus"></span> Add New Item
					</a>
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
		<form id="form">
			@csrf
		<div id="item_form" style="display: none;" class="mb-5">
			<div class="row">
			    <div class="col-3 form-group ">
			    	<label>Item</label>
					<select class="form-control" name="item_id" id="item_id">
						<option>Select</option>
						@foreach($item as $Item)
							<option value="{{$Item->id}}">{{$Item->title}} {{$Item->item_number}}</option>
						@endforeach
					</select>
			    </div>
			    <div class="col-3 form-group">
			    	<label>UOM</label>
					<select class="form-control" name="uom_id" id="uom_id">
						<option>Select</option>
						@foreach($uom as $UOM)
							<option value="{{$UOM->id}}">{{$UOM->name}}</option>
						@endforeach
					</select>
			    </div>
			    <div class="col-3 form-group">
			    	<label>Quantity</label>
					<input name="quantit" class="form-control quantity">
			    </div>
			    <div class="col-3 form-group">
			    	<label>Rate</label><br>
					<input  name="rate" class="form-control rate">
			    </div>
			    <div class="col-3 form-group">
			    	<label>Total</label><br>
					<input readonly="true" id="total" name="amount" class="form-control">
			    </div>
			</div>
			<div class="row">
			    <div class="col-sm-6 form-group">
			    	<label>Remark</label>
					<textarea name="remark" id="remark" class="form-control"></textarea>							
				</div>
			    <div class="col-sm-6 form-group">
			    	<label>Item Description</label>
					<textarea name="item_desc" id="item_desc" class="form-control"></textarea>					
					<input type="hidden" value="{{$id}}" name="tender_id">
				</div>	
			</div>		
			<div class="row">
				<div class="col-sm-12">
					<input type="hidden" id="update_id" value="">
					<button id="submitform" class="btn btn-success">Save</button>
				</div>
			</div>
		</div>	
		</form>
		<div class="row">		
			<div class="col-md-12 col-xl-12">
				<div class="card shadow-xs">					
					<div class="card-body table-responsive">
						<table class="table table-striped table-hover">
							<thead>
								<tr class="text-center">
									<th>SN.</th>
									<th>Item Name</th>
									<th>Item Code</th>
									<th>Item Description</th>
									<th>UOM</th>
									<th>Item Quantity</th>
									<th>Item Rate</th>
									<th>Amount</th>									
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php $count = 0; ?>
								@foreach($data as $Data)
									<tr>
										<td>{{++$count}}</td>
										<td>{{$Data->item->title}}</td>
										<td>{{$Data->item->item_number}}</td>
										<td>{{$Data->item_desc}}</td>
										<td>{{$Data->uom->name}}</td>
										<td>{{$Data->quantit}}</td>
										<td>{{$Data->rate}}</td>
										<td>{{$Data->amount}}</td>
										<td>
											<a class="fa fa-pencil text-success" onclick="edit({{$Data->id}} )"></a>
											<a onclick="deleted({{$Data->id}})" class="fa fa-trash text-danger"></a>
										</td>
									</tr>
								@endforeach
							</tbody>
						</table>						
					</div>
					<div class="row">
						<div class="col-sm-12 mb-4 ">
							<hr>
							<div style="float: right;padding-right: 10px;"><b>Total=</b>{{$sum}}</div>
						</div>
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

		$(document).on('click','#add_item',function(){
			$('#item_form').toggle()
		})

		$(document).on('change','.quantity,.rate',function(){
			let qty  = $('.quantity').val()
			let rate = $('.rate').val()		
			$('#total').val(rate * qty)
		})

		function edit(id){
						
			$.ajax({
				type:'get',
				url:'/edit_boq/'+id,				
				success:function(res){
					$('#item_form').toggle()
					$('html,body').animate({scrollTop: 0}, 1500);
					$('#item_id option').filter('[value='+res.item_id+']').attr('selected', true);	
					$('#uom_id option').filter('[value='+res.uom_id+']').attr('selected', true);	
					$('.quantity').val(res.quantit)
					$('.rate').val(res.rate)
					$('#total').val(res.amount)
					$('#item_desc').text(res.item_desc)
					$('#remark').text(res.remark)
					$('#update_id').val(res.id)
				}
			})
		}

		function deleted(id){
			$.ajax({
				method:'GET',
				url:'/delete_boq/'+id,
				success:function(data){
					location.reload()
				}
			})
		}

$('label.required').append('&nbsp;<strong class="text-danger">*</strong>&nbsp;');
var form = $("#form");

form.validate({   
    rules: {
		item_id:{
			required: true,
      		number: true,

		},
		uom_id:{
			required:true,
      		number: true,

		},
		quantit:{
			required: true,
      		number: true,
		},
		quantit:{
			required: true,
      		number: true,
		},
		remark:{
			required:true
		},
		item_desc:{
			required:true
		},		
    },
	messages: {
	},
	errorElement: "em",
	errorPlacement: function errorPlacement(error, element) { 
		element.after(error);
		error.addClass( "help-block" );

	 },
	highlight: function ( element, errorClass, validClass ) {
		$( element ).parents( ".form-group" ).addClass( "has-error" ).removeClass( "has-success" );
	},
	unhighlight: function (element, errorClass, validClass) {
		$( element ).parents( ".form-group" ).addClass( "has-success" ).removeClass( "has-error" );
	},
	submitHandler: function (form) {        
			let uid = $('#update_id').val()	       
			if(uid==''){
		        $.ajax({
	                 url: "{{route('tender_boq.store')}}",
	                 type: 'POST',                 
	                 data: $('#form').serialize(),
	                 success: function (data) {
	                 	location.reload()                	
	                }
		       })
		    }
		    else{
		    	$.ajax({
	                 url: "/tender_boq/"+uid,
	                 type: 'PATCH',                 
	                 data: $('#form').serialize(),
	                 success: function (data) {
	                 	$('#item_id option').val('');	
						$('#uom_id option').val('');	
						$('.quantity').val('')
						$('.rate').val('')
						$('#total').val('')
						$('#item_desc').text('')
						$('#remark').text('')
						$('#update_id').val('')
               	
	                 	location.reload()
	                }
		       })
		    }
    }
                      
});
	</script>
@endpush