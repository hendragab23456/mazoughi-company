<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تعديل المشروع - المزوغي للمقاولات</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 min-h-screen">

<div class="max-w-4xl mx-auto px-4 py-8">

    <div class="mb-8">
        <a href="{{ route('projects.show', $project) }}"
           class="text-blue-600 hover:text-blue-800 font-semibold">
            ← العودة إلى المشروع
        </a>

        <h1 class="text-3xl font-bold text-gray-800 mt-4">
            تعديل المشروع
        </h1>

        <p class="text-gray-500 mt-2">
            تعديل بيانات {{ $project->name }}
        </p>
    </div>

    @if($errors->any())
        <div class="bg-red-50 border border-red-200 text-red-700 rounded-xl p-4 mb-6">
            <ul class="list-disc list-inside space-y-1">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('projects.update', $project) }}"
          method="POST"
          class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">

        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <div class="md:col-span-2">
                <label class="block text-gray-700 font-semibold mb-2">
                    اسم المشروع *
                </label>

                <input type="text"
                       name="name"
                       value="{{ old('name', $project->name) }}"
                       required
                       class="w-full border-gray-300 rounded-xl focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div>
                <label class="block text-gray-700 font-semibold mb-2">
                    اسم العميل
                </label>

                <input type="text"
                       name="client_name"
                       value="{{ old('client_name', $project->client_name) }}"
                       class="w-full border-gray-300 rounded-xl">
            </div>

            <div>
                <label class="block text-gray-700 font-semibold mb-2">
                    موقع المشروع
                </label>

                <input type="text"
                       name="location"
                       value="{{ old('location', $project->location) }}"
                       class="w-full border-gray-300 rounded-xl">
            </div>

            <div>
                <label class="block text-gray-700 font-semibold mb-2">
                    الميزانية *
                </label>

                <input type="number"
                       name="budget"
                       value="{{ old('budget', $project->budget) }}"
                       min="0"
                       step="0.01"
                       required
                       class="w-full border-gray-300 rounded-xl">
            </div>

            <div>
                <label class="block text-gray-700 font-semibold mb-2">
                    إجمالي المصروفات
                </label>

                <input type="number"
                       name="total_expenses"
                       value="{{ old('total_expenses', $project->total_expenses) }}"
                       min="0"
                       step="0.01"
                       class="w-full border-gray-300 rounded-xl">
            </div>

            <div>
                <label class="block text-gray-700 font-semibold mb-2">
                    تاريخ البداية
                </label>

                <input type="date"
                       name="start_date"
                       value="{{ old('start_date', $project->start_date?->format('Y-m-d')) }}"
                       class="w-full border-gray-300 rounded-xl">
            </div>

            <div>
                <label class="block text-gray-700 font-semibold mb-2">
                    تاريخ النهاية
                </label>

                <input type="date"
                       name="end_date"
                       value="{{ old('end_date', $project->end_date?->format('Y-m-d')) }}"
                       class="w-full border-gray-300 rounded-xl">
            </div>

            <div>
                <label class="block text-gray-700 font-semibold mb-2">
                    حالة المشروع *
                </label>

                <select name="status"
                        required
                        class="w-full border-gray-300 rounded-xl">

                    <option value="planning"
                        {{ old('status', $project->status) === 'planning' ? 'selected' : '' }}>
                        تخطيط
                    </option>

                    <option value="active"
                        {{ old('status', $project->status) === 'active' ? 'selected' : '' }}>
                        نشط
                    </option>

                    <option value="completed"
                        {{ old('status', $project->status) === 'completed' ? 'selected' : '' }}>
                        مكتمل
                    </option>

                    <option value="paused"
                        {{ old('status', $project->status) === 'paused' ? 'selected' : '' }}>
                        متوقف
                    </option>

                    <option value="cancelled"
                        {{ old('status', $project->status) === 'cancelled' ? 'selected' : '' }}>
                        ملغي
                    </option>

                </select>
            </div>

            <div class="md:col-span-2">

                <label class="block text-gray-700 font-semibold mb-2">
                    وصف المشروع
                </label>

                <textarea name="description"
                          rows="5"
                          class="w-full border-gray-300 rounded-xl">{{ old('description', $project->description) }}</textarea>

            </div>

        </div>

        <div class="flex gap-3 mt-8">

            <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-xl font-semibold">
                حفظ التعديلات
            </button>

            <a href="{{ route('projects.show', $project) }}"
               class="bg-gray-100 hover:bg-gray-200 text-gray-800 px-8 py-3 rounded-xl font-semibold">
                إلغاء
            </a>

        </div>

    </form>

</div>

</body>
</html>