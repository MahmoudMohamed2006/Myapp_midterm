<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrowing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class BorrowingController extends Controller
{
    public function store(Request $request, Book $book)
    {
        if ($book->copies <= 0) {
            return back()->with('error', 'Book Currently Unavailable');
        }

        try {
            DB::transaction(function () use ($book) {
                // Double check inside transaction if it's locked/available just in case
                $lockedBook = Book::where('id', $book->id)->lockForUpdate()->first();
                
                if ($lockedBook->copies <= 0) {
                    throw new \Exception('Book Currently Unavailable');
                }

                $lockedBook->copies -= 1;
                $lockedBook->save();

                Borrowing::create([
                    'user_id' => Auth::id(),
                    'book_id' => $lockedBook->id,
                    'borrow_date' => now(),
                    'status' => 'Active',
                ]);
            });

            return back()->with('success', 'Book borrowed successfully!');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage() === 'Book Currently Unavailable' ? $e->getMessage() : 'An error occurred while borrowing the book. Please try again.');
        }
    }
}
