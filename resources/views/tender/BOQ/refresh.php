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
					<a href="{{route('Boqdelete',$Data->id)}}" class="fa fa-trash text-danger"></a>
				</td>
			</tr>
		@endforeach
	</tbody>
</table>			