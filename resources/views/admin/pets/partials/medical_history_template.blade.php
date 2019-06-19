<script src="{{asset('backend/js/handlebars-v4.1.2.js')}}" charset="utf-8"></script>

<script id="medical_history_template" type="text/x-handlebars-template">
<div class="medical_history_record">

  <div class="row">
    <div class="col-md-5">
      <div class="form-group">
        <label for="medical_vaccination_id">Vaccination Name:</label>
        <select class="form-control form-data" name="medical_histories[@{{index}}][medical_vaccination_id]" id="medical_vaccination_id">
            @foreach($medical_vaccinations as $id => $name)
            <option value="{{$id}}">{{$name}}</option>
            @endforeach
        </select>
      </div>
    </div>
    <div class="col-md-5">
      <div class="form-group">
        <label for="good_until">Good Until:</label>
        <input type="date" id="good_until" name="medical_histories[@{{index}}][good_until]" class="form-control form-data" >
      </div>
    </div>
    <div class="col-md-2">
      <i class="fa fa-1x fa-times pull-right delete_medical_history"></i>
    </div>
  </div>

  <hr style="height:1px;border:none;color:#333;background-color:#333;" />
</div>


</script>
