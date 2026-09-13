<x-guest-layout>
    <div class="min-h-screen bg-slate-50 flex items-center justify-center px-4 py-10" dir="rtl">

```
    <div class="w-full max-w-md">

        {{-- Logo --}}
        <div class="text-center mb-8">
            <img
                src="{{ asset('images/company-logo.jpeg') }}"
                alt="شعار شركة المزوغي"
                class="h-24 w-auto mx-auto object-contain"
            >

            <h1 class="mt-5 text-2xl font-extrabold text-slate-800">
                المزوغي للمقاولات العامة والتوريدات
            </h1>

            <p class="mt-2 text-sm text-slate-500">
                تسجيل الدخول إلى نظام الإدارة
            </p>
        </div>

        {{-- Login Card --}}
        <div class="bg-white border border-slate-200 rounded-3xl shadow-sm p-6 sm:p-8">

            <div class="mb-6">
                <h2 class="text-xl font-extrabold text-slate-800">
                    تسجيل الدخول
                </h2>

                <p class="text-sm text-slate-500 mt-1">
                    أدخل بيانات حسابك للمتابعة
                </p>
            </div>

            {{-- Session Status --}}
            @if (session('status'))
                <div class="mb-5 rounded-xl bg-emerald-50 border border-emerald-200 px-4 py-3 text-sm text-emerald-700">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                {{-- Email --}}
                <div>
                    <label
                        for="email"
                        class="block text-sm font-bold text-slate-700 mb-2"
                    >
                        البريد الإلكتروني
                    </label>

                    <input
                        id="email"
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        autofocus
                        autocomplete="username"
                        class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-slate-500 focus:ring-2 focus:ring-slate-200"
                        placeholder="example@email.com"
                    >

                    @if ($errors->has('email'))
                        <p class="mt-2 text-xs font-medium text-red-600">
                            {{ $errors->first('email') }}
                        </p>
                    @endif
                </div>

                {{-- Password --}}
                <div class="mt-5">
                    <label
                        for="password"
                        class="block text-sm font-bold text-slate-700 mb-2"
                    >
                        كلمة المرور
                    </label>

                    <input
                        id="password"
                        type="password"
                        name="password"
                        required
                        autocomplete="current-password"
                        class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-slate-500 focus:ring-2 focus:ring-slate-200"
                        placeholder="••••••••"
                    >

                    @if ($errors->has('password'))
                        <p class="mt-2 text-xs font-medium text-red-600">
                            {{ $errors->first('password') }}
                        </p>
                    @endif
                </div>

                {{-- Remember --}}
                <div class="flex items-center justify-between mt-5">

                    <label class="inline-flex items-center gap-2">
                        <input
                            type="checkbox"
                            name="remember"
                            class="rounded border-slate-300 text-slate-800 focus:ring-slate-400"
                        >

                        <span class="text-sm text-slate-600">
                            تذكرني
                        </span>
                    </label>

                    @if (Route::has('password.request'))
                        <a
                            href="{{ route('password.request') }}"
                            class="text-sm font-bold text-slate-600 hover:text-slate-900"
                        >
                            نسيت كلمة المرور؟
                        </a>
                    @endif

                </div>

                {{-- Submit --}}
                <button
                    type="submit"
                    class="w-full mt-6 rounded-xl bg-slate-800 px-5 py-3.5 text-sm font-bold text-white hover:bg-slate-700 transition shadow-sm"
                >
                    تسجيل الدخول
                </button>

            </form>

        </div>

        <p class="text-center text-xs text-slate-400 mt-6">
            © {{ date('Y') }} نظام إدارة المزوغي
        </p>

    </div>

</div>
```

</x-guest-layout>
