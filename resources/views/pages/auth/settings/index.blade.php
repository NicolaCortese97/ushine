@extends('layouts.guest')



@section('content')
<div class="min-h-screen bg-base-100 font-sans text-base-content">
    <!-- Header -->
    <header class="bg-base-100 border-b border-base-200 sticky top-0 z-50" style="height: 64px; line-height: 64px;">
        <div class="max-w-4xl mx-auto px-4" style="height: 100%; display: flex; align-items: center; justify-content: space-between; position: relative;">
            
            <!-- Left Side: Back button -->
            <div style="display: flex; align-items: center; height: 100%;">
                <a href="#" onclick="window.history.back(); return false;" class="hover:bg-base-200" style="display: inline-flex; align-items: center; justify-content: center; width: 40px; height: 40px; border-radius: 50%; transition: background-color 0.2s ease; text-decoration: none; color: inherit;">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-base-content" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" style="width: 24px; height: 24px;">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                </a>
            </div>
            
            <!-- Center Title: Centered with absolute positioning to prevent vertical/horizontal offsets -->
            <div style="position: absolute; left: 50%; top: 50%; transform: translate(-50%, -50%); pointer-events: none; max-width: 60%; width: auto; display: flex; align-items: center; justify-content: center; height: 100%;">
                <h1 class="text-xl font-bold" style="margin: 0; padding: 0; line-height: 1; text-align: center; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; pointer-events: auto;">Settings</h1>
            </div>
            
            <!-- Right Side Spacer (forces correct alignment and spacing) -->
            <div style="width: 40px; height: 100%;"></div>
            
        </div>
    </header>

    <main class="max-w-4xl mx-auto px-4 py-6">
        
        <!-- Apparence -->
        <section class="mb-6">
            <h2 class="text-xs font-bold text-base-content/60 uppercase tracking-wider mb-1 px-2">Apparence</h2>
            <div class="bg-base-200 rounded-xl overflow-hidden">
                <div class="flex items-center justify-between p-4">
                    <div class="flex items-center gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-base-content" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" /></svg>
                        <span class="font-medium text-[15px]">Dark Mode</span>
                    </div>
                    <input type="checkbox" id="theme-toggle" class="toggle" />
                </div>
            </div>
        </section>

        <!-- Account -->
        <section class="mb-6">
            <h2 class="text-xs font-bold text-base-content/60 uppercase tracking-wider mb-1 px-2">Account</h2>
            <div class="bg-base-200 rounded-xl overflow-hidden">
                <a href="{{ route('settings.profile.edit') }}" class="flex items-center justify-between p-4 hover:bg-base-300 transition-colors">
                    <div class="flex items-center gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-base-content" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                        <span class="font-medium text-[15px]">Edit Profile</span>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-base-content/40" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" /></svg>
                </a>
            </div>
        </section>

        <!-- Privacy & Security -->
        <section class="mb-6">
            <h2 class="text-xs font-bold text-base-content/60 uppercase tracking-wider mb-1 px-2">Privacy & Security</h2>
            <div class="bg-base-200 rounded-xl overflow-hidden">
                <a href="#" class="flex items-center justify-between p-4 hover:bg-base-300 transition-colors">
                    <div class="flex items-center gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-base-content" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" /></svg>
                        <span class="font-medium text-[15px]">Privacy & Security</span>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-base-content/40" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" /></svg>
                </a>
            </div>
        </section>

        <!-- Notifications -->
        <section class="mb-6">
            <h2 class="text-xs font-bold text-base-content/60 uppercase tracking-wider mb-1 px-2">Notifications</h2>
            <div class="bg-base-200 rounded-xl overflow-hidden">
                <a href="{{ route('settings.notifications') }}" class="flex items-center justify-between p-4 hover:bg-base-300 transition-colors">
                    <div class="flex items-center gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-base-content" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" /></svg>
                        <span class="font-medium text-[15px]">Notifications</span>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-base-content/40" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" /></svg>
                </a>
            </div>
        </section>

        <!-- Support -->
        <section class="mb-6">
            <h2 class="text-xs font-bold text-base-content/60 uppercase tracking-wider mb-1 px-2">Support</h2>
            <div class="bg-base-200 rounded-xl overflow-hidden">
                <a href="#" class="flex items-center justify-between p-4 hover:bg-base-300 transition-colors">
                    <div class="flex items-center gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-base-content" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        <span class="font-medium text-[15px]">Help & Support</span>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-base-content/40" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" /></svg>
                </a>
            </div>
        </section>

        <!-- Danger zone -->
        <section class="mb-8">
            <h2 class="text-xs font-bold text-error uppercase tracking-wider mb-1 px-2">Danger zone</h2>
            <div class="bg-base-200 rounded-xl overflow-hidden">
                <form action="{{ route('logout') }}" method="POST" id="logout-form">
                    @csrf
                    <button type="submit" class="w-full flex items-center justify-between p-4 hover:bg-base-300 transition-colors text-error cursor-pointer">
                        <div class="flex items-center gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" /></svg>
                            <span class="font-medium text-[15px]">Logout</span>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 opacity-60" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" /></svg>
                    </button>
                </form>
            </div>
        </section>

    </main>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const toggle = document.getElementById('theme-toggle');
        
        // Inizializza lo stato in base al tema corrente salvato in localStorage
        const currentTheme = document.documentElement.getAttribute('data-theme') || 'light';
        if (currentTheme === 'dark') {
            toggle.checked = true;
        }

        toggle.addEventListener('change', (e) => {
            if (e.target.checked) {
                document.documentElement.setAttribute('data-theme', 'dark');
                localStorage.setItem('theme', 'dark');
            } else {
                document.documentElement.setAttribute('data-theme', 'light');
                localStorage.setItem('theme', 'light');
            }
        });
    });
</script>
@endpush
@endsection
