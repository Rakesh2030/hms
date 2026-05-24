@extends('layouts.hms')
@section('content')
<div class="d-flex flex-column flex-sm-row justify-content-between gap-2 mb-3"><h3>Prescriptions</h3><a href="{{ route('prescriptions.create') }}" class="btn btn-primary mobile-full-btn">Add Prescription</a></div>
<div class="card"><div class="card-body"><div class="table-responsive"><table class="table table-bordered">
<thead><tr><th>Doctor</th><th>Patient</th><th>Date</th><th width="220">Action</th></tr></thead>
<tbody id="prescriptionsTable"><tr><td colspan="4" class="text-center">Loading...</td></tr></tbody>
</table></div></div></div>

{{-- Old normal CRUD table loop and delete form --}}
{{-- @foreach($prescriptions as $prescription)
<form action="{{ route('prescriptions.destroy',$prescription) }}" method="POST">@csrf @method('DELETE')</form>
@endforeach --}}
@endsection

@push('scripts')
<script>
    $(document).ready(function () {
        loadPrescriptions();
    });

    // Fetch prescription data from API and show it in table.
    function loadPrescriptions() {
        $.get('/api/prescriptions', function (response) {
            var rows = '';

            $.each(response.data, function (index, prescription) {
                rows += '<tr>';
                rows += '<td>' + textValue(prescription.doctor ? prescription.doctor.name : '') + '</td>';
                rows += '<td>' + textValue(prescription.patient ? prescription.patient.name : '') + '</td>';
                rows += '<td>' + textValue(prescription.prescription_date) + '</td>';
                rows += '<td>';
                rows += '<a href="/prescriptions/' + prescription.id + '" class="btn btn-sm btn-info">View</a> ';
                rows += '<a href="/prescriptions/' + prescription.id + '/edit" class="btn btn-sm btn-warning">Edit</a> ';
                rows += '<button class="btn btn-sm btn-danger" onclick="deletePrescription(' + prescription.id + ')">Delete</button>';
                rows += '</td></tr>';
            });

            if (rows == '') {
                rows = '<tr><td colspan="4" class="text-center">No prescriptions found.</td></tr>';
            }

            $('#prescriptionsTable').html(rows);
        });
    }

    // Delete prescription using API after SweetAlert confirmation.
    function deletePrescription(id) {
        Swal.fire({
            title: 'Delete this prescription?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete'
        }).then(function (result) {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/api/prescriptions/' + id,
                    type: 'DELETE',
                    success: function (response) {
                        Swal.fire('Deleted', response.message, 'success');
                        loadPrescriptions();
                    },
                    error: function (xhr) {
                        showAjaxError(xhr);
                    }
                });
            }
        });
    }
</script>
@endpush
