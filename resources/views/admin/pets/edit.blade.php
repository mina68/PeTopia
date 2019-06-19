@extends('admin.layouts.app')

@section('title', 'Admin Panel - Edit Pet')

@section('header')
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
	    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-tachometer-alt"></i> Edit Pet - Admin Panel</h1>
	    <ol class="breadcrumb">
	        <li class="breadcrumb-item"><a href="{{url('admin')}}">Home</a></li>
	        <li class="breadcrumb-item"><a href="{{url('admin/pets')}}">Pets</a></li>
	        <li class="breadcrumb-item active" aria-current="page">Edit</li>
	    </ol>
	</div>
@endsection

@section('content')

@include('admin.pets.partials.medical_history_template')

  {!! Form::model($pet, array(
    'url' => [url('/admin/pets/'.$pet->id)],
    'method' => 'PUT',
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
			<h5 class="card-title float-left">Photos Attached</h5>
    	</div>
    	<div class="card-body">
		    <div class="row mb-4">
		      <div class="col-md-12">
		        <div class="image-preview">
		        @if(count($pet->images) > 0)
		          @foreach($pet->images as $image)
		          <div class="attach_img">
		            <button type="button">x</button>
		            <a href="{{ asset('images/pets/'.$image->name) }}">
		              <input type="hidden" class="form-data" name="existing_images[]" value="{{$image->id}}">
		              <img class="img-thumbnail" src="{{ url('images/pets/'.$image->name) }}" alt="photo"/>
		            </a>
		          </div>
		          @endforeach
		        @else
		         	<p>No photos attached to this pet!</p>
		        @endif
		        </div>
		      </div>
		    </div>


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

		    	@foreach($pet->medicalHistory as $key => $mh)
		    		<div class="medical_history_record">

						{!! Form::hidden("old_medical_histories[$key][changed]",0,['class'=>'changed form-control form-data']) !!}
						{!! Form::hidden("old_medical_histories[$key][prev_medical_vaccination_id]",$mh->id,['class'=>'form-control form-data']) !!}

					  	<div class="row">
					    	<div class="col-md-5">
					      		<div class="form-group">
					        		<label for="medical_vaccination_id">Vaccination Name:</label>
					        		<select class="form-control form-data" name="old_medical_histories[{{$key}}][medical_vaccination_id]" id="medical_vaccination_id">
						            	@foreach($medical_vaccinations as $id => $name)
							            <option value="{{$id}}" {{$id == $mh->id ? 'selected' : ''}}>{{$name}}</option>
							            @endforeach
							        </select>
						      	</div>
						    </div>
						    <div class="col-md-5">
						      	<div class="form-group">
							        <label for="good_until">Good Until:</label>
							        <input type="date" id="good_until" name="old_medical_histories[{{$key}}][good_until]" class="form-control form-data" value="{{$mh->pivot->good_until}}">
						      	</div>
						    </div>
						    <div class="col-md-2">
						      	<i class="fa fa-1x fa-times pull-right delete_medical_history"></i>
						    </div>
					  	</div>

					  	<hr style="height:1px;border:none;color:#333;background-color:#333;" />
					</div>
		    	@endforeach
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