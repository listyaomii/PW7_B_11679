<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Models\Book;


class BookController extends Controller
{
    /**
    * index
    *
    * @return void
    */
    public function index()
    //get book
    {
        $book = Book::latest()->paginate(5);
        //render view with posts
        return view('book.index', compact('book'));
    }

    /**
    * create
    *
    * @return void
    */
    public function create()
    {
        return view('book.create');
    }

    /**
    * store
    *
    * @param Request $request
    * @return void
    */
    public function store(Request $request)
    {
        // Validasi Formulir
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'pages' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048' // Validasi gambar jika ada
        ]);
    
        // Proses upload gambar
        $imagePath = null; // Pastikan ini null secara default
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public'); // Simpan gambar ke public/images
        }
    
        // Simpan data ke dalam database
        Book::create([
            'title' => $request->title,
            'author' => $request->author,
            'pages' => $request->pages,
            'image' => $imagePath, // Menggunakan $imagePath yang bisa null
        ]);
    
        return redirect()->route('book.index')->with(['success' => 'Book Added Successfully!']);
    }
    

/**
 * update
 *
 * @param Request $request
 * @param int $id
 * @return void
 */
 public function edit($id)
{
    $book = Book::find($id);
    // Check if the book exists
    if (!$book) {
        return redirect()->route('book.index')->with(['error' => 'Book not found!']);
    }
    return view('book.edit', compact('book'));
}

public function update(Request $request, $id)
{
    $book = Book::find($id);
    
    // Validate form
    $request->validate([
        'title' => 'required',
        'author' => 'required',
        'pages' => 'required',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048' // Validate image if provided
    ]);
    
    // Check if a new image is uploaded
    $imagePath = $book->image; // Keep the old image path by default
    if ($request->hasFile('image')) {
        // If there's a new image, store it and update the image path
        $image = $request->file('image');
        $imagePath = $image->store('images', 'public'); // Save to 'storage/app/public/book_images'
    }

    // Update the book data
    $book->update([
        'title' => $request->title,
        'author' => $request->author,
        'pages' => $request->pages,
        'image' => $imagePath, // Save new image path if uploaded, or keep old
    ]);

    return redirect()->route('book.index')->with(['success' => 'Data Berhasil Diubah!']);
}

    /**
    * destroy
    *
    * @param int $id
    * @return void
    */
    public function destroy($id)
    {
        $book = Book::find($id);
        $book->delete();
        return redirect()->route('book.index')->with(['success' => 'Data
        Berhasil Dihapus!']);
    }
        
    

}
