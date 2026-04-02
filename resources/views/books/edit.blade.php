@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-10 slide-up">
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-8">
        <h2 class="text-2xl font-bold text-slate-900 mb-6 border-b border-slate-100 pb-4">Edit Book</h2>
        
        <form action="{{ route('books.update', $book->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="space-y-6">
                <div>
                    <label for="title" class="block text-sm font-medium text-slate-700 mb-1">Book Title</label>
                    <input type="text" name="title" id="title" required class="w-full rounded-lg border-slate-300 focus:border-brand-500 focus:ring-brand-500 px-4 py-2 border shadow-sm" value="{{ old('title', $book->title) }}">
                    @error('title')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
                
                <div>
                    <label for="author" class="block text-sm font-medium text-slate-700 mb-1">Author</label>
                    <input type="text" name="author" id="author" required class="w-full rounded-lg border-slate-300 focus:border-brand-500 focus:ring-brand-500 px-4 py-2 border shadow-sm" value="{{ old('author', $book->author) }}">
                    @error('author')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label for="isbn" class="block text-sm font-medium text-slate-700 mb-1">ISBN</label>
                    <input type="text" name="isbn" id="isbn" required class="w-full rounded-lg border-slate-300 focus:border-brand-500 focus:ring-brand-500 px-4 py-2 border shadow-sm" value="{{ old('isbn', $book->isbn) }}">
                    @error('isbn')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label for="copies" class="block text-sm font-medium text-slate-700 mb-1">Number of Copies</label>
                    <input type="number" name="copies" id="copies" min="0" required class="w-full rounded-lg border-slate-300 focus:border-brand-500 focus:ring-brand-500 px-4 py-2 border shadow-sm" value="{{ old('copies', $book->copies) }}">
                    @error('copies')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <div class="pt-4 flex justify-end">
                    <a href="{{ route('home') }}" class="px-4 py-2 text-sm font-medium text-slate-600 hover:text-slate-900 mr-4">Cancel</a>
                    <button type="submit" class="px-6 py-2 bg-brand-600 hover:bg-brand-700 text-white rounded-lg font-medium shadow-md transition-all">Update Book</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
