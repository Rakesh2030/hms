<div class="row">
    <div class="col-md-6 mb-3"><label>Room Number</label><input name="room_number" class="form-control" value="{{ old('room_number',$room->room_number ?? '') }}"></div>
    <div class="col-md-6 mb-3"><label>Room Type</label><input name="room_type" class="form-control" value="{{ old('room_type',$room->room_type ?? '') }}"></div>
    <div class="col-md-6 mb-3"><label>Floor</label><input name="floor" class="form-control" value="{{ old('floor',$room->floor ?? '') }}"></div>
    <div class="col-md-6 mb-3"><label>Price Per Day</label><input name="price_per_day" class="form-control" value="{{ old('price_per_day',$room->price_per_day ?? '') }}"></div>
</div>
