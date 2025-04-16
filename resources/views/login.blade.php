<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login | Digital World</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-indigo-600 flex items-center justify-center min-h-screen text-white">

<div class="bg-white text-gray-800 p-10 rounded-2xl shadow-xl w-full max-w-md">
    <h2 class="text-3xl font-bold text-center mb-6 text-indigo-700">Login to Digital World</h2>

    <!-- Login Form -->
    <form method="POST" action="{{ route('check') }}" class="space-y-6">
        @csrf

        <!-- Email -->
        <div>
            <label for="email" class="block text-sm font-medium mb-1">Email</label>
            <input type="email" name="email" id="email"
                   class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500" />
            @error('email')
            <span class="text-danger"><small>{{$errors->first('email')}}</small></span>
            @enderror
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-sm font-medium mb-1">Password</label>
            <input type="password" name="password" id="password"
                   class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500" />
            @error('password')
            <span class="text-danger"><small>{{$errors->first('password')}}</small></span>
            @enderror
        </div>

        <!-- Submit Button -->
        <div>
            <button type="submit"
                    class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded-lg transition duration-300">
                Login
            </button>
        </div>

        <!-- Optional Links -->
        <div class="text-sm text-center mt-4">
            <a href="#" class="text-indigo-600 hover:underline">Forgot your password?</a><br>
        </div>
    </form>
</div>

</body>
</html>
