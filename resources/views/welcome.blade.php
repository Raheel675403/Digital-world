<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>World Best Landing Page</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        #smart-footer {
            transition: transform 0.4s ease-in-out;
        }
        .footer-hidden {
            transform: translateY(100%);
        }
        .footer-visible {
            transform: translateY(0);
        }
    </style>
</head>
<body class="bg-gray-100 flex flex-col min-h-screen">

<header class="bg-white shadow-md fixed top-0 left-0 right-0 z-50">
    <div class="w-full px-6 py-4 flex justify-between items-center">
        <!-- Left: Logo and Title -->
        <div class="flex items-center gap-3">
            <img src="https://img.freepik.com/premium-vector/modern-digital-futuristic-hexagon-world-globe-link-network-internet-logo-design_358185-214.jpg" alt="Logo" class="w-10 h-10" />
            <h1 class="text-2xl font-bold text-indigo-700">DigitalWorld</h1>
        </div>

        <!-- Right: Navigation Links -->
        <nav class="space-x-6">
            <a href="#docs" class="text-gray-700 hover:text-indigo-600 font-medium">Docs</a>
            <a href="#contact" class="text-gray-700 hover:text-indigo-600 font-medium">Contact</a>
            <a href="#contact" class="text-gray-700 hover:text-indigo-600 font-medium">About us</a>
            <a href="@if(auth()->user()) {{route('dashboard')}} @else {{route('login')}} @endif"
               class="text-gray-700 hover:text-indigo-600 font-medium">
                @if(auth()->user()) Dashboard @else Log in @endif
            </a>
        </nav>
    </div>
</header>


<!-- Spacer for fixed header -->
<div class="h-20"></div>

<!-- Main Content -->
<main class="flex-grow bg-gradient-to-br from-indigo-600 to-purple-700 text-white px-4 py-20">
    <div class="max-w-4xl mx-auto text-center">
        <h2 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold mb-6">
            Welcome to the World’s Best Platform
        </h2>
        <p class="text-lg sm:text-xl mb-10">
            Start your journey by choosing your account type.
        </p>
        <div class="flex flex-col sm:flex-row justify-center gap-6">
            <a href="{{route('register-purchase',"purchase")}}" class="bg-white text-indigo-700 font-bold px-6 py-3 rounded-xl hover:bg-indigo-100 transition duration-300">
                Create Account as Purchaser
            </a>
            <a href="{{route('register-viewer',"viewer")}}" class="bg-white text-purple-700 font-bold px-6 py-3 rounded-xl hover:bg-purple-100 transition duration-300">
                Create Account as Viewer
            </a>
        </div>

        <!-- Extra content to make scrolling happen -->
        <div class="mt-20 space-y-10 text-left text-white/90">
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus vehicula tellus vitae sem placerat blandit...</p>
            <p>Praesent et metus nec lorem sodales luctus. Suspendisse potenti. Integer volutpat dolor vel enim fermentum...</p>
            <p>Curabitur a neque at libero placerat tempus. Donec dapibus eros in elit blandit sollicitudin. Proin tristique...</p>
            <p>Quisque eu sapien vel magna lacinia varius. In hac habitasse platea dictumst. Integer at bibendum neque...</p>
            <p>Sed tincidunt ex at sapien suscipit, id tristique nulla hendrerit. Phasellus imperdiet sapien non bibendum mattis...</p>
        </div>
    </div>
</main>

<!-- Footer -->
<footer id="smart-footer" class="bg-white border-t fixed bottom-0 left-0 right-0 footer-hidden z-40">
    <div class="w-100 mx-auto px-4 py-6 grid grid-cols-1 sm:grid-cols-3 gap-6 text-gray-700">
        <!-- Developer Info with Photo -->
        <div class="flex items-center space-x-4">
            <img src="https://i.pravatar.cc/100?img=3" alt="Developer" class="w-14 h-14 rounded-full border-2 border-indigo-500 shadow" />
            <div>
                <h3 class="text-lg font-semibold">Developer</h3>
                <p>Raheel Rashid</p>
                <a href="mailto:youremail@example.com" class="text-indigo-600 hover:underline text-sm">youremail@example.com</a>
            </div>
        </div>
        <!-- Quick Links -->
        <div>
            <h3 class="text-lg font-semibold mb-2">Quick Links</h3>
            <ul class="space-y-1">
                <li><a href="#docs" class="hover:text-indigo-600">Documentation</a></li>
                <li><a href="#contact" class="hover:text-indigo-600">Contact</a></li>
            </ul>
        </div>
        <!-- Contact -->
        <div id="contact">
            <h3 class="text-lg font-semibold mb-2">Contact Us</h3>
            <p>Phone: +123 456 7890</p>
            <p>Address: 123 Main Street, Your City</p>
        </div>
    </div>
    <div class="text-center text-sm text-gray-500 py-3 border-t">
        © 2025 WorldBest. All rights reserved.
    </div>
</footer>

<!-- JavaScript for scroll footer -->
<script>
    const footer = document.getElementById("smart-footer");

    window.addEventListener("scroll", () => {
        const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
        const windowHeight = window.innerHeight;
        const documentHeight = document.documentElement.scrollHeight;

        // If user has reached bottom
        if (scrollTop + windowHeight >= documentHeight - 10) {
            footer.classList.add("footer-visible");
            footer.classList.remove("footer-hidden");
        } else {
            footer.classList.remove("footer-visible");
            footer.classList.add("footer-hidden");
        }
    });
</script>


</body>
</html>
