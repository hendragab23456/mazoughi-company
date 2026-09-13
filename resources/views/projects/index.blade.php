<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>المشاريع - المزوغي للمقاولات</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 min-h-screen">

    <div class="max-w-7xl mx-auto px-4 py-8">

        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">المشاريع</h1>
                <p class="text-gray-500 mt-2">إدارة ومتابعة جميع مشاريع الشركة</p>
            </div>

            <a href="{{ route('projects.create') }}"
               class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl font-semibold text-center">
                + إضافة مشروع
            </a>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border border-green-300 text-green-800 px-5 py-4 rounded-xl mb-6">
                {{ session('success') }}
            </div>
        @endif

        @if($projects->count())

            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">

                @foreach($projects as $project)

                    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">

                        <div class="flex items-start justify-between gap-3 mb-5">
                            <div>
                                <h2 class="text-xl font-bold text-gray-800">
                                    {{ $project->name }}
                                </h2>

                                @if($project->client_name)
                                    <p class="text-gray-500 mt-1">
                                        العميل: {{ $project->client_name }}
                                    </p>
                                @endif
                            </div>

                            @php
                                $statusLabels = [
                                    'planning' => 'تخطيط',
                                    'active' => 'نشط',
                                    'completed' => 'مكتمل',
                                    'paused' => 'متوقف',
                                    'cancelled' => 'ملغي',
                                ];
                            @endphp

                            <span class="px-3 py-1 rounded-full text-sm bg-gray-100 text-gray-700 whitespace-nowrap">
                                {{ $statusLabels[$project->status] ?? $project->status }}
                            </span>
                        </div>

                        @if($project->location)
                            <p class="text-sm text-gray-500 mb-4">
                                📍 {{ $project->location }}
                            </p>
                        @endif

                        <div class="space-y-3 border-t border-gray-100 pt-4">

                            <div class="flex justify-between">
                                <span class="text-gray-500">الميزانية</span>
                                <span class="font-semibold">
                                    {{ number_format($project->budget, 2) }} ج.م
                                </span>
                            </div>

                            <div class="flex justify-between">
                                <span class="text-gray-500">المصروفات</span>
                                <span class="font-semibold text-red-600">
                                    {{ number_format($project->total_expenses, 2) }} ج.م
                                </span>
                            </div>

                            <div class="flex justify-between">
                                <span class="text-gray-500">المتبقي</span>

                                <span class="font-bold {{ $project->isOverBudget() ? 'text-red-600' : 'text-green-600' }}">
                                    {{ number_format($project->remaining_budget, 2) }} ج.م
                                </span>
                            </div>

                        </div>

                        @if($project->isOverBudget())
                            <div class="mt-4 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl text-sm">
                                ⚠️ المشروع تجاوز الميزانية
                            </div>
                        @endif

                        <div class="flex gap-2 mt-6">

                            <a href="{{ route('projects.show', $project) }}"
                               class="flex-1 text-center bg-gray-100 hover:bg-gray-200 text-gray-800 px-4 py-2 rounded-lg">
                                عرض
                            </a>

                            <a href="{{ route('projects.edit', $project) }}"
                               class="flex-1 text-center bg-blue-50 hover:bg-blue-100 text-blue-700 px-4 py-2 rounded-lg">
                                تعديل
                            </a>

                            <form action="{{ route('projects.destroy', $project) }}"
                                  method="POST"
                                  class="flex-1"
                                  onsubmit="return confirm('هل أنت متأكد من حذف المشروع؟');">

                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        class="w-full bg-red-50 hover:bg-red-100 text-red-700 px-4 py-2 rounded-lg">
                                    حذف
                                </button>

                            </form>

                        </div>

                    </div>

                @endforeach

            </div>

        @else

            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-12 text-center">

                <div class="text-5xl mb-4">🏗️</div>

                <h2 class="text-2xl font-bold text-gray-800 mb-2">
                    لا توجد مشاريع حتى الآن
                </h2>

                <p class="text-gray-500 mb-6">
                    ابدأ بإضافة أول مشروع للشركة
                </p>

                <a href="{{ route('projects.create') }}"
                   class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl font-semibold">
                    + إضافة مشروع
                </a>

            </div>

        @endif

        <div class="mt-8">
            <a href="{{ route('dashboard') }}"
               class="text-blue-600 hover:text-blue-800 font-semibold">
                ← العودة إلى لوحة التحكم
            </a>
        </div>

    </div>

</body>
</html>
