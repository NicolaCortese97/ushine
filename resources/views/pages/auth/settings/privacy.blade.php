@extends('layouts.guest')

@section('content')
<div style="min-height: 100vh; background-color: #F8F9FC; padding: 40px 16px; display: flex; flex-direction: column; justify-content: center; align-items: center; font-family: 'Inter', system-ui, -apple-system, sans-serif;">
    
    {{-- Ushine Logo & Text centered at the top --}}
    <div style="display: flex; flex-direction: column; align-items: center; justify-content: center; margin-bottom: 24px; text-align: center; select-none: none;">
        <a href="{{ route('homepage') }}" style="display: flex; flex-direction: column; align-items: center; text-decoration: none; gap: 6px; transition: transform 0.2s;">
            <img src="{{ asset('images/logoushine.png') }}" alt="Ushine Logo" style="height: 60px; width: auto; object-fit: contain; display: block;">
            <h2 style="font-size: 22px; font-weight: 900; color: #0D0F1C; margin: 0; margin-top: 4px; letter-spacing: 0.1em; text-transform: uppercase;">USHINE</h2>
        </a>
    </div>

    {{-- Main Premium Card Container --}}
    <div x-data="{ 
        showDeleteModal: false, 
        loggedOutOther: false, 
        sessionsCount: localStorage.getItem('sessionsCount') !== null ? parseInt(localStorage.getItem('sessionsCount')) : 2, 
        requestState: 'idle',
        privateProfile: localStorage.getItem('privateProfile') === 'true',
        activityStatus: localStorage.getItem('activityStatus') !== 'false',
        saveState: 'idle'
    }" style="position: relative; width: 100%; max-width: 768px; background-color: #ffffff; border: 1px solid #CED2E9; border-radius: 16px; box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05), 0 8px 10px -6px rgba(0, 0, 0, 0.05); overflow: hidden; width: 100%;">
        
        {{-- Elegant Header with Ushine Cohesive Cobalt Gradient --}}
        <div style="background: linear-gradient(135deg, #607AFB 0%, #4A5FD0 100%); padding: 32px 32px 36px 32px; color: #ffffff; position: relative;">
            
            {{-- Navigation/Back Button --}}
            <a href="{{ route('settings.index') }}" style="display: inline-flex; align-items: center; gap: 8px; color: rgba(255, 255, 255, 0.85); text-decoration: none; font-weight: 600; font-size: 13px; margin-bottom: 20px; transition: color 0.2s;" onmouseover="this.style.color='#ffffff'" onmouseout="this.style.color='rgba(255, 255, 255, 0.85)'">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
                {{ __('Back to settings') }}
            </a>

            {{-- Title & Subtitle --}}
            <h1 style="font-size: 26px; font-weight: 800; color: #ffffff; margin: 0; line-height: 1.2; letter-spacing: -0.02em;">
                {{ __('Privacy & Security') }}
            </h1>
            <p style="font-size: 13px; color: rgba(255, 255, 255, 0.85); margin: 0; margin-top: 8px; font-weight: 500;">
                {{ __('Manage your account visibility, active devices, and security parameters.') }}
            </p>
        </div>

        {{-- Scrollable Content Area --}}
        <div class="terms-scroll-container" style="padding: 32px; max-height: 50vh; overflow-y: auto; box-sizing: border-box; background-color: #ffffff;">
            
            {{-- Alert success settings save --}}
            <div x-show="saveState === 'success'" 
                 x-transition 
                 style="padding: 12px 16px; background-color: #E6F4EA; border: 1px solid #B7E1CD; color: #137333; border-radius: 12px; font-size: 13px; font-weight: 600; margin-bottom: 20px; display: flex; align-items: center; gap: 8px;"
                 role="alert">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                </svg>
                <span>{{ __('Privacy and security settings saved successfully.') }}</span>
            </div>

            {{-- Section 1: Profile Privacy --}}
            <section style="display: block; margin-bottom: 28px; border-bottom: 1px solid #F0F2F9; padding-bottom: 24px;">
                <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 14px;">
                    <span style="display: inline-flex; align-items: center; justify-content: center; width: 28px; height: 28px; border-radius: 8px; background-color: #EBF0FF; color: #607AFB; font-weight: bold; font-size: 13px; shrink: 0;">1</span>
                    <h2 style="font-size: 18px; font-weight: 700; color: #0D0F1C; margin: 0;">{{ __('Profile Privacy') }}</h2>
                </div>

                <p style="font-size: 13px; color: #666666; line-height: 1.5; margin: 0; margin-top: -4px; margin-bottom: 16px; padding-left: 40px; box-sizing: border-box;">
                    {{ __('Manage who can see your profile details, updates, and active status.') }}
                </p>
                
                <div style="padding-left: 40px; display: flex; flex-direction: column; gap: 14px; width: 100%; box-sizing: border-box;">
                    {{-- Card Private Account --}}
                    <div style="padding: 16px; background-color: #F8F9FC; border: 1px solid #CED2E9; border-radius: 12px; display: flex; align-items: center; justify-content: space-between; gap: 16px; box-sizing: border-box; width: 100%;">
                        <div style="flex: 1;">
                            <h4 style="font-size: 14px; font-weight: 700; color: #0D0F1C; margin: 0; margin-bottom: 4px;">{{ __('Private Account') }}</h4>
                            <p style="font-size: 12px; color: #666666; margin: 0; line-height: 1.5;">
                                {{ __('When active, your posts and profile updates will only be visible to approved Sponsors and verified users.') }}
                            </p>
                        </div>
                        <input type="checkbox" id="private_profile_toggle" class="toggle toggle-primary toggle-sm cursor-pointer" x-model="privateProfile" />
                    </div>

                    {{-- Card Activity Status --}}
                    <div style="padding: 16px; background-color: #F8F9FC; border: 1px solid #CED2E9; border-radius: 12px; display: flex; align-items: center; justify-content: space-between; gap: 16px; box-sizing: border-box; width: 100%;">
                        <div style="flex: 1;">
                            <h4 style="font-size: 14px; font-weight: 700; color: #0D0F1C; margin: 0; margin-bottom: 4px;">{{ __('Activity Status') }}</h4>
                            <p style="font-size: 12px; color: #666666; margin: 0; line-height: 1.5;">
                                {{ __('Allows other talents and sponsors to see when you were last active or if you are currently online in platform chats.') }}
                            </p>
                        </div>
                        <input type="checkbox" id="activity_status_toggle" class="toggle toggle-primary toggle-sm cursor-pointer" x-model="activityStatus" />
                    </div>
                </div>
            </section>

            {{-- Section 2: Two-Factor Authentication --}}
            <section style="display: block; margin-bottom: 28px; border-bottom: 1px solid #F0F2F9; padding-bottom: 24px;">
                <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 14px;">
                    <span style="display: inline-flex; align-items: center; justify-content: center; width: 28px; height: 28px; border-radius: 8px; background-color: #EBF0FF; color: #607AFB; font-weight: bold; font-size: 13px; shrink: 0;">2</span>
                    <h2 style="font-size: 18px; font-weight: 700; color: #0D0F1C; margin: 0;">{{ __('Two-Factor Authentication (2FA)') }}</h2>
                </div>
                
                <div style="padding-left: 40px; box-sizing: border-box; width: 100%;">
                    <div style="padding: 16px; background-color: #F8F9FC; border: 1px solid #CED2E9; border-radius: 12px; display: flex; align-items: center; justify-content: space-between; gap: 16px; box-sizing: border-box; width: 100%; flex-wrap: wrap;">
                        <div style="flex: 1; min-width: 250px;">
                            <h4 style="font-size: 14px; font-weight: 700; color: #0D0F1C; margin: 0; margin-bottom: 4px; display: flex; align-items: center; gap: 6px;">
                                {{ __('Two-Factor Authentication') }}
                                <span style="font-size: 10px; background-color: #E6E9F4; color: #0D0F1C; padding: 2px 6px; border-radius: 6px; font-weight: 800;">{{ __('RECOMMENDED') }}</span>
                            </h4>
                            <p style="font-size: 12px; color: #666666; margin: 0; line-height: 1.5;">
                                {{ __('Add an extra layer of security to your Ushine account by requiring a verification code from your authenticator app at login.') }}
                            </p>
                        </div>
                        <button type="button" class="btn-privacy-action btn-idle">
                            {{ __('Configure 2FA') }}
                        </button>
                    </div>
                </div>
            </section>

            {{-- Section 3: Active Sessions --}}
            <section style="display: block; margin-bottom: 28px; border-bottom: 1px solid #F0F2F9; padding-bottom: 24px;">
                <div style="display: flex; align-items: center; justify-content: space-between; gap: 16px; margin-bottom: 14px; flex-wrap: wrap;">
                    <div style="display: flex; align-items: center; gap: 12px;">
                        <span style="display: inline-flex; align-items: center; justify-content: center; width: 28px; height: 28px; border-radius: 8px; background-color: #EBF0FF; color: #607AFB; font-weight: bold; font-size: 13px; shrink: 0;">3</span>
                        <h2 style="font-size: 18px; font-weight: 700; color: #0D0F1C; margin: 0;">{{ __('Active Sessions') }}</h2>
                    </div>
                    <template x-if="sessionsCount > 1">
                        <button type="button" 
                                @click="loggedOutOther = true; sessionsCount = 1;"
                                style="font-size: 12px; font-weight: 700; color: #607AFB; background: none; border: none; cursor: pointer; padding: 0; outline: none; hover: underline;">
                            {{ __('Log out from all other devices') }}
                        </button>
                    </template>
                </div>

                <p style="font-size: 13px; color: #666666; line-height: 1.5; margin: 0; margin-top: -4px; margin-bottom: 16px; padding-left: 40px; box-sizing: border-box;">
                    {{ __('Review where you are currently signed in to Ushine.') }}
                </p>

                <div style="padding-left: 40px; box-sizing: border-box; width: 100%;">
                    {{-- Alert success session logout --}}
                    <div x-show="loggedOutOther" 
                         x-transition 
                         style="padding: 12px 16px; background-color: #E6F4EA; border: 1px solid #B7E1CD; color: #137333; border-radius: 12px; font-size: 13px; font-weight: 600; margin-bottom: 14px; display: flex; align-items: center; gap: 8px;"
                         role="alert">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                        </svg>
                        <span>{{ __('Successfully logged out of all other sessions.') }}</span>
                    </div>
                    
                    <div style="display: flex; flex-direction: column; border: 1px solid #CED2E9; border-radius: 12px; overflow: hidden; background-color: #ffffff;">
                        {{-- Device 1: Current --}}
                        <div style="padding: 16px; border-bottom: 1px solid #CED2E9; display: flex; align-items: center; justify-content: space-between; gap: 16px;">
                            <div style="display: flex; align-items: center; gap: 12px;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="none" viewBox="0 0 24 24" stroke="#666666" stroke-width="1.5">
                                    <rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect>
                                    <line x1="8" y1="21" x2="16" y2="21"></line>
                                    <line x1="12" y1="17" x2="12" y2="21"></line>
                                </svg>
                                <div>
                                    <h5 style="font-size: 14px; font-weight: 700; color: #0D0F1C; margin: 0; display: flex; align-items: center; gap: 6px;">
                                        {{ __('Windows PC • Chrome') }}
                                        <span style="font-size: 9px; background-color: #EBF0FF; color: #607AFB; padding: 2px 6px; border-radius: 4px; font-weight: 800;">{{ __('THIS DEVICE') }}</span>
                                    </h5>
                                    <p style="font-size: 11px; color: #888888; margin: 0; margin-top: 2px;">{{ __('Milan, Italy • IP: 82.50.112.44') }}</p>
                                </div>
                            </div>
                        </div>

                        {{-- Device 2: Other --}}
                        <template x-if="sessionsCount > 1">
                            <div style="padding: 16px; display: flex; align-items: center; justify-content: space-between; gap: 16px; background-color: #ffffff;" x-transition>
                                <div style="display: flex; align-items: center; gap: 12px;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="none" viewBox="0 0 24 24" stroke="#666666" stroke-width="1.5">
                                        <rect x="5" y="2" width="14" height="20" rx="2" ry="2"></rect>
                                        <line x1="12" y1="18" x2="12.01" y2="18"></line>
                                    </svg>
                                    <div>
                                        <h5 style="font-size: 14px; font-weight: 700; color: #0D0F1C; margin: 0;">{{ __('iPhone 15 • Safari') }}</h5>
                                        <p style="font-size: 11px; color: #888888; margin: 0; margin-top: 2px;">{{ __('Rome, Italy • IP: 109.117.84.19 • Active 2 hours ago') }}</p>
                                    </div>
                                </div>
                                <button type="button" 
                                        @click="sessionsCount = 1; loggedOutOther = true;"
                                        style="font-size: 12px; font-weight: 700; color: #ef4444; background: none; border: none; cursor: pointer; padding: 0; outline: none; hover: underline;">
                                    {{ __('Revoke') }}
                                </button>
                            </div>
                        </template>
                    </div>
                </div>
            </section>

            {{-- Section 4: Personal Data Archive --}}
            <section style="display: block; margin-bottom: 28px; border-bottom: 1px solid #F0F2F9; padding-bottom: 24px;">
                <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 14px;">
                    <span style="display: inline-flex; align-items: center; justify-content: center; width: 28px; height: 28px; border-radius: 8px; background-color: #EBF0FF; color: #607AFB; font-weight: bold; font-size: 13px; shrink: 0;">4</span>
                    <h2 style="font-size: 18px; font-weight: 700; color: #0D0F1C; margin: 0;">{{ __('Personal Data Archive') }}</h2>
                </div>
                
                <div style="padding-left: 40px; box-sizing: border-box; width: 100%;">
                    <div style="padding: 16px; background-color: #F8F9FC; border: 1px solid #CED2E9; border-radius: 12px; display: flex; align-items: center; justify-content: space-between; gap: 16px; box-sizing: border-box; width: 100%; flex-wrap: wrap;">
                        <div style="flex: 1; min-width: 250px;">
                            <h4 style="font-size: 14px; font-weight: 700; color: #0D0F1C; margin: 0; margin-bottom: 4px;">{{ __('Export Account Data') }}</h4>
                            <p style="font-size: 12px; color: #666666; margin: 0; line-height: 1.5;">
                                {{ __('Request a full ZIP archive containing all your profile info, posts, uploaded media, and comments. This file will be emailed to you.') }}
                            </p>
                        </div>
                        
                        <button type="button" 
                                @click="requestState = 'loading'; setTimeout(() => { requestState = 'success'; }, 1500);"
                                class="btn-privacy-action"
                                :class="{ 
                                    'btn-idle': requestState === 'idle', 
                                    'btn-loading': requestState === 'loading', 
                                    'btn-success': requestState === 'success' 
                                }"
                                :disabled="requestState !== 'idle'">
                            <template x-if="requestState === 'idle'">
                                <span>{{ __('Request Data') }}</span>
                            </template>
                            <template x-if="requestState === 'loading'">
                                <span style="display: inline-flex; align-items: center; gap: 6px;">
                                    <span class="loading loading-spinner loading-xs"></span>
                                    {{ __('Requesting...') }}
                                </span>
                            </template>
                            <template x-if="requestState === 'success'">
                                <span style="display: inline-flex; align-items: center; gap: 6px;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41L9 16.17z"/>
                                    </svg>
                                    {{ __('Requested') }}
                                </span>
                            </template>
                        </button>
                    </div>
                </div>
            </section>

            {{-- Section 5: Danger Zone --}}
            <section style="display: block; margin-bottom: 0;">
                <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 14px;">
                    <span style="display: inline-flex; align-items: center; justify-content: center; width: 28px; height: 28px; border-radius: 8px; background-color: #FCE8E6; color: #D93025; font-weight: bold; font-size: 13px; shrink: 0;">5</span>
                    <h2 style="font-size: 18px; font-weight: 700; color: #D93025; margin: 0;">{{ __('Danger Zone') }}</h2>
                </div>
                
                <div style="padding-left: 40px; box-sizing: border-box; width: 100%;">
                    <div style="padding: 16px; background-color: #FDF2F2; border: 1px solid #F8B4B4; border-radius: 12px; display: flex; align-items: center; justify-content: space-between; gap: 16px; box-sizing: border-box; width: 100%; flex-wrap: wrap;">
                        <div style="flex: 1; min-width: 250px;">
                            <h4 style="font-size: 14px; font-weight: 700; color: #D93025; margin: 0; margin-bottom: 4px;">{{ __('Delete Account') }}</h4>
                            <p style="font-size: 12px; color: #A83232; margin: 0; line-height: 1.5;">
                                {{ __('Permanently delete your account and all associated updates. This action is irreversible and all your sponsorship history will be lost.') }}
                            </p>
                        </div>
                        <button type="button" 
                                @click="showDeleteModal = true"
                                style="padding: 10px 20px; font-size: 13px; font-weight: 700; color: #ffffff; background-color: #ef4444; border: none; border-radius: 8px; cursor: pointer; transition: background-color 0.2s; box-shadow: 0 4px 6px -1px rgba(239, 68, 68, 0.2); outline: none;"
                                onmouseover="this.style.backgroundColor='#dc2626'" onmouseout="this.style.backgroundColor='#ef4444'">
                            {{ __('Delete Account') }}
                        </button>
                    </div>
                </div>
            </section>

        </div>

        {{-- Premium Card Footer Action --}}
        <div style="background-color: #F8F9FC; border-top: 1px solid #CED2E9; padding: 20px 32px; display: flex; align-items: center; justify-content: space-between; gap: 16px; flex-wrap: wrap; box-sizing: border-box;">
            <span style="font-size: 12px; color: #666666; font-weight: 500; font-family: sans-serif;">
                © 2026 Ushine Inc. {{ __('All rights reserved.') }}
            </span>
            <div class="flex gap-4">
                <button type="button" 
                        @click="
                            saveState = 'saving'; 
                            localStorage.setItem('privateProfile', privateProfile);
                            localStorage.setItem('activityStatus', activityStatus);
                            localStorage.setItem('sessionsCount', sessionsCount);
                            localStorage.setItem('loggedOutOther', loggedOutOther);
                            setTimeout(() => { 
                                saveState = 'success'; 
                                setTimeout(() => { saveState = 'idle'; }, 3000); 
                            }, 1000);"
                        style="padding: 10px 24px; font-size: 14px; font-weight: 700; color: #ffffff; background-color: #607AFB; border: none; border-radius: 10px; cursor: pointer; transition: background-color 0.2s, transform 0.1s; box-shadow: 0 4px 6px -1px rgba(96, 122, 251, 0.2); font-family: sans-serif; display: inline-flex; align-items: center; justify-content: center; select-none: none; outline: none; min-width: 140px; box-sizing: border-box;" 
                        onmouseover="this.style.backgroundColor='#4A5FD0'" 
                        onmouseout="this.style.backgroundColor='#607AFB'"
                        :disabled="saveState === 'saving'">
                    <template x-if="saveState === 'idle'">
                        <span>{{ __('Save') }}</span>
                    </template>
                    <template x-if="saveState === 'saving'">
                        <span style="display: flex; align-items: center; gap: 6px;">
                            <span class="loading loading-spinner loading-xs"></span>
                            {{ __('Saving...') }}
                        </span>
                    </template>
                    <template x-if="saveState === 'success'">
                        <span style="display: flex; align-items: center; gap: 6px;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41L9 16.17z"/>
                            </svg>
                            {{ __('Saved') }}
                        </span>
                    </template>
                </button>
            </div>
        </div>

    </div>

    {{-- Delete Account Modal Overlay --}}
    <div x-show="showDeleteModal" 
         class="fixed inset-0 z-50 flex items-center justify-center bg-black/60 backdrop-blur-xs p-4"
         x-transition
         style="display: none;">
        
        {{-- Modal Body --}}
        <div class="bg-base-100 border border-base-200 rounded-2xl max-w-md w-full shadow-2xl p-6 space-y-6"
             @click.outside="showDeleteModal = false">
            
            <div class="flex items-start gap-4">
                <div class="w-10 h-10 rounded-full bg-error/10 flex items-center justify-center text-error shrink-0">
                    <span class="icon-[tabler--alert-circle] size-6"></span>
                </div>
                <div class="space-y-1">
                    <h4 class="font-bold text-base-content text-[17px]">{{ __('Are you absolutely sure?') }}</h4>
                    <p class="text-xs text-base-content/60 leading-relaxed">
                        {{ __('Please type your password below to confirm account deletion. This action cannot be undone.') }}
                    </p>
                </div>
            </div>

            {{-- Form block --}}
            <div class="space-y-4">
                <div>
                    <label class="label-text" for="delete_confirm_password">{{ __('Your Password') }}</label>
                    <input type="password" 
                           id="delete_confirm_password" 
                           class="input input-error" 
                           placeholder="{{ __('Enter your account password') }}" />
                </div>
            </div>

            {{-- Actions --}}
            <div class="flex justify-end gap-3">
                <button type="button" 
                        @click="showDeleteModal = false"
                        class="btn btn-soft btn-secondary btn-sm cursor-pointer">
                    {{ __('Cancel') }}
                </button>
                <button type="button" 
                        class="btn btn-error btn-sm cursor-pointer"
                        onclick="alert('{{ __('Account deletion simulated successfully!') }}'); localStorage.removeItem('privateProfile'); localStorage.removeItem('activityStatus'); localStorage.removeItem('sessionsCount'); localStorage.removeItem('loggedOutOther'); window.location.href='/landing';">
                    {{ __('Permanently Delete') }}
                </button>
            </div>

        </div>
    </div>

</div>

{{-- Custom premium styles --}}
<style>
    /* Styling scrollbar per Chrome/Safari/Edge */
    .terms-scroll-container::-webkit-scrollbar {
        width: 6px;
    }
    .terms-scroll-container::-webkit-scrollbar-track {
        background: #F3F4F6;
        border-radius: 9999px;
    }
    .terms-scroll-container::-webkit-scrollbar-thumb {
        background: #607AFB;
        border-radius: 9999px;
    }
    .terms-scroll-container::-webkit-scrollbar-thumb:hover {
        background: #4A5FD0;
    }

    /* Scrollbar dark mode */
    .dark .terms-scroll-container::-webkit-scrollbar-track,
    [data-theme="dark"] .terms-scroll-container::-webkit-scrollbar-track {
        background: var(--bg-nested, #181a24) !important;
    }
    .dark .terms-scroll-container::-webkit-scrollbar-thumb,
    [data-theme="dark"] .terms-scroll-container::-webkit-scrollbar-thumb {
        background: #607AFB !important;
    }

    /* Privacy Action Buttons Base */
    .btn-privacy-action {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 8px 16px !important;
        font-size: 12px !important;
        font-weight: 700 !important;
        border-radius: 8px !important;
        border: none !important;
        cursor: pointer !important;
        transition: all 0.2s ease !important;
        outline: none !important;
        user-select: none !important;
        text-decoration: none !important;
        min-height: 32px;
        box-sizing: border-box;
    }

    /* States: Light Mode */
    .btn-privacy-action.btn-idle {
        background-color: #EBF0FF !important;
        color: #607AFB !important;
    }
    .btn-privacy-action.btn-idle:hover {
        background-color: #dbe4ff !important;
    }

    .btn-privacy-action.btn-loading {
        background-color: #E6E9F4 !important;
        color: #666666 !important;
        cursor: default !important;
    }

    .btn-privacy-action.btn-success {
        background-color: #E6F4EA !important;
        color: #137333 !important;
        cursor: default !important;
    }

    /* States: Dark Mode Overrides */
    .dark .btn-privacy-action.btn-idle, 
    [data-theme="dark"] .btn-privacy-action.btn-idle {
        background-color: rgba(96, 122, 251, 0.15) !important;
        color: #8da2ff !important;
    }
    .dark .btn-privacy-action.btn-idle:hover, 
    [data-theme="dark"] .btn-privacy-action.btn-idle:hover {
        background-color: rgba(96, 122, 251, 0.25) !important;
    }

    .dark .btn-privacy-action.btn-loading, 
    [data-theme="dark"] .btn-privacy-action.btn-loading {
        background-color: rgba(230, 233, 244, 0.1) !important;
        color: #a1a1a1 !important;
    }

    .dark .btn-privacy-action.btn-success, 
    [data-theme="dark"] .btn-privacy-action.btn-success {
        background-color: rgba(22, 163, 74, 0.15) !important;
        color: #4ade80 !important;
    }
</style>
@endsection
