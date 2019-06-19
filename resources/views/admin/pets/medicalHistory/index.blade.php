@extends('admin.layouts.app')

@section('title', "Pet's Medical History")

@section('styles')
	<link rel="stylesheet" type="text/css" href="{{ asset('backend/datatables/jquery.dataTables.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('backend/datatables/dataTables.bootstrap4.min.css') }}">
@endsection

@section('header')
	<div class="d-sm-flex align-items-center justify-content-between mb-2">
	    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-tachometer-alt"></i> Pet's Medeical History - Admin Panel</h1>
	    <ol class="breadcrumb">
	        <li class="breadcrumb-item"><a href="{{url('admin')}}">Home</a></li>
	        <li class="breadcrumb-item"><a href="{{url('admin/pets')}}">Pets</a></li>
	        <li class="breadcrumb-item"><a href="{{url('admin/pets/'.$pet->id.'/edit')}}">{{$pet->id}}</a></li>
	        <li class="breadcrumb-item active" aria-current="page">Medical History</li>
	    </ol>
	</div>
@endsection

@section('content')

@include('admin.pets.partials.medical_history_template')

<div class="card">
	<div class="card-header">
		<h5 class="card-title float-left">Pet's Medical History</h5>
	</div>
	<div class="card-body">
		<table class="table display" id="medical-history" width="100%">
			<thead style="background-color: #fff">
				<tr>
					<th class="text-center">Name</th>
					<th class="text-center">Good Until</th>
					<th class="text-center">Operations</th>
				</tr>
			</thead>
		</table>
	</div>
</div>

<div class="card">
	<div class="card-header">
		<h5 class="card-title float-left">Add To Medical History</h5>
		<button class='float-right' id="add_new_medical_history" data-popup='tooltip' data-placement="top" title="Add Vaccination">
			<i class="icon-plus2"></i>
		</button>
	</div>

	{!! Form::model($pet, array(
	'url' => [url('/admin/pets/'.$pet->id.'/medical_history')],
	'method' => 'POST',
	'class' => 'form-basic ajax',
	)) !!}
	<div class="card-body" id="medical_histories">
		<div class="medical_history_record">
		  	<div class="row">
		    	<div class="col-md-5">
		      		<div class="form-group">
		        		<label for="medical_vaccination_id">Vaccination Name:</label>
		        		<select class="form-control form-data" name="medical_histories[0][medical_vaccination_id]" id="medical_vaccination_id">
			            	@foreach($medical_vaccinations as $id => $name)
				            <option value="{{$id}}">{{$name}}</option>
				            @endforeach
				        </select>
			      	</div>
			    </div>
			    <div class="col-md-5">
			      	<div class="form-group">
				        <label for="good_until">Good Until:</label>
				        <input type="date" id="good_until" name="medical_histories[0][good_until]" class="form-control form-data">
			      	</div>
			    </div>
		  	</div>

		  	<hr style="height:1px;border:none;color:#333;background-color:#333;" />
		</div>
	</div>
	<div class="form-wizard-actions">
    	<button class="btn btn-info" type="submit">Save</button>
  	</div>
	{!! Form::close() !!}

</div>


@endsection

@section('scripts')
	<script type="text/javascript" src="{{ asset('backend/datatables/jquery.dataTables.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('backend/datatables/dataTables.bootstrap4.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('backend/js/pages/create-edit-pet.js') }}"></script>
	<script>
		$(document).ready(function() {
			$('#medical-history').dataTable({
				processing : true,
				serverSide : true,
				scrollX	   : true,
				order      : [],
				ajax       : {
				    url      :	"{{ url('admin/pets/'.$pet->id.'/medical_history/index') }}",
				},
				columns    : [
					{ data:"name" },
					{ data:"pivot.good_until" },
					{
				        data: "id",
				        render : function (data, type, item) {
				          	return "<ul class='list-inline'><li class='list-inline-item'><a class='text-danger delete-action' data-url='{{ url('/admin/pets/') }}/" + item.pivot.pet_id + "/medical_history/" + data + "' data-popup='tooltip' title='Delete' ><i class='fa fa-trash'></i></a></li></ul>";
				        }

				    },
				],
				columnDefs: [
				    {
				        "targets": '_all',
				        "createdCell": function(td, cellData, rowData, row, col) {
			                $(td).addClass('text-center');
				        }
				    },
				],
				createdRow: function ( row, data, index ) {
          			$(row).find('[data-popup="tooltip"]').tooltip();
		        }
			});

			$(window).on('resize', function () {
				$('#medical-history').dataTable().fnAdjustColumnSizing();
			});
			$('#sidebarToggle').on('click', function () {
				$('#medical-history').dataTable().fnAdjustColumnSizing();
			});

		});
	</script>
@endsection