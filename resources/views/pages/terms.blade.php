@extends('layouts.guest')

@section('content')
<div style="min-height: 100vh; background-color: #F8F9FC; padding: 40px 16px; display: flex; flex-direction: column; justify-content: center; align-items: center; font-family: 'Inter', system-ui, -apple-system, sans-serif;">
    
    {{-- Ushine Logo & Text centered at the top --}}
    <div style="display: flex; flex-direction: column; align-items: center; justify-content: center; margin-bottom: 24px; text-align: center; select-none: none;">
        <a href="{{ route('landing') }}" style="display: flex; flex-direction: column; align-items: center; text-decoration: none; gap: 6px; transition: transform 0.2s;">
            <img src="{{ asset('images/logoushine.png') }}" alt="Ushine Logo" style="height: 60px; width: auto; object-fit: contain; display: block;">
            <h2 style="font-size: 22px; font-weight: 900; tracking-content: wide; color: #0D0F1C; margin: 0; margin-top: 4px; letter-spacing: 0.1em; text-transform: uppercase;">USHINE</h2>
        </a>
    </div>

    {{-- Main Premium Card Container - Tighter max-w-3xl for premium presentation --}}
    <div style="position: relative; width: 100%; max-width: 768px; background-color: #ffffff; border: 1px solid #CED2E9; border-radius: 16px; box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05), 0 8px 10px -6px rgba(0, 0, 0, 0.05); overflow: hidden; width: 100%;">
        
        {{-- Elegant Header with Ushine Cohesive Cobalt Gradient --}}
        <div style="background: linear-gradient(135deg, #607AFB 0%, #4A5FD0 100%); padding: 32px 32px 36px 32px; color: #ffffff; position: relative;">
            
            {{-- Navigation/Back Button --}}
            <a href="{{ route('register') }}" style="display: inline-flex; align-items: center; gap: 8px; color: rgba(255, 255, 255, 0.85); text-decoration: none; font-weight: 600; font-size: 13px; margin-bottom: 20px; transition: color 0.2s;" onmouseover="this.style.color='#ffffff'" onmouseout="this.style.color='rgba(255, 255, 255, 0.85)'">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
                {{ __('Back to registration') }}
            </a>

            {{-- Title & Subtitle --}}
            <h1 style="font-size: 26px; font-weight: 800; color: #ffffff; margin: 0; line-height: 1.2; letter-spacing: -0.02em;">
                {{ __('Terms and Conditions') }}
            </h1>
            <p style="font-size: 13px; color: rgba(255, 255, 255, 0.85); margin: 0; margin-top: 8px; font-weight: 500;">
                {{ __('Last updated: June 2, 2026. Please read these terms carefully before using Ushine.') }}
            </p>
        </div>

        {{-- Scrollable Terms Content --}}
        <div class="terms-scroll-container" style="padding: 32px; max-height: 50vh; overflow-y: auto; box-sizing: border-box; background-color: #ffffff;">
            
            {{-- Section 1: Introduction --}}
            <section style="display: block; margin-bottom: 24px; border-bottom: 1px solid #F0F2F9; padding-bottom: 24px;" id="sec-introduction">
                <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 12px;">
                    <span style="display: inline-flex; align-items: center; justify-content: center; width: 28px; height: 28px; border-radius: 8px; background-color: #EBF0FF; color: #607AFB; font-weight: bold; font-size: 13px; shrink: 0;">1</span>
                    <h2 style="font-size: 18px; font-weight: 700; color: #0D0F1C; margin: 0;">{{ __('Acceptance of Terms') }}</h2>
                </div>
                <p style="font-size: 14px; color: #555555; line-height: 1.6; margin: 0; padding-left: 40px; box-sizing: border-box;">
                    {{ __('By creating an account, registering, or using the Ushine platform ("Service"), you agree to be bound by these Terms and Conditions and our Privacy Policy. If you do not agree with any of the provisions described, you may not access or use our services.') }}
                </p>
            </section>

            {{-- Section 2: Account Registration & Roles --}}
            <section style="display: block; margin-bottom: 24px; border-bottom: 1px solid #F0F2F9; padding-bottom: 24px;" id="sec-registration">
                <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 12px;">
                    <span style="display: inline-flex; align-items: center; justify-content: center; width: 28px; height: 28px; border-radius: 8px; background-color: #EBF0FF; color: #607AFB; font-weight: bold; font-size: 13px; shrink: 0;">2</span>
                    <h2 style="font-size: 18px; font-weight: 700; color: #0D0F1C; margin: 0;">{{ __('Registration and Account Types') }}</h2>
                </div>
                <p style="font-size: 14px; color: #555555; line-height: 1.6; margin: 0; padding-left: 40px; box-sizing: border-box;">
                    {{ __('During account creation, you will be asked to select one of the following account types:') }}
                </p>
                
                {{-- Account Cards Grid --}}
                <div style="padding-left: 40px; margin-top: 16px; display: flex; flex-direction: column; gap: 14px; box-sizing: border-box; width: 100%;">
                    <div style="padding: 16px; background-color: #F8F9FC; border: 1px solid #CED2E9; border-radius: 12px; display: block; box-sizing: border-box; width: 100%; min-height: fit-content;">
                        <h4 style="font-size: 14px; font-weight: 700; color: #0D0F1C; margin: 0; margin-bottom: 6px;">{{ __('Talent Account') }}</h4>
                        <p style="font-size: 12px; color: #666666; margin: 0; line-height: 1.6;">
                            {{ __('Dedicated to creatives, artists, athletes, and innovators who want to showcase their skills, upload media content (updates, photos, videos), and receive sponsorships, donations, and support from professional investors.') }}
                        </p>
                    </div>
                    <div style="padding: 16px; background-color: #F8F9FC; border: 1px solid #CED2E9; border-radius: 12px; display: block; box-sizing: border-box; width: 100%; min-height: fit-content;">
                        <h4 style="font-size: 14px; font-weight: 700; color: #0D0F1C; margin: 0; margin-bottom: 6px;">{{ __('Sponsor Account') }}</h4>
                        <p style="font-size: 12px; color: #666666; margin: 0; line-height: 1.6;">
                            {{ __('Dedicated to companies, investors, and organizations that wish to support emerging talents, manage donations, validate certifications, and promote innovation in various industrial and artistic fields.') }}
                        </p>
                    </div>
                </div>
            </section>

            {{-- Section 3: User Conduct --}}
            <section style="display: block; margin-bottom: 24px; border-bottom: 1px solid #F0F2F9; padding-bottom: 24px;" id="sec-conduct">
                <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 12px;">
                    <span style="display: inline-flex; align-items: center; justify-content: center; width: 28px; height: 28px; border-radius: 8px; background-color: #EBF0FF; color: #607AFB; font-weight: bold; font-size: 13px; shrink: 0;">3</span>
                    <h2 style="font-size: 18px; font-weight: 700; color: #0D0F1C; margin: 0;">{{ __('User Conduct') }}</h2>
                </div>
                <p style="font-size: 14px; color: #555555; line-height: 1.6; margin: 0; padding-left: 40px; box-sizing: border-box; margin-bottom: 12px;">
                    {{ __('You agree to use Ushine solely for lawful purposes and in compliance with applicable laws. It is strictly prohibited to:') }}
                </p>
                <ul style="list-style-type: disc; margin: 0; padding-left: 64px; font-size: 13px; color: #555555; box-sizing: border-box;">
                    <li style="margin-bottom: 8px; line-height: 1.5;">{{ __('Upload or share unlawful, defamatory, offensive, threatening, or intellectual property-infringing content.') }}</li>
                    <li style="margin-bottom: 8px; line-height: 1.5;">{{ __('Attempt to bypass security systems, gather sensitive data fraudulently, or use automated scripts to interact with our services.') }}</li>
                    <li style="margin-bottom: 0; line-height: 1.5;">{{ __('Sponsor fake projects or mislead investors regarding the actual state of your skills and milestones.') }}</li>
                </ul>
            </section>

            {{-- Section 4: Sponsorships & Donations --}}
            <section style="display: block; margin-bottom: 24px; border-bottom: 1px solid #F0F2F9; padding-bottom: 24px;" id="sec-donations">
                <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 12px;">
                    <span style="display: inline-flex; align-items: center; justify-content: center; width: 28px; height: 28px; border-radius: 8px; background-color: #EBF0FF; color: #607AFB; font-weight: bold; font-size: 13px; shrink: 0;">4</span>
                    <h2 style="font-size: 18px; font-weight: 700; color: #0D0F1C; margin: 0;">{{ __('Donations and Sponsorships') }}</h2>
                </div>
                <p style="font-size: 14px; color: #555555; line-height: 1.6; margin: 0; padding-left: 40px; box-sizing: border-box;">
                    {{ __("All transactions, donations, and sponsorship agreements concluded between Sponsors and Talents take place directly under the parties' responsibility. Ushine solely provides the technological infrastructure and does not guarantee the success or return on any investments made.") }}
                </p>
            </section>

            {{-- Section 5: Intellectual Property --}}
            <section style="display: block; margin-bottom: 24px; border-bottom: 1px solid #F0F2F9; padding-bottom: 24px;" id="sec-property">
                <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 12px;">
                    <span style="display: inline-flex; align-items: center; justify-content: center; width: 28px; height: 28px; border-radius: 8px; background-color: #EBF0FF; color: #607AFB; font-weight: bold; font-size: 13px; shrink: 0;">5</span>
                    <h2 style="font-size: 18px; font-weight: 700; color: #0D0F1C; margin: 0;">{{ __('Intellectual Property') }}</h2>
                </div>
                <p style="font-size: 14px; color: #555555; line-height: 1.6; margin: 0; padding-left: 40px; box-sizing: border-box;">
                    {{ __('All materials on the Service (excluding content uploaded by users), including source code, databases, features, website design, text, and graphics, are the exclusive property of Ushine and are protected by copyright and trademark laws.') }}
                </p>
            </section>

            {{-- Section 6: Account Termination --}}
            <section style="display: block; margin-bottom: 0;" id="sec-termination">
                <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 12px;">
                    <span style="display: inline-flex; align-items: center; justify-content: center; width: 28px; height: 28px; border-radius: 8px; background-color: #EBF0FF; color: #607AFB; font-weight: bold; font-size: 13px; shrink: 0;">6</span>
                    <h2 style="font-size: 18px; font-weight: 700; color: #0D0F1C; margin: 0;">{{ __('Account Termination') }}</h2>
                </div>
                <p style="font-size: 14px; color: #555555; line-height: 1.6; margin: 0; padding-left: 40px; box-sizing: border-box;">
                    {{ __('We reserve the right to suspend, limit, or permanently terminate your account at any time, without prior notice and at our discretion, in the event of any proven or suspected violation of our contractual terms or community rules.') }}
                </p>
            </section>

        </div>

        {{-- Premium Card Footer Action --}}
        <div style="background-color: #F8F9FC; border-top: 1px solid #CED2E9; padding: 20px 32px; display: flex; align-items: center; justify-content: space-between; gap: 16px; flex-wrap: wrap; box-sizing: border-box;">
            <span style="font-size: 12px; color: #666666; font-weight: 500; font-family: sans-serif;">
                © 2026 Ushine Inc. {{ __('All rights reserved.') }}
            </span>
            <div class="flex gap-4">
                <button type="button" onclick="acceptAndRedirect()" style="padding: 10px 24px; font-size: 14px; font-weight: 700; color: #ffffff; background-color: #607AFB; border: none; border-radius: 10px; cursor: pointer; transition: background-color 0.2s, transform 0.1s; box-shadow: 0 4px 6px -1px rgba(96, 122, 251, 0.2); font-family: sans-serif; display: inline-flex; align-items: center; justify-content: center; select-none: none; outline: none;" onmouseover="this.style.backgroundColor='#4A5FD0'" onmouseout="this.style.backgroundColor='#607AFB'">
                    {{ __('Accept and Continue') }}
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

<script>
    function acceptAndRedirect() {
        window.location.href = "{{ route('register') }}?accepted=1";
    }
</script>
@endsection
