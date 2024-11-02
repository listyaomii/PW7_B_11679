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
    //render view with posts
        return view('bookings.index', compact('bookings'));
    }

    public function create()
    {
        $books = Book::all(); // Ambil semua data buku untuk dropdown
        return view('bookings.create', compact('books')); // Kirim data buku ke view
    }
    /**
     * store
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request)
    {
        // Validate form data
        $request->validate([
            'id_book' => 'required|exists:books,id', // Validate that the book exists
            'class' => 'required|string|max:255',
            'price' => 'required',
        ]);

        // Create a new booking
        Bookings::create([
            'id_book' => $request->id_book, // Store the selected book ID
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
        $booking = Bookings::findOrFail($id); // Cari booking berdasarkan ID
        $books = Book::all(); // Ambil semua buku untuk dropdown
        return view('bookings.edit', compact('booking', 'books'));
    }

    /**
     * update
     */
    public function update(Request $request, $id)
    {
        $booking = Bookings::findOrFail($id);

        // Validasi data
        $request->validate([
            'id_book' => 'required|exists:books,id',
            'class' => 'required|string|max:255',
            'price' => 'required|numeric',
        ]);

        // Update booking
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
