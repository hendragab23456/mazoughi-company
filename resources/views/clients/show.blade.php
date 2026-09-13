<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $client->name }} - العملاء</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-slate-50 text-slate-900">

<div class="min-h-screen">

    <header class="bg-slate-900 text-white shadow-lg">
        <div class="max-w-4xl mx-auto px-6 py-5">
            <h1 class="text-2xl font-bold">{{ $client->name }}</h1>
            <p class="text-slate-300 text-sm mt-1">
                بيانات وحساب العميل
            </p>
        </div>
    </header>

    <main class="max-w-4xl mx-auto px-6 py-8">

        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 md:p-8">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <div>
                    <p class="text-sm text-slate-500">اسم العميل</p>
                    <p class="font-bold text-lg mt-1">{{ $client->name }}</p>
                </div>

                <div>
                    <p class="text-sm text-slate-500">رقم الهاتف</p>
                    <p class="font-bold text-lg mt-1">
                        {{ $client->phone ?: 'غير مسجل' }}
                    </p>
                </div>

                <div>
                    <p class="text-sm text-slate-500">الشركة</p>
                    <p class="font-bold text-lg mt-1">
                        {{ $client->company ?: 'غير مسجلة' }}
                    </p>
                </div>

                <div>
                    <p class="text-sm text-slate-500">العنوان</p>
                    <p class="font-bold text-lg mt-1">
                        {{ $client->address ?: 'غير مسجل' }}
                    </p>
                </div>

            </div>

            <div class="border-t border-slate-200 my-8"></div>

            <h2 class="text-xl font-bold mb-5">الحساب المالي</h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">

                <div class="rounded-2xl bg-slate-50 border border-slate-200 p-5">
                    <p class="text-sm text-slate-500">إجمالي المستحق</p>
                    <p class="text-2xl font-bold mt-2">
                        {{ number_format($client->total_due, 2) }}
                        <span class="text-sm font-normal">ج.م</span>
                    </p>
                </div>

                <div class="rounded-2xl bg-emerald-50 border border-emerald-200 p-5">
                    <p class="text-sm text-emerald-700">المدفوع</p>
                    <p class="text-2xl font-bold text-emerald-600 mt-2">
                        {{ number_format($client->total_paid, 2) }}
                        <span class="text-sm font-normal">ج.م</span>
                    </p>
                </div>

                <div class="rounded-2xl bg-red-50 border border-red-200 p-5">
                    <p class="text-sm text-red-700">المتبقي</p>
                    <p class="text-2xl font-bold text-red-600 mt-2">
                        {{ number_format($client->remaining, 2) }}
                        <span class="text-sm font-normal">ج.م</span>
                    </p>
                </div>

            </div>

            @if($client->notes)

                <div class="mt-8">
                    <p class="text-sm text-slate-500 mb-2">ملاحظات</p>

                    <div class="bg-slate-50 border border-slate-200 rounded-xl p-4">
                        {{ $client->notes }}
                    </div>
                </div>

            @endif

            <div class="mt-8 flex items-center gap-3">

                <a
                    href="{{ route('clients.edit', $client) }}"
                    class="bg-slate-900 text-white px-6 py-3 rounded-xl font-bold hover:bg-slate-800 transition"
                >
                    تعديل البيانات
                </a>

                <a
                    href="{{ route('clients.index') }}"
                    class="px-6 py-3 rounded-xl font-bold bg-slate-100 hover:bg-slate-200 transition"
                >
                    العودة للعملاء
                </a>

            </div>

        </div>

    </main>

</div>

</body>
</html>
