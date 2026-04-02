@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 slide-up">
    <div class="md:grid md:grid-cols-3 md:gap-8">
        
        <!-- Profile Sidebar -->
        <div class="md:col-span-1 mb-8 md:mb-0">
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
                <div class="flex items-center space-x-4 mb-6">
                    <div class="h-16 w-16 rounded-full bg-gradient-to-tr from-brand-500 to-indigo-600 flex items-center justify-center text-white text-2xl font-bold">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-slate-900">{{ Auth::user()->name }}</h2>
                        <p class="text-sm text-slate-500">{{ Auth::user()->email }}</p>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-brand-100 text-brand-800 mt-2">
                            {{ Auth::user()->role ? Auth::user()->role->name : 'Member' }}
                        </span>
                    </div>
                </div>
                
                <div class="border-t border-slate-100 pt-6">
                    <h3 class="text-sm font-medium text-slate-900 mb-4 uppercase tracking-wider">Account Status</h3>
                    <div class="flex justify-between items-center mb-3">
                        <span class="text-sm text-slate-500">Active Borrowings</span>
                        <span class="text-lg font-bold text-brand-600">{{ $activeBorrowingsCount }}</span>
                    </div>
                    <!-- Display borrowing status logic -->
                    <div class="mt-4 p-4 rounded-xl {{ $activeBorrowingsCount > 0 ? 'bg-indigo-50 border border-indigo-100' : 'bg-slate-50 border border-slate-100' }}">
                        <p class="text-sm text-slate-700 font-medium">
                            @if($activeBorrowingsCount > 0)
                                You have {{ $activeBorrowingsCount }} active borrowing(s). Please return them when you are done!
                            @else
                                You currently have no active borrowed books. Check out our catalogue!
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Borrowing History List -->
        <div class="md:col-span-2">
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
                <div class="px-6 py-5 border-b border-slate-100 bg-slate-50 border-l-4 border-l-brand-500">
                    <h3 class="text-lg leading-6 font-bold text-slate-900">Your Borrowing History</h3>
                    <p class="mt-1 max-w-2xl text-sm text-slate-500">List of all books you have borrowed on your account.</p>
                </div>
                
                @if($borrowings->isEmpty())
                    <div class="p-8 text-center text-slate-500">
                        You have not borrowed any books yet.
                    </div>
                @else
                    <ul class="divide-y divide-slate-100">
                        @foreach($borrowings as $borrow)
                            <li class="p-6 transition-colors hover:bg-slate-50">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 bg-slate-100 h-12 w-12 rounded-lg flex items-center justify-center">
                                            <svg class="h-6 w-6 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" /></svg>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-bold text-slate-900">{{ $borrow->book ? $borrow->book->title : 'Unknown Book' }}</div>
                                            <div class="text-sm text-slate-500">By {{ $borrow->book ? $borrow->book->author : 'Unknown' }}</div>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $borrow->status === 'Active' ? 'bg-amber-100 text-amber-800' : 'bg-green-100 text-green-800' }}">
                                            {{ $borrow->status }}
                                        </span>
                                        <div class="text-xs text-slate-500 mt-2">Borrowed: {{ $borrow->borrow_date->format('M d, Y') }}</div>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
        
    </div>
</div>
@endsection
