@extends('layouts.hms')
@section('content')
<div class="d-flex flex-column flex-sm-row justify-content-between gap-2 mb-3"><h3>Billing</h3><a href="{{ route('billings.create') }}" class="btn btn-primary mobile-full-btn">Add Bill</a></div>
<div class="card"><div class="card-body"><div class="table-responsive"><table class="table table-bordered">
<thead><tr><th>Patient</th><th>Amount</th><th>Status</th><th>Date</th><th width="220">Action</th></tr></thead>
<tbody id="billingsTable"><tr><td colspan="5" class="text-center">Loading...</td></tr></tbody>
</table></div></div></div>

{{-- Old normal CRUD table loop and delete form --}}
{{-- @foreach($billings as $billing)
<form action="{{ route('billings.destroy',$billing) }}" method="POST">@csrf @method('DELETE')</form>
@endforeach --}}
@endsection

@push('scripts')
<script>
    $(document).ready(function () {
        loadBillings();
    });

    // Fetch bill data from API and show it in table.
    function loadBillings() {
        $.get('/api/billings', function (response) {
            var rows = '';

            $.each(response.data, function (index, billing) {
                rows += '<tr>';
                rows += '<td>' + textValue(billing.patient ? billing.patient.name : '') + '</td>';
                rows += '<td>' + textValue(billing.amount) + '</td>';
                rows += '<td>' + textValue(billing.payment_status) + '</td>';
                rows += '<td>' + textValue(billing.billing_date) + '</td>';
                rows += '<td>';
                rows += '<a href="/billings/' + billing.id + '" class="btn btn-sm btn-info">View</a> ';
                rows += '<a href="/billings/' + billing.id + '/edit" class="btn btn-sm btn-warning">Edit</a> ';
                rows += '<button class="btn btn-sm btn-danger" onclick="deleteBilling(' + billing.id + ')">Delete</button>';
                rows += '</td></tr>';
            });

            if (rows == '') {
                rows = '<tr><td colspan="5" class="text-center">No bills found.</td></tr>';
            }

            $('#billingsTable').html(rows);
        });
    }

    // Delete bill using API after SweetAlert confirmation.
    function deleteBilling(id) {
        Swal.fire({
            title: 'Delete this bill?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete'
        }).then(function (result) {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/api/billings/' + id,
                    type: 'DELETE',
                    success: function (response) {
                        Swal.fire('Deleted', response.message, 'success');
                        loadBillings();
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
