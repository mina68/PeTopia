@extends('admin.layouts.app')

@section('title', 'Pets')

@section('styles')
	<link rel="stylesheet" type="text/css" href="{{ asset('backend/datatables/jquery.dataTables.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('backend/datatables/dataTables.bootstrap4.min.css') }}">
@endsection

@section('header')
	<div class="d-sm-flex align-items-center justify-content-between mb-2">
	    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-tachometer-alt"></i> Pets - Admin Panel</h1>
	    <ol class="breadcrumb">
	        <li class="breadcrumb-item"><a href="{{url('admin')}}">Home</a></li>
	        <li class="breadcrumb-item active" aria-current="page">Pets</li>
	    </ol>
	</div>
@endsection

@section('content')
<div class="card">
	<div class="card-header">
		<h5 class="card-title float-left">Pets</h5>
		<p class='float-right' data-popup='tooltip' data-placement="top"
		title="Add Pet">
			<a href="{{ url('/admin/pets/create') }}"><i class="icon-plus2"></i>
			</a>
		</p>
	</div>
	<div class="card-body">
		<table class="table display" id="pets" width="100%">
			<thead style="background-color: #fff">
				<tr>
					<th class="text-center">#</th>
					<th class="text-center">Response Name</th>
					<th class="text-center">Type</th>
					<th class="text-center">Birth Date</th>
					<th class="text-center">Birth Country</th>
					<th class="text-center">Breed</th>
					<th class="text-center">Weight</th>
					<th class="text-center">Altered</th>
					<th class="text-center">Sex</th>
					<th class="text-center">Color</th>
					<th class="text-center">Price</th>
					<th class="text-center">Visibility</th>
					<th class="text-center">Operations</th>
				</tr>
			</thead>
		</table>
	</div>
</div>
@endsection

@section('scripts')
	<script type="text/javascript" src="{{ asset('backend/datatables/jquery.dataTables.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('backend/datatables/dataTables.bootstrap4.min.js') }}"></script>
	<script>
		$(document).ready(function() {
			$('#pets').dataTable({
				processing : true,
				serverSide : true,
				scrollX	   : true,
				order      : [],
				ajax       : {
				    url      :	"{{ url('admin/pets/index') }}",
				},
				columns    : [
					{ data:"id" },
					{ data:"response_name" },
					{ data:"type.name" },
					{ data:"birthday" },
					{ data:"birth_country" },
					{ data:"breed" },
					{ data:"weight" },
					{ 
						data:"altered",
						render:function(data, type, row){
							if(data) 
								return 'Yes'
							else 
								return 'No'
						}
					},
					{ data:"sex" },
					{ data:"color" },
					{ data:"price" },
					{
						data: "hidden",
						render : function (data, type, item) {
							if (data == 0) {
								return "<span class='visibility-status badge badge-success'>Visible</span>";
							}else if(data == 1){
								return "<span class='visibility-status badge badge-warning'>Hidden</span>";
							}
						}
					},
					{
				        data: "id",
				        render : function (data, type, item) {
				        	let action = 'show'
				        	let iconClass = "fa-eye"
				        	if(item.hidden == 0){
				        		action = 'hide'
				        		iconClass = 'fa-eye-slash'
				        	}

				          	return "<ul class='list-inline'><li class='list-inline-item'><a class='text-info' href='{{ url('/admin/pets/') }}/" + data + "/edit' data-popup='tooltip' title='Edit'><i class='fas fa-pencil-alt'></i></a></li><li class='list-inline-item'><a class='text-primary "+action+"-action' data-url='{{ url('/admin/pets/') }}/" + data + '/' + action + "' data-popup='tooltip' title='"+action+"' ><i class='fas "+iconClass+"'></i></a></li><li class='list-inline-item'><a class='text-danger delete-action' data-url='{{ url('/admin/pets/') }}/" + data + "' data-popup='tooltip' title='Delete' ><i class='fa fa-trash'></i></a></li><li class='list-inline-item'><a class='text-success' href='{{url('/admin/pets')}}/"+data+"/medical_history' data-popup='tooltip' title='Medical History' ><i class='fas fa-plus-circle'></i></a></li></ul>";
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