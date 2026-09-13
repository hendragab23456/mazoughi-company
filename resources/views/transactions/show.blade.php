<x-app-layout>

    <x-slot name="header">
        <h2 class="font-bold text-xl text-gray-800">
            تفاصيل العملية
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto px-4">

            {{-- الرسائل --}}
            @if(session('success'))
                <div class="bg-green-100 text-green-800 p-4 rounded-xl mb-5">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-100 text-red-800 p-4 rounded-xl mb-5">
                    {{ session('error') }}
                </div>
            @endif

            <div class="bg-white rounded-2xl shadow-sm overflow-hidden">

                <div class="p-6 border-b">
                    <h1 class="text-2xl font-bold">
                        🧾 تفاصيل العملية
                    </h1>
                </div>

                <div class="p-6 space-y-5">

                    {{-- نوع العملية --}}
                    <div>
                        <div class="text-gray-500 text-sm">
                            نوع العملية
                        </div>

                        <div class="font-bold text-lg mt-1">
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
                        </div>
                    </div>

                    {{-- المبلغ --}}
                    <div>
                        <div class="text-gray-500 text-sm">
                            المبلغ
                        </div>

                        <div class="font-bold text-2xl mt-1">
                            {{ number_format($transaction->amount, 2) }}
                            جنيه
                        </div>
                    </div>

                    {{-- الحساب --}}
                    <div>
                        <div class="text-gray-500 text-sm">
                            الحساب
                        </div>

                        <div class="font-bold mt-1">
                            @if($transaction->account_type === 'cash')
                                💰 الخزنة
                            @else
                                🏦 البنك
                            @endif
                        </div>
                    </div>

                    {{-- التاريخ --}}
                    <div>
                        <div class="text-gray-500 text-sm">
                            تاريخ العملية
                        </div>

                        <div class="font-bold mt-1">
                            {{ $transaction->transaction_date->format('d/m/Y') }}
                        </div>
                    </div>

                    {{-- الوصف --}}
                    <div>
                        <div class="text-gray-500 text-sm">
                            البيان
                        </div>

                        <div class="mt-1">
                            {{ $transaction->description ?: 'لا يوجد بيان' }}
                        </div>
                    </div>

                    {{-- منشئ العملية --}}
                    <div>
                        <div class="text-gray-500 text-sm">
                            سجلها
                        </div>

                        <div class="font-bold mt-1">
                            {{ $transaction->creator->name ?? '-' }}
                        </div>
                    </div>

                    {{-- الحالة --}}
                    <div>
                        <div class="text-gray-500 text-sm">
                            الحالة
                        </div>

                        <div class="mt-2">

                            @if($transaction->status === 'pending')

                                <span class="bg-yellow-100 text-yellow-800 px-4 py-2 rounded-full">
                                    ⏳ في انتظار موافقة رجب
                                </span>

                            @elseif($transaction->status === 'approved')

                                <span class="bg-green-100 text-green-800 px-4 py-2 rounded-full">
                                    ✅ تم اعتماد العملية
                                </span>

                            @else

                                <span class="bg-red-100 text-red-800 px-4 py-2 rounded-full">
                                    ❌ تم رفض العملية
                                </span>

                            @endif

                        </div>
                    </div>

                    {{-- بيانات الموافقة --}}
                    @if($transaction->approved_by)

                        <div class="border-t pt-5">

                            <div class="text-gray-500 text-sm">
                                تمت المراجعة بواسطة
                            </div>

                            <div class="font-bold mt-1">
                                {{ $transaction->approver->name ?? '-' }}
                            </div>

                            @if($transaction->approved_at)
                                <div class="text-gray-500 text-sm mt-1">
                                    {{ $transaction->approved_at->format('d/m/Y H:i') }}
                                </div>
                            @endif

                        </div>

                    @endif

                    {{-- سبب الرفض --}}
                    @if($transaction->status === 'rejected')

                        <div class="bg-red-50 p-4 rounded-xl">

                            <div class="font-bold text-red-700">
                                سبب الرفض
                            </div>

                            <div class="mt-1">
                                {{ $transaction->rejection_reason }}
                            </div>

                        </div>

                    @endif

                    {{-- أزرار المراجعة --}}
                    @if(
                        $transaction->status === 'pending' &&
                        auth()->user()->hasRole('Owner')
                    )

                        <div class="border-t pt-6">

                            <div class="font-bold text-lg mb-4">
                                👑 مراجعة العملية
                            </div>

                            <div class="flex flex-wrap gap-3">

                                {{-- قبول --}}
                                <form
                                    method="POST"
                                    action="{{ route('transactions.approve', $transaction) }}"
                                >
                                    @csrf

                                    <button
                                        type="submit"
                                        class="bg-green-600 text-white px-6 py-3 rounded-xl font-bold"
                                    >
                                        ✅ اعتماد العملية
                                    </button>
                                </form>

                                {{-- رفض --}}
                                <form
                                    method="POST"
                                    action="{{ route('transactions.reject', $transaction) }}"
                                    class="flex gap-2"
                                >
                                    @csrf

                                    <input
                                        type="text"
                                        name="rejection_reason"
                                        required
                                        placeholder="سبب الرفض"
                                        class="rounded-xl border-gray-300"
                                    >

                                    <button
                                        type="submit"
                                        class="bg-red-600 text-white px-6 py-3 rounded-xl font-bold"
                                    >
                                        ❌ رفض
                                    </button>
                                </form>

                            </div>

                        </div>

                    @endif

                    {{-- رجوع --}}
                    <div class="border-t pt-5">

                        <a
                            href="{{ route('transactions.index') }}"
                            class="inline-block bg-gray-100 px-6 py-3 rounded-xl font-bold"
                        >
                            ← العودة للعمليات
                        </a>

                    </div>

                </div>

            </div>

        </div>
    </div>

</x-app-layout>