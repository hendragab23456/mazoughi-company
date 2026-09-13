<x-app-layout>
    <div class="min-h-screen bg-slate-50 py-10" dir="rtl">

        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="flex items-center justify-between mb-8">
                <div>
                    <p class="text-sm text-slate-500 mb-2">الموردين</p>
                    <h1 class="text-3xl font-black text-slate-900">
                        تعديل بيانات المورد
                    </h1>
                </div>

                <a href="{{ route('suppliers.index') }}"
                   class="bg-slate-900 hover:bg-slate-800 text-white px-5 py-3 rounded-xl font-bold transition">
                    ← العودة للموردين
                </a>
            </div>

            @if ($errors->any())
                <div class="mb-6 bg-rose-50 border border-rose-200 text-rose-700 rounded-2xl p-5">
                    <ul class="list-disc list-inside space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-8">

                <form action="{{ route('suppliers.update', $supplier) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">
                                اسم المورد
                            </label>

                            <input
                                type="text"
                                name="name"
                                value="{{ old('name', $supplier->name) }}"
                                required
                                class="w-full rounded-xl border-slate-300 focus:border-blue-500 focus:ring-blue-500"
                                placeholder="اسم المورد">
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">
                                رقم الهاتف
                            </label>

                            <input
                                type="text"
                                name="phone"
                                value="{{ old('phone', $supplier->phone) }}"
                                class="w-full rounded-xl border-slate-300 focus:border-blue-500 focus:ring-blue-500"
                                placeholder="رقم الهاتف">
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">
                                الشركة
                            </label>

                            <input
                                type="text"
                                name="company"
                                value="{{ old('company', $supplier->company) }}"
                                class="w-full rounded-xl border-slate-300 focus:border-blue-500 focus:ring-blue-500"
                                placeholder="اسم الشركة">
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">
                                العنوان
                            </label>

                            <input
                                type="text"
                                name="address"
                                value="{{ old('address', $supplier->address) }}"
                                class="w-full rounded-xl border-slate-300 focus:border-blue-500 focus:ring-blue-500"
                                placeholder="عنوان المورد">
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">
                                إجمالي المستحق
                            </label>

                            <input
                                type="number"
                                step="0.01"
                                min="0"
                                name="total_due"
                                value="{{ old('total_due', $supplier->total_due) }}"
                                class="w-full rounded-xl border-slate-300 focus:border-blue-500 focus:ring-blue-500"
                                placeholder="0.00">
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-2">
                                إجمالي المدفوع
                            </label>

                            <input
                                type="number"
                                step="0.01"
                                min="0"
                                name="total_paid"
                                value="{{ old('total_paid', $supplier->total_paid) }}"
                                class="w-full rounded-xl border-slate-300 focus:border-blue-500 focus:ring-blue-500"
                                placeholder="0.00">
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-sm font-bold text-slate-700 mb-2">
                                ملاحظات
                            </label>

                            <textarea
                                name="notes"
                                rows="5"
                                class="w-full rounded-xl border-slate-300 focus:border-blue-500 focus:ring-blue-500"
                                placeholder="اكتب أي ملاحظات عن المورد">{{ old('notes', $supplier->notes) }}</textarea>
                        </div>

                    </div>

                    <div class="flex items-center gap-3 mt-8">

                        <button
                            type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-7 py-3 rounded-xl font-bold transition">
                            حفظ التعديلات
                        </button>

                        <a
                            href="{{ route('suppliers.index') }}"
                            class="bg-slate-200 hover:bg-slate-300 text-slate-800 px-7 py-3 rounded-xl font-bold transition">
                            إلغاء
                        </a>

                    </div>

                </form>

            </div>

        </div>
    </div>
</x-app-layout>
