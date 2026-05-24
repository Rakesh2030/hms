<div class="row">
    <div class="col-md-6 mb-3"><label>Bed</label><select name="bed_id" class="form-control">@foreach($beds as $bed)<option value="{{ $bed->id }}" @selected(old('bed_id',$bedAllotment->bed_id ?? '')==$bed->id)>{{ $bed->bed_number }} - Room {{ $bed->room->room_number }}</option>@endforeach</select></div>
    <div class="col-md-6 mb-3"><label>Patient</label><select name="patient_id" class="form-control">@foreach($patients as $patient)<option value="{{ $patient->id }}" @selected(old('patient_id',$bedAllotment->patient_id ?? '')==$patient->id)>{{ $patient->name }}</option>@endforeach</select></div>
    <div class="col-md-6 mb-3"><label>Allotment Date</label><input type="date" name="allotment_date" class="form-control" value="{{ old('allotment_date',$bedAllotment->allotment_date ?? date('Y-m-d')) }}"></div>
    <div class="col-md-6 mb-3"><label>Discharge Date</label><input type="date" name="discharge_date" class="form-control" value="{{ old('discharge_date',$bedAllotment->discharge_date ?? '') }}"></div>
    @isset($bedAllotment)
    <div class="col-md-6 mb-3"><label>Status</label><select name="status" class="form-control"><option value="admitted" @selected(old('status',$bedAllotment->status)=='admitted')>Admitted</option><option value="discharged" @selected(old('status',$bedAllotment->status)=='discharged')>Discharged</option></select></div>
    @endisset
</div>
