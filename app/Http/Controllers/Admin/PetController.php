<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CreateEditPetRequest;
use DataTables;
use App\Pet;
use App\PetType;
use App\PetImage;
use App\MedicalVaccination;
use Image;
use DB;
use Illuminate\Support\Facades\File;

use Illuminate\Http\Request;

class PetController extends Controller
{
	public function index(){
		$active = ['products', 'pets'];
		return view('admin.pets.index', compact('active'));
	}

	public function medicalHistoryIndex(Pet $pet){
		$active = ['products', 'pets'];
		$medical_vaccinations = MedicalVaccination::getInSelectForm(true);
		return view('admin.pets.medicalHistory.index', compact('active', 'pet', 'medical_vaccinations'));
	}

    public function apiIndex()
    {
    	return DataTables::of(Pet::with('type')->get())->make(true);
    }

    public function medicalHistoryApiIndex(Pet $pet){
    	return DataTables::of($pet->medicalHistory)->make(true);
	}

    public function create(){
    	$active = ['products', 'pets'];
    	$pet_types = PetType::getInSelectForm(true);
    	$medical_vaccinations = MedicalVaccination::getInSelectForm(true);
	    return view('admin.pets.create', compact('active', 'pet_types', 'medical_vaccinations'));
    }

    public function store(CreateEditPetRequest $request){

    	if($id = $this->checkDuplicatedMedicalVaccinations($request)){
    		if (request()->ajax()) {
		        return response()->json([
		          	'requestStatus' => false,
		          	'message'       => 'Medical Vaccination '.MedicalVaccination::find($id)->name.' is duplicated'
		        ]);
	      	}
	      	else{
	        	request()->session()->flash('status', 'danger');
	        	request()->session()->flash('message', 'Medical Vaccination '.MedicalVaccination::find($id)->name.' is duplicated');
	      		return back('/admin/pets')->withInputs();
	      	}
    	}

	    $pet_data = $request->except(['medical_histories', 'images']);

	    $pet = new Pet($pet_data);
	    if ($pet->save()){

		    if(!empty($request['medical_histories'])){
		    	$medical_histories = $request['medical_histories'];
		    	foreach($medical_histories as $medical_history){
		    		$pet->medicalHistory()->attach($medical_history['medical_vaccination_id'], array_diff_key($medical_history, array_flip(["medical_vaccination_id"])));
		    	}
		    }

		    if($request->hasfile('images'))
            {
                $path = public_path('images'.DIRECTORY_SEPARATOR.'pets'.DIRECTORY_SEPARATOR);
                foreach($request->file('images') as $image)
                {
                    $extension = $image->getClientOriginalExtension();
                    $filename ='pet-'.$pet->id.'-'.str_random(12).date('Y-m-d').'.'.$extension;
                    $image = Image::make($image)->save($path.$filename);

                    $petImage = new PetImage();
                    $petImage->pet_id   = $pet->id;
                    $petImage->name = $filename;
                    $petImage->save();
                }
            }

	      	request()->session()->flash('status','success');
	        request()->session()->flash('message', 'Pet Added Successfully');

	      	if (request()->ajax()) {
		        return response()->json([
		          	'requestStatus' => true,
		          	'message'       => 'Pet Added Successfully',
		          	'redirect'		=> url('admin/pets')
		        ]);
	      	}
	      	else{
		        return redirect('admin/pets');
	      	}
	    }
	    else{
	      	if (request()->ajax()) {
		        return response()->json([
		          	'requestStatus' => false,
		          	'message'       => 'Some error happened'
		        ]);
	      	}
	      	else{
	        	request()->session()->flash('status', 'danger');
	        	request()->session()->flash('message', 'Some error happened');
	      		return back('/admin/pets')->withInputs();
	      	}
	    }
  	}

  	public function medicalHistoryStore(Request $request, Pet $pet){

  		$request->validate([
  			'medical_histories.*.medical_vaccination_id' => 'required|integer',
            'medical_histories.*.good_until' => 'required|date'
  		]);

    	if($id = $this->checkDuplicatedMedicalVaccinations($request, true, $pet)){
    		if (request()->ajax()) {
		        return response()->json([
		          	'requestStatus' => false,
		          	'message'       => 'Medical Vaccination '.MedicalVaccination::find($id)->name.' is duplicated'
		        ]);
	      	}
	      	else{
	        	request()->session()->flash('status', 'danger');
	        	request()->session()->flash('message', 'Medical Vaccination '.MedicalVaccination::find($id)->name.' is duplicated');
	      		return back('/admin/pets')->withInputs();
	      	}
    	}

	    if(!empty($request['medical_histories'])){
	    	$medical_histories = $request['medical_histories'];
	    	foreach($medical_histories as $medical_history){
	    		$pet->medicalHistory()->attach($medical_history['medical_vaccination_id'], array_diff_key($medical_history, array_flip(["medical_vaccination_id"])));
	    	}
	    }

      	request()->session()->flash('status','success');
        request()->session()->flash('message', 'Vacinations Added Successfully');

      	if (request()->ajax()) {
	        return response()->json([
	          	'requestStatus' => true,
	          	'message'       => 'Vacinations Added Successfully',
	          	'redirect'		=> url('admin/pets/'.$pet->id.'/medical_history')
	        ]);
      	}
      	else{
	        return redirect('admin/pets');
      	}
  	}

  	public function edit(Pet $pet){
    	$active = ['products', 'pets'];
    	$pet_types = PetType::getInSelectForm(true);
    	$medical_vaccinations = MedicalVaccination::getInSelectForm(true);
	    return view('admin.pets.edit', compact('active', 'pet_types', 'medical_vaccinations', 'pet'));
    }

    public function update(CreateEditPetRequest $request, Pet $pet){

    	if($id = $this->checkDuplicatedMedicalVaccinations($request)){
    		if (request()->ajax()) {
		        return response()->json([
		          	'requestStatus' => false,
		          	'message'       => 'Medical Vaccination '.MedicalVaccination::find($id)->name.' is duplicated'
		        ]);
	      	}
	      	else{
	        	request()->session()->flash('status', 'danger');
	        	request()->session()->flash('message', 'Medical Vaccination '.MedicalVaccination::find($id)->name.' is duplicated');
	      		return back('/admin/pets')->withInputs();
	      	}
    	}

	    $pet_data = $request->except(['medical_histories', 'old_medical_histories', 'images', 'existing_images']);

	    if ($pet->update($pet_data)){

		    $ids_to_delete = DB::table('pet_medical_history')->where('pet_id', $pet->id)->pluck('medical_vaccination_id')->toArray();
	    	if(!empty($request->old_medical_histories)){
		      	foreach($request->old_medical_histories as $mh){
		          	$ids_to_delete = array_diff($ids_to_delete, [$mh['prev_medical_vaccination_id']]);
		          	if($mh['changed'] == 1){
		          		$pet->medicalHistory()->updateExistingPivot($mh['prev_medical_vaccination_id'], array_diff_key($mh, array_flip(["prev_medical_vaccination_id", "changed"])));
		          	}
		    	}
		    }
		    
		    $pet->medicalHistory()->detach($ids_to_delete);

		    if(!empty($request['medical_histories'])){
		    	$medical_histories = $request['medical_histories'];
		    	foreach($medical_histories as $medical_history){
		    		$pet->medicalHistory()->attach($medical_history['medical_vaccination_id'], array_diff_key($medical_history, array_flip(["prev_medical_vaccination_id", "changed"])));
		    	}
		    }


		    // Delete detached images *******************************8
		    $existing_images = [];
		    if(!empty($request['existing_images']))
		    	$existing_images = $request['existing_images'];

	    	$images_to_be_deleted = $pet->images()->whereNotIn('id',$existing_images)->get();
		    foreach ($images_to_be_deleted as $image) {
		    	$image_path = public_path('images'.DIRECTORY_SEPARATOR.'pets'.DIRECTORY_SEPARATOR).$image->name;
		    	if(File::exists($image_path))
		      		File::delete($image_path);
		    }
		    PetImage::whereNotIn('id',$existing_images)->delete();
		    // ************************************************************

		    

		    if($request->hasfile('images'))
            {
                $path = public_path('images'.DIRECTORY_SEPARATOR.'pets'.DIRECTORY_SEPARATOR);
                foreach($request->file('images') as $image)
                {
                    $extension = $image->getClientOriginalExtension();
                    $filename ='pet-'.$pet->id.'-'.str_random(12).date('Y-m-d').'.'.$extension;
                    $image = Image::make($image)->save($path.$filename);

                    $petImage = new PetImage();
                    $petImage->pet_id   = $pet->id;
                    $petImage->name = $filename;
                    $petImage->save();
                }
            }

	      	request()->session()->flash('status','success');
	        request()->session()->flash('message', 'Pet Updated Successfully');

	      	if (request()->ajax()) {
		        return response()->json([
		          	'requestStatus' => true,
		          	'message'       => 'Pet Updated Successfully',
		          	'redirect'		=> url('admin/pets/'.$pet->id.'/edit')
		        ]);
	      	}
	      	else{
		        return redirect('admin/pets');
	      	}
	    }
	    else{
	      	if (request()->ajax()) {
		        return response()->json([
		          	'requestStatus' => false,
		          	'message'       => 'Some error happened'
		        ]);
	      	}
	      	else{
	        	request()->session()->flash('status', 'danger');
	        	request()->session()->flash('message', 'Some error happened');
	      		return back('/admin/pets')->withInputs();
	      	}
	    }
  	}

  	public function destroy(Pet $pet)
    {
	    if(!$pet)
	    {
	        return response()->json([
	          'deleteStatus' => false ,
	          'error'        => 'Pet not exist'
	        ]);
	    }

        try {

        	foreach($pet->images as $image){
        		$image_path = public_path('images'.DIRECTORY_SEPARATOR.'pets'.DIRECTORY_SEPARATOR).$image->name;
		    	if(File::exists($image_path))
		      		File::delete($image_path);
        	}
        	PetImage::where('pet_id',$pet->id)->delete();

   			$pet->medicalHistory()->detach();

            $pet->delete();
            return response()->json([
              	'deleteStatus' => true
            ]);
        } 
        catch (\Exception $e) {
            return response()->json([
              	'deleteStatus' => false ,
              	'error'        => 'Some error happened!'
            ]);
        }
    }

    public function medicalHistoryDestroy(Pet $pet, $medical_vaccination)
    {
	    if(!$pet)
	    {
	        return response()->json([
	          'deleteStatus' => false ,
	          'error'        => 'Pet not exist'
	        ]);
	    }

        try {
   			$pet->medicalHistory()->detach($medical_vaccination);
            return response()->json([
              	'deleteStatus' => true
            ]);
        } 
        catch (\Exception $e) {
            return response()->json([
              	'deleteStatus' => false ,
              	'error'        => 'Some error happened!'
            ]);
        }
    }

    public function show(Pet $pet){
    	try{
	    	$pet->hidden = 0;
	    	$pet->save();
	    	return response()->json([
	            'showStatus' => true
	        ]);
    	}
    	catch (\Exception $e) {
            return response()->json([
              	'showStatus' => false ,
              	'error'        => 'Some error happened!'
            ]);
        }
    }

    public function hide(Pet $pet){
    	try{
	    	$pet->hidden = 1;
	    	$pet->save();
	    	return response()->json([
	            'hideStatus' => true
	        ]);
    	}
    	catch (\Exception $e) {
            return response()->json([
              	'hideStatus' => false ,
              	'error'        => 'Some error happened!'
            ]);
        }
    }

  	private function checkDuplicatedMedicalVaccinations($request, $check_database=false, $pet=null){
  		$mv_ids = [];
  		if($check_database)
  			$mv_ids = $pet->medicalHistory()->pluck('id')->toArray();

  		$medical_histories = array();
    	if(!empty($request['medical_histories']))
	    	$medical_histories = $medical_histories + $request['medical_histories'];
	    if(!empty($request['old_medical_histories']))
	    	$medical_histories = $medical_histories + $request['old_medical_histories'];

    	foreach($medical_histories as $medical_history){
    		if(in_array($medical_history['medical_vaccination_id'], $mv_ids)){
    			return $medical_history['medical_vaccination_id'];
    		}
    		$mv_ids[] = $medical_history['medical_vaccination_id'];
    	}

    	return false;
  	}
}
