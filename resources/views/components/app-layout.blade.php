<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">

<head>
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'المزوغي') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-slate-50 text-slate-900">

    <div class="min-h-screen">

        {{-- Navigation --}}
        <nav class="bg-white border-b border-slate-200 shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

                <div class="flex items-center justify-between h-16">

                    {{-- Logo --}}
                    <div class="flex items-center gap-3">

                        <a href="{{ route('dashboard') }}"
                           class="flex items-center gap-3">

                            <div class="w-10 h-10 rounded-xl overflow-hidden border border-slate-200 bg-white flex items-center justify-center">
                                <img
                                    src="{{ asset('images/company-logo.jpeg') }}"
                                    alt="المزوغي"
                                    class="w-full h-full object-contain"
                                >
                            </div>

                            <div class="hidden sm:block">
                                <div class="font-black text-slate-900">
                                    المزوغي
                                </div>

                                <div class="text-xs text-slate-500">
                                    للمقاولات العامة والتوريدات
                                </div>
                            </div>

                        </a>

                    </div>


                    {{-- Main Links --}}
                    <div class="hidden md:flex items-center gap-2">

                        <a
                            href="{{ route('dashboard') }}"
                            class="px-4 py-2 rounded-lg text-sm font-bold
                            {{ request()->routeIs('dashboard')
                                ? 'bg-slate-900 text-white'
                                : 'text-slate-600 hover:bg-slate-100' }}"
                        >
                            لوحة التحكم
                        </a>

                        <a
                            href="{{ route('transactions.index') }}"
                            class="px-4 py-2 rounded-lg text-sm font-bold
                            {{ request()->routeIs('transactions.*')
                                ? 'bg-slate-900 text-white'
                                : 'text-slate-600 hover:bg-slate-100' }}"
                        >
                            العمليات
                        </a>

                    </div>


                    {{-- User --}}
                    <div class="flex items-center gap-3">

                        <div class="hidden sm:block text-left">

                            <p class="text-sm font-bold text-slate-800">
                                {{ auth()->user()->name ?? 'المستخدم' }}
                            </p>

                            <p class="text-xs text-slate-500">
                                المدير العام
                            </p>

                        </div>


                        <div class="w-10 h-10 rounded-full bg-slate-900 text-white flex items-center justify-center font-black">
                            {{ strtoupper(substr(auth()->user()->name ?? 'م', 0, 1)) }}
                        </div>


                        {{-- Logout --}}
                        <form method="POST" action="{{ route('logout') }}">

                            @csrf

                            <button
                                type="submit"
                                class="px-3 py-2 rounded-lg text-sm font-bold text-red-600 hover:bg-red-50 transition"
                            >
                                خروج
                            </button>

                        </form>

                    </div>

                </div>

            </div>
        </nav>


        {{-- Page Content --}}
        <main>
            {{ $slot }}
        </main>

    </div>

</body>

</html>