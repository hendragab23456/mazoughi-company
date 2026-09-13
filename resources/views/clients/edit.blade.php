<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>تعديل العميل - المزوغي للمقاولات</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-slate-50 text-slate-900">

<div class="min-h-screen">

    <header class="bg-slate-900 text-white shadow-lg">
        <div class="max-w-4xl mx-auto px-6 py-5">
            <h1 class="text-2xl font-bold">تعديل بيانات العميل</h1>

            <p class="text-slate-300 text-sm mt-1">
                {{ $client->name }}
            </p>
        </div>
    </header>

    <main class="max-w-4xl mx-auto px-6 py-8">

        @if($errors->any())
            <div class="mb-6 rounded-xl bg-red-100 border border-red-200 text-red-800 px-5 py-4">
                <ul class="list-disc mr-5 space-y-1">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form
            action="{{ route('clients.update', $client) }}"
            method="POST"
            class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 md:p-8"
        >
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <div>
                    <label class="block font-bold mb-2">اسم العميل *</label>

                    <input
                        type="text"
                        name="name"
                        value="{{ old('name', $client->name) }}"
                        required
                        class="w-full rounded-xl border-slate-300 focus:border-slate-900 focus:ring-slate-900"
                    >
                </div>

                <div>
                    <label class="block font-bold mb-2">رقم الهاتف</label>

                    <input
                        type="text"
                        name="phone"
                        value="{{ old('phone', $client->phone) }}"
                        class="w-full rounded-xl border-slate-300 focus:border-slate-900 focus:ring-slate-900"
                    >
                </div>

                <div>
                    <label class="block font-bold mb-2">اسم الشركة</label>

                    <input
                        type="text"
                        name="company"
                        value="{{ old('company', $client->company) }}"
                        class="w-full rounded-xl border-slate-300 focus:border-slate-900 focus:ring-slate-900"
                    >
                </div>

                <div>
                    <label class="block font-bold mb-2">العنوان</label>

                    <input
                        type="text"
                        name="address"
                        value="{{ old('address', $client->address) }}"
                        class="w-full rounded-xl border-slate-300 focus:border-slate-900 focus:ring-slate-900"
                    >
                </div>

                <div>
                    <label class="block font-bold mb-2">إجمالي المستحق *</label>

                    <input
                        type="number"
                        name="total_due"
                        value="{{ old('total_due', $client->total_due) }}"
                        min="0"
                        step="0.01"
                        required
                        class="w-full rounded-xl border-slate-300 focus:border-slate-900 focus:ring-slate-900"
                    >
                </div>

                <div>
                    <label class="block font-bold mb-2">إجمالي المدفوع *</label>

                    <input
                        type="number"
                        name="total_paid"
                        value="{{ old('total_paid', $client->total_paid) }}"
                        min="0"
                        step="0.01"
                        required
                        class="w-full rounded-xl border-slate-300 focus:border-slate-900 focus:ring-slate-900"
                    >
                </div>

            </div>

            <div class="mt-6">

                <label class="block font-bold mb-2">ملاحظات</label>

                <textarea
                    name="notes"
                    rows="4"
                    class="w-full rounded-xl border-slate-300 focus:border-slate-900 focus:ring-slate-900"
                >{{ old('notes', $client->notes) }}</textarea>

            </div>

            <div class="mt-8 flex items-center gap-3">

                <button
                    type="submit"
                    class="bg-slate-900 text-white px-6 py-3 rounded-xl font-bold hover:bg-slate-800 transition"
                >
                    حفظ التعديلات
                </button>

                <a
                    href="{{ route('clients.show', $client) }}"
                    class="px-6 py-3 rounded-xl font-bold bg-slate-100 hover:bg-slate-200 transition"
                >
                    إلغاء
                </a>

            </div>

        </form>

    </main>

</div>

</body>
</html>

