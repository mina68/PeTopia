@extends('admin.layouts.app')

@section('title', 'foods')

@section('styles')
	<link rel="stylesheet" type="text/css" href="{{ asset('backend/datatables/jquery.dataTables.min.css') }}">
@endsection

@section('header')
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
	    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-tachometer-alt"></i> Foods</h1>
	    <ol class="breadcrumb">
	        <li class="breadcrumb-item"><a href="{{url('admin')}}">Home</a></li>
	        <li class="breadcrumb-item active" aria-current="page">Foods</li>
	    </ol>
	</div>
@endsection

@section('content')
	<table class="table display" id="foods">
		<thead style="background-color: #eee">
			<tr>
				<th class="text-center">#</th>
				<th class="text-center">Name</th>
				<th class="text-center">Type</th>
				<th class="text-center">Pet Type</th>
				<th class="text-center">Sizes</th>
			</tr>
		</thead>
	</table>
@endsection

@section('scripts')
	<script type="text/javascript" src="{{ asset('backend/datatables/jquery.dataTables.min.js') }}"></script>
	<script>
		$(document).ready(function() {
			$('#foods').dataTable({
				processing : true,
				serverSide : true,
				order      : [],
				ajax       : {
				    url      :	"{{ url('admin/foods/index') }}",
				},
				columns    : [
					{ data:"id" },
					{ data:"name" },
					{ data:"type.name" },
					{ 
						data:"pet_type", 
						render:function(data, type, row){
							if(data)
								return data.name
							else
								return 'General'
						}
					},
					{
						data:"sizes",
						render:function(data, type, row){
							let count_sizes = data.length
							let to_print_sizes = '';
							for(var i=0; i<count_sizes; i++){
								to_print_sizes += data[i]['size'];
								if(i != count_sizes-1)
									to_print_sizes+=' - '
							}
							return to_print_sizes
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

		});
	</script>
@endsection