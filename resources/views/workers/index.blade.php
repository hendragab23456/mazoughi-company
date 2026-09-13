<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>العمال والمقاولين - المزوغي</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 text-gray-800">

    <div class="min-h-screen">

        <!-- الهيدر -->
        <header class="bg-slate-900 text-white shadow-lg">
            <div class="max-w-7xl mx-auto px-6 py-5 flex items-center justify-between">

                <div>
                    <h1 class="text-2xl font-bold">
                        العمال والمقاولين
                    </h1>

                    <p class="text-gray-300 mt-1">
                        إدارة العمال والمقاولين والمستحقات
                    </p>
                </div>

                <a
                    href="{{ route('workers.create') }}"
                    class="bg-blue-600 hover:bg-blue-700 px-5 py-3 rounded-lg font-semibold transition"
                >
                    + إضافة عامل
                </a>

            </div>
        </header>

        <!-- المحتوى -->
        <main class="max-w-7xl mx-auto px-6 py-8">

            @if(session('success'))
                <div class="mb-6 bg-green-100 border border-green-300 text-green-800 px-5 py-4 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mb-6 bg-red-100 border border-red-300 text-red-800 px-5 py-4 rounded-lg">
                    {{ session('error') }}
                </div>
            @endif

            <!-- ملخص -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-8">

                <div class="bg-white rounded-xl shadow p-6">
                    <p class="text-gray-500 mb-2">عدد العمال والمقاولين</p>
                    <p class="text-3xl font-bold text-slate-900">
                        {{ $workers->count() }}
                    </p>
                </div>

                <div class="bg-white rounded-xl shadow p-6">
                    <p class="text-gray-500 mb-2">إجمالي المستحقات</p>
                    <p class="text-3xl font-bold text-orange-600">
                        {{ number_format($workers->sum('total_due'), 2) }} ج.م
                    </p>
                </div>

                <div class="bg-white rounded-xl shadow p-6">
                    <p class="text-gray-500 mb-2">إجمالي المدفوع</p>
                    <p class="text-3xl font-bold text-green-600">
                        {{ number_format($workers->sum('total_paid'), 2) }} ج.م
                    </p>
                </div>

            </div>

            <!-- الجدول -->
            <div class="bg-white rounded-xl shadow overflow-hidden">

                <div class="px-6 py-5 border-b">
                    <h2 class="text-xl font-bold">
                        قائمة العمال والمقاولين
                    </h2>
                </div>

                @if($workers->count() > 0)

                    <div class="overflow-x-auto">

                        <table class="w-full text-right">

                            <thead class="bg-gray-50 border-b">
                                <tr>
                                    <th class="px-6 py-4 font-semibold">الاسم</th>
                                    <th class="px-6 py-4 font-semibold">النوع</th>
                                    <th class="px-6 py-4 font-semibold">الوظيفة</th>
                                    <th class="px-6 py-4 font-semibold">المستحق</th>
                                    <th class="px-6 py-4 font-semibold">المدفوع</th>
                                    <th class="px-6 py-4 font-semibold">المتبقي</th>
                                    <th class="px-6 py-4 font-semibold">الإجراءات</th>
                                </tr>
                            </thead>

                            <tbody class="divide-y">

                                @foreach($workers as $worker)

                                    <tr class="hover:bg-gray-50">

                                        <td class="px-6 py-4 font-semibold">
                                            {{ $worker->name }}
                                        </td>

                                        <td class="px-6 py-4">
                                            @if($worker->type === 'worker')
                                                <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm">
                                                    عامل
                                                </span>
                                            @else
                                                <span class="bg-purple-100 text-purple-800 px-3 py-1 rounded-full text-sm">
                                                    مقاول
                                                </span>
                                            @endif
                                        </td>

                                        <td class="px-6 py-4">
                                            {{ $worker->job_title ?: '—' }}
                                        </td>

                                        <td class="px-6 py-4 font-semibold">
                                            {{ number_format($worker->total_due, 2) }} ج.م
                                        </td>

                                        <td class="px-6 py-4 text-green-600 font-semibold">
                                            {{ number_format($worker->total_paid, 2) }} ج.م
                                        </td>

                                        <td class="px-6 py-4">

                                            @if($worker->remaining > 0)

                                                <span class="text-red-600 font-bold">
                                                    {{ number_format($worker->remaining, 2) }} ج.م
                                                </span>

                                            @else

                                                <span class="text-green-600 font-bold">
                                                    لا يوجد
                                                </span>

                                            @endif

                                        </td>

                                        <td class="px-6 py-4">

                                            <div class="flex gap-2">

                                                <a
                                                    href="{{ route('workers.show', $worker) }}"
                                                    class="bg-slate-700 hover:bg-slate-800 text-white px-3 py-2 rounded-lg text-sm"
                                                >
                                                    عرض
                                                </a>

                                                <a
                                                    href="{{ route('workers.edit', $worker) }}"
                                                    class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-2 rounded-lg text-sm"
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

                    <div class="text-center py-16">

                        <div class="text-5xl mb-4">
                            👷
                        </div>

                        <h3 class="text-xl font-bold text-gray-700 mb-2">
                            لا يوجد عمال أو مقاولون حتى الآن
                        </h3>

                        <p class="text-gray-500 mb-6">
                            ابدأ بإضافة أول عامل أو مقاول للنظام.
                        </p>

                        <a
                            href="{{ route('workers.create') }}"
                            class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-semibold"
                        >
                            + إضافة أول عامل
                        </a>

                    </div>

                @endif

            </div>

            <!-- رجوع للوحة التحكم -->
            <div class="mt-6">

                <a
                    href="{{ route('dashboard') }}"
                    class="text-blue-600 hover:text-blue-800 font-semibold"
                >
                    ← العودة للوحة التحكم
                </a>

            </div>

        </main>

    </div>

</body>
</html>

