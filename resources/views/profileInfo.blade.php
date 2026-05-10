@extends('layouts.app')

@section('content')
@php
    $user = auth()->user();
@endphp

<div class="space-y-6">
    <!-- Welcome Section -->
    <div>
        <h1 class="text-2xl md:text-3xl font-bold">Welcome back, {{ $user->name }}!</h1>
        <p class="text-base-content/60 mt-1">You are a {{ strtoupper($user->tipo_utente ?? 'Talent') }}</p>
    </div>

        <!-- User Info Card / Profile Information -->
    <div class="card bg-base-100 shadow-xl">
        <div class="card-body">
            <h2 class="card-title text-lg">Contacts</h2>
            <div class="space-y-2 mt-4">
                <!-- <div class="flex flex-wrap">
                    <div class="w-24 font-semibold text-base-content/60">Name:</div>
                    <div>{{ $user->name }} {{ $user->cognome }}</div>
                </div> -->
                <div class="flex flex-wrap">
                    <div class="w-24 font-semibold text-base-content/60">Email:</div>
                    <div>{{ $user->email }}</div>
                </div>
                <div class="flex flex-wrap">
                    <div class="w-24 font-semibold text-base-content/60">Phone:</div>
                    <div>{{ $user->prefisso_internazionale ?? '' }}{{ $user->telefono }}</div>
                </div>
                <div class="flex flex-wrap">
                    <div class="w-24 font-semibold text-base-content/60">Joined:</div>
                    <div>{{ $user->created_at->format('d/m/Y') }}</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bio Card (stile post con HTML preservato) -->
    @if($user->bio && trim($user->bio) != '')
    <div class="card bg-base-100 shadow-xl">
        <div class="card-body">
            <div class="flex items-center gap-3">
                <div class="avatar">
                    <div class="w-10 rounded-full">
                        @if($user->foto_profilo)
                            <img src="{{ $user->foto_profilo }}" alt="Avatar">
                        @else
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=random" alt="Avatar">
                        @endif
                    </div>
                </div>
                <div>
                    <h3 class="font-semibold">{{ $user->name }} {{ $user->cognome }}</h3>
                    <p class="text-xs text-base-content/50">Bio personale</p>
                </div>
            </div>
            <div class="mt-3 prose prose-sm max-w-none bio-html-content">
                {!! $user->bio !!}
            </div>
        </div>
    </div>
    @endif


    <!-- Statistics Section (XP, Rank, Level - in riquadri separati orizzontali) -->
    <div>
        <h2 class="text-lg font-bold mb-4">Statistics</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <!-- XP Points Card -->
            <div class="card bg-base-100 shadow-xl text-center">
                <div class="card-body">
                    <div class="flex justify-center mb-2">
                        <i class="fas fa-star text-4xl text-primary"></i>
                    </div>
                    <h3 class="text-sm font-semibold text-base-content/60 uppercase tracking-wide">XP Points</h3>
                    <p class="text-3xl font-bold text-primary">{{ $user->xp_points ?? 0 }}</p>
                    <p class="text-xs text-base-content/50">Total earned points</p>
                </div>
            </div>
            
            <!-- Rank Card -->
            <div class="card bg-base-100 shadow-xl text-center">
                <div class="card-body">
                    <div class="flex justify-center mb-2">
                        <i class="fas fa-trophy text-4xl text-secondary"></i>
                    </div>
                    <h3 class="text-sm font-semibold text-base-content/60 uppercase tracking-wide">Rank</h3>
                    <p class="text-3xl font-bold text-secondary">{{ $user->rank ?? '#1' }}</p>
                    <p class="text-xs text-base-content/50">Global position</p>
                </div>
            </div>
            
            <!-- Level Card -->
            <div class="card bg-base-100 shadow-xl text-center">
                <div class="card-body">
                    <div class="flex justify-center mb-2">
                        <i class="fas fa-chart-line text-4xl text-info"></i>
                    </div>
                    <h3 class="text-sm font-semibold text-base-content/60 uppercase tracking-wide">Level</h3>
                    <p class="text-3xl font-bold text-info">{{ $user->level ?? 1 }}</p>
                    <p class="text-xs text-base-content/50">Current level</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection