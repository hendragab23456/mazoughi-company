<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>إضافة مورد - المزوغي</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-slate-50">

<div class="min-h-screen">

    <header class="bg-slate-900 text-white">
        <div class="max-w-4xl mx-auto px-6 py-6">
            <h1 class="text-2xl font-black">
                إضافة مورد
            </h1>

            <p class="text-slate-300 text-sm mt-1">
                تسجيل بيانات مورد جديد
            </p>
        </div>
    </header>

    <main class="max-w-4xl mx-auto px-6 py-8">

        @if($errors->any())
            <div class="mb-6 bg-red-50 border border-red-200 text-red-700 rounded-xl p-4">
                <ul class="list-disc mr-5 space-y-1">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form
            action="{{ route('suppliers.store') }}"
            method="POST"
            class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 md:p-8"
        >

            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <div>
                    <label class="block font-bold mb-2">
                        اسم المورد *
                    </label>

                    <input
                        type="text"
                        name="name"
                        value="{{ old('name') }}"
                        required
                        class="w-full rounded-xl border-slate-300 focus:border-slate-900 focus:ring-slate-900"
                    >
                </div>

                <div>
                    <label class="block font-bold mb-2">
                        رقم الهاتف
                    </label>

                    <input
                        type="text"
                        name="phone"
                        value="{{ old('phone') }}"
                        class="w-full rounded-xl border-slate-300 focus:border-slate-900 focus:ring-slate-900"
                        placeholder="01xxxxxxxxx" 
                        >
                   
                </div>

                <div>
                    <label class="block font-bold mb-2">
                        اسم الشركة
                    </label>

                    <input
                        type="text"
                        name="company"
                        value="{{ old('company') }}"
                        class="w-full rounded-xl border-slate-300 focus:border-slate-900 focus:ring-slate-900"
                    >
                </div>

                <div>
                    <label class="block font-bold mb-2">
                        العنوان
                    </label>

                    <input
                        type="text"
                        name="address"
                        value="{{ old('address') }}"
                        class="w-full rounded-xl border-slate-300 focus:border-slate-900 focus:ring-slate-900"
                    >
                </div>

                <div>
                    <label class="block font-bold mb-2">
                        إجمالي المستحق
                    </label>

                    <input
                        type="number"
                        name="total_due"
                        value="{{ old('total_due', 0) }}"
                        min="0"
                        step="0.01"
                        class="w-full rounded-xl border-slate-300 focus:border-slate-900 focus:ring-slate-900"
                    >
                </div>

                <div>
                    <label class="block font-bold mb-2">
                        إجمالي المدفوع
                    </label>

                    <input
                        type="number"
                        name="total_paid"
                        value="{{ old('total_paid', 0) }}"
                        min="0"
                        step="0.01"
                        class="w-full rounded-xl border-slate-300 focus:border-slate-900 focus:ring-slate-900"
                    >
                </div>

            </div>

            <div class="mt-6">

                <label class="block font-bold mb-2">
                    ملاحظات
                </label>

                <textarea
                    name="notes"
                    rows="4"
                    class="w-full rounded-xl border-slate-300 focus:border-slate-900 focus:ring-slate-900"
                >{{ old('notes') }}</textarea>

            </div>

            <div class="mt-8 flex items-center gap-3">

                <button
                    type="submit"
                    class="bg-slate-900 text-white px-6 py-3 rounded-xl font-bold hover:bg-slate-800 transition"
                >
                    حفظ المورد
                </button>

                <a
                    href="{{ route('suppliers.index') }}"
                    class="bg-slate-100 text-slate-800 px-6 py-3 rounded-xl font-bold hover:bg-slate-200 transition"
                >
                    إلغاء
                </a>

            </div>

        </form>

    </main>

</div>

</body>
</html>

