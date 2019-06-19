<fieldset class="step" id="step1">
  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        <label for="pet_type_id">Pet Type:</label>
            {!! form::select('pet_type_id', $pet_types, null, ['class' => 'form-control form-data', 'id' => 'pet_type_id']) !!}
            {!! $errors->first('pet_type_id' , '<p class="validation-error-label">:message</p>') !!}
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label for="response_name">Response Name:</label>
        {!! form::text('response_name', null, ['class' =>'form-control form-data', 'id' => 'response_name' ]) !!}
        {!! $errors->first('response_name' , '<p class="validation-error-label">:message</p>') !!}
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        <label class="display-block text-semibold">Sex:</label>
        <label class="radio-inline">
          {!! Form::radio('sex', 'male', true,['class' => 'styled form-data']) !!}
          Male
        </label>
        <label class="radio-inline">
          {!! Form::radio('sex', 'female', false,['class' => 'styled form-data']) !!}
          Female
        </label>
        {!! $errors->first('sex' , '<p class="validation-error-label">:message</p>') !!}
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label for="breed">Breed:</label>
        {!! form::text('breed', null, ['class' =>'form-control form-data', 'id' => 'breed' ]) !!}
        {!! $errors->first('breed' , '<p class="validation-error-label">:message</p>') !!}
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        <label for="color">Color:</label>
        {!! form::text('color', null, ['class' =>'form-control form-data', 'id' => 'color' ]) !!}
        {!! $errors->first('color' , '<p class="validation-error-label">:message</p>') !!}
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label for="weight">Weight (kg):</label>
        {!! form::text('weight', null, ['class' =>'form-control form-data', 'id' => 'weight' ]) !!}
        {!! $errors->first('weight' , '<p class="validation-error-label">:message</p>') !!}
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        <label for="birthday">Birth Day:</label>
      {!! Form::date("birthday",null,['class'=>'form-control form-data','id' => 'birthday']) !!}
      {!! $errors->first('birthday' , '<p class="validation-error-label">:message</p>') !!}
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label for="birth_country">Birth Country:</label>
        {!! form::text('birth_country', null, ['class' =>'form-control form-data', 'id' => 'birth_country' ]) !!}
        {!! $errors->first('birth_country' , '<p class="validation-error-label">:message</p>') !!}
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        <label class="display-block text-semibold">Altered:</label>
        <label class="radio-inline">
          {!! Form::radio('altered', 1, true,['class' => 'styled form-data']) !!}
          Yes
        </label>
        <label class="radio-inline">
          {!! Form::radio('altered', 0, false,['class' => 'styled form-data']) !!}
          No
        </label>
        {!! $errors->first('altered' , '<p class="validation-error-label">:message</p>') !!}
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label for="price">Price (LE):</label>
        {!! form::text('price', null, ['class' =>'form-control form-data', 'id' => 'price' ]) !!}
        {!! $errors->first('price' , '<p class="validation-error-label">:message</p>') !!}
      </div>
    </div>
  </div>

</fieldset>