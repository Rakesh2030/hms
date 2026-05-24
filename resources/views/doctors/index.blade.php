@extends('layouts.hms')
@section('content')
<div class="d-flex flex-column flex-sm-row justify-content-between gap-2 mb-3"><h3>Doctors</h3><a href="{{ route('doctors.create') }}" class="btn btn-primary mobile-full-btn">Add Doctor</a></div>
<div class="card"><div class="card-body"><div class="table-responsive"><table class="table table-bordered">
<thead><tr><th>Name</th><th>Email</th><th>Phone</th><th>Specialization</th><th width="220">Action</th></tr></thead>
<tbody id="doctorsTable"><tr><td colspan="5" class="text-center">Loading...</td></tr></tbody>
</table></div></div></div>

{{-- Old normal CRUD table loop and delete form --}}
{{-- @foreach($doctors as $doctor)
<form action="{{ route('doctors.destroy',$doctor) }}" method="POST">@csrf @method('DELETE')</form>
@endforeach --}}
@endsection

@push('scripts')
<script>
    $(document).ready(function () {
        loadDoctors();
    });

    // Fetch doctor data from API and show it in table.
    function loadDoctors() {
        $.get('/api/doctors', function (response) {
            var rows = '';

            $.each(response.data, function (index, doctor) {
                rows += '<tr>';
                rows += '<td>' + textValue(doctor.name) + '</td>';
                rows += '<td>' + textValue(doctor.email) + '</td>';
                rows += '<td>' + textValue(doctor.phone) + '</td>';
                rows += '<td>' + textValue(doctor.specialization) + '</td>';
                rows += '<td>';
                rows += '<a href="/doctors/' + doctor.id + '" class="btn btn-sm btn-info">View</a> ';
                rows += '<a href="/doctors/' + doctor.id + '/edit" class="btn btn-sm btn-warning">Edit</a> ';
                rows += '<button class="btn btn-sm btn-danger" onclick="deleteDoctor(' + doctor.id + ')">Delete</button>';
                rows += '</td></tr>';
            });

            if (rows == '') {
                rows = '<tr><td colspan="5" class="text-center">No doctors found.</td></tr>';
            }

            $('#doctorsTable').html(rows);
        });
    }

    // Delete doctor using API after SweetAlert confirmation.
    function deleteDoctor(id) {
        Swal.fire({
            title: 'Delete this doctor?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete'
        }).then(function (result) {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/api/doctors/' + id,
                    type: 'DELETE',
                    success: function (response) {
                        Swal.fire('Deleted', response.message, 'success');
                        loadDoctors();
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
