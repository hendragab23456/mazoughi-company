<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $from = $request->input('from');
        $to = $request->input('to');

        $query = Transaction::where('status', 'approved');

        if ($from) {
            $query->whereDate('transaction_date', '>=', $from);
        }

        if ($to) {
            $query->whereDate('transaction_date', '<=', $to);
        }

        $transactions = $query
            ->latest('transaction_date')
            ->latest()
            ->get();

        $totalIncome = $transactions
            ->where('type', 'income')
            ->sum('amount');

        $totalExpenses = $transactions
            ->whereIn('type', [
                'expense',
                'worker_payment',
                'advance',
                'material_purchase',
                'transport',
            ])
            ->sum('amount');

        $cashIncome = $transactions
            ->where('account_type', 'cash')
            ->where('type', 'income')
            ->sum('amount');

        $cashExpenses = $transactions
            ->where('account_type', 'cash')
            ->whereIn('type', [
                'expense',
                'worker_payment',
                'advance',
                'material_purchase',
                'transport',
            ])
            ->sum('amount');

        $cashBalance = $cashIncome - $cashExpenses;

        $bankIncome = $transactions
            ->where('account_type', 'bank')
            ->where('type', 'income')
            ->sum('amount');

        $bankExpenses = $transactions
            ->where('account_type', 'bank')
            ->whereIn('type', [
                'expense',
                'worker_payment',
                'advance',
                'material_purchase',
                'transport',
            ])
            ->sum('amount');

        $bankBalance = $bankIncome - $bankExpenses;

        $netProfit = $totalIncome - $totalExpenses;

        return view('reports.index', compact(
            'transactions',
            'totalIncome',
            'totalExpenses',
            'cashBalance',
            'bankBalance',
            'netProfit',
            'from',
            'to'
        ));
    }
}