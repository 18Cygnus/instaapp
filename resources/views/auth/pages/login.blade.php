@extends('auth.layout.auth')

@section('auth')
    <section class="flex h-screen">
        <div class="w-1/2 bg-blue-300 flex justify-center items-center">
            <div class="text-center">
                <h1 class="text-4xl font-bold text-white">InstaApp</h1>
            </div>
        </div>

        <div class="w-1/2 flex justify-center items-center bg-white">
            <form action="{{ route('login.authenticate')}}" class="w-full max-w-md mx-auto px-8" method="post">
                @csrf
                <div class="mb-8 text-center">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-2">Welcome Back</h2>
                    <p class="text-gray-600">Please sign in to your account</p>
                </div>

                @if (session('success'))
                    <div class="mb-5 p-4 text-sm text-green-700 bg-green-100 rounded-lg" role="alert">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="mb-5">
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Your email</label>
                    <input type="email" id="email" name="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="name@example.com" required />
                </div>

                <div class="mb-5">
                    <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Your password</label>
                    <input type="password" id="password" name="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " placeholder="Enter your password" required />
                </div>
                
                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full px-5 py-2.5 text-center mb-4">Sign In</button>

                <div class="text-center">
                    <p class="text-sm text-gray-600">
                        Don't have an account? 
                        <a href="{{ route('register') }}" class="text-blue-600 hover:text-blue-800 font-medium">Register here</a>
                    </p>
                </div>
            </form>
        </div>
    </section>
@endsection