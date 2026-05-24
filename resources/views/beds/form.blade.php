<div class="row">
    <div class="col-md-6 mb-3"><label>Room</label><select name="room_id" class="form-control">@foreach($rooms as $room)<option value="{{ $room->id }}" @selected(old('room_id',$bed->room_id ?? '')==$room->id)>{{ $room->room_number }} - {{ $room->room_type }}</option>@endforeach</select></div>
    <div class="col-md-6 mb-3"><label>Bed Number</label><input name="bed_number" class="form-control" value="{{ old('bed_number',$bed->bed_number ?? '') }}"></div>
    <div class="col-md-6 mb-3"><label>Status</label><select name="status" class="form-control"><option value="available" @selected(old('status',$bed->status ?? '')=='available')>Available</option><option value="occupied" @selected(old('status',$bed->status ?? '')=='occupied')>Occupied</option></select></div>
</div>
