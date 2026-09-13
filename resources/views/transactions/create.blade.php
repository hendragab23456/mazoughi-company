<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            إضافة عملية مالية
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto px-4">

            <div class="bg-white rounded-2xl shadow-sm p-6">

                <h1 class="text-2xl font-bold mb-2">
                    ➕ إضافة عملية
                </h1>

                <p class="text-gray-500 mb-6">
                    العملية ستُرسل للمراجعة قبل اعتمادها.
                </p>

                @if ($errors->any())
                    <div class="bg-red-100 text-red-700 p-4 rounded-xl mb-5">
                        <ul class="list-disc mr-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('transactions.store') }}">
                    @csrf

                    {{-- نوع العملية --}}
                    <div class="mb-5">
                        <label class="block font-bold mb-2">
                            نوع العملية
                        </label>

                        <select
                            name="type"
                            required
                            class="w-full rounded-xl border-gray-300"
                        >
                            <option value="">اختر نوع العملية</option>

                            <option value="expense">
                                📉 مصروف
                            </option>

                            <option value="income">
                                📈 إيراد
                            </option>

                            <option value="worker_payment">
                                👷 دفعة عامل
                            </option>

                            <option value="advance">
                                💵 عهدة
                            </option>

                            <option value="material_purchase">
                                🧱 شراء خامات
                            </option>

                            <option value="transport">
                                🚛 نقل
                            </option>
                        </select>
                    </div>

                    {{-- المبلغ --}}
                    <div class="mb-5">
                        <label class="block font-bold mb-2">
                            المبلغ
                        </label>

                        <input
                            type="number"
                            name="amount"
                            step="0.01"
                            min="0.01"
                            required
                            class="w-full rounded-xl border-gray-300"
                            placeholder=""
                        >
                    </div>

                    {{-- الحساب --}}
                    <div class="mb-5">
                        <label class="block font-bold mb-2">
                            طريقة الدفع
                        </label>

                        <select
                            name="account_type"
                            required
                            class="w-full rounded-xl border-gray-300"
                        >
                            <option value="">اختر الحساب</option>

                            <option value="cash">
                                💰 الخزنة
                            </option>

                            <option value="bank">
                                🏦 البنك
                            </option>
                        </select>
                    </div>

                    {{-- التاريخ --}}
                    <div class="mb-5">
                        <label class="block font-bold mb-2">
                            تاريخ العملية
                        </label>

                        <input
                            type="date"
                            name="transaction_date"
                            value="{{ now()->format('Y-m-d') }}"
                            required
                            class="w-full rounded-xl border-gray-300"
                        >
                    </div>

                    {{-- الوصف --}}
                    <div class="mb-6">
                        <label class="block font-bold mb-2">
                            البيان / الوصف
                        </label>

                        <textarea
                            name="description"
                            rows="4"
                            class="w-full rounded-xl border-gray-300"
                            placeholder="اكتب تفاصيل العملية..."
                        ></textarea>
                    </div>

                    <div class="flex gap-3">

                        <button
                            type="submit"
                            class="bg-blue-600 text-white px-6 py-3 rounded-xl font-bold hover:bg-blue-700"
                        >
                            إرسال للمراجعة
                        </button>

                        <a
                            href="{{ route('dashboard') }}"
                            class="bg-gray-100 px-6 py-3 rounded-xl font-bold"
                        >
                            إلغاء
                        </a>

                    </div>

                </form>

            </div>

        </div>
    </div>

</x-app-layout>