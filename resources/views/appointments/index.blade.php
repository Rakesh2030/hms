@extends('layouts.hms')
@section('content')
<div class="d-flex flex-column flex-sm-row justify-content-between gap-2 mb-3"><h3>Appointments</h3><a href="{{ route('appointments.create') }}" class="btn btn-primary mobile-full-btn">Add Appointment</a></div>
<div class="card"><div class="card-body"><div class="table-responsive"><table class="table table-bordered">
<thead><tr><th>Doctor</th><th>Patient</th><th>Date</th><th>Status</th><th width="220">Action</th></tr></thead>
<tbody id="appointmentsTable"><tr><td colspan="5" class="text-center">Loading...</td></tr></tbody>
</table></div></div></div>

{{-- Old normal CRUD table loop and delete form --}}
{{-- @foreach($appointments as $appointment)
<form action="{{ route('appointments.destroy',$appointment) }}" method="POST">@csrf @method('DELETE')</form>
@endforeach --}}
@endsection

@push('scripts')
<script>
    $(document).ready(function () {
        loadAppointments();
    });

    // Fetch appointment data from API and show it in table.
    function loadAppointments() {
        $.get('/api/appointments', function (response) {
            var rows = '';

            $.each(response.data, function (index, appointment) {
                rows += '<tr>';
                rows += '<td>' + textValue(appointment.doctor ? appointment.doctor.name : '') + '</td>';
                rows += '<td>' + textValue(appointment.patient ? appointment.patient.name : '') + '</td>';
                rows += '<td>' + textValue(appointment.appointment_date) + '</td>';
                rows += '<td>' + textValue(appointment.status) + '</td>';
                rows += '<td>';
                rows += '<a href="/appointments/' + appointment.id + '" class="btn btn-sm btn-info">View</a> ';
                rows += '<a href="/appointments/' + appointment.id + '/edit" class="btn btn-sm btn-warning">Edit</a> ';
                rows += '<button class="btn btn-sm btn-danger" onclick="deleteAppointment(' + appointment.id + ')">Delete</button>';
                rows += '</td></tr>';
            });

            if (rows == '') {
                rows = '<tr><td colspan="5" class="text-center">No appointments found.</td></tr>';
            }

            $('#appointmentsTable').html(rows);
        });
    }

    // Delete appointment using API after SweetAlert confirmation.
    function deleteAppointment(id) {
        Swal.fire({
            title: 'Delete this appointment?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete'
        }).then(function (result) {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/api/appointments/' + id,
                    type: 'DELETE',
                    success: function (response) {
                        Swal.fire('Deleted', response.message, 'success');
                        loadAppointments();
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
