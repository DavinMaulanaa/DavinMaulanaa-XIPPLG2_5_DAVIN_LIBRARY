<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;

class LoanController extends Controller
{
    public function index()
    {
        try {
            $loans = Loan::all();
            return response()->json($loans, 200);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'book_id' => 'required|exists:books,id',
                'loan_date' => 'required|date',
                'return_date' => 'nullable|date|after:loan_date',
            ]);

            $loan = Loan::create([
                'book_id' => $validated['book_id'],
                'user_id' => Auth::user()->id,
                'loan_date' => $validated['loan_date'],
                'return_date' => $validated['return_date'] ?? null,
            ]);

            return response()->json($loan, 201);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function show($id)
    {
        try {
            $loan = Loan::findOrFail($id);
            return response()->json($loan, 200);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $loan = Loan::findOrFail($id);
            $validated = $request->validate([
                'loan_date' => 'required|date',
                'return_date' => 'nullable|date|after:loan_date',
            ]);
            $loan->update($validated);
            return response()->json($loan, 200);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $loan = Loan::findOrFail($id);
            $loan->delete();
            return response()->json(['message' => 'Loan deleted successfully'], 200);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
