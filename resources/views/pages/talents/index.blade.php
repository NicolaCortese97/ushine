@extends('layouts.app')

@section('content')
<style>
    .talents-container {
        max-width: 1200px;
        margin: 0 auto;
        padding-top: 10px;
    }
    .talents-header {
        text-align: center;
        margin-bottom: 32px;
    }
    .talents-header h1 {
        font-size: 32px;
        font-weight: 800;
        color: #1a1a1a;
        margin-bottom: 8px;
    }
    .talents-header p {
        font-size: 16px;
        color: #666;
    }
    .search-card {
        background: #f5f5f5;
        border: 1px solid #e0e0e0;
        border-radius: 12px;
        padding: 24px;
        margin-bottom: 40px;
    }
    .search-form {
        display: flex;
        gap: 16px;
        align-items: center;
        flex-wrap: wrap;
    }
    .search-input-wrapper {
        flex: 1;
        min-width: 250px;
        position: relative;
    }
    .search-input {
        width: 100%;
        background: #fff;
        border: 1px solid #ccc;
        border-radius: 8px;
        padding: 12px 16px 12px 40px;
        font-size: 14px;
        outline: none;
        transition: border-color 0.2s;
        color: #333;
    }
    .search-input:focus {
        border-color: #3b82f6;
    }
    .search-icon {
        position: absolute;
        left: 14px;
        top: 50%;
        transform: translateY(-50%);
        color: #888;
    }
    .category-select {
        background: #fff;
        border: 1px solid #ccc;
        border-radius: 8px;
        padding: 12px 16px;
        font-size: 14px;
        outline: none;
        min-width: 200px;
        cursor: pointer;
        color: #333;
    }
    .search-btn {
        background: #3b82f6;
        color: #fff;
        font-weight: 600;
        padding: 12px 24px;
        border-radius: 8px;
        border: none;
        cursor: pointer;
        transition: background 0.2s;
    }
    .search-btn:hover {
        background: #2563eb;
    }
    .clear-btn {
        background: #e5e7eb;
        color: #374151;
        font-weight: 600;
        padding: 12px 20px;
        border-radius: 8px;
        border: 1px solid #d1d5db;
        cursor: pointer;
        text-decoration: none;
        text-align: center;
        transition: background 0.2s;
    }
    .clear-btn:hover {
        background: #d1d5db;
    }
    
    .section-title {
        font-size: 22px;
        font-weight: 800;
        color: #1a1a1a;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    /* Trending Carousel Wrapper & Controls */
    .trending-carousel-wrapper {
        position: relative;
        width: 100%;
        margin-bottom: 40px;
    }
    .trending-scroll-container {
        display: flex;
        gap: 24px;
        overflow-x: auto;
        padding: 12px 4px 24px 4px;
        scrollbar-width: none; /* Firefox */
        -ms-overflow-style: none;  /* IE and Edge */
        scroll-behavior: smooth;
        width: 100%;
    }
    .trending-scroll-container::-webkit-scrollbar {
        display: none; /* Chrome, Safari, Opera */
    }
    
    .carousel-nav-btn {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        width: 44px;
        height: 44px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.95);
        border: 1px solid #e2e8f0;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        z-index: 10;
        transition: all 0.2s ease-in-out;
        color: #3b82f6;
        opacity: 0;
        pointer-events: none;
    }
    .carousel-nav-btn:hover {
        background: #fff;
        color: #2563eb;
        box-shadow: 0 6px 14px rgba(0, 0, 0, 0.15);
        transform: translateY(-50%) scale(1.05);
    }
    .carousel-nav-btn.left {
        left: -16px;
    }
    .carousel-nav-btn.right {
        right: -16px;
    }
    .trending-carousel-wrapper:hover .carousel-nav-btn {
        opacity: 1;
        pointer-events: auto;
    }
    @media (max-width: 768px) {
        .carousel-nav-btn {
            display: none;
        }
    }

    /* Skeleton Loading Effects */
    .skeleton-grid {
        display: grid;
        grid-template-cols: repeat(auto-fill, minmax(260px, 1fr));
        gap: 20px;
        margin-bottom: 32px;
    }
    .skeleton-card {
        background: #f9f9f9;
        border: 1px solid #e0e0e0;
        border-radius: 12px;
        padding: 20px;
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        height: 258px;
        position: relative;
        overflow: hidden;
    }
    .skeleton-pulse {
        background: linear-gradient(90deg, #f3f4f6 25%, #e5e7eb 50%, #f3f4f6 75%);
        background-size: 200% 100%;
        animation: pulse-shimmer 1.5s infinite;
        border-radius: 4px;
    }
    .skeleton-avatar {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        margin-bottom: 16px;
    }
    .skeleton-title {
        width: 140px;
        height: 18px;
        margin-bottom: 8px;
    }
    .skeleton-subtitle {
        width: 80px;
        height: 14px;
        margin-bottom: 16px;
    }
    .skeleton-badge {
        width: 60px;
        height: 20px;
        border-radius: 999px;
        margin: 0 4px 16px 4px;
    }
    .skeleton-btn {
        width: 100%;
        height: 32px;
        margin-top: auto;
        border-radius: 6px;
    }
    @keyframes pulse-shimmer {
        0% {
            background-position: 200% 0;
        }
        100% {
            background-position: -200% 0;
        }
    }
    .featured-card {
        flex: 0 0 280px;
        min-width: 280px;
        background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%);
        border: 2px solid #93c5fd;
        border-radius: 16px;
        padding: 24px;
        position: relative;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        box-shadow: 0 4px 12px rgba(59, 130, 246, 0.1);
    }
    .featured-badge {
        position: absolute;
        top: 12px;
        right: 12px;
        background: #3b82f6;
        color: #fff;
        font-size: 11px;
        font-weight: 700;
        padding: 4px 10px;
        border-radius: 999px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    /* General Talents Grid */
    .talents-grid {
        display: grid;
        grid-template-cols: repeat(auto-fill, minmax(260px, 1fr));
        gap: 20px;
        margin-bottom: 32px;
    }
    .talent-card {
        background: #f9f9f9;
        border: 1px solid #e0e0e0;
        border-radius: 12px;
        padding: 20px;
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        transition: transform 0.2s, box-shadow 0.2s;
    }
    .talent-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(0,0,0,0.05);
    }

    .talent-avatar {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid #fff;
        box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    }
    .featured-avatar {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid #fff;
        box-shadow: 0 4px 10px rgba(59, 130, 246, 0.2);
    }
    
    .talent-name {
        font-size: 16px;
        font-weight: 700;
        color: #1a1a1a;
        margin-top: 12px;
        margin-bottom: 2px;
    }
    .featured-name {
        font-size: 18px;
        font-weight: 800;
        color: #1e3a8a;
        margin-top: 14px;
        margin-bottom: 4px;
    }
    
    .talent-level {
        font-size: 12px;
        font-weight: 600;
        color: #555;
        margin-bottom: 12px;
    }

    .category-badges {
        display: flex;
        flex-wrap: wrap;
        gap: 6px;
        justify-content: center;
        margin-bottom: 16px;
        min-height: 24px;
    }
    .category-badge {
        background: #e2e8f0;
        color: #475569;
        font-size: 11px;
        font-weight: 600;
        padding: 2px 8px;
        border-radius: 999px;
    }
    .featured-category-badge {
        background: #dbeafe;
        color: #1e40af;
        font-size: 11px;
        font-weight: 700;
        padding: 2px 8px;
        border-radius: 999px;
    }

    .view-profile-btn {
        display: block;
        width: 100%;
        padding: 8px 16px;
        background: #fff;
        border: 1px solid #ccc;
        color: #374151;
        font-size: 12px;
        font-weight: 700;
        border-radius: 6px;
        text-decoration: none;
        margin-top: auto;
        transition: background 0.2s, border-color 0.2s;
    }
    .view-profile-btn:hover {
        background: #f3f4f6;
        border-color: #9ca3af;
    }
    
    .featured-profile-btn {
        display: block;
        width: 100%;
        padding: 10px 16px;
        background: #3b82f6;
        color: #fff;
        font-size: 12px;
        font-weight: 700;
        border-radius: 6px;
        text-decoration: none;
        margin-top: auto;
        transition: background 0.2s;
    }
    .featured-profile-btn:hover {
        background: #2563eb;
    }
</style>

<div class="talents-container">
    {{-- Header --}}
    <div class="talents-header">
        <h1>Discover Talents</h1>
        <p>Find and connect with outstanding talents on Ushine</p>
    </div>

    {{-- Search Form --}}
    <div class="search-card">
        <form method="GET" id="talents-search-form" action="{{ route('talents.index') }}" class="search-form">
            <div class="search-input-wrapper">
                <svg class="search-icon" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                </svg>
                <input type="text" name="q" id="search-q" value="{{ request('q') }}" class="search-input" placeholder="Search by name, surname, or bio...">
            </div>
            
            <select name="category_id" id="search-category" class="category-select">
                <option value="">All Categories</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>
            
            <button type="submit" class="search-btn">Search</button>
            
            <a href="{{ route('talents.index') }}" id="clear-search-btn" class="clear-btn" style="display: {{ request()->anyFilled(['q', 'category_id']) ? 'inline-block' : 'none' }};">Clear</a>
        </form>
    </div>

    @php
        $isSearching = request()->anyFilled(['q', 'category_id']);
    @endphp

    {{-- Flex container to manage sections ordering dynamically via JS/CSS --}}
    <div id="talents-sections-wrapper" style="display: flex; flex-direction: column;">
        
        {{-- 1. SEARCH RESULTS SECTION --}}
        <div id="search-results-section" style="order: 1; display: {{ $isSearching ? 'block' : 'none' }}; margin-bottom: 40px;">
            <h2 class="section-title">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#3b82f6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                Search Results
            </h2>
            
            <div id="talents-grid-container">
                @if($isSearching)
                    @include('pages.talents.partials.grid')
                @endif
            </div>
        </div>

        {{-- 2. TRENDING TALENTS SECTION --}}
        <div id="trending-section" style="order: {{ $isSearching ? '2' : '0' }}; margin-bottom: 40px;">
            <h2 class="section-title">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#f59e0b" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                Trending Talents (Most Viewed)
            </h2>
            
            <div class="trending-carousel-wrapper">
                {{-- Navigation Buttons --}}
                <button type="button" class="carousel-nav-btn left" id="carousel-prev" aria-label="Previous">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"></polyline></svg>
                </button>
                <button type="button" class="carousel-nav-btn right" id="carousel-next" aria-label="Next">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>
                </button>

                <div class="trending-scroll-container" id="trending-scroll-container">
                    {{-- Fake Talent 1 --}}
                    <div class="featured-card">
                        <div style="width: 100px; height: 100px; border-radius: 50%; background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%); color: #fff; display: flex; align-items: center; justify-content: center; font-size: 28px; font-weight: 800; border: 3px solid #fff; box-shadow: 0 4px 10px rgba(0,0,0,0.1); flex-shrink: 0;">
                            GM
                        </div>
                        <h3 class="featured-name">Gabriele Moretti</h3>
                        <p class="talent-level">Level 14 &bull; <span style="color:#1d4ed8; font-weight:700;">24.8k views</span></p>
                        <div class="category-badges">
                            <span class="featured-category-badge">Danza Classica</span>
                        </div>
                        <p style="font-size: 12px; color: #1e3a8a; line-height: 1.5; margin-bottom: 16px; min-height: 54px;">"Ballerino solista con esperienze internazionali. Esprimere l'invisibile attraverso il movimento."</p>
                        <a href="{{ route('profileInfo') }}" class="featured-profile-btn">View Profile</a>
                    </div>

                    {{-- Fake Talent 2 --}}
                    <div class="featured-card">
                        <div style="width: 100px; height: 100px; border-radius: 50%; background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%); color: #fff; display: flex; align-items: center; justify-content: center; font-size: 28px; font-weight: 800; border: 3px solid #fff; box-shadow: 0 4px 10px rgba(0,0,0,0.1); flex-shrink: 0;">
                            FL
                        </div>
                        <h3 class="featured-name">Francesca Leone</h3>
                        <p class="talent-level">Level 12 &bull; <span style="color:#1d4ed8; font-weight:700;">18.2k views</span></p>
                        <div class="category-badges">
                            <span class="featured-category-badge">Canto & Musica</span>
                        </div>
                        <p style="font-size: 12px; color: #1e3a8a; line-height: 1.5; margin-bottom: 16px; min-height: 54px;">"Cantautrice e pianista jazz. Le note raccontano storie che le parole non sanno dire."</p>
                        <a href="{{ route('profileInfo') }}" class="featured-profile-btn">View Profile</a>
                    </div>

                    {{-- Fake Talent 3 --}}
                    <div class="featured-card">
                        <div style="width: 100px; height: 100px; border-radius: 50%; background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%); color: #fff; display: flex; align-items: center; justify-content: center; font-size: 28px; font-weight: 800; border: 3px solid #fff; box-shadow: 0 4px 10px rgba(0,0,0,0.1); flex-shrink: 0;">
                            VE
                        </div>
                        <h3 class="featured-name">Valerio Esposito</h3>
                        <p class="talent-level">Level 15 &bull; <span style="color:#1d4ed8; font-weight:700;">31.5k views</span></p>
                        <div class="category-badges">
                            <span class="featured-category-badge">Sport</span>
                        </div>
                        <p style="font-size: 12px; color: #1e3a8a; line-height: 1.5; margin-bottom: 16px; min-height: 54px;">"Ginnasta agonista. Determinazione ferrea, costanza e il sogno delle Olimpiadi nel quale."</p>
                        <a href="{{ route('profileInfo') }}" class="featured-profile-btn">View Profile</a>
                    </div>

                    {{-- Fake Talent 4 --}}
                    <div class="featured-card">
                        <div style="width: 100px; height: 100px; border-radius: 50%; background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%); color: #fff; display: flex; align-items: center; justify-content: center; font-size: 28px; font-weight: 800; border: 3px solid #fff; box-shadow: 0 4px 10px rgba(0,0,0,0.1); flex-shrink: 0;">
                            BR
                        </div>
                        <h3 class="featured-name">Beatrice Romano</h3>
                        <p class="talent-level">Level 11 &bull; <span style="color:#1d4ed8; font-weight:700;">15.9k views</span></p>
                        <div class="category-badges">
                            <span class="featured-category-badge">Recitazione</span>
                        </div>
                        <p style="font-size: 12px; color: #1e3a8a; line-height: 1.5; margin-bottom: 16px; min-height: 54px;">"Attrice di teatro e cortometraggi. Amo dare vita a personaggi complessi e intensi."</p>
                        <a href="{{ route('profileInfo') }}" class="featured-profile-btn">View Profile</a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchForm = document.getElementById('talents-search-form');
    const searchInput = document.getElementById('search-q');
    const categorySelect = document.getElementById('search-category');
    const clearBtn = document.getElementById('clear-search-btn');
    
    const wrapper = document.getElementById('talents-sections-wrapper');
    const searchResultsSection = document.getElementById('search-results-section');
    const trendingSection = document.getElementById('trending-section');
    const gridContainer = document.getElementById('talents-grid-container');
    
    // Carousel controls
    const scrollContainer = document.getElementById('trending-scroll-container');
    const prevBtn = document.getElementById('carousel-prev');
    const nextBtn = document.getElementById('carousel-next');
    
    if (scrollContainer && prevBtn && nextBtn) {
        prevBtn.addEventListener('click', () => {
            scrollContainer.scrollBy({ left: -304, behavior: 'smooth' });
        });
        nextBtn.addEventListener('click', () => {
            scrollContainer.scrollBy({ left: 304, behavior: 'smooth' });
        });
    }
    
    let debounceTimer;
    
    // Skeleton loader HTML (simulates 3 cards)
    const skeletonHtml = `
        <div class="skeleton-grid">
            ${Array(3).fill(`
                <div class="skeleton-card">
                    <div class="skeleton-avatar skeleton-pulse"></div>
                    <div class="skeleton-title skeleton-pulse"></div>
                    <div class="skeleton-subtitle skeleton-pulse"></div>
                    <div style="display:flex; justify-content:center;">
                        <div class="skeleton-badge skeleton-pulse"></div>
                    </div>
                    <div class="skeleton-btn skeleton-pulse"></div>
                </div>
            `).join('')}
        </div>
    `;

    function updateLayoutState() {
        const qVal = searchInput.value.trim();
        const catVal = categorySelect.value;
        const isFilled = qVal.length > 0 || catVal.length > 0;
        
        if (isFilled) {
            searchResultsSection.style.display = 'block';
            trendingSection.style.order = '2';
            clearBtn.style.display = 'inline-block';
        } else {
            searchResultsSection.style.display = 'none';
            trendingSection.style.order = '0';
            clearBtn.style.display = 'none';
            gridContainer.innerHTML = '';
        }
    }
    
    function fetchResults() {
        const qVal = searchInput.value.trim();
        const catVal = categorySelect.value;
        
        if (qVal.length === 0 && catVal.length === 0) {
            // URL Sync back to default
            const url = new URL(window.location);
            url.searchParams.delete('q');
            url.searchParams.delete('category_id');
            url.searchParams.delete('page');
            window.history.replaceState({}, '', url);
            return;
        }
        
        // Show Skeleton Loader
        gridContainer.innerHTML = skeletonHtml;
        
        // Update URL dynamically
        const url = new URL(window.location);
        if (qVal) url.searchParams.set('q', qVal); else url.searchParams.delete('q');
        if (catVal) url.searchParams.set('category_id', catVal); else url.searchParams.delete('category_id');
        url.searchParams.delete('page'); // reset page on typing new query
        window.history.replaceState({}, '', url);
        
        // Fetch via AJAX
        fetch(url.toString(), {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.text())
        .then(html => {
            gridContainer.innerHTML = html;
            attachPaginationListeners();
        })
        .catch(err => {
            console.error('Search failed:', err);
            gridContainer.innerHTML = `
                <div style="background:#f9f9f9; border:1px solid #e0e0e0; border-radius:12px; padding:48px; text-align:center; color:#ef4444; margin-bottom: 40px; font-weight:700;">
                    Failed to fetch search results. Please try again.
                </div>
            `;
        });
    }
    
    function attachPaginationListeners() {
        const paginationLinks = gridContainer.querySelectorAll('.ajax-pagination a');
        paginationLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const targetUrl = new URL(this.href);
                
                // Show Skeleton Loader
                gridContainer.innerHTML = skeletonHtml;
                
                // Smooth scroll to top of search results
                searchResultsSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
                
                // Fetch page results
                fetch(targetUrl.toString(), {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => response.text())
                .then(html => {
                    gridContainer.innerHTML = html;
                    attachPaginationListeners();
                    // Sync URL page parameter
                    window.history.pushState({}, '', targetUrl.toString());
                })
                .catch(err => {
                    console.error('Pagination load failed:', err);
                });
            });
        });
    }
    
    function debounceSearch() {
        clearTimeout(debounceTimer);
        updateLayoutState();
        if (searchInput.value.trim().length > 0 || categorySelect.value.length > 0) {
            debounceTimer = setTimeout(fetchResults, 250);
        }
    }
    
    // Event listeners
    searchInput.addEventListener('input', debounceSearch);
    categorySelect.addEventListener('change', () => {
        updateLayoutState();
        fetchResults();
    });
    
    // Prevent default form submit so page doesn't reload, but still perform search
    searchForm.addEventListener('submit', function(e) {
        e.preventDefault();
        updateLayoutState();
        fetchResults();
    });
    
    // Auto focus search input if page is opened via header click (focus=1 parameter)
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get('focus') === '1') {
        searchInput.focus();
        // Remove focus parameter from URL cleanly to keep it clean
        urlParams.delete('focus');
        const cleanUrl = window.location.pathname + (urlParams.toString() ? '?' + urlParams.toString() : '');
        window.history.replaceState({}, '', cleanUrl);
    }

    // Initial binding for pagination if preloaded via deep link
    attachPaginationListeners();
});
</script>
@endsection
