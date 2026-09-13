<x-app-layout>

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-bold text-xl text-gray-800">
                العمليات المالية
            </h2>

            <a href="{{ route('transactions.create') }}"
               class="bg-blue-600 text-white px-5 py-2 rounded-xl font-bold">
                ➕ تسجيل عملية
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4">

            {{-- رسائل النجاح --}}
            @if(session('success'))
                <div class="bg-green-100 text-green-800 p-4 rounded-xl mb-5">
                    {{ session('success') }}
                </div>
            @endif

            {{-- رسائل الخطأ --}}
            @if(session('error'))
                <div class="bg-red-100 text-red-800 p-4 rounded-xl mb-5">
                    {{ session('error') }}
                </div>
            @endif

            <div class="bg-white rounded-2xl shadow-sm overflow-hidden">

                <div class="p-6 border-b">
                    <h1 class="text-2xl font-bold">
                        🧾 سجل العمليات
                    </h1>

                    <p class="text-gray-500 mt-1">
                        جميع العمليات المالية المسجلة في النظام
                    </p>
                </div>

                @if($transactions->count())

                    <div class="overflow-x-auto">

                        <table class="w-full text-right">

                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="p-4">التاريخ</th>
                                    <th class="p-4">النوع</th>
                                    <th class="p-4">المبلغ</th>
                                    <th class="p-4">الحساب</th>
                                    <th class="p-4">أنشأها</th>
                                    <th class="p-4">الحالة</th>
                                    <th class="p-4">الإجراء</th>
                                </tr>
                            </thead>

                            <tbody>

                                @foreach($transactions as $transaction)

                                    <tr class="border-t">

                                        <td class="p-4">
                                            {{ $transaction->transaction_date->format('d/m/Y') }}
                                        </td>

                                        <td class="p-4">
                                            @switch($transaction->type)

                                                @case('expense')
                                                    📉 مصروف
                                                    @break

                                                @case('income')
                                                    📈 إيراد
                                                    @break

                                                @case('worker_payment')
                                                    👷 دفعة عامل
                                                    @break

                                                @case('advance')
                                                    💵 عهدة
                                                    @break

                                                @case('material_purchase')
                                                    🧱 شراء خامات
                                                    @break

                                                @case('transport')
                                                    🚛 نقل
                                                    @break

                                            @endswitch
                                        </td>

                                        <td class="p-4 font-bold">
                                            {{ number_format($transaction->amount, 2) }}
                                            جنيه
                                        </td>

                                        <td class="p-4">
                                            @if($transaction->account_type === 'cash')
                                                💰 الخزنة
                                            @else
                                                🏦 البنك
                                            @endif
                                        </td>

                                        <td class="p-4">
                                            {{ $transaction->creator->name ?? '-' }}
                                        </td>

                                        <td class="p-4">

                                            @if($transaction->status === 'pending')

                                                <span class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-sm">
                                                    ⏳ معلقة
                                                </span>

                                            @elseif($transaction->status === 'approved')

                                                <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm">
                                                    ✅ معتمدة
                                                </span>

                                            @else

                                                <span class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-sm">
                                                    ❌ مرفوضة
                                                </span>

                                            @endif

                                        </td>

                                        <td class="p-4">

                                            <a href="{{ route('transactions.show', $transaction) }}"
                                               class="text-blue-600 font-bold">
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
                            🧾
                        </div>

                        <h2 class="text-xl font-bold">
                            لا توجد عمليات حتى الآن
                        </h2>

                        <p class="text-gray-500 mt-2">
                            ابدأ بإضافة أول عملية مالية.
                        </p>

                        <a href="{{ route('transactions.create') }}"
                           class="inline-block mt-5 bg-blue-600 text-white px-6 py-3 rounded-xl font-bold">
                            ➕ تسجيل أول عملية
                        </a>

                    </div>

                @endif

            </div>

        </div>
    </div>

</x-app-layout>