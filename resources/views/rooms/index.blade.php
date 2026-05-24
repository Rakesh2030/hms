@extends('layouts.hms')
@section('content')
<div class="d-flex flex-column flex-sm-row justify-content-between gap-2 mb-3"><h3>Rooms</h3><a href="{{ route('rooms.create') }}" class="btn btn-primary mobile-full-btn">Add Room</a></div>
<div class="card"><div class="card-body"><div class="table-responsive"><table class="table table-bordered">
<thead><tr><th>Room No</th><th>Type</th><th>Floor</th><th>Price</th><th width="220">Action</th></tr></thead>
<tbody id="roomsTable"><tr><td colspan="5" class="text-center">Loading...</td></tr></tbody>
</table></div></div></div>

{{-- Old normal CRUD table loop and delete form --}}
{{-- @foreach($rooms as $room)
<form action="{{ route('rooms.destroy',$room) }}" method="POST">@csrf @method('DELETE')</form>
@endforeach --}}
@endsection

@push('scripts')
<script>
    $(document).ready(function () {
        loadRooms();
    });

    // Fetch room data from API and show it in table.
    function loadRooms() {
        $.get('/api/rooms', function (response) {
            var rows = '';

            $.each(response.data, function (index, room) {
                rows += '<tr>';
                rows += '<td>' + textValue(room.room_number) + '</td>';
                rows += '<td>' + textValue(room.room_type) + '</td>';
                rows += '<td>' + textValue(room.floor) + '</td>';
                rows += '<td>' + textValue(room.price_per_day) + '</td>';
                rows += '<td>';
                rows += '<a href="/rooms/' + room.id + '" class="btn btn-sm btn-info">View</a> ';
                rows += '<a href="/rooms/' + room.id + '/edit" class="btn btn-sm btn-warning">Edit</a> ';
                rows += '<button class="btn btn-sm btn-danger" onclick="deleteRoom(' + room.id + ')">Delete</button>';
                rows += '</td></tr>';
            });

            if (rows == '') {
                rows = '<tr><td colspan="5" class="text-center">No rooms found.</td></tr>';
            }

            $('#roomsTable').html(rows);
        });
    }

    // Delete room using API after SweetAlert confirmation.
    function deleteRoom(id) {
        Swal.fire({
            title: 'Delete this room?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete'
        }).then(function (result) {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/api/rooms/' + id,
                    type: 'DELETE',
                    success: function (response) {
                        Swal.fire('Deleted', response.message, 'success');
                        loadRooms();
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
