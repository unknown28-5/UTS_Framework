<?php
namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class BookController extends Controller
{   // logic menampilkan daftar buku
    public function index()
    {
        $books = Book::with('category')->get(); 
        return view('books.index', compact('books'));
    }
    //logic menampilkan form tambah buku
    public function create()
    {
        $categories = Category::all();
        return view('books.create', compact('categories'));
    }
    //logic simpan buku
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|max:255',
            'author' => 'required|max:100',
            'published_year' => 'required|numeric',
            'stock' => 'required|numeric'
        ]);

        Book::create($request->all());
        return redirect()->route('books.index')->with('success', 'Buku berhasil ditambahkan.');
    }
    // logic menampilkan form edit buku
    public function edit(Book $book)
    {
        $categories = Category::all();
        return view('books.edit', compact('book', 'categories'));
    }

    // logic update/edit buku
    public function update(Request $request, Book $book)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|max:255',
            'author' => 'required|max:100',
            'published_year' => 'required|numeric',
            'stock' => 'required|numeric'
        ]);

        $book->update($request->all());
        return redirect()->route('books.index')->with('success', 'Data Buku berhasil diperbarui.');
    }

    // logic hapus buku
    public function destroy(Book $book)
    {
        $book->delete();
        return redirect()->route('books.index')->with('success', 'Buku berhasil dihapus.');
    }
}