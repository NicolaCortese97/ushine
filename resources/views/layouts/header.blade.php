<div class="bg-base-100 border-base-content/20 sticky top-0 z-50 flex border-b">
    <div class="mx-auto w-full max-w-7xl">
        <nav class="navbar py-2">
            <div class="navbar-start items-center gap-4">
                <a href="{{ route('homepage') }}" class="flex items-center gap-2 ml-2">
                    <img src="{{ asset('images/logoushine.png') }}" alt="Ushine Logo" class="h-14 w-auto object-contain">
                    <!--<span class="text-lg font-bold text-base-content tracking-tight">Ushine</span>-->
                </a>
            </div>

            <div class="navbar-end items-center gap-4">
                <!-- Header Search Bar -->
                <form id="header-search-form" action="{{ route('talents.index') }}" method="GET" class="relative hidden sm:flex items-center" style="transition: all 0.3s ease-in-out;">
                    <input type="text" name="q" id="header-search-input" value="{{ request('q') }}" placeholder="Search talents..."
                        style="width: 180px; height: 36px; padding: 8px 12px 8px 34px; font-size: 13px; border-radius: 20px; border: 1px solid #d1d5db; background: #fafafa; color: #333; outline: none; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);" />
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#666" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"
                        style="position: absolute; left: 12px; top: 50%; transform: translateY(-50%); pointer-events: none;">
                        <circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                    </svg>
                </form>

                <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const headerSearchInput = document.getElementById('header-search-input');
                    const headerSearchForm = document.getElementById('header-search-form');
                    
                    if (headerSearchInput) {
                        headerSearchInput.addEventListener('mousedown', function(e) {
                            // Smooth visual expansion to fill more space in header
                            headerSearchInput.style.width = '350px';
                            headerSearchInput.style.borderColor = '#3b82f6';
                            headerSearchInput.style.background = '#fff';
                            
                            const isTalentPage = window.location.pathname.includes('/talents');
                            if (!isTalentPage) {
                                e.preventDefault();
                                setTimeout(() => {
                                    window.location.href = "{{ route('talents.index') }}?focus=1";
                                }, 180);
                            }
                        });
                        
                        headerSearchInput.addEventListener('blur', function() {
                            headerSearchInput.style.width = '180px';
                            headerSearchInput.style.borderColor = '#d1d5db';
                            headerSearchInput.style.background = '#fafafa';
                        });

                        headerSearchForm.addEventListener('submit', function(e) {
                            const isTalentPage = window.location.pathname.includes('/talents');
                            if (!isTalentPage) {
                                e.preventDefault();
                                window.location.href = "{{ route('talents.index') }}?q=" + encodeURIComponent(headerSearchInput.value);
                            }
                        });
                    }
                });
                </script>

                <!-- Notifications Center Dropdown -->
                <style>
                    /* Premium Round Bell Button (Facebook Style) */
                    #notification-bell-btn {
                        width: 40px !important;
                        height: 40px !important;
                        border-radius: 50% !important;
                        background: #f0f2f5 !important;
                        color: #65676b !important;
                        border: none !important;
                        outline: none !important;
                        cursor: pointer !important;
                        display: flex !important;
                        align-items: center !important;
                        justify-content: center !important;
                        position: relative !important;
                        transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1) !important;
                    }
                    #notification-bell-btn svg {
                        color: #050505 !important;
                        transition: color 0.2s ease !important;
                    }
                    #notification-bell-btn:hover {
                        background: #e4e6eb !important;
                        transform: scale(1.05);
                    }
                    #notification-bell-btn:hover svg {
                        color: #1877f2 !important;
                    }
                    #notification-bell-btn.active-bell {
                        background: #e7f3ff !important;
                    }
                    #notification-bell-btn.active-bell svg {
                        color: #1877f2 !important;
                    }

                    /* Unread Pulsing Badge (Facebook Style) */
                    #notification-badge {
                        position: absolute !important;
                        top: -1px !important;
                        right: -1px !important;
                        display: flex;
                        align-items: center !important;
                        justify-content: center !important;
                        min-width: 18px !important;
                        height: 18px !important;
                        padding: 0 5px !important;
                        border-radius: 10px !important;
                        background: #f02849 !important; /* Facebook Notification Red */
                        color: #ffffff !important;
                        font-size: 11px !important;
                        font-weight: 700 !important;
                        border: 2px solid #ffffff !important;
                        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.15) !important;
                        pointer-events: none !important;
                    }

                    /* Main Dropdown Panel */
                    #notification-panel {
                        width: 360px !important;
                        background: #ffffff !important;
                        border-radius: 12px !important;
                        box-shadow: 0 12px 28px 0 rgba(0, 0, 0, 0.15), 0 2px 4px 0 rgba(0, 0, 0, 0.08), inset 0 0 0 1px rgba(0,0,0,0.04) !important;
                        position: absolute !important;
                        right: 0 !important;
                        top: calc(100% + 8px) !important;
                        z-index: 100 !important;
                        display: none;
                        flex-direction: column !important;
                        overflow: hidden !important;
                        border: none !important;
                        transform-origin: top right !important;
                    }

                    /* Smooth scale-in/spring transition */
                    @keyframes fbDropdownShow {
                        0% {
                            opacity: 0;
                            transform: translateY(-8px) scale(0.96);
                        }
                        100% {
                            opacity: 1;
                            transform: translateY(0) scale(1);
                        }
                    }
                    .fb-dropdown-open {
                        display: flex !important;
                        animation: fbDropdownShow 0.2s cubic-bezier(0.18, 0.89, 0.32, 1.28) forwards !important;
                    }

                    /* Panel Header */
                    .fb-header {
                        padding: 16px 16px 10px 16px !important;
                    }
                    .fb-header-top {
                        display: flex !important;
                        justify-content: space-between !important;
                        align-items: center !important;
                        margin-bottom: 12px !important;
                    }
                    .fb-title {
                        font-size: 22px !important;
                        font-weight: 800 !important;
                        color: #050505 !important;
                        margin: 0 !important;
                        letter-spacing: -0.5px !important;
                    }
                    .fb-mark-read {
                        color: #1877f2 !important;
                        font-size: 13px !important;
                        font-weight: 600 !important;
                        background: none !important;
                        border: none !important;
                        cursor: pointer !important;
                        padding: 6px 10px !important;
                        border-radius: 6px !important;
                        transition: background 0.15s ease !important;
                        outline: none !important;
                    }
                    .fb-mark-read:hover {
                        background: #f2f3f5 !important;
                    }

                    /* Pills Navigation (Tabs) */
                    .fb-tabs {
                        display: flex !important;
                        gap: 8px !important;
                    }
                    .fb-tab {
                        padding: 6px 12px !important;
                        font-size: 14px !important;
                        font-weight: 600 !important;
                        border-radius: 18px !important;
                        cursor: pointer !important;
                        transition: all 0.2s ease !important;
                        border: none !important;
                        background: none !important;
                        outline: none !important;
                    }
                    .fb-tab.active {
                        background: #e7f3ff !important;
                        color: #1877f2 !important;
                    }
                    .fb-tab:not(.active) {
                        background: transparent !important;
                        color: #65676b !important;
                    }
                    .fb-tab:not(.active):hover {
                        background: #f2f3f5 !important;
                        color: #050505 !important;
                    }

                    /* Scroll List Area */
                    #notification-list {
                        overflow-y: auto !important;
                        flex: 1 !important;
                        max-height: 330px !important;
                        padding: 4px 8px !important;
                    }
                    #notification-list::-webkit-scrollbar {
                        width: 6px !important;
                    }
                    #notification-list::-webkit-scrollbar-track {
                        background: transparent !important;
                    }
                    #notification-list::-webkit-scrollbar-thumb {
                        background: #bcc0c4 !important;
                        border-radius: 10px !important;
                    }
                    #notification-list::-webkit-scrollbar-thumb:hover {
                        background: #a8acb0 !important;
                    }

                    /* Individual Notification Item */
                    .fb-item {
                        display: flex !important;
                        padding: 10px 10px !important;
                        gap: 12px !important;
                        align-items: center !important;
                        cursor: pointer !important;
                        transition: background-color 0.2s ease, transform 0.2s ease, opacity 0.2s ease !important;
                        border-radius: 8px !important;
                        margin-bottom: 2px !important;
                        position: relative !important;
                        background-color: transparent;
                    }
                    .fb-item:hover {
                        background-color: #f2f3f5 !important;
                    }
                    .fb-item.unread {
                        background-color: rgba(24, 119, 242, 0.05) !important;
                    }
                    .fb-item.unread:hover {
                        background-color: rgba(24, 119, 242, 0.08) !important;
                    }
                    .fb-item.dismissed {
                        opacity: 0 !important;
                        transform: translateX(50px) scale(0.95) !important;
                        pointer-events: none !important;
                    }

                    /* Avatar & Overlay Badges */
                    .fb-avatar-container {
                        position: relative !important;
                        width: 48px !important;
                        height: 48px !important;
                        flex-shrink: 0 !important;
                    }
                    .fb-avatar {
                        width: 48px !important;
                        height: 48px !important;
                        border-radius: 50% !important;
                        display: flex !important;
                        align-items: center !important;
                        justify-content: center !important;
                        font-weight: 700 !important;
                        font-size: 14px !important;
                        color: #ffffff !important;
                        box-shadow: 0 1px 2px rgba(0,0,0,0.1) !important;
                    }
                    .fb-avatar-badge {
                        position: absolute !important;
                        bottom: -2px !important;
                        right: -2px !important;
                        width: 20px !important;
                        height: 20px !important;
                        border-radius: 50% !important;
                        display: flex !important;
                        align-items: center !important;
                        justify-content: center !important;
                        box-shadow: 0 2px 4px rgba(0,0,0,0.15) !important;
                        border: 2px solid #ffffff !important;
                        color: #ffffff !important;
                    }

                    /* Content Block */
                    .fb-content {
                        flex: 1 !important;
                        min-width: 0 !important;
                        text-align: left !important;
                    }
                    .fb-text {
                        font-size: 13.5px !important;
                        color: #050505 !important;
                        line-height: 1.4 !important;
                        margin: 0 !important;
                    }
                    .fb-text strong {
                        font-weight: 700 !important;
                        color: #000000 !important;
                    }
                    .fb-time {
                        font-size: 12px !important;
                        color: #65676b !important;
                        margin-top: 4px !important;
                        display: block !important;
                        font-weight: 500 !important;
                    }
                    .fb-time.unread {
                        color: #1877f2 !important;
                        font-weight: 700 !important;
                    }

                    /* Unread blue dot indicator */
                    .fb-unread-dot {
                        width: 10px !important;
                        height: 10px !important;
                        border-radius: 50% !important;
                        background: #1877f2 !important;
                        flex-shrink: 0 !important;
                        margin-left: auto !important;
                        box-shadow: 0 0 0 2px #ffffff, 0 0 6px rgba(24, 119, 242, 0.4) !important;
                    }

                    /* Close Button that fades in on hover */
                    .fb-dismiss-btn {
                        width: 32px !important;
                        height: 32px !important;
                        border-radius: 50% !important;
                        display: flex !important;
                        align-items: center !important;
                        justify-content: center !important;
                        background: #ffffff !important;
                        color: #65676b !important;
                        border: 1px solid rgba(0,0,0,0.06) !important;
                        box-shadow: 0 2px 6px rgba(0,0,0,0.1) !important;
                        cursor: pointer !important;
                        opacity: 0 !important;
                        transform: scale(0.85) !important;
                        transition: all 0.2s cubic-bezier(0.175, 0.885, 0.32, 1.275) !important;
                        margin-left: 6px !important;
                        padding: 0 !important;
                        flex-shrink: 0 !important;
                    }
                    .fb-item:hover .fb-dismiss-btn {
                        opacity: 1 !important;
                        transform: scale(1) !important;
                    }
                    .fb-dismiss-btn:hover {
                        background: #f2f3f5 !important;
                        color: #050505 !important;
                        transform: scale(1.08) !important;
                    }

                    /* Empty State Design */
                    .fb-empty-state {
                        padding: 40px 20px !important;
                        display: none;
                        flex-direction: column !important;
                        align-items: center !important;
                        justify-content: center !important;
                        text-align: center !important;
                    }
                    .fb-empty-state.show-empty {
                        display: flex !important;
                    }
                    .fb-empty-icon {
                        width: 56px !important;
                        height: 56px !important;
                        border-radius: 50% !important;
                        background: #f0f2f5 !important;
                        display: flex !important;
                        align-items: center !important;
                        justify-content: center !important;
                        margin-bottom: 12px !important;
                        color: #8a8d91 !important;
                    }
                    .fb-empty-title {
                        font-size: 15px !important;
                        font-weight: 700 !important;
                        color: #65676b !important;
                        margin: 0 0 4px 0 !important;
                    }
                    .fb-empty-desc {
                        font-size: 13px !important;
                        color: #8a8d91 !important;
                        margin: 0 !important;
                    }

                    /* Dropdown Footer */
                    .fb-footer {
                        padding: 8px 12px !important;
                        text-align: center !important;
                        border-top: 1px solid rgba(0, 0, 0, 0.05) !important;
                        background: #ffffff !important;
                    }
                    .fb-footer-link {
                        font-size: 14px !important;
                        font-weight: 700 !important;
                        color: #1877f2 !important;
                        text-decoration: none !important;
                        display: inline-block !important;
                        padding: 8px 12px !important;
                        border-radius: 8px !important;
                        transition: background 0.15s ease !important;
                        width: 100% !important;
                    }
                    .fb-footer-link:hover {
                        background: #f2f3f5 !important;
                    }
                </style>

                <div class="relative inline-block" id="notification-dropdown-container">
                    <button id="notification-bell-btn" type="button" class="focus:outline-none" aria-label="Notifications">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                            <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                        </svg>
                        <!-- Pulsing badge dot -->
                        <span id="notification-badge">3</span>
                    </button>
                    
                    <!-- Dropdown Panel (Facebook style) -->
                    <div id="notification-panel">
                        <!-- Panel Header -->
                        <div class="fb-header">
                            <div class="fb-header-top">
                                <h3 class="fb-title">Notifications</h3>
                                <button id="mark-all-read-btn" type="button" class="fb-mark-read">
                                    Mark all as read
                                </button>
                            </div>
                            
                            <!-- Category filter tabs
                            <div class="fb-tabs">
                                <button type="button" class="fb-tab active" id="fb-tab-all">All</button>
                                <button type="button" class="fb-tab" id="fb-tab-unread">Unread</button>
                            </div> -->
                        </div>
                        
                        <!-- Notifications List -->
                        <div id="notification-list">
                            <!-- Item 1 (Sponsorship) -->
                            <div class="fb-item notification-item unread" data-id="1">
                                <div class="fb-avatar-container">
                                    <!-- Gorgeous Gradient Avatar -->
                                    <div class="fb-avatar" style="background: linear-gradient(135deg, #3b82f6, #1d4ed8);">SP</div>
                                    <!-- Overlay Category Badge -->
                                    <div class="fb-avatar-badge" style="background: #3b82f6;">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                            <line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="fb-content">
                                    <p class="fb-text">
                                        <strong>Elite Sports Group</strong> sent you a sponsorship request!
                                    </p>
                                    <span class="fb-time unread">2 minutes ago</span>
                                </div>
                                <span class="fb-unread-dot unread-dot"></span>
                                <button type="button" class="fb-dismiss-btn dismiss-notification-btn" aria-label="Remove">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                        <line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line>
                                    </svg>
                                </button>
                            </div>
                            
                            <!-- Item 2 (Level Up) -->
                            <div class="fb-item notification-item unread" data-id="2">
                                <div class="fb-avatar-container">
                                    <!-- Gorgeous Gradient Avatar -->
                                    <div class="fb-avatar" style="background: linear-gradient(135deg, #fbbf24, #d97706);">LV</div>
                                    <!-- Overlay Category Badge -->
                                    <div class="fb-avatar-badge" style="background: #10b981;">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                            <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                        </svg>
                                    </div>
                                </div>
                                <div class="fb-content">
                                    <p class="fb-text">
                                        <strong>Level Up!</strong> You reached level 15! Keep shining!
                                    </p>
                                    <span class="fb-time unread">1 hour ago</span>
                                </div>
                                <span class="fb-unread-dot unread-dot"></span>
                                <button type="button" class="fb-dismiss-btn dismiss-notification-btn" aria-label="Remove">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                        <line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line>
                                    </svg>
                                </button>
                            </div>
                            
                            <!-- Item 3 (Like Post) -->
                            <div class="fb-item notification-item unread" data-id="3">
                                <div class="fb-avatar-container">
                                    <!-- Gorgeous Gradient Avatar -->
                                    <div class="fb-avatar" style="background: linear-gradient(135deg, #ec4899, #db2777);">FL</div>
                                    <!-- Overlay Category Badge -->
                                    <div class="fb-avatar-badge" style="background: #ef4444;">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 24 24" fill="currentColor" stroke="currentColor" stroke-width="1">
                                            <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                                        </svg>
                                    </div>
                                </div>
                                <div class="fb-content">
                                    <p class="fb-text">
                                        <strong>Francesca Leone</strong> liked your post 'My Danza Classica Routine'
                                    </p>
                                    <span class="fb-time unread">3 hours ago</span>
                                </div>
                                <span class="fb-unread-dot unread-dot"></span>
                                <button type="button" class="fb-dismiss-btn dismiss-notification-btn" aria-label="Remove">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                        <line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line>
                                    </svg>
                                </button>
                            </div>
                        </div>
                        
                        <!-- Empty State (Facebook styled) -->
                        <div id="notification-empty-state" class="fb-empty-state">
                            <div class="fb-empty-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                                    <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                                </svg>
                            </div>
                            <h4 class="fb-empty-title">No notifications yet</h4>
                            <p class="fb-empty-desc">We'll notify you when something interesting happens!</p>
                        </div>
                        
                        <!-- Panel Footer -->
                        <div class="fb-footer">
                            <a href="{{ route('settings.notifications') }}" class="fb-footer-link">
                                See all in Settings
                            </a>
                        </div>
                    </div>
                </div>

                <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const bellBtn = document.getElementById('notification-bell-btn');
                    const panel = document.getElementById('notification-panel');
                    const badge = document.getElementById('notification-badge');
                    const list = document.getElementById('notification-list');
                    const emptyState = document.getElementById('notification-empty-state');
                    const markAllReadBtn = document.getElementById('mark-all-read-btn');
                    const tabAll = document.getElementById('fb-tab-all');
                    const tabUnread = document.getElementById('fb-tab-unread');
                    
                    function updateBadge() {
                        if (badge) {
                            const count = list.querySelectorAll('.notification-item.unread').length;
                            if (count <= 0) {
                                badge.style.display = 'none';
                            } else {
                                badge.style.display = 'flex';
                                badge.textContent = count;
                            }
                        }
                    }
                    
                    // Toggle dropdown panel with active classes
                    if (bellBtn && panel) {
                        bellBtn.addEventListener('click', function(e) {
                            e.stopPropagation();
                            const isOpen = panel.classList.contains('fb-dropdown-open');
                            if (isOpen) {
                                panel.classList.remove('fb-dropdown-open');
                                bellBtn.classList.remove('active-bell');
                            } else {
                                panel.classList.add('fb-dropdown-open');
                                bellBtn.classList.add('active-bell');
                            }
                        });
                    }
                    
                    // Close panel when clicking outside
                    document.addEventListener('click', function(e) {
                        if (panel && panel.classList.contains('fb-dropdown-open')) {
                            if (!panel.contains(e.target) && e.target !== bellBtn && !bellBtn.contains(e.target)) {
                                panel.classList.remove('fb-dropdown-open');
                                bellBtn.classList.remove('active-bell');
                            }
                        }
                    });

                    // Tab switching filtration logic
                    if (tabAll && tabUnread) {
                        tabAll.addEventListener('click', function(e) {
                            e.stopPropagation();
                            tabAll.classList.add('active');
                            tabUnread.classList.remove('active');
                            
                            const items = list.querySelectorAll('.notification-item');
                            items.forEach(i => i.style.display = 'flex');
                            
                            list.style.display = 'block';
                            checkEmptyState();
                        });
                        
                        tabUnread.addEventListener('click', function(e) {
                            e.stopPropagation();
                            tabUnread.classList.add('active');
                            tabAll.classList.remove('active');
                            
                            const items = list.querySelectorAll('.notification-item');
                            items.forEach(i => {
                                if (i.classList.contains('unread')) {
                                    i.style.display = 'flex';
                                } else {
                                    i.style.display = 'none';
                                }
                            });
                            
                            list.style.display = 'block';
                            checkEmptyState();
                        });
                    }
                    
                    // Individual notification item mark-as-read
                    const items = document.querySelectorAll('.notification-item');
                    items.forEach(item => {
                        item.addEventListener('click', function(e) {
                            if (e.target.closest('.dismiss-notification-btn')) return;
                            
                            if (this.classList.contains('unread')) {
                                this.classList.remove('unread');
                                const dot = this.querySelector('.unread-dot');
                                if (dot) dot.remove();
                                
                                const time = this.querySelector('.fb-time');
                                if (time) time.classList.remove('unread');
                                
                                updateBadge(); // Recalculate and update badge count dynamically
                                
                                // Slide out if we are currently viewing only Unread notifications
                                if (tabUnread && tabUnread.classList.contains('active')) {
                                    this.style.transition = 'all 0.25s ease-out';
                                    this.style.opacity = '0';
                                    this.style.transform = 'scale(0.95)';
                                    setTimeout(() => {
                                        this.style.display = 'none';
                                        this.style.opacity = '1';
                                        this.style.transform = 'none';
                                        checkEmptyState();
                                    }, 250);
                                }
                            }
                        });
                        
                        // Dismiss notification slide-out logic
                        const dismissBtn = item.querySelector('.dismiss-notification-btn');
                        if (dismissBtn) {
                            dismissBtn.addEventListener('click', function(e) {
                                e.stopPropagation();
                                
                                // Remove unread class immediately so it is excluded from badge calculations
                                item.classList.remove('unread');
                                updateBadge(); // Recalculate badge dynamically
                                
                                item.classList.add('dismissed');
                                setTimeout(() => {
                                    item.remove();
                                    checkEmptyState();
                                    updateBadge(); // Double check and sync badge
                                }, 220);
                            });
                        }
                    });
                    
                    // Mark all as read click action
                    if (markAllReadBtn) {
                        markAllReadBtn.addEventListener('click', function(e) {
                            e.stopPropagation();
                            
                            const unreadItems = list.querySelectorAll('.notification-item.unread');
                            unreadItems.forEach(item => {
                                item.classList.remove('unread');
                                const dot = item.querySelector('.unread-dot');
                                if (dot) dot.remove();
                                const time = item.querySelector('.fb-time');
                                if (time) time.classList.remove('unread');
                            });
                            
                            updateBadge(); // Reset badge dynamically (will be 0, hides badge)
                            
                            if (tabUnread && tabUnread.classList.contains('active')) {
                                const items = list.querySelectorAll('.notification-item');
                                items.forEach(i => i.style.display = 'none');
                            }
                            checkEmptyState();
                        });
                    }
                    
                    function checkEmptyState() {
                        const remainingItems = list.querySelectorAll('.notification-item');
                        
                        if (remainingItems.length === 0) {
                            list.style.display = 'none';
                            emptyState.classList.add('show-empty');
                            emptyState.querySelector('.fb-empty-title').textContent = 'No notifications yet';
                            emptyState.querySelector('.fb-empty-desc').textContent = 'We\'ll notify you when something interesting happens!';
                        } else {
                            // Leave normal list display active
                            list.style.display = 'block';
                            emptyState.classList.remove('show-empty');
                        }
                    }
                });
                </script>

                <!-- Profile Dropdown -->
                <div class="dropdown relative inline-flex [--offset:21]">
                    <button id="profile-dropdown" type="button" class="dropdown-toggle avatar" aria-haspopup="menu"
                        aria-expanded="false" aria-label="Dropdown">
                        <span class="rounded-field size-9.5">
                            @if(auth()->user()->foto_profilo)
                                <img src="{{ auth()->user()->foto_profilo }}" alt="Avatar" class="w-full h-full object-cover rounded-full" />
                            @else
                                <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=random" alt="Avatar" class="w-full h-full rounded-full" />
                            @endif
                        </span>
                    </button>
                    <ul class="dropdown-menu dropdown-open:opacity-100 max-w-75 hidden w-full space-y-0.5" role="menu"
                        aria-orientation="vertical" aria-labelledby="profile-dropdown">
                        <li class="dropdown-header pt-4.5 mb-1 gap-4 px-5 pb-3.5">
                            <div class="avatar avatar-online-top">
                                <div class="w-10 rounded-full">
                                    @if(auth()->user()->foto_profilo)
                                        <img src="{{ auth()->user()->foto_profilo }}" alt="Avatar" class="w-full h-full object-cover" />
                                    @else
                                        <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=random" alt="avatar" />
                                    @endif
                                </div>
                            </div>
                            <div>
                                <h6 class="text-base-content mb-0.5 font-semibold">{{ auth()->user()->name }}</h6>
                                <p class="text-base-content/80 font-medium">{{ auth()->user()->email }}</p>
                            </div>
                        </li>
                        <li>
                            <a class="dropdown-item px-3" href="{{ route('settings.index') }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-base-content/80" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                Settings
                            </a>
                        </li>
                        <li class="dropdown-footer p-2 pt-1">
                            <form method="POST" action="{{ route('logout') }}" class="w-full">
                                @csrf
                                <button type="submit"
                                    class="btn btn-text btn-error btn-block h-11 justify-start px-3 font-normal">
                                    <span class="icon-[tabler--logout] size-5"></span>
                                    Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</div>
