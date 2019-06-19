<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CreateEditPetRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'pet_type_id'      => 'required|integer',
            'response_name' => 'required|string',
            'birthday'      => 'required|date',
            'birth_country' => 'required|string',
            'color'         => 'required|string',
            'sex'           => 'required',
            'breed'         => 'required|string',
            'weight'        => 'required|numeric',
            'altered'       => 'required|boolean',
            'price'         => 'required|numeric',
            'images.*'      => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ];

        if(!empty($this->request->get('medical_histories')))
            foreach ($this->request->get('medical_histories') as $i => $pricelist) {
                $rules['medical_histories.' .$i. '.medical_vaccination_id'] = 'required|integer';
                $rules['medical_histories.' .$i. '.good_until'] = 'required|date';
            }

        if(!empty($this->request->get('old_medical_histories')))
            foreach ($this->request->get('old_medical_histories') as $i => $pricelist) {
                $rules['old_medical_histories.' .$i. '.medical_vaccination_id'] = 'required|integer';
                $rules['old_medical_histories.' .$i. '.good_until'] = 'required|date';
            }

        return $rules;
    }
}
