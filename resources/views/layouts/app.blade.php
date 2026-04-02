<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WebSecTest Library</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                    colors: {
                        brand: {
                            50: '#f0f9ff',
                            100: '#e0f2fe',
                            500: '#0ea5e9',
                            600: '#0284c7',
                            900: '#0c4a6e',
                        }
                    }
                }
            }
        }
    </script>
    <style>
        body { font-family: 'Inter', sans-serif; }
        .glass {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.18);
        }
        .slide-up {
            animation: slideUp 0.5s ease-out forwards;
        }
        @keyframes slideUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body class="bg-slate-50 text-slate-800 antialiased min-h-screen flex flex-col">

    <!-- Navigation -->
    <nav class="glass sticky top-0 z-50 border-b border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ route('home') }}" class="text-2xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-brand-500 to-indigo-600 transition-transform duration-300 hover:scale-105">
                        Library<span class="font-light">System</span>
                    </a>
                </div>

                <!-- Nav Links -->
                <div class="flex items-center space-x-6">
                    <a href="{{ route('home') }}" class="text-sm font-medium text-slate-600 hover:text-brand-600 transition-colors">Catalogue</a>
                    
                    @auth
                        @if(Auth::user()->hasRole('Admin') || Auth::user()->hasRole('Librarian'))
                            <a href="{{ route('members.index') }}" class="text-sm font-medium text-slate-600 hover:text-brand-600 transition-colors">Members</a>
                            <a href="{{ route('books.create') }}" class="text-sm font-medium text-slate-600 hover:text-brand-600 transition-colors">Add Book</a>
                        @endif
                        
                        @if(Auth::user()->hasRole('Admin'))
                            <a href="{{ route('admin.roles') }}" class="text-sm font-medium text-slate-600 hover:text-brand-600 transition-colors">Roles/Perms</a>
                            <a href="{{ route('librarians.create') }}" class="text-sm font-medium text-slate-600 hover:text-brand-600 transition-colors">New Librarian</a>
                        @endif

                        <div x-data="{ open: false }" class="relative ml-4">
                            <button @click="open = !open" class="flex items-center text-sm font-medium text-slate-700 hover:text-brand-600 focus:outline-none transition-colors">
                                {{ Auth::user()->name }}
                                <svg class="ml-1 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </button>
                            <div x-show="open" @click.away="open = false" x-transition class="origin-top-right absolute right-0 mt-2 w-48 rounded-lg shadow-lg bg-white ring-1 ring-black ring-opacity-5 py-1 z-50">
                                <a href="{{ route('profile') }}" class="block px-4 py-2 text-sm text-slate-700 hover:bg-slate-100 transition-colors">My Profile & Borrows</a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="w-full text-left px-4 py-2 text-sm text-slate-700 hover:bg-slate-100 transition-colors">Logout</button>
                                </form>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="text-sm font-medium text-slate-600 hover:text-brand-600 transition-colors">Login</a>
                        <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-full text-white bg-brand-600 hover:bg-brand-700 shadow-md hover:shadow-lg transition-all duration-300">Register</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Page Content -->
    <main class="flex-grow">
        @if(session('success'))
            <div x-data="{ show: true }" x-show="show" class="max-w-7xl mx-auto px-4 mt-6">
                <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg flex justify-between items-center shadow-sm">
                    <span>{{ session('success') }}</span>
                    <button @click="show = false" class="text-green-500 hover:text-green-700">×</button>
                </div>
            </div>
        @endif
        
        @if(session('error'))
            <div x-data="{ show: true }" x-show="show" class="max-w-7xl mx-auto px-4 mt-6">
                <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg flex justify-between items-center shadow-sm">
                    <span>{{ session('error') }}</span>
                    <button @click="show = false" class="text-red-500 hover:text-red-700">×</button>
                </div>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t border-slate-200 mt-12 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <p class="text-sm text-slate-500">&copy; {{ date('Y') }} WebSecTest Library. All rights reserved.</p>
        </div>
    </footer>

</body>
</html>
