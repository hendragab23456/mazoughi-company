<x-app-layout>
<div class="min-h-screen bg-slate-50" dir="rtl">

    {{-- =========================
        HEADER
    ========================== --}}
    <header class="bg-white border-b border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">

                {{-- Logo + Company --}}
                <div class="flex items-center gap-4">

                    <div class="w-14 h-14 rounded-2xl overflow-hidden border border-slate-200 bg-white shadow-sm flex items-center justify-center">
                        <img
                            src="{{ asset('images/company-logo.jpeg') }}"
                            alt="شعار المزوغي"
                            class="w-full h-full object-contain"
                        >
                    </div>
                    <div>
                        <h1 class="text-xl font-black text-slate-800">
                            المزوغي
                        </h1>

                        <p class="text-sm text-slate-500">
                            للمقاولات العامة والتوريدات
                        </p>
                    </div>

                </div>

                {{-- User --}}
                <div class="flex items-center gap-4">

                    <div class="hidden sm:block text-left">
                        <p class="text-sm font-bold text-slate-800">
                            {{ auth()->user()->name ?? 'المستخدم' }}
                        </p>

                        <p class="text-xs text-slate-500">
                            المدير العام
                        </p>
                    </div>

                    <div class="w-11 h-11 rounded-full bg-slate-900 text-white flex items-center justify-center font-bold shadow-sm">
                        {{ strtoupper(substr(auth()->user()->name ?? 'م', 0, 1)) }}
                    </div>

                </div>

            </div>
        </div>
    </header>


    {{-- =========================
        MAIN
    ========================== --}}
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        {{-- Welcome --}}
        <div class="mb-8">

            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5">

                <div>
                    <p class="text-sm text-slate-500 mb-2">
                        لوحة التحكم الرئيسية
                    </p>

                    <h2 class="text-3xl font-black text-slate-900">
                        مرحبًا {{ auth()->user()->name ?? 'بك' }} 👑
                    </h2>

                    <p class="text-slate-500 mt-2">
                        تابع حسابات الشركة وحركة العمليات من مكان واحد.
                    </p>
                </div>

                <a
                    href="{{ route('transactions.create') }}"
                    class="inline-flex items-center justify-center gap-2 bg-slate-900 hover:bg-slate-800 text-white px-6 py-3 rounded-xl font-bold shadow-sm transition"
                >
                    <span class="text-lg">＋</span>
                    إضافة عملية
                </a>

            </div>

        </div>


        {{-- =========================
            FINANCIAL CARDS
        ========================== --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-5 mb-8">

            {{-- Cash --}}
            <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm hover:shadow-md transition">

                <div class="flex items-center justify-between mb-5">

                    <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-2xl">
                        💵
                    </div>

                    <span class="text-xs font-bold text-emerald-600 bg-emerald-50 px-3 py-1 rounded-full">
                        نقدية
                    </span>

                </div>

                <p class="text-sm text-slate-500 mb-2">
                    رصيد الخزينة
                </p>

                <h3 class="text-2xl font-black text-slate-900">
                    {{ number_format($cashBalance ?? 0, 2) }}
                    <span class="text-sm font-medium text-slate-500">ج.م</span>
                </h3>

            </div>


            {{-- Bank --}}
            <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm hover:shadow-md transition">

                <div class="flex items-center justify-between mb-5">

                    <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center text-2xl">
                        🏦
                    </div>

                    <span class="text-xs font-bold text-blue-600 bg-blue-50 px-3 py-1 rounded-full">
                        بنك
                    </span>

                </div>

                <p class="text-sm text-slate-500 mb-2">
                    الرصيد البنكي
                </p>

                <h3 class="text-2xl font-black text-slate-900">
                    {{ number_format($bankBalance ?? 0, 2) }}
                    <span class="text-sm font-medium text-slate-500">ج.م</span>
                </h3>

            </div>


            {{-- Revenue --}}
            <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm hover:shadow-md transition">

                <div class="flex items-center justify-between mb-5">

                    <div class="w-12 h-12 rounded-xl bg-violet-50 text-violet-600 flex items-center justify-center text-2xl">
                        📈
                    </div>

                    <span class="text-xs font-bold text-violet-600 bg-violet-50 px-3 py-1 rounded-full">
                        إيرادات
                    </span>

                </div>

                <p class="text-sm text-slate-500 mb-2">
                    إجمالي الإيرادات
                </p>

                <h3 class="text-2xl font-black text-slate-900">
                    {{ number_format($totalRevenue ?? 0, 2) }}
                    <span class="text-sm font-medium text-slate-500">ج.م</span>
                </h3>

            </div>


            {{-- Expenses --}}
            <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm hover:shadow-md transition">

                <div class="flex items-center justify-between mb-5">

                    <div class="w-12 h-12 rounded-xl bg-rose-50 text-rose-600 flex items-center justify-center text-2xl">
                        📉
                    </div>

                    <span class="text-xs font-bold text-rose-600 bg-rose-50 px-3 py-1 rounded-full">
                        مصروفات
                    </span>

                </div>

                <p class="text-sm text-slate-500 mb-2">
                    إجمالي المصروفات
                </p>

                <h3 class="text-2xl font-black text-slate-900">
                    {{ number_format($totalExpenses ?? 0, 2) }}
                    <span class="text-sm font-medium text-slate-500">ج.م</span>
                </h3>

            </div>

        </div>


        {{-- =========================
            QUICK ACTIONS
        ========================== --}}
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 mb-8">

            <div class="flex items-center justify-between mb-6">

                <div>
                    <h3 class="text-lg font-black text-slate-900">
                        الوصول السريع
                    </h3>

                    <p class="text-sm text-slate-500 mt-1">
                        أهم أقسام النظام
                    </p>
                </div>

            </div>


            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">

                {{-- Transactions --}}
                <a
                    href="{{ route('transactions.index') }}"
                    class="group p-5 rounded-2xl border border-slate-200 hover:border-slate-900 hover:bg-slate-50 transition"
                >

                    <div class="w-11 h-11 rounded-xl bg-slate-100 group-hover:bg-slate-900 group-hover:text-white flex items-center justify-center text-xl mb-4 transition">
                        💳
                    </div>

                    <p class="font-bold text-slate-800">
                        العمليات
                    </p>

                    <p class="text-xs text-slate-500 mt-1">
                        الحسابات
                    </p>

                </a>


                {{-- Projects --}}
                <a
                    href="{{ route('projects.index') }}" 
                    class="group p-5 rounded-2xl border border-slate-200 hover:border-slate-900 hover:bg-slate-50 transition"
                >

                    <div class="w-11 h-11 rounded-xl bg-blue-50 group-hover:bg-blue-600 group-hover:text-white flex items-center justify-center text-xl mb-4 transition">
                        🏗️
                    </div>

                    <p class="font-bold text-slate-800">
                        المشاريع
                    </p>

                    <p class="text-xs text-slate-500 mt-1">
                        متابعة المشاريع
                    </p>

                </a>


                {{-- Workers --}}
                <a
                    href="{{ route('workers.index') }}"
                    class="group p-5 rounded-2xl border border-slate-200 hover:border-slate-900 hover:bg-slate-50 transition"
                >

                    <div class="w-11 h-11 rounded-xl bg-amber-50 group-hover:bg-amber-500 group-hover:text-white flex items-center justify-center text-xl mb-4 transition">
                        👷
                    </div>

                    <p class="font-bold text-slate-800">
                        العمال
                    </p>

                    <p class="text-xs text-slate-500 mt-1">
                        العمال والمقاولين
                    </p>

                </a>


                {{-- Clients --}}
                <a
                    href="{{ route('clients.index') }}"
                    class="group p-5 rounded-2xl border border-slate-200 hover:border-slate-900 hover:bg-slate-50 transition"
                >

                    <div class="w-11 h-11 rounded-xl bg-emerald-50 group-hover:bg-emerald-600 group-hover:text-white flex items-center justify-center text-xl mb-4 transition">
                        👥
                    </div>

                    <p class="font-bold text-slate-800">
                        العملاء
                    </p>

                    <p class="text-xs text-slate-500 mt-1">
                        إدارة العملاء
                    </p>

                </a>


                {{-- Suppliers --}}
                <a
                    href="{{ route('suppliers.index') }}"
                    class="group p-5 rounded-2xl border border-slate-200 hover:border-slate-900 hover:bg-slate-50 transition"
                >

                    <div class="w-11 h-11 rounded-xl bg-violet-50 group-hover:bg-violet-600 group-hover:text-white flex items-center justify-center text-xl mb-4 transition">
                        📦
                    </div>

                    <p class="font-bold text-slate-800">
                        الموردين
                    </p>

                    <p class="text-xs text-slate-500 mt-1">
                        المشتريات والخامات
                    </p>

                </a>


                {{-- Reports --}}
                <a
                   href="{{ route('reports.index') }}"
                    class="group p-5 rounded-2xl border border-slate-200 hover:border-slate-900 hover:bg-slate-50 transition"
                >

                    <div class="w-11 h-11 rounded-xl bg-cyan-50 group-hover:bg-cyan-600 group-hover:text-white flex items-center justify-center text-xl mb-4 transition">
                        📊
                    </div>

                    <p class="font-bold text-slate-800">
                        التقارير
                    </p>

                    <p class="text-xs text-slate-500 mt-1">
                        تقارير الحسابات
                    </p>

                </a>

            </div>

        </div>


        {{-- =========================
            CONTENT GRID
        ========================== --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">


            {{-- Latest Transactions --}}
            <div class="lg:col-span-2 bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">

                <div class="p-6 border-b border-slate-100 flex items-center justify-between">

                    <div>
                        <h3 class="text-lg font-black text-slate-900">
                            آخر العمليات
                        </h3>

                        <p class="text-sm text-slate-500 mt-1">
                            أحدث الحركات المالية
                        </p>
                    </div>

                    <a
                        href="{{ route('transactions.index') }}"
                        class="text-sm font-bold text-slate-700 hover:text-slate-900"
                    >
                        عرض الكل
                    </a>

                </div>


                @if(isset($latestTransactions) && $latestTransactions->count())

                    <div class="divide-y divide-slate-100">

                        @foreach($latestTransactions as $transaction)

                            <div class="p-5 flex items-center justify-between gap-4 hover:bg-slate-50 transition">

                                <div class="flex items-center gap-4 min-w-0">

                                    <div class="w-11 h-11 rounded-xl bg-slate-100 flex items-center justify-center text-xl flex-shrink-0">
                                        @if(($transaction->type ?? '') === 'revenue')
                                            📈
                                        @elseif(($transaction->type ?? '') === 'expense')
                                            📉
                                        @else
                                            💰
                                        @endif
                                    </div>

                                    <div class="min-w-0">

                                        <p class="font-bold text-slate-800 truncate">
                                            {{ $transaction->description ?? $transaction->title ?? 'عملية مالية' }}
                                        </p>

                                        <p class="text-xs text-slate-500 mt-1">
                                            {{ $transaction->created_at?->format('Y-m-d H:i') ?? '' }}
                                        </p>

                                    </div>

                                </div>


                                <div class="text-left flex-shrink-0">

                                    <p class="font-black
                                        @if(($transaction->type ?? '') === 'revenue')
                                            text-emerald-600
                                        @elseif(($transaction->type ?? '') === 'expense')
                                            text-rose-600
                                        @else
                                            text-slate-800
                                        @endif
                                    ">
                                        {{ number_format($transaction->amount ?? 0, 2) }}
                                        ج.م
                                    </p>

                                    <p class="text-xs text-slate-400 mt-1">
                                        {{ $transaction->type ?? 'عملية' }}
                                    </p>

                                </div>

                            </div>

                        @endforeach

                    </div>

                @else

                    <div class="p-10 text-center">

                        <div class="text-4xl mb-4">
                            📋
                        </div>

                        <h4 class="font-bold text-slate-800">
                            لا توجد عمليات حتى الآن
                        </h4>

                        <p class="text-sm text-slate-500 mt-2">
                            عند إضافة عمليات مالية ستظهر هنا.
                        </p>

                        <a
                            href="{{ route('transactions.create') }}"
                            class="inline-flex mt-5 bg-slate-900 text-white px-5 py-2.5 rounded-xl text-sm font-bold hover:bg-slate-800 transition"
                        >
                            إضافة أول عملية
                        </a>

                    </div>

                @endif

            </div>


            {{-- Alerts --}}
            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">

                <div class="p-6 border-b border-slate-100">

                    <h3 class="text-lg font-black text-slate-900">
                        التنبيهات
                    </h3>

                    <p class="text-sm text-slate-500 mt-1">
                        تحتاج إلى متابعتك
                    </p>

                </div>


                <div class="p-5 space-y-4">

                    {{-- Worker dues --}}
                    <div class="flex gap-3 p-4 rounded-xl bg-amber-50 border border-amber-100">

                        <div class="text-xl">
                            ⚠️
                        </div>

                        <div>
                            <p class="font-bold text-slate-800 text-sm">
                                مستحقات العمال
                            </p>

                            <p class="text-xs text-slate-500 mt-1">
                                راجع المستحقات والدفعات القادمة.
                            </p>
                        </div>

                    </div>


                    {{-- Advances --}}
                    <div class="flex gap-3 p-4 rounded-xl bg-blue-50 border border-blue-100">

                        <div class="text-xl">
                            💼
                        </div>

                        <div>
                            <p class="font-bold text-slate-800 text-sm">
                                العهد المفتوحة
                            </p>

                            <p class="text-xs text-slate-500 mt-1">
                                تابع العهد التي لم تتم تسويتها.
                            </p>
                        </div>

                    </div>


                    {{-- Invoices --}}
                    <div class="flex gap-3 p-4 rounded-xl bg-rose-50 border border-rose-100">

                        <div class="text-xl">
                            🧾
                        </div>

                        <div>
                            <p class="font-bold text-slate-800 text-sm">
                                الفواتير
                            </p>

                            <p class="text-xs text-slate-500 mt-1">
                                تابع الفواتير غير المسددة.
                            </p>
                        </div>

                    </div>


                    {{-- Budget --}}
                    <div class="flex gap-3 p-4 rounded-xl bg-violet-50 border border-violet-100">

                        <div class="text-xl">
                            📊
                        </div>

                        <div>
                            <p class="font-bold text-slate-800 text-sm">
                                متابعة الميزانية
                            </p>

                            <p class="text-xs text-slate-500 mt-1">
                                راقب المصروفات مقارنة بالمشاريع.
                            </p>
                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- =========================
            SYSTEM STATUS
        ========================== --}}
        <div class="mt-6 bg-slate-900 rounded-2xl p-6 text-white">

            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-5">

                <div>

                    <p class="text-slate-400 text-sm mb-1">
                        حالة النظام
                    </p>

                    <h3 class="font-black text-lg">
                        نظام المزوغي يعمل بشكل طبيعي
                    </h3>

                </div>


                <div class="flex items-center gap-3">

                    <span class="w-3 h-3 bg-emerald-400 rounded-full"></span>

                    <span class="text-sm text-slate-300">
                        متصل
                    </span>

                </div>

            </div>

        </div>


    </main>


    {{-- =========================
        FOOTER
    ========================== --}}
    <footer class="border-t border-slate-200 bg-white">

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-5">

            <div class="flex flex-col sm:flex-row items-center justify-between gap-3">

                <p class="text-sm text-slate-500">
                    © {{ date('Y') }} المزوغي للمقاولات العامة والتوريدات
                </p>

                <p class="text-xs text-slate-400">
                    نظام إدارة الحسابات والعمليات
                </p>

            </div>

        </div>

    </footer>

</div>


</x-app-layout>
