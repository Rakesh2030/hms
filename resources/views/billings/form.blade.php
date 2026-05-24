<div class="row">
    <div class="col-md-6 mb-3"><label>Patient</label><select name="patient_id" class="form-control">@foreach($patients as $patient)<option value="{{ $patient->id }}" @selected(old('patient_id',$billing->patient_id ?? '')==$patient->id)>{{ $patient->name }}</option>@endforeach</select></div>
    <div class="col-md-6 mb-3"><label>Amount</label><input name="amount" class="form-control" value="{{ old('amount',$billing->amount ?? '') }}"></div>
    <div class="col-md-6 mb-3"><label>Payment Status</label><select name="payment_status" class="form-control"><option value="unpaid" @selected(old('payment_status',$billing->payment_status ?? '')=='unpaid')>Unpaid</option><option value="paid" @selected(old('payment_status',$billing->payment_status ?? '')=='paid')>Paid</option></select></div>
    <div class="col-md-6 mb-3"><label>Billing Date</label><input type="date" name="billing_date" class="form-control" value="{{ old('billing_date',$billing->billing_date ?? date('Y-m-d')) }}"></div>
    <div class="col-md-12 mb-3"><label>Notes</label><textarea name="notes" class="form-control">{{ old('notes',$billing->notes ?? '') }}</textarea></div>
</div>
