<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
class UserController extends Controller
{
    public function update(Request $request) {

        try{
            $validated = $request->validate([
                'id' => 'required|string',
                'firstName' => 'required|string|max:255',
                'lastName' => 'required|string|max:255',
                'role' => 'required|string|max:255',
                // 'admin' => 'required|boolean',
            ]);

            $users = User::findOrFail($validated['id']);

            $users->firstName = $validated['firstName'];
            $users->lastName = $validated['lastName'];
            $users->role = $validated['role'];
            $users->admin = $request->input('admin', 0);

            $users->save();

            return redirect()->route('users')->with('success', 'Success!');
        } catch (ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->validator) // Store validation errors
                ->with('error_alert', true); // Store session flag for alert
        }
    }
}
