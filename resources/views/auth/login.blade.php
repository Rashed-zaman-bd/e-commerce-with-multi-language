@extends('layouts.app')

@section('title', 'Login Page')

@section('content')

<div class="flex items-center justify-center min-h-screen px-4 py-10">

    <div class="w-full max-w-lg">

        <!-- Card -->
        <div class="bg-white rounded-2xl shadow-xl p-6 sm:p-8 border border-slate-100">

            <!-- Header -->
            <div class="text-center mb-8">

                <div
                    class="bg-green-600 w-14 h-14 rounded-xl flex items-center justify-center mx-auto mb-4 shadow-lg shadow-blue-200">

                    <i class="fa-solid fa-shield-halved text-white text-2xl"></i>
                </div>

                <h2 class="text-2xl font-bold text-slate-800">
                    Welcome Back
                </h2>

                <p class="text-slate-500 mt-2">
                    Please enter your details to sign in
                </p>
            </div>

            <!-- Form -->
            <form id="loginForm" class="space-y-5">

                <!-- Mobile -->
                <div>

                    <label class="block text-sm font-medium text-slate-700 mb-1">
                        Mobile Number
                    </label>

                    <div class="relative">

                        <span
                            class="absolute inset-y-0 left-0 pl-3 flex items-center text-slate-400">

                            <i class="fa-solid fa-phone text-sm"></i>
                        </span>

                        <input
                            type="text"
                            id="mobile"
                            name="mobile"
                            class="block w-full pl-10 pr-3 py-3 bg-slate-50 border border-slate-200 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none"
                            placeholder="017xxxxxxxx">
                    </div>
                </div>

                <!-- Password -->
                <div>

                    <label class="block text-sm font-medium text-slate-700 mb-1">
                        Password
                    </label>

                    <div class="relative">

                        <span
                            class="absolute inset-y-0 left-0 pl-3 flex items-center text-slate-400">

                            <i class="fa-solid fa-lock text-sm"></i>
                        </span>

                        <input
                            type="password"
                            id="password"
                            name="password"
                            class="block w-full pl-10 pr-3 py-3 bg-slate-50 border border-slate-200 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none"
                            placeholder="••••••••">
                    </div>
                </div>

                <!-- Remember -->
                <div class="flex items-center justify-between text-sm">

                    <label class="flex items-center text-slate-600">

                        <input
                            type="checkbox"
                            class="rounded border-slate-300 text-blue-600 focus:ring-green-500 mr-2">

                        Remember me
                    </label>

                    <a href="#"
                        class="text-green-600 hover:underline font-medium">

                        Forgot password?
                    </a>
                </div>

                <!-- Button -->
                <button
                    type="submit"
                    id="loginBtn"
                    class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-3 rounded-lg shadow-md shadow-blue-100 transition-all active:scale-[0.98] flex items-center justify-center">

                    <span id="btnText">
                        Sign In
                    </span>

                    <div
                        id="loader"
                        class="hidden animate-spin rounded-full h-5 w-5 border-2 border-white border-t-transparent ml-2">
                    </div>
                </button>

            </form>

            <!-- Message -->
            <div
                id="msg"
                class="mt-6 text-center text-sm font-medium">
            </div>

            <!-- Footer -->
            <p class="mt-8 text-center text-slate-500 text-sm">

                Don't have an account?

                <a href="/register"
                    class="text-green-600 hover:underline font-bold">

                    Sign up
                </a>
            </p>
        </div>
    </div>
</div>

<!-- Axios -->
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<!-- FontAwesome -->
<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"/>

<script>

    const loginForm = document.getElementById('loginForm');

    loginForm.addEventListener('submit', async function(e) {

        e.preventDefault();

        const btn = document.getElementById('loginBtn');
        const btnText = document.getElementById('btnText');
        const loader = document.getElementById('loader');
        const msg = document.getElementById('msg');

        const mobile = document.getElementById('mobile').value.trim();
        const password = document.getElementById('password').value.trim();

        // Validation
        if (!mobile || !password) {

            msg.className = "mt-6 text-center text-sm font-medium text-red-600";
            msg.innerText = "All fields are required.";

            return;
        }

        // Loading State
        btn.disabled = true;
        btnText.innerText = "Processing...";
        loader.classList.remove('hidden');

        msg.innerText = "";

        try {

            const response = await axios.post('/api/user/login', {
                mobile,
                password
            });

            // Save Token
            localStorage.setItem('token', response.data.data.token);

            // Success Message
            msg.className = "mt-6 text-center text-sm font-medium text-green-600";
            msg.innerText = "Login successful! Redirecting...";

            // Redirect
            setTimeout(() => {
                window.location.href = "/auth/admin";
            }, 1000);

        } catch (error) {

            msg.className = "mt-6 text-center text-sm font-medium text-red-600";

            msg.innerText =
                error.response?.data?.message ||
                "Invalid credentials. Please try again.";

        } finally {

            btn.disabled = false;
            btnText.innerText = "Sign In";
            loader.classList.add('hidden');
        }
    });

</script>

@endsection