@extends('layouts.app')

@section('title', 'Register Page')

@section('content')

<div class="flex items-center justify-center min-h-screen px-4 py-10">

    <div class="w-full max-w-2xl">

        <!-- Card -->
        <div class="bg-white rounded-2xl shadow-xl p-6 sm:p-8 border border-slate-100">

            <!-- Header -->
            <div class="text-center mb-8">

                <div
                    class="bg-green-600 w-14 h-14 rounded-xl flex items-center justify-center mx-auto mb-4 shadow-lg shadow-green-200">

                    <i class="fa-solid fa-user-plus text-white text-2xl"></i>
                </div>

                <h2 class="text-2xl font-bold text-slate-800">
                    {{ __('messages.register') }}
                </h2>
            </div>

            <!-- Form -->
            <form id="registerForm" enctype="multipart/form-data">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                    <!-- Full Name -->
                    <div class="md:col-span-2">

                        <label class="block text-sm font-medium text-slate-700 mb-1">
                            {{ __('messages.full_name') }}
                        </label>

                        <div class="relative">

                            <span
                                class="absolute inset-y-0 left-0 pl-3 flex items-center text-slate-400">

                                <i class="fa-solid fa-signature text-sm"></i>
                            </span>

                            <input
                                type="text"
                                id="name"
                                name="name"
                                class="block w-full pl-10 pr-3 py-3 bg-slate-50 border border-slate-200 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none"
                                placeholder="John Doe">
                        </div>
                    </div>

                    <!-- Mobile -->
                    <div>

                        <label class="block text-sm font-medium text-slate-700 mb-1">
                            {{ __('messages.mobile_number') }}
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

                    <!-- Email -->
                    <div>

                        <label class="block text-sm font-medium text-slate-700 mb-1">
                            {{ __('messages.email') }}
                        </label>

                        <div class="relative">

                            <span
                                class="absolute inset-y-0 left-0 pl-3 flex items-center text-slate-400">

                                <i class="fa-solid fa-envelope text-sm"></i>
                            </span>

                            <input
                                type="email"
                                id="email"
                                name="email"
                                class="block w-full pl-10 pr-3 py-3 bg-slate-50 border border-slate-200 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none"
                                placeholder="name@example.com">
                        </div>
                    </div>

                    <!-- Password -->
                    <div class="md:col-span-2">

                        <label class="block text-sm font-medium text-slate-700 mb-1">
                            {{ __('messages.password') }}
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

                        <p class="text-xs text-slate-500 mt-1">
                            Must be at least 6 characters long.
                        </p>
                    </div>

                    <!-- Profile Image -->
                    <div class="md:col-span-2">

                        <label class="block text-sm font-medium text-slate-700 mb-2">
                            {{ __('messages.profile_image') }} (Optional)
                        </label>

                        <div class="flex items-center gap-4">

                            <!-- Preview -->
                            <img
                                id="previewImage"
                                src="https://placehold.co/120x120/e2e8f0/64748b?text=Preview"
                                alt="Preview"
                                class="w-24 h-24 object-cover rounded-full border border-slate-200 shadow-sm shrink-0">

                            <!-- Input -->
                            <input
                                type="file"
                                id="profile_image"
                                name="profile_image"
                                accept="image/*"
                                class="block w-full py-3 px-3 bg-slate-50 border border-slate-200 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none">
                        </div>
                    </div>
                </div>

                <!-- Button -->
                <div class="mt-6">

                    <button
                        type="submit"
                        id="regBtn"
                        class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-3 rounded-lg shadow-md shadow-green-100 transition-all active:scale-[0.98] flex items-center justify-center">

                        <span id="btnText">
                            Register Now
                        </span>

                        <div
                            id="loader"
                            class="hidden animate-spin rounded-full h-5 w-5 border-2 border-white border-t-transparent ml-2">
                        </div>
                    </button>
                </div>
            </form>

            <!-- Message -->
            <div
                id="msg"
                class="mt-6 text-center text-sm font-medium">
            </div>

            <!-- Footer -->
            <p class="mt-8 text-center text-slate-500 text-sm">

                Already have an account?

                <a href="/login"
                    class="text-green-600 hover:underline font-bold">

                    Login here
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

    const registerForm = document.getElementById('registerForm');

    registerForm.addEventListener('submit', async function(e) {

        e.preventDefault();

        const btn = document.getElementById('regBtn');
        const btnText = document.getElementById('btnText');
        const loader = document.getElementById('loader');
        const msg = document.getElementById('msg');

        // Inputs
        const name = document.getElementById('name').value.trim();
        const mobile = document.getElementById('mobile').value.trim();
        const email = document.getElementById('email').value.trim();
        const password = document.getElementById('password').value.trim();
        const profileImage = document.getElementById('profile_image').files[0];

        // Validation
        if (!name || !mobile || !email || !password) {

            msg.className =
                "mt-6 text-center text-sm font-medium text-red-600 border border-red-100 bg-red-50 p-3 rounded";

            msg.innerText = "All fields are required.";

            return;
        }

        // FormData
        const formData = new FormData();

        formData.append('name', name);
        formData.append('mobile', mobile);
        formData.append('email', email);
        formData.append('password', password);

        if (profileImage) {
            formData.append('profile_image', profileImage);
        }

        // Loading
        btn.disabled = true;
        btnText.innerText = "Creating Account...";
        loader.classList.remove('hidden');

        msg.innerText = "";

        try {

            const response = await axios.post(
                '/api/user/register',
                formData,
                {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                }
            );

            // Save Token
            localStorage.setItem('token', response.data.data.token);

            // Success
            msg.className =
                "mt-6 text-center text-sm font-medium text-green-600 border border-green-100 bg-green-50 p-3 rounded";

            msg.innerText = "Registration Successful! Redirecting...";

            // Redirect
            setTimeout(() => {
                window.location.href = "/auth/admin";
            }, 1500);

        } catch (error) {

            msg.className =
                "mt-6 text-center text-sm font-medium text-red-600 border border-red-100 bg-red-50 p-3 rounded";

            // Laravel Validation Error
            if (error.response?.data?.errors) {

                const firstError =
                    Object.values(error.response.data.errors)[0][0];

                msg.innerText = firstError;

            } else {

                msg.innerText =
                    error.response?.data?.message ||
                    "Registration failed. Please try again.";
            }

        } finally {

            btn.disabled = false;
            btnText.innerText = "Register Now";
            loader.classList.add('hidden');
        }
    });


    // Image Preview
    const profileInput = document.getElementById('profile_image');
    const previewImage = document.getElementById('previewImage');

    profileInput.addEventListener('change', function(e) {

        const file = e.target.files[0];

        if (file) {

            // Validate image type
            if (!file.type.startsWith('image/')) {

                alert('Please select a valid image.');

                profileInput.value = '';

                return;
            }

            // Create preview URL
            const imageUrl = URL.createObjectURL(file);

            previewImage.src = imageUrl;
        }
    });

</script>

@endsection