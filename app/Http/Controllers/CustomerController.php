<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Bookings; 

class CustomerController extends Controller
{
    public function index()
    {
       
        $customers = Customer::orderBy('created_at', 'desc')->paginate(5);
        return view('customer.index', compact('customers'));
    }

    public function create()
    {
        
        $bookings = Bookings::all(); 
        return view('customer.create', compact('bookings')); 
    }

    public function store(Request $request)
    {
       
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'quantity' => 'required|integer',
            'id_bookings' => 'required|exists:bookings,id',
        ]);
    
       
        Customer::create($request->only(['name', 'email', 'phone', 'quantity', 'id_bookings']));
    
      
        return redirect()->route('customer.index')->with('success', 'Customer created successfully.');
    }
    

    public function edit($id)
    {
       
        $customer = Customer::findOrFail($id);
        
       
        $bookings = Bookings::all(); 
        
        return view('customer.edit', compact('customer', 'bookings')); 
    }

    public function update(Request $request, $id)
    {
       
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'quantity' => 'required|integer',
            'id_bookings' => 'required|exists:bookings,id', 
        ]);

        
        $customer = Customer::findOrFail($id);
        $customer->update($request->all());

        return redirect()->route('customer.index')->with('success', 'Customer updated successfully.');
    }

    public function destroy($id)
    {
       
        $customer = Customer::findOrFail($id);
        $customer->delete();

        return redirect()->route('customer.index')->with('success', 'Customer deleted successfully.');
    }
}
