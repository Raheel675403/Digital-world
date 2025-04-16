<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex">

<!-- Sidebar -->
<aside class="w-64 bg-white shadow-md hidden md:block">
    <div class="p-6 border-b">
        <h1 class="text-2xl font-bold text-indigo-600">User Panel</h1>
    </div>
    <nav class="p-6 space-y-4 text-gray-700">
        <a href="#" class="block hover:text-indigo-600">Dashboard</a>
        <a href="#" class="block hover:text-indigo-600">Profile</a>
        <a href="#" class="block hover:text-indigo-600">Settings</a>
        <form action="" method="POST">
            @csrf
            <button class="text-red-600 hover:underline mt-4">Logout</button>
        </form>
    </nav>
</aside>

<!-- Main Content -->
<div class="flex-1 flex flex-col">
    <!-- Topbar -->
    <header class="bg-white shadow-md px-6 py-4 flex justify-between items-center">
        <h2 class="text-xl font-semibold text-indigo-700">Dashboard</h2>
        <div class="text-gray-600">Welcome, {{ Auth::user()->name }}</div>
    </header>

    <!-- Content Area -->
    <main class="flex-1 p-6">
        <div class="bg-white shadow-md rounded-lg p-6">
            <h3 class="text-2xl font-bold mb-4">Dashboard Overview</h3>
            <p class="text-gray-600">
                You are now logged in as a <strong>{{ Auth::user()->email }}</strong>.
            </p>
        </div>

        <!-- Example Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
            <div class="bg-indigo-100 p-4 rounded shadow text-center">
                <p class="text-lg font-semibold">Total Orders</p>
                <p class="text-2xl text-indigo-700">25</p>
            </div>
            <div class="bg-purple-100 p-4 rounded shadow text-center">
                <p class="text-lg font-semibold">Messages</p>
                <p class="text-2xl text-purple-700">10</p>
            </div>
            <div class="bg-green-100 p-4 rounded shadow text-center">
                <p class="text-lg font-semibold">Status</p>
                <p class="text-2xl text-green-700">Active</p>
            </div>
        </div>
    </main>
</div>

</body>
</html>
