<x-app-layout>

    <div class="min-h-screen bg-slate-50 py-10" dir="rtl">

        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Header --}}
            <div class="flex items-center justify-between mb-8">

                <div>
                    <p class="text-sm text-slate-500 mb-2">
                        الموردين
                    </p>

                    <h1 class="text-3xl font-black text-slate-900">
                        بيانات المورد
                    </h1>
                </div>

                <a
                    href="{{ route('suppliers.index') }}"
                    class="bg-slate-900 hover:bg-slate-800 text-white px-5 py-3 rounded-xl font-bold transition"
                >
                    ← العودة للموردين
                </a>

            </div>


            {{-- Supplier Card --}}
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">

                <div class="bg-slate-900 p-8 text-white">

                    <div class="flex items-center gap-5">

                        <div class="w-16 h-16 rounded-2xl bg-white/10 flex items-center justify-center text-3xl">
                            📦
                        </div>

                        <div>
                            <h2 class="text-2xl font-black">
                                {{ $supplier->name }}
                            </h2>

                            @if($supplier->company)
                                <p class="text-slate-300 mt-1">
                                    {{ $supplier->company }}
                                </p>
                            @endif
                        </div>

                    </div>

                </div>


                {{-- Details --}}
                <div class="p-8">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                        {{-- Phone --}}
                        <div class="p-5 rounded-2xl bg-slate-50 border border-slate-200">

                            <p class="text-sm text-slate-500 mb-2">
                                رقم الهاتف
                            </p>

                            <p class="text-lg font-black text-slate-900">
                                {{ $supplier->phone ?: '—' }}
                            </p>

                        </div>


                        {{-- Company --}}
                        <div class="p-5 rounded-2xl bg-slate-50 border border-slate-200">

                            <p class="text-sm text-slate-500 mb-2">
                                الشركة
                            </p>

                            <p class="text-lg font-black text-slate-900">
                                {{ $supplier->company ?: '—' }}
                            </p>

                        </div>


                        {{-- Address --}}
                        <div class="p-5 rounded-2xl bg-slate-50 border border-slate-200">

                            <p class="text-sm text-slate-500 mb-2">
                                العنوان
                            </p>

                            <p class="text-lg font-black text-slate-900">
                                {{ $supplier->address ?: '—' }}
                            </p>

                        </div>


                        {{-- Total Due --}}
                        <div class="p-5 rounded-2xl bg-rose-50 border border-rose-100">

                            <p class="text-sm text-rose-600 mb-2">
                                إجمالي المستحق
                            </p>

                            <p class="text-2xl font-black text-rose-600">
                                {{ number_format($supplier->total_due ?? 0, 2) }}
                                <span class="text-sm">ج.م</span>
                            </p>

                        </div>


                        {{-- Total Paid --}}
                        <div class="p-5 rounded-2xl bg-emerald-50 border border-emerald-100">

                            <p class="text-sm text-emerald-600 mb-2">
                                إجمالي المدفوع
                            </p>

                            <p class="text-2xl font-black text-emerald-600">
                                {{ number_format($supplier->total_paid ?? 0, 2) }}
                                <span class="text-sm">ج.م</span>
                            </p>

                        </div>


                        {{-- Remaining --}}
                        <div class="p-5 rounded-2xl bg-amber-50 border border-amber-100">

                            <p class="text-sm text-amber-600 mb-2">
                                المتبقي
                            </p>

                            <p class="text-2xl font-black text-amber-600">
                                {{ number_format(($supplier->total_due ?? 0) - ($supplier->total_paid ?? 0), 2) }}
                                <span class="text-sm">ج.م</span>
                            </p>

                        </div>

                    </div>


                    {{-- Notes --}}
                    @if($supplier->notes)

                        <div class="mt-6 p-5 rounded-2xl bg-slate-50 border border-slate-200">

                            <p class="text-sm text-slate-500 mb-2">
                                ملاحظات
                            </p>

                            <p class="text-slate-800 leading-7">
                                {{ $supplier->notes }}
                            </p>

                        </div>

                    @endif


                    {{-- Actions --}}
                    <div class="flex gap-3 mt-8">

                        <a
                            href="{{ route('suppliers.edit', $supplier) }}"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl font-bold transition"
                        >
                            تعديل المورد
                        </a>

                        <form
                            action="{{ route('suppliers.destroy', $supplier) }}"
                            method="POST"
                        >
                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                onclick="return confirm('هل أنت متأكد من حذف المورد؟')"
                                class="bg-rose-600 hover:bg-rose-700 text-white px-6 py-3 rounded-xl font-bold transition"
                            >
                                حذف المورد
                            </button>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>