@extends('admin.layouts.app')

@section('title', 'Drugs')

@section('styles')
	<link rel="stylesheet" type="text/css" href="{{ asset('backend/datatables/jquery.dataTables.min.css') }}">
@endsection

@section('header')
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
	    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-tachometer-alt"></i> Pet Types</h1>
	    <ol class="breadcrumb">
	        <li class="breadcrumb-item"><a href="{{url('admin')}}">Home</a></li>
	        <li class="breadcrumb-item active" aria-current="page">Pet Types</li>
	    </ol>
	</div>
@endsection

@section('content')
	<table class="table display" id="pet_types">
		<thead style="background-color: #eee">
			<tr>
				<th class="text-center">#</th>
				<th class="text-center">Name</th>
			</tr>
		</thead>
	</table>
@endsection

@section('scripts')
	<script type="text/javascript" src="{{ asset('backend/datatables/jquery.dataTables.min.js') }}"></script>
	<script>
		$(document).ready(function() {
			$('#pet_types').dataTable({
				processing : true,
				serverSide : true,
				order      : [],
				ajax       : {
				    url      :	"{{ url('admin/pet_types/index') }}",
				},
				columns    : [
					{ data:"id" },
					{ data:"name" },
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

		});
	</script>
@endsection