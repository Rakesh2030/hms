<div class="row">
    <div class="col-md-6 mb-3"><label>Name</label><input name="name" class="form-control" value="{{ old('name',$patient->name ?? '') }}"></div>
    <div class="col-md-6 mb-3"><label>Email</label><input name="email" class="form-control" value="{{ old('email',$patient->email ?? '') }}"></div>
    <div class="col-md-6 mb-3"><label>Phone</label><input name="phone" class="form-control" value="{{ old('phone',$patient->phone ?? '') }}"></div>
    <div class="col-md-6 mb-3"><label>Age</label><input name="age" class="form-control" value="{{ old('age',$patient->age ?? '') }}"></div>
    <div class="col-md-6 mb-3"><label>Gender</label><select name="gender" class="form-control"><option value="">Select</option><option value="male" @selected(old('gender',$patient->gender ?? '')=='male')>Male</option><option value="female" @selected(old('gender',$patient->gender ?? '')=='female')>Female</option></select></div>
    <div class="col-md-6 mb-3"><label>Blood Group</label><input name="blood_group" class="form-control" value="{{ old('blood_group',$patient->blood_group ?? '') }}"></div>
    <div class="col-md-12 mb-3"><label>Address</label><input name="address" class="form-control" value="{{ old('address',$patient->address ?? '') }}"></div>
</div>
