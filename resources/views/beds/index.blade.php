@extends('layouts.hms')
@section('content')
<div class="d-flex flex-column flex-sm-row justify-content-between gap-2 mb-3"><h3>Beds</h3><a href="{{ route('beds.create') }}" class="btn btn-primary mobile-full-btn">Add Bed</a></div>
<div class="card"><div class="card-body"><div class="table-responsive"><table class="table table-bordered">
<thead><tr><th>Bed No</th><th>Room</th><th>Status</th><th width="220">Action</th></tr></thead>
<tbody id="bedsTable"><tr><td colspan="4" class="text-center">Loading...</td></tr></tbody>
</table></div></div></div>

{{-- Old normal CRUD table loop and delete form --}}
{{-- @foreach($beds as $bed)
<form action="{{ route('beds.destroy',$bed) }}" method="POST">@csrf @method('DELETE')</form>
@endforeach --}}
@endsection

@push('scripts')
<script>
    $(document).ready(function () {
        loadBeds();
    });

    // Fetch bed data from API and show it in table.
    function loadBeds() {
        $.get('/api/beds', function (response) {
            var rows = '';

            $.each(response.data, function (index, bed) {
                rows += '<tr>';
                rows += '<td>' + textValue(bed.bed_number) + '</td>';
                rows += '<td>' + textValue(bed.room ? bed.room.room_number : '') + '</td>';
                rows += '<td>' + textValue(bed.status) + '</td>';
                rows += '<td>';
                rows += '<a href="/beds/' + bed.id + '" class="btn btn-sm btn-info">View</a> ';
                rows += '<a href="/beds/' + bed.id + '/edit" class="btn btn-sm btn-warning">Edit</a> ';
                rows += '<button class="btn btn-sm btn-danger" onclick="deleteBed(' + bed.id + ')">Delete</button>';
                rows += '</td></tr>';
            });

            if (rows == '') {
                rows = '<tr><td colspan="4" class="text-center">No beds found.</td></tr>';
            }

            $('#bedsTable').html(rows);
        });
    }

    // Delete bed using API after SweetAlert confirmation.
    function deleteBed(id) {
        Swal.fire({
            title: 'Delete this bed?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete'
        }).then(function (result) {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/api/beds/' + id,
                    type: 'DELETE',
                    success: function (response) {
                        Swal.fire('Deleted', response.message, 'success');
                        loadBeds();
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
