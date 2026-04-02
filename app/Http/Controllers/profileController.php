<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class profileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // Members can view a list of all books they have borrowed
        $borrowings = $user->borrowings()->with('book')->orderBy('borrow_date', 'desc')->get();
        
        // Count active borrowings to display 'borrowing limit or borrow status'
        $activeBorrowingsCount = $borrowings->where('status', 'Active')->count();

        return view('profile', compact('borrowings', 'activeBorrowingsCount'));
    }
}
