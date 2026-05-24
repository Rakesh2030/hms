<?php

namespace App\Http\Controllers;

use App\Models\Billing;
use App\Models\Patient;
use Illuminate\Http\Request;

class BillingController extends Controller
{
    // This web controller now mainly opens Blade pages.
    // Old normal CRUD store/update/delete code is kept below for interview explanation.
    // New API CRUD code is inside app/Http/Controllers/Api/BillingController.php.

    public function index()
    {
        $billings = Billing::with('patient')->latest()->get();
        return view('billings.index', compact('billings'));
    }

    public function create()
    {
        $patients = Patient::all();
        return view('billings.create', compact('patients'));
    }

    public function store(Request $request)
    {
        // Old normal CRUD code: form submitted directly to this controller.
        $request->validate([
            'patient_id' => 'required',
            'amount' => 'required|numeric',
            'payment_status' => 'required',
            'billing_date' => 'required|date',
        ]);

        Billing::create($request->all());
        return redirect()->route('billings.index')->with('success', 'Bill added successfully.');
    }

    public function show(Billing $billing)
    {
        return view('billings.show', compact('billing'));
    }

    public function edit(Billing $billing)
    {
        $patients = Patient::all();
        return view('billings.edit', compact('billing', 'patients'));
    }

    public function update(Request $request, Billing $billing)
    {
        // Old normal CRUD code: update happened directly from the Blade form.
        $request->validate([
            'patient_id' => 'required',
            'amount' => 'required|numeric',
            'payment_status' => 'required',
            'billing_date' => 'required|date',
        ]);

        $billing->update($request->all());
        return redirect()->route('billings.index')->with('success', 'Bill updated successfully.');
    }

    public function destroy(Billing $billing)
    {
        // Old normal CRUD code: delete happened directly from a web form.
        $billing->delete();
        return redirect()->route('billings.index')->with('success', 'Bill deleted successfully.');
    }
}
