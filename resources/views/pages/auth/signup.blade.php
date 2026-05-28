@extends('layouts.guest')



@section('content')
<div class="auth-background flex h-auto min-h-screen items-center justify-center overflow-x-hidden bg-cover bg-center bg-no-repeat py-10">
    <div class="relative flex items-center justify-center px-4 sm:px-6 lg:px-8">
        <div class="bg-base-100 shadow-base-300/20 z-1 w-full space-y-6 rounded-xl p-6 shadow-md sm:max-w-lg lg:p-8">
            <div class="flex flex-col items-center justify-center text-center gap-2">
                <a href="{{ route('landing') }}" class="flex flex-col items-center gap-2">
                    <img src="{{ asset('images/logoushine.png') }}" alt="Ushine Logo" class="h-16 w-auto object-contain">
                    <!--<h2 class="text-base-content text-2xl font-bold tracking-tight">Ushine</h2>-->
                </a>
            </div>
            <div>
                <h3 class="text-base-content mb-1.5 text-2xl font-semibold">Create your account</h3>
            </div>

            @if($errors->any())
                <div class="alert alert-danger">
                    @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}" class="space-y-4" id="registerForm">
                @csrf
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="label-text" for="name">Name*</label>
                        <input type="text" 
                               name="name" 
                               id="name"
                               class="input @error('name') input-error @enderror" 
                               placeholder="Enter your name"
                               value="{{ old('name') }}"
                               required>
                        @error('name')
                            <span class="text-error text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label class="label-text" for="cognome">Last Name*</label>
                        <input type="text" 
                               name="cognome" 
                               id="cognome"
                               class="input @error('cognome') input-error @enderror" 
                               placeholder="Enter your last name"
                               value="{{ old('cognome') }}"
                               required>
                        @error('cognome')
                            <span class="text-error text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div>
                    <label class="label-text" for="email">Email*</label>
                    <input type="email" 
                           name="email" 
                           id="email"
                           class="input @error('email') input-error @enderror" 
                           placeholder="Enter your email"
                           value="{{ old('email') }}"
                           required>
                    @error('email')
                        <span class="text-error text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label class="label-text block mb-1.5" for="telefono">Phone Number*</label>
                    <div class="phone-input-group flex items-center bg-base-100 overflow-hidden">
                        <select name="prefisso_internazionale" class="phone-prefix-select bg-transparent outline-none cursor-pointer shrink-0">
                            <option value="+39" {{ old('prefisso_internazionale', '+39') == '+39' ? 'selected' : '' }}>🇮🇹 +39</option>
                            <option value="+41" {{ old('prefisso_internazionale') == '+41' ? 'selected' : '' }}>🇨🇭 +41</option>
                            <option value="+49" {{ old('prefisso_internazionale') == '+49' ? 'selected' : '' }}>🇩🇪 +49</option>
                            <option value="+33" {{ old('prefisso_internazionale') == '+33' ? 'selected' : '' }}>🇫🇷 +33</option>
                            <option value="+44" {{ old('prefisso_internazionale') == '+44' ? 'selected' : '' }}>🇬🇧 +44</option>
                            <option value="+1" {{ old('prefisso_internazionale') == '+1' ? 'selected' : '' }}>🇺🇸 +1</option>
                        </select>
                        <div class="w-[1px] h-6 bg-base-content/20 shrink-0"></div>
                        <input type="tel" 
                               name="telefono" 
                               id="telefono"
                               class="phone-number-input flex-1 bg-transparent outline-none" 
                               placeholder="Enter your phone number"
                               value="{{ old('telefono') }}"
                               required>
                    </div>
                    @error('telefono')
                        <span class="text-error text-sm mt-1.5 block">{{ $message }}</span>
                    @enderror
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="label-text" for="password">Password*</label>
                        <div class="input @error('password') input-error @enderror">
                            <input id="password" name="password" type="password" placeholder="Enter your password" required>
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
                        <label class="label-text" for="password_confirmation">Confirm Password*</label>
                        <div class="input">
                            <input id="password_confirmation" name="password_confirmation" type="password" placeholder="Confirm your password" required>
                            <button type="button" data-toggle-password='{ "target": "#password_confirmation" }' class="block cursor-pointer">
                                <span class="icon-[tabler--eye] password-active:block hidden size-5 shrink-0"></span>
                                <span class="icon-[tabler--eye-off] password-active:hidden block size-5 shrink-0"></span>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Password Strength Indicator -->
                <div id="passwordStrengthContainer" class="hidden">
                    <div class="flex justify-between items-center">
                        <small class="text-base-content/60">Password strength:</small>
                        <small id="strengthText" class="font-semibold"></small>
                    </div>
                    <div class="h-1 bg-base-200 rounded-full mt-1 overflow-hidden">
                        <div id="strengthBar" class="h-full transition-all duration-300" style="width: 0%;"></div>
                    </div>
                </div>

                <!-- Categories Selector -->
                <div>
                    <label class="label-text mb-2.5 block" for="categories">What are your interests / categories?*</label>
                    <div class="flex flex-wrap gap-2.5">
                        @php
                            $allCategories = \App\Models\Category::all();
                        @endphp
                        @foreach($allCategories as $category)
                            <label class="cursor-pointer">
                                <input type="checkbox" name="categories[]" value="{{ $category->id }}" class="hidden category-checkbox" {{ is_array(old('categories')) && in_array($category->id, old('categories')) ? 'checked' : '' }}>
                                <div class="category-chip font-medium text-sm transition-all duration-200 flex items-center gap-1.5">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 check-icon hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                    </svg>
                                    {{ $category->name }}
                                </div>
                            </label>
                        @endforeach
                    </div>
                    @error('categories')
                        <p class="mt-1.5 text-sm text-error">{{ $message }}</p>
                    @enderror
                </div>

                <!-- User Type Selector (come in Flutter) -->
                <div>
                    <label class="label-text block mb-2">Account type</label>
                    <div class="flex gap-3">
                        <button type="button" 
                                class="user-type-option @if(old('tipo_utente', 'Talent') == 'Talent') active @endif"
                                data-type="Talent">Talent</button>
                        <button type="button" 
                                class="user-type-option @if(old('tipo_utente') == 'Sponsor') active @endif"
                                data-type="Sponsor">Sponsor</button>
                    </div>
                    <input type="hidden" name="tipo_utente" id="tipo_utente" value="{{ old('tipo_utente', 'Talent') }}">
                </div>

                <div class="flex items-center gap-2">
                    <input type="checkbox" class="checkbox checkbox-primary checkbox-sm" id="accetta_termini" name="accetta_termini" value="1" required>
                    <label class="label-text text-base-content/80 text-sm" for="accetta_termini">
                        I accept the <a href="#" class="link link-primary">Terms and Conditions</a>
                    </label>
                </div>

                <button type="submit" class="btn btn-primary btn-gradient btn-block" id="registerBtn">Create Account</button>
            </form>

            <p class="text-base-content/80 text-center">
                Already have an account? 
                <a href="{{ route('login') }}" class="link link-animated link-primary font-normal">Sign in</a>
            </p>
        </div>
    </div>
</div>

@push('scripts')
<script>
// Password strength checker
const passwordInput = document.getElementById('password');
const strengthContainer = document.getElementById('passwordStrengthContainer');
const strengthBar = document.getElementById('strengthBar');
const strengthText = document.getElementById('strengthText');

function checkPasswordStrength(password) {
    let score = 0;
    if (password.length >= 8) score++;
    if (/[a-z]/.test(password)) score++;
    if (/[A-Z]/.test(password)) score++;
    if (/[0-9]/.test(password)) score++;
    if (/[!@#$%^&*(),.?":{}|<>]/.test(password)) score++;
    
    if (score <= 2) return { text: 'Weak', color: '#DC3545', width: '25%' };
    if (score <= 3) return { text: 'Fair', color: '#FFC107', width: '50%' };
    if (score <= 4) return { text: 'Good', color: '#0DCAF0', width: '75%' };
    return { text: 'Strong', color: '#198754', width: '100%' };
}

passwordInput.addEventListener('input', function() {
    if (this.value.length > 0) {
        strengthContainer.classList.remove('hidden');
        const result = checkPasswordStrength(this.value);
        strengthBar.style.width = result.width;
        strengthBar.style.backgroundColor = result.color;
        strengthText.textContent = result.text;
        strengthText.style.color = result.color;
    } else {
        strengthContainer.classList.add('hidden');
    }
});

// User type selector
document.querySelectorAll('.user-type-option').forEach(btn => {
    btn.addEventListener('click', function() {
        document.querySelectorAll('.user-type-option').forEach(b => b.classList.remove('active'));
        this.classList.add('active');
        document.getElementById('tipo_utente').value = this.dataset.type;
    });
});

// Form submission loading state
document.getElementById('registerBtn')?.addEventListener('click', function(e) {
    const form = this.closest('form');
    if (form && form.checkValidity()) {
        this.disabled = true;
        this.innerHTML = '<span class="loading loading-spinner loading-sm mr-2"></span>Creating account...';
    }
});
</script>

<style>
.user-type-option {
    height: 44px;
    padding: 0 16px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border-radius: 12px;
    border: 1px solid #CED2E9;
    background-color: transparent;
    color: #0D0F1C;
    font-size: 14px;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.2s ease;
}
.user-type-option.active {
    border: 3px solid #607AFB;
    font-weight: 600;
}

/* Stili personalizzati per il campo telefono premium */
.phone-input-group {
    border: 1px solid #CED2E9;
    background-color: #ffffff;
    height: 44px;
    border-radius: 8px;
    transition: all 0.2s ease;
}
.phone-input-group:focus-within {
    border-color: #607AFB;
    box-shadow: 0 0 0 2px rgba(96, 122, 251, 0.2);
}
[data-theme="dark"] .phone-input-group {
    border-color: rgba(228, 228, 231, 0.2);
    background-color: transparent;
}
[data-theme="dark"] .phone-input-group:focus-within {
    border-color: #607AFB;
    box-shadow: 0 0 0 2px rgba(96, 122, 251, 0.2);
}
.phone-prefix-select {
    width: 86px !important;
    min-width: 86px !important;
    max-width: 86px !important;
    background: transparent !important;
    border: none !important;
    outline: none !important;
    font-size: 14px !important;
    color: #0D0F1C !important;
    padding-left: 10px !important;
    padding-right: 4px !important;
    cursor: pointer !important;
    height: 100% !important;
}
[data-theme="dark"] .phone-prefix-select {
    color: #e4e4e7 !important;
}
.phone-prefix-select option {
    background-color: #ffffff;
    color: #0D0F1C;
}
[data-theme="dark"] .phone-prefix-select option {
    background-color: #1a1d2e;
    color: #e4e4e7;
}
.phone-number-input {
    background: transparent !important;
    border: none !important;
    outline: none !important;
    font-size: 14px !important;
    color: #0D0F1C !important;
    padding-left: 12px !important;
    padding-right: 12px !important;
    width: 100% !important;
    height: 100% !important;
}
[data-theme="dark"] .phone-number-input {
    color: #e4e4e7 !important;
}

/* Stili per i chip selezionati/deselezionati nella registrazione */
.category-chip {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 8px 16px !important;
    border-radius: 9999px !important; /* Pills shape pillola */
    font-size: 14px;
    font-weight: 500;
    border: 1px solid rgba(13, 15, 28, 0.2) !important;
    background-color: transparent;
    cursor: pointer;
    transition: all 0.2s ease;
}
.category-chip:hover {
    background-color: rgba(13, 15, 28, 0.05) !important;
}
.category-checkbox:checked + .category-chip {
    background-color: var(--color-primary, #607AFB) !important;
    color: #ffffff !important;
    border-color: var(--color-primary, #607AFB) !important;
}
.category-checkbox:not(:checked) + .category-chip {
    background-color: transparent !important;
    color: #0D0F1C !important;
    border-color: rgba(13, 15, 28, 0.2) !important;
}
[data-theme="dark"] .category-checkbox:not(:checked) + .category-chip {
    color: #e4e4e7 !important;
    border-color: rgba(228, 228, 231, 0.2) !important;
}
[data-theme="dark"] .category-chip:hover {
    background-color: rgba(228, 228, 231, 0.1) !important;
}
.category-checkbox:checked + .category-chip .check-icon {
    display: inline-block !important;
}
</style>
@endpush
@endsection