<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>الموردين - المزوغي</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-slate-50">

<div class="min-h-screen">

    <header class="bg-slate-900 text-white">
        <div class="max-w-6xl mx-auto px-6 py-6 flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-black">الموردين</h1>
                <p class="text-slate-300 text-sm mt-1">
                    إدارة الموردين وحساباتهم
                </p>
            </div>

            <a
                href="{{ route('suppliers.create') }}"
                class="bg-white text-slate-900 px-5 py-3 rounded-xl font-bold hover:bg-slate-100 transition"
            >
                + إضافة مورد
            </a>
        </div>
    </header>

    <main class="max-w-6xl mx-auto px-6 py-8">

        @if(session('success'))
            <div class="mb-6 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-xl p-4 font-bold">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">

            @if($suppliers->count())

                <div class="overflow-x-auto">

                    <table class="w-full text-right">

                        <thead class="bg-slate-50 border-b border-slate-200">
                            <tr>
                                <th class="px-6 py-4 text-sm font-bold">المورد</th>
                                <th class="px-6 py-4 text-sm font-bold">الهاتف</th>
                                <th class="px-6 py-4 text-sm font-bold">المستحق</th>
                                <th class="px-6 py-4 text-sm font-bold">المدفوع</th>
                                <th class="px-6 py-4 text-sm font-bold">المتبقي</th>
                                <th class="px-6 py-4 text-sm font-bold">الإجراء</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-slate-100">

                            @foreach($suppliers as $supplier)

                                @php
                                    $remaining = $supplier->total_due - $supplier->total_paid;
                                @endphp

                                <tr class="hover:bg-slate-50">

                                    <td class="px-6 py-5 font-bold text-slate-800">
                                        {{ $supplier->name }}
                                    </td>

                                    <td class="px-6 py-5 text-slate-600">
                                        {{ $supplier->phone ?: '-' }}
                                    </td>

                                    <td class="px-6 py-5 font-bold">
                                        {{ number_format($supplier->total_due, 2) }} ج.م
                                    </td>

                                    <td class="px-6 py-5 text-emerald-600 font-bold">
                                        {{ number_format($supplier->total_paid, 2) }} ج.م
                                    </td>

                                    <td class="px-6 py-5 font-bold {{ $remaining > 0 ? 'text-red-600' : 'text-emerald-600' }}">
                                        {{ number_format($remaining, 2) }} ج.م
                                    </td>

                                    <td class="px-6 py-5">
                                        <a
                                            href="{{ route('suppliers.show', $supplier) }}"
                                            class="text-slate-700 font-bold hover:text-slate-900"
                                        >
                                            عرض
                                        </a>
                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            @else

                <div class="py-16 text-center">

                    <div class="text-5xl mb-4">📦</div>

                    <h2 class="text-xl font-bold text-slate-800">
                        لا يوجد موردين
                    </h2>

                    <p class="text-slate-500 mt-2">
                        أضف أول مورد لبدء تسجيل حساباته.
                    </p>

                    <a
                        href="{{ route('suppliers.create') }}"
                        class="inline-flex mt-6 bg-slate-900 text-white px-6 py-3 rounded-xl font-bold"
                    >
                        إضافة مورد
                    </a>

                </div>

            @endif

        </div>

        <div class="mt-6">
            <a
                href="{{ route('dashboard') }}"
                class="text-slate-600 font-bold hover:text-slate-900"
            >
                ← العودة للوحة التحكم
            </a>
        </div>

    </main>

</div>

</body>
</html>
