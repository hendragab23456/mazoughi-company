<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>إضافة عامل - المزوغي</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 text-gray-800">

<div class="min-h-screen">

    <!-- الهيدر -->
    <header class="bg-slate-900 text-white shadow-lg">
        <div class="max-w-4xl mx-auto px-6 py-5">

            <h1 class="text-2xl font-bold">
                إضافة عامل أو مقاول
            </h1>

            <p class="text-gray-300 mt-1">
                تسجيل بيانات العامل والمبلغ المستحق له
            </p>

        </div>
    </header>

    <!-- المحتوى -->
    <main class="max-w-4xl mx-auto px-6 py-8">

        <div class="bg-white rounded-xl shadow-lg p-6 md:p-8">

            @if ($errors->any())

                <div class="mb-6 bg-red-100 border border-red-300 text-red-800 rounded-lg p-4">

                    <h3 class="font-bold mb-2">
                        يوجد بعض الأخطاء:
                    </h3>

                    <ul class="list-disc mr-5 space-y-1">

                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach

                    </ul>

                </div>

            @endif

            <form
                action="{{ route('workers.store') }}"
                method="POST"
                class="space-y-6"
            >

                @csrf

                <!-- الاسم -->
                <div>

                    <label class="block font-semibold mb-2">
                        اسم العامل أو المقاول
                    </label>

                    <input
                        type="text"
                        name="name"
                        value="{{ old('name') }}"
                        required
                        placeholder=""
                        class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    >

                </div>

                <!-- الهاتف -->
                <div>

                    <label class="block font-semibold mb-2">
                        رقم الهاتف
                    </label>

                    <input
                        type="text"
                        name="phone"
                        value="{{ old('phone') }}"
                        placeholder=" 010xxxxxxxx"
                        class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    >

                </div>

                <!-- الوظيفة والنوع -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <div>

                        <label class="block font-semibold mb-2">
                            الوظيفة
                        </label>

                        <input
                            type="text"
                            name="job_title"
                            value="{{ old('job_title') }}"
                            placeholder=" نجار / حداد / سائق"
                            class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        >

                    </div>

                    <div>

                        <label class="block font-semibold mb-2">
                            نوع التعامل
                        </label>

                        <select
                            name="type"
                            required
                            class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        >

                            <option value="worker" {{ old('type', 'worker') === 'worker' ? 'selected' : '' }}>
                                عامل
                            </option>

                            <option value="contractor" {{ old('type') === 'contractor' ? 'selected' : '' }}>
                                مقاول
                            </option>

                        </select>

                    </div>

                </div>

                <!-- المستحق -->
                <div>

                    <label class="block font-semibold mb-2">
                        إجمالي المبلغ المستحق
                    </label>

                    <div class="relative">

                        <input
                            type="number"
                            name="total_due"
                            value="{{ old('total_due', 0) }}"
                            min="0"
                            step="0.01"
                            required
                            placeholder="0.00"
                            class="w-full border border-gray-300 rounded-lg px-4 py-3 pl-16 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        >

                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500">
                            ج.م
                        </span>

                    </div>

                    <p class="text-sm text-gray-500 mt-2">
                       .
                    </p>

                </div>

                <!-- ملاحظات -->
                <div>

                    <label class="block font-semibold mb-2">
                        ملاحظات
                    </label>

                    <textarea
                        name="notes"
                        rows="4"
                        placeholder="أي ملاحظات خاصة بالعامل أو المقاول..."
                        class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    >{{ old('notes') }}</textarea>

                </div>

                <!-- الأزرار -->
                <div class="flex flex-col md:flex-row gap-3 pt-4 border-t">

                    <button
                        type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-semibold transition"
                    >
                        حفظ العامل
                    </button>

                    <a
                        href="{{ route('workers.index') }}"
                        class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-6 py-3 rounded-lg font-semibold text-center transition"
                    >
                        إلغاء
                    </a>

                </div>

            </form>

        </div>

    </main>

</div>

</body>
</html>
