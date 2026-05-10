@extends('layouts.guest')



@section('content')
<div class="auth-background flex h-auto min-h-screen items-center justify-center overflow-x-hidden bg-cover bg-center bg-no-repeat py-10">
    <div class="relative flex items-center justify-center px-4 sm:px-6 lg:px-8">
        <div class="absolute">
            <svg width="612" height="697" viewBox="0 0 612 697" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M360.405 111.996C393.955 67.9448 456.863 59.4318 500.914 92.9818V92.9818C544.965 126.532 553.478 189.44 519.928 233.491L250.545 587.191C216.995 631.243 154.087 639.756 110.036 606.206V606.206C65.9845 572.656 57.4716 509.747 91.0216 465.696L360.405 111.996Z" fill="url(#paint0_linear_13715_136336)" fill-opacity="0.08" />
                <path d="M519.53 233.188L250.147 586.888C216.765 630.72 154.17 639.19 110.339 605.808C66.5071 572.425 58.0367 509.831 91.4194 465.999L360.802 112.299C394.185 68.4674 456.78 59.9969 500.611 93.3796C544.443 126.762 552.913 189.357 519.53 233.188Z" stroke="var(--color-primary)" stroke-opacity="0.2" />
                <defs>
                    <linearGradient id="paint0_linear_13715_136336" x1="500.914" y1="92.9818" x2="110.036" y2="606.206" gradientUnits="userSpaceOnUse">
                        <stop offset="0" stop-color="var(--color-primary)" />
                        <stop offset="1" stop-color="var(--color-primary)" stop-opacity="0.2" />
                    </linearGradient>
                </defs>
            </svg>
        </div>
        <div class="bg-base-100 shadow-base-300/20 z-1 w-full space-y-6 rounded-xl p-6 shadow-md sm:max-w-md lg:p-8">
            <div class="flex items-center gap-3">
                <a href="{{ route('landing') }}" class="flex items-center gap-3">
                    <span class="text-primary">
                        <svg width="32" height="32" viewBox="0 0 34 34" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_18078_104881)">
                                <mask id="mask0_18078_104881" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="0" y="0" width="34" height="34">
                                    <path d="M25.5 0H8.5C3.80558 0 0 3.80558 0 8.5V25.5C0 30.1944 3.80558 34 8.5 34H25.5C30.1944 34 34 30.1944 34 25.5V8.5C34 3.80558 30.1944 0 25.5 0Z" fill="white" />
                                </mask>
                                <g mask="url(#mask0_18078_104881)">
                                    <path d="M25.5 0H8.5C3.80558 0 0 3.80558 0 8.5V25.5C0 30.1944 3.80558 34 8.5 34H25.5C30.1944 34 34 30.1944 34 25.5V8.5C34 3.80558 30.1944 0 25.5 0Z" fill="url(#paint0_linear_18078_104881)" />
                                    <path d="M16.1238 20.1522C16.511 19.662 17.2479 19.6428 17.66 20.1122L20.5526 23.41C21.1194 24.0563 20.6611 25.0689 19.8016 25.0692H14.3055C13.47 25.0692 13.0026 24.1059 13.5203 23.4501L16.1238 20.1522ZM16.1326 8.45497C16.5308 7.95801 17.286 7.95453 17.6883 8.44813L27.5164 20.5077C28.0488 21.161 27.5838 22.1395 26.741 22.1395H24.4442C24.1428 22.1395 23.8577 22.0034 23.6678 21.7694L17.7029 14.4188C17.2962 13.9175 16.5285 13.927 16.1346 14.4384L10.7303 21.454C10.5411 21.6996 10.2484 21.8435 9.9383 21.8436H7.4881C6.64925 21.8436 6.18332 20.8733 6.70783 20.2186L16.1326 8.45497Z" fill="url(#paint1_linear_18078_104881)" />
                                </g>
                                <path d="M25.5002 0.707886H8.50017C4.19695 0.707886 0.708496 4.19634 0.708496 8.49956V25.4996C0.708496 29.8028 4.19695 33.2912 8.50017 33.2912H25.5002C29.8034 33.2912 33.2918 29.8028 33.2918 25.4996V8.49956C33.2918 4.19634 29.8034 0.707886 25.5002 0.707886Z" stroke="url(#paint2_linear_18078_104881)" stroke-width="2" />
                            </g>
                            <defs>
                                <linearGradient id="paint0_linear_18078_104881" x1="30.2812" y1="2.65625" x2="4.25" y2="32.4063" gradientUnits="userSpaceOnUse">
                                    <stop offset="0" stop-color="currentColor" />
                                    <stop offset="1" stop-color="currentColor" />
                                </linearGradient>
                                <linearGradient id="paint1_linear_18078_104881" x1="17.1147" y1="8.08008" x2="17.1147" y2="25.0692" gradientUnits="userSpaceOnUse">
                                    <stop offset="0" stop-color="white" />
                                    <stop offset="1" stop-color="white" stop-opacity="0.6" />
                                </linearGradient>
                                <linearGradient id="paint2_linear_18078_104881" x1="17.0002" y1="-0.000447931" x2="17.0002" y2="33.9996" gradientUnits="userSpaceOnUse">
                                    <stop offset="0" stop-color="white" stop-opacity="0.28" />
                                    <stop offset="1" stop-color="white" stop-opacity="0.04" />
                                </linearGradient>
                                <clipPath id="clip0_18078_104881">
                                    <rect width="34" height="34" fill="white" />
                                </clipPath>
                            </defs>
                        </svg>
                    </span>
                    <h2 class="text-base-content text-xl font-bold">Ushine</h2>
                </a>
            </div>
            <div>
                <h3 class="text-base-content mb-1.5 text-2xl font-semibold">Reset your password</h3>
                <p class="text-base-content/80">Enter your new password below.</p>
            </div>

            @if($errors->any())
                <div class="alert alert-danger">
                    @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('password.store') }}" class="space-y-4">
                @csrf
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <div>
                    <label class="label-text" for="email">Email</label>
                    <input type="email" 
                           name="email" 
                           id="email"
                           class="input @error('email') input-error @enderror" 
                           value="{{ old('email', $request->email) }}"
                           readonly>
                </div>

                <div>
                    <label class="label-text" for="password">New Password</label>
                    <div class="input @error('password') input-error @enderror">
                        <input id="password" name="password" type="password" placeholder="Enter your new password" required>
                        <button type="button" data-toggle-password='{ "target": "#password" }' class="block cursor-pointer">
                            <span class="icon-[tabler--eye] password-active:block hidden size-5 shrink-0"></span>
                            <span class="icon-[tabler--eye-off] password-active:hidden block size-5 shrink-0"></span>
                        </button>
                    </div>
                    @error('password')
                        <span class="text-error text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label class="label-text" for="password_confirmation">Confirm New Password</label>
                    <div class="input">
                        <input id="password_confirmation" name="password_confirmation" type="password" placeholder="Confirm your new password" required>
                        <button type="button" data-toggle-password='{ "target": "#password_confirmation" }' class="block cursor-pointer">
                            <span class="icon-[tabler--eye] password-active:block hidden size-5 shrink-0"></span>
                            <span class="icon-[tabler--eye-off] password-active:hidden block size-5 shrink-0"></span>
                        </button>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary btn-gradient btn-block">Reset password</button>
            </form>

            <p class="text-base-content/80 text-center">
                Remember your password? 
                <a href="{{ route('login') }}" class="link link-animated link-primary font-normal">Sign in</a>
            </p>
        </div>
    </div>
</div>
@endsection