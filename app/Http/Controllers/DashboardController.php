<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        // العمليات المعتمدة فقط تدخل في الحسابات
        $approved = Transaction::where('status', 'approved');

        // إجمالي الإيرادات
        $totalRevenue = (clone $approved)
            ->where('type', 'income')
            ->sum('amount');

        // إجمالي المصروفات
        $totalExpenses = (clone $approved)
            ->whereIn('type', [
                'expense',
                'worker_payment',
                'advance',
                'material_purchase',
                'transport',
            ])
            ->sum('amount');

        // رصيد الخزنة
        $cashIncome = (clone $approved)
            ->where('account_type', 'cash')
            ->where('type', 'income')
            ->sum('amount');

        $cashExpenses = (clone $approved)
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

        // رصيد البنك
        $bankIncome = (clone $approved)
            ->where('account_type', 'bank')
            ->where('type', 'income')
            ->sum('amount');

        $bankExpenses = (clone $approved)
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

        // آخر العمليات
        $latestTransactions = Transaction::with(['creator', 'approver'])
            ->latest('transaction_date')
            ->latest()
            ->take(10)
            ->get();

        // عدد العمليات المعلقة
        $pendingTransactions = Transaction::where('status', 'pending')->count();

        return view('dashboard', compact(
            'cashBalance',
            'bankBalance',
            'totalRevenue',
            'totalExpenses',
            'latestTransactions',
            'pendingTransactions'
        ));
    }
}