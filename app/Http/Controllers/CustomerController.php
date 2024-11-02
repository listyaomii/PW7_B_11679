<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Bookings; // Ensure to import the Bookings model

class CustomerController extends Controller
{
    public function index()
    {
        // Mengambil data customers dan mengirim ke view dengan pagination
        $customers = Customer::orderBy('created_at', 'desc')->paginate(5);
        return view('customer.index', compact('customers'));
    }

    public function create()
    {
        // Mengambil data booking yang telah ada
        $bookings = Bookings::all(); // Fetch all bookings from the database
        return view('customer.create', compact('bookings')); // Pass bookings to the view
    }

    public function store(Request $request)
    {
        // Validate form data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'quantity' => 'required|integer',
            'id_bookings' => 'required|exists:bookings,id',
        ]);
    
        // Create a new customer record with only the specified fields
        Customer::create($request->only(['name', 'email', 'phone', 'quantity', 'id_bookings']));
    
        // Redirect with a success message
        return redirect()->route('customer.index')->with('success', 'Customer created successfully.');
    }
    

    public function edit($id)
    {
        // Mengambil data customer berdasarkan ID
        $customer = Customer::findOrFail($id);
        
        // Mengambil data booking yang telah ada
        $bookings = Bookings::all(); // Fetch all bookings from the database
        
        return view('customer.edit', compact('customer', 'bookings')); // Pass customer and bookings to the view
    }

    public function update(Request $request, $id)
    {
        // Validasi data yang dikirim dari form
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'quantity' => 'required|integer',
            'id_bookings' => 'required|exists:bookings,id', // Ensure the booking exists
        ]);

        // Mencari customer berdasarkan ID dan memperbarui data
        $customer = Customer::findOrFail($id);
        $customer->update($request->all());

        return redirect()->route('customer.index')->with('success', 'Customer updated successfully.');
    }

    public function destroy($id)
    {
        // Mencari customer berdasarkan ID dan menghapusnya
        $customer = Customer::findOrFail($id);
        $customer->delete();

        return redirect()->route('customer.index')->with('success', 'Customer deleted successfully.');
    }
}
