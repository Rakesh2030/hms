<div class="row">
    <div class="col-md-6 mb-3"><label>Name</label><input name="name" class="form-control" value="{{ old('name',$doctor->name ?? '') }}"></div>
    <div class="col-md-6 mb-3"><label>Email</label><input name="email" class="form-control" value="{{ old('email',$doctor->email ?? '') }}"></div>
    <div class="col-md-6 mb-3"><label>Phone</label><input name="phone" class="form-control" value="{{ old('phone',$doctor->phone ?? '') }}"></div>
    <div class="col-md-6 mb-3"><label>Specialization</label><input name="specialization" class="form-control" value="{{ old('specialization',$doctor->specialization ?? '') }}"></div>
    <div class="col-md-6 mb-3"><label>Qualification</label><input name="qualification" class="form-control" value="{{ old('qualification',$doctor->qualification ?? '') }}"></div>
    <div class="col-md-6 mb-3"><label>Address</label><input name="address" class="form-control" value="{{ old('address',$doctor->address ?? '') }}"></div>
</div>
