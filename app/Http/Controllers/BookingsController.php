<?php

namespace App\Http\Controllers;

use App\Models\Bookings;
use Illuminate\Http\Request;
use App\Models\Book;

class BookingsController extends Controller
{
    /**
    * index
    *
    * @return void
    */
    public function index()
    {
        $bookings = Bookings::latest()->paginate(5);
  
        return view('bookings.index', compact('bookings'));
    }

    public function create()
    {
        $books = Book::all(); 
        return view('bookings.create', compact('books')); 
    }
    /**
     * store
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request)
    {
        
        $request->validate([
            'id_book' => 'required|exists:books,id', 
            'class' => 'required|string|max:255',
            'price' => 'required',
        ]);

      
        Bookings::create([
            'id_book' => $request->id_book, 
            'class' => $request->class,
            'price' => $request->price,
        ]);

        return redirect()->route('bookings.index')->with(['success' => 'Booking Created Successfully!']);
    }

/**
     * edit
     */
    public function edit($id)
    {
        $booking = Bookings::findOrFail($id); 
        $books = Book::all(); 
        return view('bookings.edit', compact('booking', 'books'));
    }

    /**
     * update
     */
    public function update(Request $request, $id)
    {
        $booking = Bookings::findOrFail($id);

       
        $request->validate([
            'id_book' => 'required|exists:books,id',
            'class' => 'required|string|max:255',
            'price' => 'required|numeric',
        ]);

       
        $booking->update([
            'id_book' => $request->id_book,
            'class' => $request->class,
            'price' => $request->price,
        ]);

        return redirect()->route('bookings.index')->with(['success' => 'Booking Updated Successfully!']);
    }

    /**
     * destroy
     */
    public function destroy($id)
    {
        $booking = Bookings::find($id);
        if (!$booking) {
            return redirect()->route('bookings.index')->with(['error' => 'Booking not found!']);
        }
        $booking->delete();
        return redirect()->route('bookings.index')->with(['success' => 'Booking Deleted Successfully!']);
    }
    
    
    
}
