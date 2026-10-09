@extends('dashboard')
@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-white">
        <h4 class="mb-0">Edit Kategori</h4>
    </div>
    <div class="card-body">
        <form action="{{ route('categories.update', $category->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="mb-3">
                <label for="name" class="form-label">Nama Kategori</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $category->name) }}">
                @error('name') 
                    <div class="text-danger mt-1 small">{{ $message }}</div> 
                @enderror
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Deskripsi</label>
                <textarea class="form-control" id="description" name="description" rows="3">{{ old('description', $category->description) }}</textarea>
                @error('description') 
                    <div class="text-danger mt-1 small">{{ $message }}</div> 
                @enderror
            </div>

            <button type="submit" class="btn btn-success">Update Kategori</button>
            <a href="{{ route('categories.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection