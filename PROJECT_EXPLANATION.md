# Hospital Management System API CRUD Explanation

## What Is API CRUD?

CRUD means:

- Create: add new data
- Read: show data
- Update: edit data
- Delete: remove data

Before, the Blade form submitted directly to a normal web controller. Now the Blade page uses AJAX to call an API route. The API controller saves data and returns JSON.

## Old CRUD Flow

Old flow:

User fills form -> form submits normally -> web route is called -> web controller saves data -> page redirects back

Example old code:

```php
// Old normal CRUD code
// Patient::create($request->all());
// return redirect()->route('patients.index');
```

The old web route examples are kept as comments in `routes/web.php`.

## New API CRUD Flow

New flow:

User clicks Save -> AJAX sends request -> API route is called -> API controller stores data -> JSON response returns -> frontend shows success message and updates/redirects

Example API response:

```php
return response()->json([
    'status' => true,
    'message' => 'Patient added successfully.',
    'data' => $patient
]);
```

## API Routes

API routes are written in `routes/api.php`.

Example:

```php
Route::apiResource('patients', PatientController::class)->names('api.patients');
```

The API routes are inside `web` and `auth` middleware, so only logged-in users can call them from the HMS pages. Admin-only modules also use the same `role:Admin` rule as before.

Laravel automatically creates these API URLs:

- `GET /api/patients`
- `POST /api/patients`
- `GET /api/patients/{patient}`
- `PUT /api/patients/{patient}`
- `DELETE /api/patients/{patient}`

## AJAX Flow

The Blade forms now use jQuery AJAX.

Example:

```javascript
$.ajax({
    url: '/api/patients',
    type: 'POST',
    data: formData,
    success: function (response) {
        Swal.fire('Success', response.message, 'success');
    }
});
```

This means the page does not submit in the old normal way. JavaScript sends the data to the API.

## JSON Response

JSON is simple data sent from backend to frontend.

Example:

```json
{
    "status": true,
    "message": "Patient added successfully.",
    "data": {
        "id": 1,
        "name": "John"
    }
}
```

The frontend reads this response and shows success or error messages.

## Complete Save Flow

1. User opens a create or edit page.
2. User fills the form.
3. User clicks Save.
4. jQuery stops normal form submit.
5. AJAX sends data to `/api/...`.
6. API route calls API controller.
7. API controller validates data.
8. API controller saves data using model.
9. Controller returns JSON response.
10. Frontend shows SweetAlert success message.
11. Frontend redirects back to list page.

## Complete Table Flow

1. User opens list page.
2. Table first shows `Loading...`.
3. jQuery calls `GET /api/...`.
4. API controller returns JSON data.
5. JavaScript creates table rows.
6. Table displays latest data.

## Complete Delete Flow

1. User clicks Delete.
2. SweetAlert asks for confirmation.
3. If confirmed, AJAX sends `DELETE /api/.../{id}`.
4. API controller deletes the record.
5. JSON success response returns.
6. Frontend reloads the table from API.

## Files Added

- `routes/api.php`
- `app/Http/Controllers/Api/DoctorController.php`
- `app/Http/Controllers/Api/PatientController.php`
- `app/Http/Controllers/Api/AppointmentController.php`
- `app/Http/Controllers/Api/PrescriptionController.php`
- `app/Http/Controllers/Api/RoomController.php`
- `app/Http/Controllers/Api/BedController.php`
- `app/Http/Controllers/Api/BedAllotmentController.php`
- `app/Http/Controllers/Api/BillingController.php`
- `app/Http/Controllers/Api/SettingController.php`

## Important Interview Point

Web controllers and web routes now mainly show Blade pages.

API controllers and API routes now handle real CRUD work.

This keeps the project easy to explain:

- Blade is for UI
- jQuery AJAX connects UI to API
- API controller handles database work
- JSON response tells frontend what happened
