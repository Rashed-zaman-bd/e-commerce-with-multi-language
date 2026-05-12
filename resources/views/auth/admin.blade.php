<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Modern App</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-slate-50 text-slate-800 font-sans">

    <!-- Navigation Bar -->
    <nav class="bg-white border-b border-slate-200 sticky top-0 z-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex items-center gap-2">
                    <div class="bg-indigo-600 p-2 rounded-lg">
                        <i class="fa-solid fa-rocket text-white"></i>
                    </div>
                    <span class="text-xl font-bold tracking-tight text-slate-900">AppPortal</span>
                </div>
                
                <div class="flex items-center gap-4">
                    <div class="text-right hidden sm:block">
                        <p class="text-sm font-semibold" id="userName">User Name</p>
                        <p class="text-xs text-slate-500">Administrator</p>
                    </div>
                    <button onclick="logout()" 
                        class="flex items-center gap-2 bg-rose-50 hover:bg-rose-100 text-rose-600 px-4 py-2 rounded-lg font-medium transition-colors border border-rose-100">
                        <i class="fa-solid fa-arrow-right-from-bracket"></i>
                        <span>Logout</span>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <!-- Header Section -->
        <div class="mb-8">
            <h1 class="text-3xl font-extrabold text-slate-900">System Users</h1>
            <p class="text-slate-500 mt-1">Manage and view all registered members in the platform.</p>
        </div>

        <!-- Stats Grid (Optional) -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-slate-500 font-medium uppercase tracking-wider">Total Users</p>
                        <h3 class="text-2xl font-bold mt-1" id="userCount">0</h3>
                    </div>
                    <div class="bg-blue-50 p-3 rounded-xl text-blue-600 text-xl">
                        <i class="fa-solid fa-users"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Users Table Card -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-slate-50 border-b border-slate-100">
                        <tr>
                            <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase">User Info</th>
                            <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase">Mobile</th>
                            <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase">Status</th>
                            <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase">Action</th>
                        </tr>
                    </thead>
                    <tbody id="usersList" class="divide-y divide-slate-100">
                        <!-- Content will be injected here via JavaScript -->
                        <tr id="loadingRow">
                            <td colspan="4" class="px-6 py-10 text-center text-slate-400">
                                <i class="fa-solid fa-circle-notch animate-spin mr-2"></i> Loading users...
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <script>
    // Check Token
    const token = localStorage.getItem('token');
    if (!token) {
        window.location.href = "/login";
    }

    // Set Axios Header
    axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;

    // Fetch Users
    async function fetchUsers() {
        try {
            const response = await axios.get('/api/user');

            const users = response.data.data;

            // Set user count
            document.getElementById('userCount').innerText = users.length;

            // Optional: show first user name (or you can create /api/me later)
            if (users.length > 0) {
                document.getElementById('userName').innerText = users[0].name;
            }

            // Render table
            renderUsers(users);

        } catch (error) {
            console.error("Error:", error);

            if (error.response?.status === 401) {
                logout();
            }
        }
    }

    // Render Users
    function renderUsers(users) {
        const list = document.getElementById('usersList');

        list.innerHTML = "";

        users.forEach(user => {
            list.innerHTML += `
                <tr class="hover:bg-slate-50 transition-colors">
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center font-bold">
                                ${user.name.charAt(0)}
                            </div>
                            <div>
                                <p class="font-semibold text-slate-800">${user.name}</p>
                                <p class="text-sm text-slate-500">${user.email}</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-sm text-slate-600 font-medium">
                        ${user.mobile}
                    </td>
                    <td class="px-6 py-4">
                        <span class="px-3 py-1 bg-green-100 text-green-700 text-xs font-bold rounded-full">
                            Active
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        <button class="text-slate-400 hover:text-indigo-600 transition-colors">
                            <i class="fa-solid fa-ellipsis-vertical"></i>
                        </button>
                    </td>
                </tr>
            `;
        });
    }

    // Logout
    function logout() {
        localStorage.removeItem('token');
        window.location.href = "/";
    }

    // Init
    fetchUsers();
</script>

</body>
</html>