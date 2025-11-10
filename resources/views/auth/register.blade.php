@extends('layouts.auth')

@section('title', 'Register - SeiyaSphere')

@section('content')
<div>
    <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
        Create your account
    </h2>
</div>
<form class="mt-8 space-y-6" action="{{ route('register') }}" method="POST">
    @csrf

     <!-- Success Message -->
    @if(session('success'))
    <div class="bg-green-50 border border-green-200 text-green-600 px-4 py-3 rounded-lg mb-4">
        <div class="flex items-center">
            <span class="mr-2">✅</span>
            <span class="font-medium">{{ session('success') }}</span>
        </div>
    </div>
    @endif

    <div class="space-y-4">
        <div>
            <label for="first_name" class="sr-only">First Name</label>
            <input id="first_name" name="first_name" type="text" autocomplete="given-name" required 
                   class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-purple-500 focus:border-purple-500 sm:text-sm"
                   placeholder="First Name" value="{{ old('first_name') }}">
            @error('first_name')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="middle_name" class="sr-only">Middle Name</label>
            <input id="middle_name" name="middle_name" type="text" autocomplete="additional-name" 
                   class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-purple-500 focus:border-purple-500 sm:text-sm"
                   placeholder="Middle Name (Optional)" value="{{ old('middle_name') }}">
            @error('middle_name')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="last_name" class="sr-only">Last Name</label>
            <input id="last_name" name="last_name" type="text" autocomplete="family-name" required 
                   class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-purple-500 focus:border-purple-500 sm:text-sm"
                   placeholder="Last Name" value="{{ old('last_name') }}">
            @error('last_name')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="email" class="sr-only">Email address</label>
            <input id="email" name="email" type="email" autocomplete="email" required 
                   class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-purple-500 focus:border-purple-500 sm:text-sm"
                   placeholder="Email address" value="{{ old('email') }}">
            @error('email')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password" class="sr-only">Password</label>
            <input id="password" name="password" type="password" autocomplete="new-password" required 
                   class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-purple-500 focus:border-purple-500 sm:text-sm"
                   placeholder="Password (At least 8 characters)">
            @error('password')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password_confirmation" class="sr-only">Confirm Password</label>
            <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" required 
                   class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-purple-500 focus:border-purple-500 sm:text-sm"
                   placeholder="Confirm Password">
        </div>
    </div>
    <div class="flex items-center">
        <input id="terms" name="terms" type="checkbox" required
               class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-gray-300 rounded">
        <label for="terms" class="ml-2 block text-sm text-gray-900">
            I agree to the <a href="{{ route('terms') }}" class="text-purple-600 hover:text-purple-500">Terms & Conditions</a> and <a href="#" class="text-purple-600 hover:text-purple-500">Privacy Policy.</a>
        </label>
    </div>

    <div>
        <button type="submit" 
                class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transition">
            Create Account
        </button>
    </div>

    <div class="text-center">
        <p class="text-sm text-gray-600">
            Already have an account? 
            <a href="{{ route('login') }}" class="font-medium text-purple-600 hover:text-purple-500">
                Sign in
            </a>
        </p>
    </div>
</form>
@endsection