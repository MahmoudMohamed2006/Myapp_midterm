@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 slide-up">
    <div class="text-center mb-16">
        <h1 class="text-4xl md:text-5xl font-extrabold text-slate-900 tracking-tight mb-4">Discover Your Next <span class="text-transparent bg-clip-text bg-gradient-to-r from-brand-500 to-indigo-600">Great Read</span></h1>
        <p class="text-xl text-slate-500 max-w-2xl mx-auto">Browse our collection of premium books. Find something you love and borrow it instantly.</p>
    </div>

    @if($books->isEmpty())
        <div class="text-center py-12 bg-white rounded-2xl shadow-sm border border-slate-100">
            <svg class="mx-auto h-12 w-12 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
            </svg>
            <h3 class="mt-2 text-sm font-medium text-slate-900">No books available</h3>
            <p class="mt-1 text-sm text-slate-500">Check back later for new additions to our catalogue.</p>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
            @foreach($books as $book)
                <div class="bg-white rounded-2xl shadow-sm hover:shadow-xl transition-shadow duration-300 border border-slate-100 overflow-hidden flex flex-col items-start p-6 group">
                    <div class="w-full bg-gradient-to-br from-slate-50 to-slate-100 h-48 rounded-xl flex items-center justify-center mb-6 group-hover:scale-[1.02] transition-transform duration-300">
                        <svg class="h-20 w-20 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 mb-1 leading-tight group-hover:text-brand-600 transition-colors">{{ $book->title }}</h3>
                    <p class="text-sm text-slate-500 mb-4">By {{ $book->author }}</p>
                    
                    <div class="mt-auto w-full pt-4 border-t border-slate-100">
                        <div class="flex justify-between items-center mb-4">
                            <span class="text-xs font-semibold uppercase tracking-wider text-slate-400">ISBN:</span>
                            <span class="text-xs text-slate-600 font-mono">{{ $book->isbn }}</span>
                        </div>
                        <div class="flex justify-between items-center mb-4">
                            <span class="text-xs font-semibold uppercase tracking-wider {{ $book->copies > 0 ? 'text-green-500' : 'text-red-500' }}">
                                {{ $book->copies > 0 ? 'In Stock' : 'Out of Stock' }}
                            </span>
                            <span class="text-sm font-bold text-slate-700">{{ $book->copies }} <span class="text-xs font-normal text-slate-500">copies</span></span>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex gap-2">
                            <form action="{{ route('borrow.store', $book->id) }}" method="POST" class="flex-1">
                                @csrf
                                <button type="submit" 
                                    class="w-full text-center px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200 
                                    @if($book->copies > 0) bg-brand-600 text-white hover:bg-brand-700 shadow hover:shadow-md 
                                    @else bg-slate-100 text-slate-400 cursor-not-allowed @endif"
                                    @if($book->copies <= 0) disabled @endif>
                                    @if($book->copies > 0) Borrow Book @else Unavailable @endif
                                </button>
                            </form>

                            @auth
                                @if(Auth::user()->hasRole('Admin') || Auth::user()->hasRole('Librarian'))
                                    <a href="{{ route('books.edit', $book->id) }}" class="px-3 py-2 bg-slate-100 hover:bg-slate-200 text-slate-600 rounded-lg text-sm font-medium transition-colors">Edit</a>
                                    <form action="{{ route('books.destroy', $book->id) }}" method="POST" onsubmit="return confirm('Ensure you want to format this book softly?');">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="px-3 py-2 bg-red-50 hover:bg-red-100 text-red-600 rounded-lg text-sm font-medium transition-colors">Del</button>
                                    </form>
                                @endif
                            @endauth
                        </div>

                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
