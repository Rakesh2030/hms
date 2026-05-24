@extends('layouts.hms')
@section('content')
<div class="d-flex flex-column flex-sm-row justify-content-between gap-2 mb-3"><h3>Bed Allotments</h3><a href="{{ route('bed-allotments.create') }}" class="btn btn-primary mobile-full-btn">Allot Bed</a></div>
<div class="card"><div class="card-body"><div class="table-responsive"><table class="table table-bordered">
<thead><tr><th>Patient</th><th>Bed</th><th>Allotment Date</th><th>Status</th><th width="220">Action</th></tr></thead>
<tbody id="bedAllotmentsTable"><tr><td colspan="5" class="text-center">Loading...</td></tr></tbody>
</table></div></div></div>

{{-- Old normal CRUD table loop and delete form --}}
{{-- @foreach($bedAllotments as $bedAllotment)
<form action="{{ route('bed-allotments.destroy',$bedAllotment) }}" method="POST">@csrf @method('DELETE')</form>
@endforeach --}}
@endsection

@push('scripts')
<script>
    $(document).ready(function () {
        loadBedAllotments();
    });

    // Fetch bed allotment data from API and show it in table.
    function loadBedAllotments() {
        $.get('/api/bed-allotments', function (response) {
            var rows = '';

            $.each(response.data, function (index, bedAllotment) {
                rows += '<tr>';
                rows += '<td>' + textValue(bedAllotment.patient ? bedAllotment.patient.name : '') + '</td>';
                rows += '<td>' + textValue(bedAllotment.bed ? bedAllotment.bed.bed_number : '') + '</td>';
                rows += '<td>' + textValue(bedAllotment.allotment_date) + '</td>';
                rows += '<td>' + textValue(bedAllotment.status) + '</td>';
                rows += '<td>';
                rows += '<a href="/bed-allotments/' + bedAllotment.id + '" class="btn btn-sm btn-info">View</a> ';
                rows += '<a href="/bed-allotments/' + bedAllotment.id + '/edit" class="btn btn-sm btn-warning">Edit</a> ';
                rows += '<button class="btn btn-sm btn-danger" onclick="deleteBedAllotment(' + bedAllotment.id + ')">Delete</button>';
                rows += '</td></tr>';
            });

            if (rows == '') {
                rows = '<tr><td colspan="5" class="text-center">No bed allotments found.</td></tr>';
            }

            $('#bedAllotmentsTable').html(rows);
        });
    }

    // Delete bed allotment using API after SweetAlert confirmation.
    function deleteBedAllotment(id) {
        Swal.fire({
            title: 'Delete this allotment?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete'
        }).then(function (result) {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/api/bed-allotments/' + id,
                    type: 'DELETE',
                    success: function (response) {
                        Swal.fire('Deleted', response.message, 'success');
                        loadBedAllotments();
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
