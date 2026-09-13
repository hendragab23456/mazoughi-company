<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>التقارير - المزوغي للمقاولات</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 min-h-screen">

    <div class="max-w-7xl mx-auto px-4 py-8">

        {{-- Header --}}
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">
                    التقارير المالية
                </h1>
                <p class="text-gray-500 mt-1">
                    تقارير العمليات المالية المعتمدة
                </p>
            </div>

            <a href="{{ route('dashboard') }}"
               class="bg-gray-800 hover:bg-gray-900 text-white px-5 py-3 rounded-xl">
                العودة للوحة التحكم
            </a>
        </div>

        {{-- Date Filter --}}
        <div class="bg-white rounded-2xl shadow-sm p-6 mb-8">
            <h2 class="text-xl font-bold text-gray-800 mb-5">
                تحديد فترة التقرير
            </h2>

            <form method="GET" action="{{ route('reports.index') }}"
                  class="grid grid-cols-1 md:grid-cols-3 gap-4">

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        من تاريخ
                    </label>

                    <input type="date"
                           name="from"
                           value="{{ $from }}"
                           class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        إلى تاريخ
                    </label>

                    <input type="date"
                           name="to"
                           value="{{ $to }}"
                           class="w-full rounded-xl border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                </div>

                <div class="flex items-end gap-3">
                    <button type="submit"
                            class="flex-1 bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded-xl font-semibold">
                        عرض التقرير
                    </button>

                    <a href="{{ route('reports.index') }}"
                       class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-5 py-3 rounded-xl">
                        مسح
                    </a>
                </div>
            </form>
        </div>

        {{-- Summary Cards --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-5 mb-8">

            <div class="bg-white rounded-2xl shadow-sm p-5">
                <p class="text-gray-500 text-sm">إجمالي الإيرادات</p>
                <p class="text-2xl font-bold text-green-600 mt-2">
                    {{ number_format($totalIncome, 2) }}
                    <span class="text-sm">ج.م</span>
                </p>
            </div>

            <div class="bg-white rounded-2xl shadow-sm p-5">
                <p class="text-gray-500 text-sm">إجمالي المصروفات</p>
                <p class="text-2xl font-bold text-red-600 mt-2">
                    {{ number_format($totalExpenses, 2) }}
                    <span class="text-sm">ج.م</span>
                </p>
            </div>

            <div class="bg-white rounded-2xl shadow-sm p-5">
                <p class="text-gray-500 text-sm">صافي الربح</p>
                <p class="text-2xl font-bold {{ $netProfit >= 0 ? 'text-blue-600' : 'text-red-600' }} mt-2">
                    {{ number_format($netProfit, 2) }}
                    <span class="text-sm">ج.م</span>
                </p>
            </div>

            <div class="bg-white rounded-2xl shadow-sm p-5">
                <p class="text-gray-500 text-sm">رصيد الخزنة</p>
                <p class="text-2xl font-bold text-purple-600 mt-2">
                    {{ number_format($cashBalance, 2) }}
                    <span class="text-sm">ج.م</span>
                </p>
            </div>

            <div class="bg-white rounded-2xl shadow-sm p-5">
                <p class="text-gray-500 text-sm">رصيد البنك</p>
                <p class="text-2xl font-bold text-indigo-600 mt-2">
                    {{ number_format($bankBalance, 2) }}
                    <span class="text-sm">ج.م</span>
                </p>
            </div>

        </div>

        {{-- Transactions --}}
        <div class="bg-white rounded-2xl shadow-sm overflow-hidden">

            <div class="p-6 border-b">
                <h2 class="text-xl font-bold text-gray-800">
                    العمليات المالية
                </h2>

                <p class="text-sm text-gray-500 mt-1">
                    العمليات المعتمدة فقط
                </p>
            </div>

            @if($transactions->count())

                <div class="overflow-x-auto">
                    <table class="w-full text-right">

                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-4 text-sm font-semibold text-gray-600">
                                    التاريخ
                                </th>

                                <th class="px-6 py-4 text-sm font-semibold text-gray-600">
                                    نوع العملية
                                </th>

                                <th class="px-6 py-4 text-sm font-semibold text-gray-600">
                                    المبلغ
                                </th>

                                <th class="px-6 py-4 text-sm font-semibold text-gray-600">
                                    الحساب
                                </th>

                                <th class="px-6 py-4 text-sm font-semibold text-gray-600">
                                    البيان
                                </th>

                                <th class="px-6 py-4 text-sm font-semibold text-gray-600">
                                    التفاصيل
                                </th>
                            </tr>
                        </thead>

                        <tbody class="divide-y">

                            @foreach($transactions as $transaction)

                                @php
                                    $typeLabels = [
                                        'income' => 'إيراد',
                                        'expense' => 'مصروف',
                                        'worker_payment' => 'دفعة عامل',
                                        'advance' => 'عهدة',
                                        'material_purchase' => 'شراء خامات',
                                        'transport' => 'نقل',
                                    ];

                                    $accountLabels = [
                                        'cash' => 'الخزنة',
                                        'bank' => 'البنك',
                                    ];
                                @endphp

                                <tr class="hover:bg-gray-50">

                                    <td class="px-6 py-4 text-gray-700">
                                        {{ $transaction->transaction_date?->format('Y-m-d') }}
                                    </td>

                                    <td class="px-6 py-4">
                                        <span class="inline-flex px-3 py-1 rounded-full text-sm bg-blue-100 text-blue-700">
                                            {{ $typeLabels[$transaction->type] ?? $transaction->type }}
                                        </span>
                                    </td>

                                    <td class="px-6 py-4 font-bold text-gray-800">
                                        {{ number_format($transaction->amount, 2) }}
                                        ج.م
                                    </td>

                                    <td class="px-6 py-4 text-gray-700">
                                        {{ $accountLabels[$transaction->account_type] ?? $transaction->account_type }}
                                    </td>

                                    <td class="px-6 py-4 text-gray-600">
                                        {{ $transaction->description ?: 'بدون بيان' }}
                                    </td>

                                    <td class="px-6 py-4">
                                        <a href="{{ route('transactions.show', $transaction) }}"
                                           class="text-blue-600 hover:text-blue-800 font-semibold">
                                            عرض
                                        </a>
                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>
                </div>

            @else

                <div class="p-12 text-center">
                    <div class="text-5xl mb-4">
                        📊
                    </div>

                    <h3 class="text-xl font-bold text-gray-700">
                        لا توجد عمليات مالية
                    </h3>

                    <p class="text-gray-500 mt-2">
                        لا توجد عمليات معتمدة في الفترة المحددة.
                    </p>
                </div>

            @endif

        </div>

    </div>

</body>
</html>