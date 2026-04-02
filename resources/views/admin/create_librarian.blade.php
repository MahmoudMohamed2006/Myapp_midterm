@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-10 slide-up">
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-8">
        <h2 class="text-2xl font-bold text-slate-900 mb-6 border-b border-slate-100 pb-4">Add Librarian Account</h2>
        
        <form action="{{ route('librarians.store') }}" method="POST">
            @csrf
            <div class="space-y-6">
                <div>
                    <label for="name" class="block text-sm font-medium text-slate-700 mb-1">Full Name</label>
                    <input type="text" name="name" id="name" required class="w-full rounded-lg border-slate-300 focus:border-brand-500 focus:ring-brand-500 px-4 py-2 border shadow-sm" value="{{ old('name') }}">
                    @error('name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
                
                <div>
                    <label for="email" class="block text-sm font-medium text-slate-700 mb-1">Email Address</label>
                    <input type="email" name="email" id="email" required class="w-full rounded-lg border-slate-300 focus:border-brand-500 focus:ring-brand-500 px-4 py-2 border shadow-sm" value="{{ old('email') }}">
                    @error('email')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-slate-700 mb-1">Password</label>
                    <input type="password" name="password" id="password" required class="w-full rounded-lg border-slate-300 focus:border-brand-500 focus:ring-brand-500 px-4 py-2 border shadow-sm">
                    @error('password')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-slate-700 mb-1">Confirm Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" required class="w-full rounded-lg border-slate-300 focus:border-brand-500 focus:ring-brand-500 px-4 py-2 border shadow-sm">
                </div>

                <div class="pt-4 flex justify-end">
                    <a href="{{ route('members.index') }}" class="px-4 py-2 text-sm font-medium text-slate-600 hover:text-slate-900 mr-4">Cancel</a>
                    <button type="submit" class="px-6 py-2 bg-brand-600 hover:bg-brand-700 text-white rounded-lg font-medium shadow-md transition-all">Create Librarian</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
