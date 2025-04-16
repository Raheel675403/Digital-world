<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Register - Digital World</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-indigo-600 flex items-center justify-center min-h-screen">

<div class="bg-white shadow-lg rounded-xl p-8 w-full max-w-xl">
    <h2 class="text-2xl font-bold text-center text-indigo-700 mb-6">Create Your Account</h2>

    <form action="{{route('register')}}" method="POST" class="space-y-6">
        @csrf
        <!-- First Row: Full Name & Email -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <div>
                <label class="block text-gray-700 mb-1">Full Name</label>
                <input type="text" name="name" required class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-indigo-500" />
                @error('name')
                <span class="text-danger w-100"><small><b>{{ $errors->first('name') }}</b></small></span>
                @enderror
            </div>
            <div>
                <label class="block text-gray-700 mb-1">Email</label>
                <input type="email" name="email" required class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-indigo-500" />
                @error('email')
                <span class="text-danger w-100"><small><b>{{ $errors->first('email') }}</b></small></span>
                @enderror
            </div>
        </div>

        <!-- Second Row: Password & Country -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <div>
                <label class="block text-gray-700 mb-1">Password</label>
                <input type="password" name="password" required class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-indigo-500" />
                @error('password')
                <span class="text-danger w-100"><small><b>{{ $errors->first('password') }}</b></small></span>
                @enderror
            </div>
            <div>
                <label class="block text-gray-700 mb-1">Country</label>
                <input type="text" name="country" required class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-indigo-500" />
                @error('country')
                <span class="text-danger w-100"><small><b>{{ $errors->first(' country') }}</b></small></span>
                @enderror
            </div>
        </div>

        <!-- Third Row: City & Bank Account Name -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <div>
                <label class="block text-gray-700 mb-1">State</label>
                <input type="text" name="state" required class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-indigo-500" />
                @error('state')
                <span class="text-danger w-100"><small><b>{{ $errors->first('state') }}</b></small></span>
                @enderror
            </div>
            <div>
                <label class="block text-gray-700 mb-1">City</label>
                <input type="text" name="city" required class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-indigo-500" />
                @error('city')
                <span class="text-danger w-100"><small><b>{{ $errors->first(' city') }}</b></small></span>
                @enderror
            </div>
        </div>

        <!-- Fourth Row: Address -->
        <div>
            <label class="block text-gray-700 mb-1">Address</label>
            <textarea name="address" rows="4" required class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-indigo-500"></textarea>
            @error('address')
            <span class="text-danger w-100"><small><b>{{ $errors->first(' address') }}</b></small></span>
            @enderror
        </div>

        <!-- Hidden input for user-type -->
        <input type="hidden" name="userType" value="{{$type}}" />

        <button type="submit" class="w-full bg-indigo-600 text-white py-2 rounded-md hover:bg-indigo-700 transition">
            Register
        </button>
    </form>

    <p class="text-center text-sm text-gray-600 mt-4">
        Already have an account? <a href="{{route('login')}}" class="text-indigo-600 hover:underline">Login here</a>
    </p>
</div>

</body>
</html>
