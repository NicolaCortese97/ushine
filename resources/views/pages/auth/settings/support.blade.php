@extends('layouts.guest')

@section('content')
<style>
    .support-input {
        width: 100%;
        padding: 12px 16px;
        border: 1px solid #CED2E9;
        border-radius: 8px;
        font-size: 14px;
        background-color: #ffffff;
        color: #0D0F1C;
        outline: none;
        box-sizing: border-box;
        transition: border-color 0.2s, box-shadow 0.2s;
        font-family: sans-serif;
    }
    .support-input:focus {
        border-color: #607AFB;
        box-shadow: 0 0 0 3px rgba(96, 122, 251, 0.15);
    }
    .support-label {
        display: block;
        font-size: 13px;
        font-weight: 700;
        color: #0D0F1C;
        margin-bottom: 6px;
        font-family: sans-serif;
    }
    .faq-item {
        border: 1px solid #CED2E9;
        border-radius: 12px;
        background-color: #F8F9FC;
        margin-bottom: 12px;
        overflow: hidden;
        transition: all 0.2s ease-in-out;
    }
    .faq-trigger {
        width: 100%;
        padding: 16px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
        background: none;
        border: none;
        cursor: pointer;
        text-align: left;
        outline: none;
    }
    .faq-question {
        font-size: 14px;
        font-weight: 700;
        color: #0D0F1C;
        margin: 0;
        font-family: sans-serif;
    }
    .faq-content {
        padding: 0 16px 16px 16px;
        font-size: 13px;
        color: #555555;
        line-height: 1.6;
        font-family: sans-serif;
    }

    /* Dark Mode overrides */
    :is(.dark, [data-theme="dark"]) .page-container {
        background-color: #0b0d19 !important;
    }
    :is(.dark, [data-theme="dark"]) .logo-title {
        color: #ffffff !important;
    }
    :is(.dark, [data-theme="dark"]) .card-container {
        background-color: #121424 !important;
        border-color: #2e3456 !important;
    }
    :is(.dark, [data-theme="dark"]) .section-title {
        color: #ffffff !important;
    }
    :is(.dark, [data-theme="dark"]) .section-desc {
        color: #94a3b8 !important;
    }
    :is(.dark, [data-theme="dark"]) .support-label {
        color: #e2e8f0 !important;
    }
    :is(.dark, [data-theme="dark"]) .support-input {
        background-color: #1a1d30 !important;
        color: #ffffff !important;
        border-color: #2e3456 !important;
    }
    :is(.dark, [data-theme="dark"]) .faq-item {
        background-color: #1a1d30 !important;
        border-color: #2e3456 !important;
    }
    :is(.dark, [data-theme="dark"]) .faq-question {
        color: #ffffff !important;
    }
    :is(.dark, [data-theme="dark"]) .faq-content {
        color: #94a3b8 !important;
    }
    :is(.dark, [data-theme="dark"]) .alt-channel-card {
        background-color: #1a1d30 !important;
        border-color: #2e3456 !important;
    }
    :is(.dark, [data-theme="dark"]) .alt-channel-title {
        color: #ffffff !important;
    }
    :is(.dark, [data-theme="dark"]) .alt-channel-desc {
        color: #94a3b8 !important;
    }
    :is(.dark, [data-theme="dark"]) .footer-text {
        color: #94a3b8 !important;
    }
</style>

<div class="page-container" style="min-height: 100vh; background-color: #F8F9FC; padding: 40px 16px; display: flex; flex-direction: column; justify-content: center; align-items: center; font-family: 'Inter', system-ui, -apple-system, sans-serif;">
    
    {{-- Ushine Logo & Text centered at the top --}}
    <div style="display: flex; flex-direction: column; align-items: center; justify-content: center; margin-bottom: 24px; text-align: center; select-none: none;">
        <a href="{{ route('homepage') }}" style="display: flex; flex-direction: column; align-items: center; text-decoration: none; gap: 6px; transition: transform 0.2s;">
            <img src="{{ asset('images/logoushine.png') }}" alt="Ushine Logo" style="height: 60px; width: auto; object-fit: contain; display: block;">
            <h2 class="logo-title" style="font-size: 22px; font-weight: 900; color: #0D0F1C; margin: 0; margin-top: 4px; letter-spacing: 0.1em; text-transform: uppercase;">USHINE</h2>
        </a>
    </div>

    {{-- Main Premium Card Container --}}
    <div class="card-container" x-data="{ 
        activeFaq: null,
        contactName: '',
        contactEmail: '',
        contactSubject: '',
        contactMessage: '',
        submitState: 'idle'
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
                {{ __('Help & Support') }}
            </h1>
            <p style="font-size: 13px; color: rgba(255, 255, 255, 0.85); margin: 0; margin-top: 8px; font-weight: 500;">
                {{ __('Find quick answers below or send a message directly to our support team.') }}
            </p>
        </div>

        {{-- Scrollable Content Area --}}
        <div class="terms-scroll-container" style="padding: 32px; max-height: 50vh; overflow-y: auto; box-sizing: border-box; background-color: #ffffff;">
            
            {{-- Alert success submit save --}}
            <div x-show="submitState === 'success'" 
                 x-transition 
                 style="padding: 12px 16px; background-color: #E6F4EA; border: 1px solid #B7E1CD; color: #137333; border-radius: 12px; font-size: 13px; font-weight: 600; margin-bottom: 20px; display: flex; align-items: center; gap: 8px;"
                 role="alert">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                </svg>
                <span>{{ __('Support message sent successfully! We will get back to you soon.') }}</span>
            </div>

            {{-- Section 1: Contact Form --}}
            <section style="display: block; margin-bottom: 28px; border-bottom: 1px solid #F0F2F9; padding-bottom: 24px;">
                <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 14px;">
                    <span style="display: inline-flex; align-items: center; justify-content: center; width: 28px; height: 28px; border-radius: 8px; background-color: #EBF0FF; color: #607AFB; font-weight: bold; font-size: 13px; shrink: 0;">1</span>
                    <h2 class="section-title" style="font-size: 18px; font-weight: 700; color: #0D0F1C; margin: 0;">{{ __('Contact Support') }}</h2>
                </div>

                <p class="section-desc" style="font-size: 13px; color: #666666; line-height: 1.5; margin: 0; margin-top: -4px; margin-bottom: 16px; padding-left: 40px; box-sizing: border-box;">
                    {{ __('Fill out the form below and our customer support agents will email you back.') }}
                </p>
                
                <div style="padding-left: 40px; display: flex; flex-direction: column; gap: 16px; width: 100%; box-sizing: border-box;">
                    <div style="display: flex; gap: 16px; width: 100%; flex-wrap: wrap;">
                        <div style="flex: 1; min-width: 250px;">
                            <label class="support-label">{{ __('Full Name *') }}</label>
                            <input type="text" x-model="contactName" class="support-input" placeholder="{{ __('Your name') }}" required />
                        </div>
                        <div style="flex: 1; min-width: 250px;">
                            <label class="support-label">{{ __('Email Address *') }}</label>
                            <input type="email" x-model="contactEmail" class="support-input" placeholder="{{ __('you@example.com') }}" required />
                        </div>
                    </div>
                    
                    <div style="width: 100%;">
                        <label class="support-label">{{ __('Subject') }}</label>
                        <input type="text" x-model="contactSubject" class="support-input" placeholder="{{ __('How can we help you?') }}" />
                    </div>

                    <div style="width: 100%;">
                        <label class="support-label">{{ __('Message *') }}</label>
                        <textarea x-model="contactMessage" rows="5" class="support-input" placeholder="{{ __('Describe your inquiry...') }}" style="resize: vertical; min-height: 100px;" required></textarea>
                    </div>
                </div>
            </section>

            {{-- Section 2: Frequently Asked Questions (FAQ) --}}
            <section style="display: block; margin-bottom: 28px; border-bottom: 1px solid #F0F2F9; padding-bottom: 24px;">
                <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 14px;">
                    <span style="display: inline-flex; align-items: center; justify-content: center; width: 28px; height: 28px; border-radius: 8px; background-color: #EBF0FF; color: #607AFB; font-weight: bold; font-size: 13px; shrink: 0;">2</span>
                    <h2 class="section-title" style="font-size: 18px; font-weight: 700; color: #0D0F1C; margin: 0;">{{ __('Frequently Asked Questions') }}</h2>
                </div>

                <p class="section-desc" style="font-size: 13px; color: #666666; line-height: 1.5; margin: 0; margin-top: -4px; margin-bottom: 16px; padding-left: 40px; box-sizing: border-box;">
                    {{ __('Quick answers to common questions about accounts, sponsorships, and security.') }}
                </p>
                
                <div style="padding-left: 40px; box-sizing: border-box; width: 100%;">
                    
                    {{-- FAQ 1 --}}
                    <div class="faq-item">
                        <button type="button" @click="activeFaq = activeFaq === 1 ? null : 1" class="faq-trigger">
                             <span class="faq-question">{{ __('What is Ushine?') }}</span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="#666" stroke-width="2.5" style="transition: transform 0.2s;" :style="activeFaq === 1 ? 'transform: rotate(180deg);' : ''">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div x-show="activeFaq === 1" x-transition class="faq-content">
                            {{ __('Ushine is a platform that connects emerging talents (creatives, artists, athletes) with professional sponsors and supporters who want to sponsor milestones, validate certifications, and fund projects.') }}
                        </div>
                    </div>

                    {{-- FAQ 2 --}}
                    <div class="faq-item">
                        <button type="button" @click="activeFaq = activeFaq === 2 ? null : 2" class="faq-trigger">
                             <span class="faq-question">{{ __('How do sponsorships work?') }}</span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="#666" stroke-width="2.5" style="transition: transform 0.2s;" :style="activeFaq === 2 ? 'transform: rotate(180deg);' : ''">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div x-show="activeFaq === 2" x-transition class="faq-content">
                            {{ __('Sponsors can browse talents, view their posts and updates, and directly fund them. All transactions and agreements are negotiated under the direct responsibility of the parties.') }}
                        </div>
                    </div>

                    {{-- FAQ 3 --}}
                    <div class="faq-item">
                        <button type="button" @click="activeFaq = activeFaq === 3 ? null : 3" class="faq-trigger">
                             <span class="faq-question">{{ __('How do I get a verified badge?') }}</span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="#666" stroke-width="2.5" style="transition: transform 0.2s;" :style="activeFaq === 3 ? 'transform: rotate(180deg);' : ''">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div x-show="activeFaq === 3" x-transition class="faq-content">
                            {{ __('Verification is granted to sponsors who complete verification, and talents who submit certified milestones. Go to your Profile settings or contact support to submit documents.') }}
                        </div>
                    </div>

                    {{-- FAQ 4 --}}
                    <div class="faq-item">
                        <button type="button" @click="activeFaq = activeFaq === 4 ? null : 4" class="faq-trigger">
                             <span class="faq-question">{{ __('How can I export my account data?') }}</span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="#666" stroke-width="2.5" style="transition: transform 0.2s;" :style="activeFaq === 4 ? 'transform: rotate(180deg);' : ''">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div x-show="activeFaq === 4" x-transition class="faq-content">
                            {{ __('You can request a ZIP archive of all your data directly from the Privacy & Security tab in your Settings panel.') }}
                        </div>
                    </div>

                </div>
            </section>

            {{-- Section 3: Alternative Channels --}}
            <section style="display: block; margin-bottom: 0;">
                <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 14px;">
                    <span style="display: inline-flex; align-items: center; justify-content: center; width: 28px; height: 28px; border-radius: 8px; background-color: #EBF0FF; color: #607AFB; font-weight: bold; font-size: 13px; shrink: 0;">3</span>
                    <h2 class="section-title" style="font-size: 18px; font-weight: 700; color: #0D0F1C; margin: 0;">{{ __('Alternative Channels') }}</h2>
                </div>
                
                <div style="padding-left: 40px; box-sizing: border-box; width: 100%;">
                    <div class="alt-channel-card" style="padding: 16px; background-color: #F8F9FC; border: 1px solid #CED2E9; border-radius: 12px; display: flex; align-items: center; justify-content: space-between; gap: 16px; box-sizing: border-box; width: 100%; flex-wrap: wrap;">
                        <div style="flex: 1; min-width: 250px;">
                            <h4 class="alt-channel-title" style="font-size: 14px; font-weight: 700; color: #0D0F1C; margin: 0; margin-bottom: 4px;">{{ __('Direct Email Support') }}</h4>
                            <p class="alt-channel-desc" style="font-size: 12px; color: #666666; margin: 0; line-height: 1.5;">
                                {{ __('Feel free to email our customer care team directly at:') }}
                            </p>
                            <a href="mailto:support@ushine.com" style="font-size: 13px; color: #607AFB; font-weight: 700; text-decoration: none; display: inline-block; margin-top: 6px;">support@ushine.com</a>
                        </div>
                    </div>
                </div>
            </section>

        </div>

        {{-- Premium Card Footer Action --}}
        <div style="background-color: #F8F9FC; border-top: 1px solid #CED2E9; padding: 20px 32px; display: flex; align-items: center; justify-content: space-between; gap: 16px; flex-wrap: wrap; box-sizing: border-box;">
            <span class="footer-text" style="font-size: 12px; color: #666666; font-weight: 500; font-family: sans-serif;">
                © 2026 Ushine Inc. {{ __('All rights reserved.') }}
            </span>
            <div class="flex gap-4">
                <button type="button" 
                        @click="
                            if(!contactName || !contactEmail || !contactMessage) {
                                alert('{{ __('Please fill in all required fields.') }}');
                                return;
                            }
                            submitState = 'submitting'; 
                            setTimeout(() => { 
                                submitState = 'success'; 
                                contactName = '';
                                contactEmail = '';
                                contactSubject = '';
                                contactMessage = '';
                                setTimeout(() => { submitState = 'idle'; }, 4000); 
                            }, 1500);"
                        style="padding: 10px 24px; font-size: 14px; font-weight: 700; color: #ffffff; background-color: #607AFB; border: none; border-radius: 10px; cursor: pointer; transition: background-color 0.2s, transform 0.1s; box-shadow: 0 4px 6px -1px rgba(96, 122, 251, 0.2); font-family: sans-serif; display: inline-flex; align-items: center; justify-content: center; select-none: none; outline: none; min-width: 140px; box-sizing: border-box;" 
                        onmouseover="this.style.backgroundColor='#4A5FD0'" 
                        onmouseout="this.style.backgroundColor='#607AFB'"
                        :disabled="submitState === 'submitting'">
                    <template x-if="submitState === 'idle'">
                        <span>{{ __('Send Message') }}</span>
                    </template>
                    <template x-if="submitState === 'submitting'">
                        <span style="display: flex; align-items: center; gap: 6px;">
                            <span class="loading loading-spinner loading-xs"></span>
                            {{ __('Sending...') }}
                        </span>
                    </template>
                    <template x-if="submitState === 'success'">
                        <span style="display: flex; align-items: center; gap: 6px;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41L9 16.17z"/>
                            </svg>
                            {{ __('Sent') }}
                        </span>
                    </template>
                </button>
            </div>
        </div>

    </div>

</div>

{{-- Custom premium scrollbar style --}}
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
</style>
@endsection
