@extends('layouts.guest')



@section('content')
<div class="auth-background flex h-auto min-h-screen items-center justify-center overflow-x-hidden bg-cover bg-center bg-no-repeat py-10">
    <div class="relative flex items-center justify-center px-4 sm:px-6 lg:px-8">
        <div class="bg-base-100 shadow-base-300/20 z-1 w-full space-y-6 rounded-xl p-6 shadow-md sm:max-w-md lg:p-8">
            <div class="flex flex-col items-center justify-center text-center gap-2">
                <a href="{{ route('landing') }}" class="flex flex-col items-center gap-2">
                    <img src="{{ asset('images/logoushine.png') }}" alt="Ushine Logo" class="h-16 w-auto object-contain">
                    <!--<h2 class="text-base-content text-2xl font-bold tracking-tight">Ushine</h2>-->
                </a>
            </div>
            <div>
                <h3 class="text-base-content mb-1.5 text-2xl font-semibold">Forgot your password?</h3>
                <p class="text-base-content/80">Enter your email address and we'll send you a link to reset your password.</p>
            </div>

            @session('status')
                <div class="alert alert-success">{{ $value }}</div>
            @endsession

            @if($errors->any())
                <div class="alert alert-danger">
                    @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
                @csrf
                <div>
                    <label class="label-text" for="email">Email</label>
                    <input type="email" 
                           name="email" 
                           id="email"
                           class="input @error('email') input-error @enderror" 
                           placeholder="Enter your email address"
                           value="{{ old('email') }}"
                           required>
                    @error('email')
                        <span class="text-error text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary btn-gradient btn-block">Send reset link</button>
            </form>

            <p class="text-base-content/80 text-center">
                Remember your password? 
                <a href="{{ route('login') }}" class="link link-animated link-primary font-normal">Sign in</a>
            </p>
        </div>
    </div>
</div>
@endsection