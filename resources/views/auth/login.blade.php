@extends('layouts.app')

@section('content')
<div class="min-h-[80vh] flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 slide-up">
    <div class="max-w-md w-full space-y-8 bg-white p-10 rounded-2xl shadow-xl border border-slate-100">
        <div>
            <h2 class="mt-2 text-center text-3xl font-extrabold text-slate-900">Welcome Back</h2>
            <p class="mt-2 text-center text-sm text-slate-600">
                Or <a href="{{ route('register') }}" class="font-medium text-brand-600 hover:text-brand-500 transition-colors">create an account</a>
            </p>
        </div>
        
        <form class="mt-8 space-y-6" action="{{ route('login') }}" method="POST">
            @csrf
            <div class="rounded-md shadow-sm -space-y-px">
                <div class="mb-4">
                    <label for="email" class="sr-only">Email address</label>
                    <input id="email" name="email" type="email" required class="appearance-none relative block w-full px-3 py-3 border @error('email') border-red-300 text-red-900 placeholder-red-300 @else border-slate-300 placeholder-slate-500 text-slate-900 @enderror rounded-t-xl focus:outline-none focus:ring-brand-500 focus:border-brand-500 focus:z-10 sm:text-sm" placeholder="Email address" value="{{ old('email') }}">
                </div>
                <div>
                    <label for="password" class="sr-only">Password</label>
                    <input id="password" name="password" type="password" required class="appearance-none relative block w-full px-3 py-3 border @error('email') border-red-300 @else border-slate-300 @enderror placeholder-slate-500 text-slate-900 rounded-b-xl focus:outline-none focus:ring-brand-500 focus:border-brand-500 focus:z-10 sm:text-sm" placeholder="Password">
                </div>
            </div>
            
            @error('email')
                <p class="text-sm border-l-4 border-red-500 pl-3 text-red-600 mt-2 bg-red-50 py-2">{{ $message }}</p>
            @enderror

            <div>
                <button type="submit" class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-xl text-white bg-brand-600 hover:bg-brand-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-500 transition-all duration-300 hover:shadow-lg">
                    Sign in
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
