@extends('layouts.hms')
@section('content')
<div class="d-flex flex-column flex-sm-row justify-content-between gap-2 mb-3"><h3>Patients</h3><a href="{{ route('patients.create') }}" class="btn btn-primary mobile-full-btn">Add Patient</a></div>
<div class="card"><div class="card-body"><div class="table-responsive"><table class="table table-bordered">
<thead><tr><th>Name</th><th>Email</th><th>Phone</th><th>Age</th><th width="220">Action</th></tr></thead>
<tbody id="patientsTable"><tr><td colspan="5" class="text-center">Loading...</td></tr></tbody>
</table></div></div></div>

{{-- Old normal CRUD table loop and delete form --}}
{{-- @foreach($patients as $patient)
<form action="{{ route('patients.destroy',$patient) }}" method="POST">@csrf @method('DELETE')</form>
@endforeach --}}
@endsection

@push('scripts')
<script>
    $(document).ready(function () {
        loadPatients();
    });

    // Fetch patient data from API and show it in table.
    function loadPatients() {
        $.get('/api/patients', function (response) {
            var rows = '';

            $.each(response.data, function (index, patient) {
                rows += '<tr>';
                rows += '<td>' + textValue(patient.name) + '</td>';
                rows += '<td>' + textValue(patient.email) + '</td>';
                rows += '<td>' + textValue(patient.phone) + '</td>';
                rows += '<td>' + textValue(patient.age) + '</td>';
                rows += '<td>';
                rows += '<a href="/patients/' + patient.id + '" class="btn btn-sm btn-info">View</a> ';
                rows += '<a href="/patients/' + patient.id + '/edit" class="btn btn-sm btn-warning">Edit</a> ';
                rows += '<button class="btn btn-sm btn-danger" onclick="deletePatient(' + patient.id + ')">Delete</button>';
                rows += '</td></tr>';
            });

            if (rows == '') {
                rows = '<tr><td colspan="5" class="text-center">No patients found.</td></tr>';
            }

            $('#patientsTable').html(rows);
        });
    }

    // Delete patient using API after SweetAlert confirmation.
    function deletePatient(id) {
        Swal.fire({
            title: 'Delete this patient?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete'
        }).then(function (result) {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/api/patients/' + id,
                    type: 'DELETE',
                    success: function (response) {
                        Swal.fire('Deleted', response.message, 'success');
                        loadPatients();
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
