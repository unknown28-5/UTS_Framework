<?php
namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // logic menampilkan daftar kategori
    public function index()
    {
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }

    // logic menampilkan form tambah kategori
    public function create()
    {
        return view('categories.create');
    }

    // logic simpan kategori
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|unique:categories|max:100',
            'description' => 'nullable'
        ]);

        Category::create($request->all());
        return redirect()->route('categories.index')->with('success', 'Kategori berhasil ditambahkan.');
    }

    // logic menampilkan form edit kategori
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    // Menyimpan perubahan data kategori
    public function update(Request $request, Category $category)
    {

        $request->validate([
            'name' => 'required|max:100|unique:categories,name,' . $category->id,
            'description' => 'nullable'
        ]);

        $category->update($request->all());
        return redirect()->route('categories.index')->with('success', 'Kategori berhasil diperbarui.');
    }

    // logic hapus kategori
    public function destroy(Category $category)
    {
        
        if ($category->books()->count() > 0) {
            return redirect()->route('categories.index')->with('error', 'Gagal dihapus: Kategori ini masih memiliki buku!');
        }
        
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Kategori berhasil dihapus.');
    }
}