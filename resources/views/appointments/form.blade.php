<div class="row">
    <div class="col-md-6 mb-3"><label>Doctor</label><select name="doctor_id" class="form-control">@foreach($doctors as $doctor)<option value="{{ $doctor->id }}" @selected(old('doctor_id',$appointment->doctor_id ?? '')==$doctor->id)>{{ $doctor->name }}</option>@endforeach</select></div>
    <div class="col-md-6 mb-3"><label>Patient</label><select name="patient_id" class="form-control">@foreach($patients as $patient)<option value="{{ $patient->id }}" @selected(old('patient_id',$appointment->patient_id ?? '')==$patient->id)>{{ $patient->name }}</option>@endforeach</select></div>
    <div class="col-md-6 mb-3"><label>Date</label><input type="date" name="appointment_date" class="form-control" value="{{ old('appointment_date',$appointment->appointment_date ?? '') }}"></div>
    <div class="col-md-6 mb-3"><label>Time</label><input type="time" name="appointment_time" class="form-control" value="{{ old('appointment_time',$appointment->appointment_time ?? '') }}"></div>
    <div class="col-md-6 mb-3"><label>Status</label><select name="status" class="form-control"><option value="pending" @selected(old('status',$appointment->status ?? '')=='pending')>Pending</option><option value="approved" @selected(old('status',$appointment->status ?? '')=='approved')>Approved</option><option value="completed" @selected(old('status',$appointment->status ?? '')=='completed')>Completed</option></select></div>
    <div class="col-md-12 mb-3"><label>Problem</label><textarea name="problem" class="form-control">{{ old('problem',$appointment->problem ?? '') }}</textarea></div>
</div>
