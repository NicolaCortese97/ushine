@if($talents->isEmpty())
    <div style="background:#f9f9f9; border:1px solid #e0e0e0; border-radius:12px; padding:48px; text-align:center; color:#666; margin-bottom: 40px;">
        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="#9ca3af" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" style="margin: 0 auto 16px auto;">
            <circle cx="11" cy="11" r="8"></circle>
            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
        </svg>
        <p style="font-size: 16px; font-weight: 700; color: #1a1a1a;">No talents found</p>
        <p style="font-size: 14px; margin-top: 4px;">Try adjusting your keyword or category filters.</p>
    </div>
@else
    <div class="talents-grid">
        @foreach($talents as $talent)
            <div class="talent-card">
                @if($talent->foto_profilo)
                    <img src="{{ $talent->foto_profilo }}" class="talent-avatar" alt="{{ $talent->name }}">
                @else
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($talent->name) }}&background=random" class="talent-avatar" alt="{{ $talent->name }}">
                @endif
                
                <h3 class="talent-name">{{ $talent->name }} {{ $talent->cognome }}</h3>
                <p class="talent-level">Level {{ $talent->level ?? 1 }}</p>
                
                <div class="category-badges">
                    @foreach($talent->categories as $cat)
                        <span class="category-badge">{{ $cat->name }}</span>
                    @endforeach
                </div>
                
                <a href="{{ route('profileInfo') }}" class="view-profile-btn">View Profile</a>
            </div>
        @endforeach
    </div>

    @if($talents->hasPages())
        <div class="ajax-pagination" style="margin-top:24px; margin-bottom: 40px; display:flex; justify-content:center;">
            {{ $talents->links() }}
        </div>
    @endif
@endif
