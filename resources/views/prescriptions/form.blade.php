<div class="row">
    <div class="col-md-6 mb-3"><label>Doctor</label><select name="doctor_id" class="form-control">@foreach($doctors as $doctor)<option value="{{ $doctor->id }}" @selected(old('doctor_id',$prescription->doctor_id ?? '')==$doctor->id)>{{ $doctor->name }}</option>@endforeach</select></div>
    <div class="col-md-6 mb-3"><label>Patient</label><select name="patient_id" class="form-control">@foreach($patients as $patient)<option value="{{ $patient->id }}" @selected(old('patient_id',$prescription->patient_id ?? '')==$patient->id)>{{ $patient->name }}</option>@endforeach</select></div>
    <div class="col-md-6 mb-3"><label>Date</label><input type="date" name="prescription_date" class="form-control" value="{{ old('prescription_date',$prescription->prescription_date ?? date('Y-m-d')) }}"></div>
    <div class="col-md-12 mb-3"><label>Medicines</label><textarea name="medicines" class="form-control" rows="4">{{ old('medicines',$prescription->medicines ?? '') }}</textarea></div>
    <div class="col-md-12 mb-3"><label>Notes</label><textarea name="notes" class="form-control">{{ old('notes',$prescription->notes ?? '') }}</textarea></div>
</div>
