<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with(['creator', 'approver'])
            ->latest('transaction_date')
            ->latest()
            ->get();

        return view('transactions.index', compact('transactions'));
    }

    public function create()
    {
        return view('transactions.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => [
                'required',
                'in:expense,income,worker_payment,advance,material_purchase,transport',
            ],
            'amount' => [
                'required',
                'numeric',
                'min:0.01',
            ],
            'account_type' => [
                'required',
                'in:cash,bank',
            ],
            'description' => [
                'nullable',
                'string',
                'max:1000',
            ],
            'transaction_date' => [
                'required',
                'date',
            ],
        ]);

        Transaction::create([
            ...$validated,
            'status' => 'pending',
            'created_by' => Auth::id(),
        ]);

        return redirect()
            ->route('transactions.index')
            ->with('success', 'تم تسجيل العملية وإرسالها للمراجعة.');
    }

    public function show(Transaction $transaction)
    {
        $transaction->load(['creator', 'approver']);

        return view('transactions.show', compact('transaction'));
    }

    public function approve(Transaction $transaction)
    {
        abort_unless(Auth::user()->hasRole('Owner'), 403);

        if ($transaction->status !== 'pending') {
            return back()->with('error', 'هذه العملية تمت مراجعتها بالفعل.');
        }

        $transaction->update([
            'status' => 'approved',
            'approved_by' => Auth::id(),
            'approved_at' => now(),
            'rejection_reason' => null,
        ]);

        return back()->with('success', 'تم اعتماد العملية بنجاح.');
    }

    public function reject(Request $request, Transaction $transaction)
    {
        abort_unless(Auth::user()->hasRole('Owner'), 403);

        if ($transaction->status !== 'pending') {
            return back()->with('error', 'هذه العملية تمت مراجعتها بالفعل.');
        }

        $validated = $request->validate([
            'rejection_reason' => [
                'required',
                'string',
                'max:1000',
            ],
        ]);

        $transaction->update([
            'status' => 'rejected',
            'approved_by' => Auth::id(),
            'approved_at' => now(),
            'rejection_reason' => $validated['rejection_reason'],
        ]);

        return back()->with('success', 'تم رفض العملية.');
    }
}