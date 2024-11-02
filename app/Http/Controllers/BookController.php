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
       
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'pages' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048' 
        ]);
    
       
        $imagePath = null; 
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public'); 
        }
    
      
        Book::create([
            'title' => $request->title,
            'author' => $request->author,
            'pages' => $request->pages,
            'image' => $imagePath, 
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

    if (!$book) {
        return redirect()->route('book.index')->with(['error' => 'Book not found!']);
    }
    return view('book.edit', compact('book'));
}

public function update(Request $request, $id)
{
    $book = Book::find($id);
    

    $request->validate([
        'title' => 'required',
        'author' => 'required',
        'pages' => 'required',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048' 
    ]);
    
   
    $imagePath = $book->image; 
    if ($request->hasFile('image')) {
        
        $image = $request->file('image');
        $imagePath = $image->store('images', 'public'); 
    }

 
    $book->update([
        'title' => $request->title,
        'author' => $request->author,
        'pages' => $request->pages,
        'image' => $imagePath,
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
