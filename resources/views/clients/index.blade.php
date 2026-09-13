<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>العملاء - المزوغي للمقاولات</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-slate-50 text-slate-900">

<div class="min-h-screen">

    {{-- Header --}}
    <header class="bg-slate-900 text-white shadow-lg">
        <div class="max-w-7xl mx-auto px-6 py-5 flex items-center justify-between">

            <div>
                <h1 class="text-2xl font-bold">العملاء</h1>
                <p class="text-slate-300 text-sm mt-1">
                    إدارة حسابات العملاء والمبالغ المستحقة
                </p>
            </div>

            <a
                href="{{ route('clients.create') }}"
                class="bg-white text-slate-900 px-5 py-2.5 rounded-xl font-bold hover:bg-slate-100 transition"
            >
                + إضافة عميل
            </a>

        </div>
    </header>


    <main class="max-w-7xl mx-auto px-6 py-8">

        {{-- Messages --}}
        @if(session('success'))
            <div class="mb-6 rounded-xl bg-emerald-100 border border-emerald-200 text-emerald-800 px-5 py-4">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="mb-6 rounded-xl bg-red-100 border border-red-200 text-red-800 px-5 py-4">
                <ul class="list-disc mr-5 space-y-1">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        {{-- Summary --}}
        @php
            $totalDue = $clients->sum('total_due');
            $totalPaid = $clients->sum('total_paid');
            $totalRemaining = $clients->sum('remaining');
        @endphp

        <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-8">

            <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm">
                <p class="text-slate-500 text-sm">إجمالي المستحقات</p>
                <p class="text-3xl font-bold mt-2">
                    {{ number_format($totalDue, 2) }}
                    <span class="text-base font-normal">ج.م</span>
                </p>
            </div>

            <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm">
                <p class="text-slate-500 text-sm">إجمالي المدفوع</p>
                <p class="text-3xl font-bold mt-2 text-emerald-600">
                    {{ number_format($totalPaid, 2) }}
                    <span class="text-base font-normal">ج.م</span>
                </p>
            </div>

            <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm">
                <p class="text-slate-500 text-sm">المتبقي</p>
                <p class="text-3xl font-bold mt-2 text-red-600">
                    {{ number_format($totalRemaining, 2) }}
                    <span class="text-base font-normal">ج.م</span>
                </p>
            </div>

        </div>


        {{-- Clients Table --}}
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">

            <div class="px-6 py-5 border-b border-slate-200">
                <h2 class="text-xl font-bold">قائمة العملاء</h2>
            </div>

            @if($clients->count())

                <div class="overflow-x-auto">

                    <table class="w-full text-right">

                        <thead class="bg-slate-50">
                            <tr>
                                <th class="px-6 py-4 font-bold">العميل</th>
                                <th class="px-6 py-4 font-bold">الهاتف</th>
                                <th class="px-6 py-4 font-bold">الشركة</th>
                                <th class="px-6 py-4 font-bold">المستحق</th>
                                <th class="px-6 py-4 font-bold">المدفوع</th>
                                <th class="px-6 py-4 font-bold">المتبقي</th>
                                <th class="px-6 py-4 font-bold">الإجراءات</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-slate-100">

                            @foreach($clients as $client)

                                <tr class="hover:bg-slate-50 transition">

                                    <td class="px-6 py-4">
                                        <div class="font-bold">
                                            {{ $client->name }}
                                        </div>

                                        @if($client->address)
                                            <div class="text-sm text-slate-500 mt-1">
                                                {{ $client->address }}
                                            </div>
                                        @endif
                                    </td>

                                    <td class="px-6 py-4 text-slate-600">
                                        {{ $client->phone ?: '—' }}
                                    </td>

                                    <td class="px-6 py-4 text-slate-600">
                                        {{ $client->company ?: '—' }}
                                    </td>

                                    <td class="px-6 py-4 font-semibold">
                                        {{ number_format($client->total_due, 2) }}
                                        ج.م
                                    </td>

                                    <td class="px-6 py-4 font-semibold text-emerald-600">
                                        {{ number_format($client->total_paid, 2) }}
                                        ج.م
                                    </td>

                                    <td class="px-6 py-4 font-bold
                                        {{ $client->remaining > 0 ? 'text-red-600' : 'text-emerald-600' }}">
                                        {{ number_format($client->remaining, 2) }}
                                        ج.م
                                    </td>

                                    <td class="px-6 py-4">

                                        <div class="flex items-center gap-2">

                                            <a
                                                href="{{ route('clients.show', $client) }}"
                                                class="px-3 py-2 rounded-lg bg-slate-100 hover:bg-slate-200 text-sm font-semibold"
                                            >
                                                عرض
                                            </a>

                                            <a
                                                href="{{ route('clients.edit', $client) }}"
                                                class="px-3 py-2 rounded-lg bg-blue-100 hover:bg-blue-200 text-blue-700 text-sm font-semibold"
                                            >
                                                تعديل
                                            </a>

                                        </div>

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            @else

                <div class="px-6 py-16 text-center">

                    <div class="text-5xl mb-4">👥</div>

                    <h3 class="text-xl font-bold mb-2">
                        لا يوجد عملاء حتى الآن
                    </h3>

                    <p class="text-slate-500 mb-6">
                        أضف أول عميل لبدء تسجيل حساباته.
                    </p>

                    <a
                        href="{{ route('clients.create') }}"
                        class="inline-block bg-slate-900 text-white px-6 py-3 rounded-xl font-bold hover:bg-slate-800 transition"
                    >
                        + إضافة أول عميل
                    </a>

                </div>

            @endif

        </div>


        {{-- Back --}}
        <div class="mt-6">
            <a
                href="{{ route('dashboard') }}"
                class="text-slate-600 hover:text-slate-900 font-semibold"
            >
                ← العودة للوحة التحكم
            </a>
        </div>

    </main>

</div>

</body>
</html>

