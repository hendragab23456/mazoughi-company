<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $project->name }} - المزوغي للمقاولات</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 min-h-screen">

<div class="max-w-5xl mx-auto px-4 py-8">

    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">

        <div>
            <a href="{{ route('projects.index') }}"
               class="text-blue-600 hover:text-blue-800 font-semibold">
                ← العودة إلى المشاريع
            </a>

            <h1 class="text-3xl font-bold text-gray-800 mt-4">
                {{ $project->name }}
            </h1>

            <p class="text-gray-500 mt-2">
                تفاصيل ومتابعة المشروع
            </p>
        </div>

        <a href="{{ route('projects.edit', $project) }}"
           class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl font-semibold text-center">
            تعديل المشروع
        </a>

    </div>

    @if($project->isOverBudget())
        <div class="bg-red-50 border border-red-200 text-red-700 rounded-xl p-4 mb-6">
            ⚠️ هذا المشروع تجاوز الميزانية المحددة.
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">

        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
            <p class="text-gray-500 mb-2">الميزانية</p>
            <p class="text-2xl font-bold text-gray-800">
                {{ number_format($project->budget, 2) }} ج.م
            </p>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
            <p class="text-gray-500 mb-2">المصروفات</p>
            <p class="text-2xl font-bold text-red-600">
                {{ number_format($project->total_expenses, 2) }} ج.م
            </p>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
            <p class="text-gray-500 mb-2">المتبقي</p>
            <p class="text-2xl font-bold {{ $project->isOverBudget() ? 'text-red-600' : 'text-green-600' }}">
                {{ number_format($project->remaining_budget, 2) }} ج.م
            </p>
        </div>

    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">

        <h2 class="text-xl font-bold text-gray-800 mb-6">
            بيانات المشروع
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <div>
                <p class="text-sm text-gray-500">اسم المشروع</p>
                <p class="font-semibold text-gray-800 mt-1">
                    {{ $project->name }}
                </p>
            </div>

            <div>
                <p class="text-sm text-gray-500">العميل</p>
                <p class="font-semibold text-gray-800 mt-1">
                    {{ $project->client_name ?: 'غير محدد' }}
                </p>
            </div>

            <div>
                <p class="text-sm text-gray-500">الموقع</p>
                <p class="font-semibold text-gray-800 mt-1">
                    {{ $project->location ?: 'غير محدد' }}
                </p>
            </div>

            <div>
                <p class="text-sm text-gray-500">الحالة</p>

                @php
                    $statusLabels = [
                        'planning' => 'تخطيط',
                        'active' => 'نشط',
                        'completed' => 'مكتمل',
                        'paused' => 'متوقف',
                        'cancelled' => 'ملغي',
                    ];
                @endphp

                <p class="font-semibold text-gray-800 mt-1">
                    {{ $statusLabels[$project->status] ?? $project->status }}
                </p>
            </div>

            <div>
                <p class="text-sm text-gray-500">تاريخ البداية</p>
                <p class="font-semibold text-gray-800 mt-1">
                    {{ $project->start_date ? $project->start_date->format('Y-m-d') : 'غير محدد' }}
                </p>
            </div>

            <div>
                <p class="text-sm text-gray-500">تاريخ النهاية</p>
                <p class="font-semibold text-gray-800 mt-1">
                    {{ $project->end_date ? $project->end_date->format('Y-m-d') : 'غير محدد' }}
                </p>
            </div>

        </div>

        @if($project->description)
            <div class="mt-8 pt-6 border-t border-gray-100">

                <p class="text-sm text-gray-500 mb-2">
                    وصف المشروع
                </p>

                <p class="text-gray-700 leading-7 whitespace-pre-line">
                    {{ $project->description }}
                </p>

            </div>
        @endif

    </div>

    <div class="flex gap-3 mt-6">

        <a href="{{ route('projects.edit', $project) }}"
           class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl font-semibold">
            تعديل المشروع
        </a>

        <form action="{{ route('projects.destroy', $project) }}"
              method="POST"
              onsubmit="return confirm('هل أنت متأكد من حذف المشروع؟');">

            @csrf
            @method('DELETE')

            <button type="submit"
                    class="bg-red-50 hover:bg-red-100 text-red-700 px-6 py-3 rounded-xl font-semibold">
                حذف المشروع
            </button>

        </form>

    </div>

</div>

</body>
</html>