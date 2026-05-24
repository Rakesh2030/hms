@extends('layouts.hms')
@section('content')
<h3>Bill Details</h3><div class="card"><div class="card-body"><p><b>Patient:</b> {{ $billing->patient->name }}</p><p><b>Amount:</b> {{ $billing->amount }}</p><p><b>Status:</b> {{ ucfirst($billing->payment_status) }}</p><p><b>Date:</b> {{ $billing->billing_date }}</p><p><b>Notes:</b> {{ $billing->notes }}</p><a href="{{ route('billings.index') }}" class="btn btn-secondary">Back</a></div></div>
@endsection
