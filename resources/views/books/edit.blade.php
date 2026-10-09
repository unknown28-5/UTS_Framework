@extends('Dashboard')
@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-white">
        <h4 class="mb-0">Edit Data Buku</h4>
    </div>
    <div class="card-body">
        <form action="{{ route('books.update', $book->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="mb-3">
                <label for="title" class="form-label">Judul Buku</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $book->title) }}">

                @error('title')
                    <div class="text-danger mt-1 small">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mb-3">
                <label for="category_id" class="form-label">Kategori</label>
                <select name="category_id" id="category_id" class="form-select">
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id', $book->category_id) == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id') 
                    <div class="text-danger mt-1 small">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="author" class="form-label">Penulis</label>
                <input type="text" class="form-control" id="author" name="author" value="{{ old('author', $book->author) }}">
                @error('author') 
                    <div class="text-danger mt-1 small">{{ $message }}</div> 
                @enderror
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="published_year" class="form-label">Tahun Terbit</label>
                    <input type="number" class="form-control" id="published_year" name="published_year" value="{{ old('published_year', $book->published_year) }}">
                    @error('published_year') 
                        <div class="text-danger mt-1 small">{{ $message }}</div> 
                    @enderror
                </div>
                
                <div class="col-md-6 mb-3">
                    <label for="stock" class="form-label">Stok Buku</label>
                    <input type="number" class="form-control" id="stock" name="stock" value="{{ old('stock', $book->stock) }}">
                    @error('stock') 
                        <div class="text-danger mt-1 small">{{ $message }}</div> 
                    @enderror
                </div>
            </div>

            <button type="submit" class="btn btn-success">Update Buku</button>
            <a href="{{ route('books.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection