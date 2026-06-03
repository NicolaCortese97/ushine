@extends('layouts.guest')

@section('content')
<div class="min-h-screen bg-base-100 font-sans text-base-content">
    
    <!-- Header -->
    <header class="bg-base-100 border-b border-base-200 sticky top-0 z-50" style="height: 64px; line-height: 64px;">
        <div class="max-w-full mx-auto px-4" style="height: 100%; display: flex; align-items: center; justify-content: space-between; position: relative;">
            
            <!-- Left Side: Back button -->
            <div style="display: flex; align-items: center; height: 100%;">
                <a href="{{ route('homepage') }}" class="hover:bg-base-200 text-base-content" style="display: inline-flex; align-items: center; justify-content: center; width: 40px; height: 40px; border-radius: 50%; transition: background-color 0.2s ease; text-decoration: none; color: inherit;">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" style="width: 24px; height: 24px;">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                </a>
            </div>
            
            <!-- Center Title: Centered with absolute positioning to prevent vertical/horizontal offsets -->
            <div style="position: absolute; left: 50%; top: 50%; transform: translate(-50%, -50%); pointer-events: none; max-width: 60%; width: auto; display: flex; align-items: center; justify-content: center; height: 100%;">
                <h1 class="text-xl font-bold text-base-content" style="margin: 0; padding: 0; line-height: 1; text-align: center; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; pointer-events: auto;">{{ __('Leaderboard') }}</h1>
            </div>
            
            <!-- Right Side: Refresh button -->
            <div style="display: flex; align-items: center; justify-content: flex-end; height: 100%;">
                <button onclick="window.location.reload();" class="hover:bg-base-200 text-base-content" style="display: inline-flex; align-items: center; justify-content: center; width: 40px; height: 40px; border-radius: 50%; transition: background-color 0.2s ease; border: none; background: none; cursor: pointer; color: inherit; outline: none;">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" fill="currentColor" class="w-6 h-6 text-base-content" style="width: 22px; height: 22px;">
                        <path d="M240,56v48a8,8,0,0,1-8,8H184a8,8,0,0,1,0-16H211.4L184.81,71.64l-.25-.24a80,80,0,1,0-1.67,114.78,8,8,0,0,1,11,11.63A95.44,95.44,0,0,1,128,224h-1.32A96,96,0,1,1,195.75,60L224,85.8V56a8,8,0,1,1,16,0Z"/>
                    </svg>
                </button>
            </div>
            
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-4 py-6" x-data="{ tab: 'talents' }">
        
        <!-- Tabs Toggles -->
        <div class="leaderboard-tabs-wrapper border-b border-base-200 mb-6">
            <div class="flex w-full">
                <button @click="tab = 'talents'" class="tab-btn flex-1 py-4 flex flex-col items-center justify-center outline-none border-none bg-transparent cursor-pointer">
                    <span class="tab-text font-bold text-[15px]" :class="tab === 'talents' ? 'text-base-content' : 'text-base-content/40'">{{ __('Talents') }}</span>
                    <span class="tab-indicator text-[8px] mt-1 text-base-content transition-opacity duration-200" :style="tab === 'talents' ? 'opacity: 1;' : 'opacity: 0;'">▼</span>
                </button>
                <button @click="tab = 'sponsors'" class="tab-btn flex-1 py-4 flex flex-col items-center justify-center outline-none border-none bg-transparent cursor-pointer">
                    <span class="tab-text font-bold text-[15px]" :class="tab === 'sponsors' ? 'text-base-content' : 'text-base-content/40'">{{ __('Sponsor') }}</span>
                    <span class="tab-indicator text-[8px] mt-1 text-base-content transition-opacity duration-200" :style="tab === 'sponsors' ? 'opacity: 1;' : 'opacity: 0;'">▼</span>
                </button>
            </div>
        </div>

        <!-- Lists Area -->
        <div class="leaderboard-content-area">
            
            <!-- Talents List -->
            <div x-show="tab === 'talents'" class="space-y-3">
                @if($talents->isEmpty())
                    <div class="text-center py-12 text-base-content/50">
                        <p>{{ __('No talents registered yet.') }}</p>
                    </div>
                @else
                    @foreach($talents as $talent)
                        @php
                            $initials = strtoupper(substr($talent->name, 0, 1));
                            if ($talent->cognome) {
                                $initials .= strtoupper(substr($talent->cognome, 0, 1));
                                if (preg_match('/(\d+)$/', $talent->cognome, $matches)) {
                                    $initials .= $matches[1];
                                }
                            }
                        @endphp
                        <div class="rank-pill-row">
                            <!-- Left: Rank & Avatar & User Info -->
                            <div class="flex items-center gap-4">
                                <span class="rank-idx font-bold text-[14px]">#{{ $loop->iteration }}</span>
                                <div class="avatar-circle-pill flex items-center justify-center font-bold text-white text-[13px] bg-primary">
                                    {{ $initials }}
                                </div>
                                <div class="flex flex-col">
                                    <span class="font-bold text-[15px] text-base-content">{{ $talent->name }} {{ $talent->cognome }}</span>
                                    <span class="text-xs text-base-content/60 mt-0.5">{{ $talent->categories->first()?->name ?? __('No category') }}</span>
                                </div>
                            </div>

                            <!-- Right: Medal & XP -->
                            <div class="flex items-center gap-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2" class="text-base-content/60">
                                    <circle cx="12" cy="8" r="6"></circle>
                                    <path d="M15.47 14L19 21l-7-3-7 3 3.53-7"></path>
                                </svg>
                                <span class="font-bold text-[14px] text-base-content">{{ $talent->xp_points }} XP</span>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>

            <!-- Sponsors List -->
            <div x-show="tab === 'sponsors'" class="space-y-3" style="display: none;">
                @if($sponsors->isEmpty())
                    <div class="text-center py-12 text-base-content/50">
                        <p>{{ __('No sponsors registered yet.') }}</p>
                    </div>
                @else
                    @foreach($sponsors as $sponsor)
                        @php
                            $initials = strtoupper(substr($sponsor->name, 0, 1));
                            if ($sponsor->cognome) {
                                $initials .= strtoupper(substr($sponsor->cognome, 0, 1));
                                if (preg_match('/(\d+)$/', $sponsor->cognome, $matches)) {
                                    $initials .= $matches[1];
                                }
                            }
                        @endphp
                        <div class="rank-pill-row">
                            <!-- Left: Rank & Avatar & User Info -->
                            <div class="flex items-center gap-4">
                                <span class="rank-idx font-bold text-[14px]">#{{ $loop->iteration }}</span>
                                <div class="avatar-circle-pill flex items-center justify-center font-bold text-white text-[13px]" style="background-color: #10b981;">
                                    {{ $initials }}
                                </div>
                                <div class="flex flex-col">
                                    <span class="font-bold text-[15px] text-base-content">{{ $sponsor->name }} {{ $sponsor->cognome }}</span>
                                    <span class="text-xs text-base-content/60 mt-0.5">{{ __('Sponsor') }}</span>
                                </div>
                            </div>

                            <!-- Right: Medal & XP -->
                            <div class="flex items-center gap-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2" class="text-base-content/60">
                                    <circle cx="12" cy="8" r="6"></circle>
                                    <path d="M15.47 14L19 21l-7-3-7 3 3.53-7"></path>
                                </svg>
                                <span class="font-bold text-[14px] text-base-content">{{ $sponsor->xp_donati_totali }} XP</span>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>

        </div>

    </main>
</div>

<style>
    /* Styling Rank Rows as Pill Cards matching the screenshot */
    .rank-pill-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 14px 24px;
        background-color: #F3F4F6;
        border-radius: 9999px;
        transition: transform 0.2s ease, background-color 0.2s ease;
    }
    
    .rank-pill-row:hover {
        transform: translateY(-1px);
        background-color: #E5E7EB;
    }

    .avatar-circle-pill {
        width: 42px;
        height: 42px;
        border-radius: 50%;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
    }

    .rank-idx {
        color: #4b5563;
        width: 24px;
        text-align: center;
    }

    /* Dark Mode Styling */
    :is(.dark, [data-theme="dark"]) .rank-pill-row {
        background-color: #1f2937;
    }
    
    :is(.dark, [data-theme="dark"]) .rank-pill-row:hover {
        background-color: #374151;
    }

    :is(.dark, [data-theme="dark"]) .rank-idx {
        color: #9ca3af;
    }
</style>
@endsection
