@extends('admin.layouts.app')

@section('title', 'Admin Panel - Create Pet')

@section('header')
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
	    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-tachometer-alt"></i> Create Pet - Admin Panel</h1>
	    <ol class="breadcrumb">
	        <li class="breadcrumb-item"><a href="{{url('admin')}}">Home</a></li>
	        <li class="breadcrumb-item"><a href="{{url('admin/pets')}}">Pets</a></li>
	        <li class="breadcrumb-item active" aria-current="page">Create</li>
	    </ol>
	</div>
@endsection

@section('content')

@include('admin.pets.partials.medical_history_template')

	{!! Form::open(array(
    'url' => [url('/admin/pets')],
    'method' => 'POST',
    'class' => 'form-basic ajax',
    'files' => true,
    )) !!}
    
	<div class="card">
		<div class="card-header">
			<h5 class="card-title float-left">Pet Details</h5>
		</div>
		<div class="card-body"> 

			    @include('admin.pets.partials.pet_details')
		</div>
	</div>

	<div class="card">
		<div class="card-header">
			<h5 class="card-title float-left">Attach Photos</h5>
		</div>
		<div class="card-body">
		    <div class="row">
		      	<div class="offset-md-3 col-md-6">
		          	<div class="form-group">
		              	<input type="file" name="images[]" id="images" class="form-data inputfile" data-multiple-caption="{count} images selected" multiple onchange="previewImage(this)" />
		              	<label class="inputfile-label" for="images"><span>No images selected</span> <strong><i class="fas fa-upload"></i> Choose Pet Images </strong></label>
		          	</div>
		      	</div>
		      	<div class="col-md-12">
			        <div id="images_preview">

			        </div>
		      	</div>
		  	</div>
	  	</div>
	</div>

	<div class="card">
		<div class="card-header">
			<h5 class="card-title float-left">Medical History</h5>
			<p class='float-right' data-popup='tooltip' data-placement="top"
			title="Add Vaccination">
				<button type="button" id="add_new_medical_history" ><i class="icon-plus2"></i>
				</button>
			</p>
		</div>
	    <div class="card-body">

		    <div id="medical_histories">
		    	
		    </div>
		</div>
	</div>

  	<div class="form-wizard-actions">
    	<button class="btn btn-info" type="submit">Save</button>
  	</div>

    {!! Form::close() !!}
    
@endsection

@section('scripts')
	<script type="text/javascript" src="{{ asset('backend/js/pages/create-edit-pet.js') }}"></script>
@endsection