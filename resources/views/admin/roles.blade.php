@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 slide-up">
    <div class="mb-8">
        <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Roles & Permissions</h1>
        <p class="mt-2 text-sm text-slate-500">System roles and their associated capabilities.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @foreach($roles as $role)
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200 hover:shadow-md transition-shadow">
                <div class="flex items-center mb-4 pb-4 border-b border-slate-100">
                    <div class="w-12 h-12 rounded-full bg-gradient-to-tr from-brand-100 to-indigo-100 flex items-center justify-center mr-4">
                        <svg class="w-6 h-6 text-brand-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" /></svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-slate-900">{{ $role->name }}</h3>
                        <p class="text-xs text-slate-500 uppercase tracking-wide">System Role</p>
                    </div>
                </div>
                
                <h4 class="text-xs font-semibold text-slate-400 uppercase tracking-widest mb-3">Permissions</h4>
                @if($role->permissions->isEmpty())
                    <p class="text-sm text-slate-500 italic">No specific granular permissions assigned.</p>
                @else
                    <div class="flex flex-wrap gap-2">
                        @foreach($role->permissions as $permission)
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-brand-50 border border-brand-200 text-brand-700">
                                {{ $permission->name }}
                            </span>
                        @endforeach
                    </div>
                @endif
            </div>
        @endforeach
    </div>
</div>
@endsection
