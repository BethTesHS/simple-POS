<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
class CustomerController extends Controller

{
    public function store(Request $request)
    {
        try{
            $validated = $request->validate([
                'firstName' => 'required|string|max:255',
                'lastName' => 'required|string|max:255',
                'phoneNo' => 'required|integer',
            ]);

            $customer = new Customer();

            $customer->firstName = $validated['firstName'];
            $customer->lastName = $validated['lastName'];
            $customer->phoneNo = $validated['phoneNo'];

            $customer->save();

            return redirect()->route('customers')->with('success', 'Product added successfully!');
        } catch (ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->validator) // Store validation errors
                ->with('error_alert', true); // Store session flag for alert
        }
    }
    public function update(Request $request) {

        try{
            $validated = $request->validate([
                'id' => 'required|string',
                'firstName' => 'required|string|max:255',
                'lastName' => 'required|string|max:255',
                'phoneNo' => 'required|integer',
            ]);

            $customers = Customer::findOrFail($validated['id']);

            $customers->firstName = $validated['firstName'];
            $customers->lastName = $validated['lastName'];
            $customers->phoneNo = $validated['phoneNo'];

            $customers->save();

            return redirect()->route('customers')->with('success', 'Success!');
        } catch (ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->validator) // Store validation errors
                ->with('error_alert', true); // Store session flag for alert
        }
    }

    public function delete(Request $request) {
        try{
            $validated = $request->validate([
                'id' => 'required|string|max:10',
            ]);

            $customer = Customer::findOrFail( $validated['id']);

            $customer->delete();

            return redirect()->route('customers')->with('success', 'Success!');
        } catch (ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->validator) // Store validation errors
                ->with('error_alert', true); // Store session flag for alert
        }
    }
}
