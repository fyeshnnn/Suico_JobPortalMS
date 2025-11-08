@extends('layouts.auth')

@section('title', 'Forgot Password - SeiyaSphere')

@section('content')
<div>
    <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
        Forgot your password?
    </h2>
    <p class="mt-2 text-center text-sm text-gray-600">
        Enter your email address and we'll send you a link to reset your password.
    </p>
</div>
<form class="mt-8 space-y-6" action="#" method="POST">
    @csrf
    <div>
        <label for="email" class="sr-only">Email address</label>
        <input id="email" name="email" type="email" autocomplete="email" required 
               class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-purple-500 focus:border-purple-500 sm:text-sm"
               placeholder="Email address">
    </div>

    <div>
        <button type="submit" 
                class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transition">
            Send Reset Link
        </button>
    </div>

    <div class="text-center">
        <a href="{{ route('login') }}" class="font-medium text-purple-600 hover:text-purple-500">
            Back to login
        </a>
    </div>
</form>
@endsection