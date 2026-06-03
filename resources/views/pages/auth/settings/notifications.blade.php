@extends('layouts.guest')

@section('content')
<style>
    .chronology-container {
        max-width: 100%;
        margin: 0 auto;
        padding: 0 16px;
    }
    .history-card {
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.02);
        margin-bottom: 24px;
        overflow: hidden;
    }
    .date-header {
        font-size: 12px;
        font-weight: 800;
        color: #64748b;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        padding: 14px 20px;
        background: #f8fafc;
        border-bottom: 1px solid #e2e8f0;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .history-item {
        display: flex;
        align-items: start;
        gap: 16px;
        padding: 20px 24px;
        border-bottom: 1px solid #f1f5f9;
        transition: all 0.2s ease-in-out;
        position: relative;
    }
    .history-item:last-child {
        border-bottom: none;
    }
    .history-item:hover {
        background: #fafbfd;
    }
    .history-item.dismissed {
        opacity: 0;
        transform: translateX(40px);
        pointer-events: none;
    }
    .history-icon-wrapper {
        flex-shrink: 0;
        width: 44px;
        height: 44px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 14px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.04);
    }
    .history-btn-clear {
        background: #fee2e2;
        color: #ef4444;
        border: none;
        border-radius: 6px;
        font-size: 12px;
        font-weight: 700;
        padding: 6px 12px;
        cursor: pointer;
        transition: background 0.2s;
    }
    .history-btn-clear:hover {
        background: #fecaca;
    }
    
    /* Empty State */
    .history-empty {
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 64px 32px;
        text-align: center;
        color: #64748b;
        box-shadow: 0 1px 3px rgba(0,0,0,0.02);
    }

    /* Notification text classes */
    .history-title {
        font-size: 14px;
        font-weight: 600;
        color: #1e293b;
        margin: 0;
        line-height: 1.5;
    }
    .history-text {
        font-size: 13px;
        color: #64748b;
        margin: 4px 0 0 0;
        line-height: 1.5;
    }
    .history-time {
        font-size: 11px;
        color: #94a3b8;
        font-weight: 600;
        margin-top: 6px;
        display: inline-block;
    }
    .empty-title {
        font-size: 18px;
        font-weight: 700;
        color: #1e293b;
        margin: 0 0 6px 0;
    }
    .empty-desc {
        font-size: 14px;
        color: #64748b;
        margin: 0 0 24px 0;
    }

    /* Dark Mode Adjustments */
    :is(.dark, [data-theme="dark"]) .history-card {
        background: #111827;
        border-color: #374151;
    }
    :is(.dark, [data-theme="dark"]) .date-header {
        background: #1f2937;
        border-bottom-color: #374151;
        color: #9ca3af;
    }
    :is(.dark, [data-theme="dark"]) .history-item {
        border-bottom-color: #1f2937;
    }
    :is(.dark, [data-theme="dark"]) .history-item:hover {
        background: #1f2937;
    }
    :is(.dark, [data-theme="dark"]) .history-empty {
        background: #111827;
        border-color: #374151;
        color: #9ca3af;
    }
    :is(.dark, [data-theme="dark"]) .history-title {
        color: #f3f4f6 !important;
    }
    :is(.dark, [data-theme="dark"]) .history-text {
        color: #9ca3af !important;
    }
    :is(.dark, [data-theme="dark"]) .history-time {
        color: #6b7280 !important;
    }
    :is(.dark, [data-theme="dark"]) .empty-title {
        color: #f3f4f6 !important;
    }
    :is(.dark, [data-theme="dark"]) .empty-desc {
        color: #9ca3af !important;
    }
</style>

<div class="min-h-screen bg-base-100 font-sans text-base-content">
    <!-- Header -->
    <header class="bg-base-100 border-b border-base-200 sticky top-0 z-50" style="height: 64px; line-height: 64px;">
        <div class="max-w-full mx-auto px-4" style="height: 100%; display: flex; align-items: center; justify-content: space-between; position: relative;">
            
            <!-- Left Side: Back button (Browser History Back) -->
            <div style="display: flex; align-items: center; height: 100%;">
                <a href="#" onclick="window.history.back(); return false;" class="hover:bg-base-200" style="display: inline-flex; align-items: center; justify-content: center; width: 40px; height: 40px; border-radius: 50%; transition: background-color 0.2s ease; text-decoration: none; color: inherit;">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-base-content" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" style="width: 24px; height: 24px;">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                </a>
            </div>
            
            <!-- Center Title -->
            <div style="position: absolute; left: 50%; top: 50%; transform: translate(-50%, -50%); pointer-events: none; max-width: 60%; width: auto; display: flex; align-items: center; justify-content: center; height: 100%;">
                <h1 class="text-xl font-bold" style="margin: 0; padding: 0; line-height: 1; text-align: center; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; pointer-events: auto;">{{ __('Notifications History') }}</h1>
            </div>
            
            <!-- Right Side: Actions -->
            <div style="display: flex; align-items: center; height: 100%;">
                <button type="button" id="history-clear-all" class="history-btn-clear">
                    {{ __('Clear All') }}
                </button>
            </div>
            
        </div>
    </header>

    <main class="py-8">
        <div class="chronology-container">
            <div id="history-content-wrapper">
                
                {{-- TODAY --}}
                <div class="history-card date-section" data-date="today">
                    <div class="date-header">
                        <span>{{ __('Today') }}</span>
                        <span class="text-xs font-semibold text-gray-400">{{ __('Recent') }}</span>
                    </div>
                    <div class="history-list">
                        <!-- Notification 1 -->
                        <div class="history-item" data-id="hist-1">
                            <div class="history-icon-wrapper bg-blue-100 text-blue-600">SP</div>
                            <div style="flex: 1; text-align: left;">
                                <p class="history-title">{{ __('Sponsorship Request') }}</p>
                                <p class="history-text">
                                    {!! __('<strong>:name</strong> sent you a sponsorship request!', ['name' => 'Elite Sports Group']) !!}
                                </p>
                                <span class="history-time">{{ __('2 minutes ago') }}</span>
                            </div>
                            <div style="display: flex; flex-direction: column; align-items: center; gap: 8px;">
                                <span class="history-unread-dot w-2.5 h-2.5 rounded-full bg-blue-500" style="display: inline-block;"></span>
                                <button class="history-delete-btn text-gray-400 hover:text-red-500 transition duration-150" style="background:none; border:none; padding:4px; cursor:pointer;" aria-label="Delete">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                        <line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line>
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <!-- Notification 2 -->
                        <div class="history-item" data-id="hist-2">
                            <div class="history-icon-wrapper bg-emerald-100 text-emerald-600">LV</div>
                            <div style="flex: 1; text-align: left;">
                                <p class="history-title">{{ __('Level Up!') }}</p>
                                <p class="history-text">
                                    {{ __('You reached Level 15! Keep shining!') }}
                                </p>
                                <span class="history-time">{{ __('1 hour ago') }}</span>
                            </div>
                            <div style="display: flex; flex-direction: column; align-items: center; gap: 8px;">
                                <span class="history-unread-dot w-2.5 h-2.5 rounded-full bg-blue-500" style="display: inline-block;"></span>
                                <button class="history-delete-btn text-gray-400 hover:text-red-500 transition duration-150" style="background:none; border:none; padding:4px; cursor:pointer;" aria-label="Delete">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                        <line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- YESTERDAY --}}
                <div class="history-card date-section" data-date="yesterday">
                    <div class="date-header">
                        <span>{{ __('Yesterday') }}</span>
                        <span class="text-xs font-semibold text-gray-400">{{ __('May 27') }}</span>
                    </div>
                    <div class="history-list">
                        <!-- Notification 3 -->
                        <div class="history-item" data-id="hist-3">
                            <div class="history-icon-wrapper bg-amber-100 text-amber-600">FL</div>
                            <div style="flex: 1; text-align: left;">
                                <p class="history-title">{{ __('Post Interaction') }}</p>
                                <p class="history-text">
                                    {!! __('<strong>:name</strong> liked your post :post', ['name' => 'Francesca Leone', 'post' => "'My Danza Classica Routine'"]) !!}
                                </p>
                                <span class="history-time">{{ __('Yesterday at 20:45') }}</span>
                            </div>
                            <div style="display: flex; flex-direction: column; align-items: center; gap: 8px;">
                                <span class="history-unread-dot w-2.5 h-2.5 rounded-full bg-blue-500" style="display: inline-block;"></span>
                                <button class="history-delete-btn text-gray-400 hover:text-red-500 transition duration-150" style="background:none; border:none; padding:4px; cursor:pointer;" aria-label="Delete">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                        <line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line>
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <!-- Notification 4 -->
                        <div class="history-item" data-id="hist-4">
                            <div class="history-icon-wrapper bg-blue-50 text-white">AN</div>
                            <div style="flex: 1; text-align: left;">
                                <p class="history-title">{{ __('Analytics Update') }}</p>
                                <p class="history-text">
                                    {!! __('Weekly Digest: Your profile views increased by <strong>:percentage</strong> this week!', ['percentage' => '45%']) !!}
                                </p>
                                <span class="history-time">{{ __('Yesterday at 17:34') }}</span>
                            </div>
                            <div style="display: flex; flex-direction: column; align-items: center; gap: 8px;">
                                <button class="history-delete-btn text-gray-400 hover:text-red-500 transition duration-150" style="background:none; border:none; padding:4px; cursor:pointer;" aria-label="Delete">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                        <line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- OLDER --}}
                <div class="history-card date-section" data-date="older">
                    <div class="date-header">
                        <span>{{ __('Older') }}</span>
                        <span class="text-xs font-semibold text-gray-400">{{ __('Last Week') }}</span>
                    </div>
                    <div class="history-list">
                        <!-- Notification 5 -->
                        <div class="history-item" data-id="hist-5">
                            <div class="history-icon-wrapper bg-purple-100 text-purple-600">SY</div>
                            <div style="flex: 1; text-align: left;">
                                <p class="history-title">{{ __('System Upgrade') }}</p>
                                <p class="history-text">
                                    {{ __('Ushine platform upgraded to v1.2 with new interactive features.') }}
                                </p>
                                <span class="history-time">{{ __('4 days ago') }}</span>
                            </div>
                            <div style="display: flex; flex-direction: column; align-items: center; gap: 8px;">
                                <button class="history-delete-btn text-gray-400 hover:text-red-500 transition duration-150" style="background:none; border:none; padding:4px; cursor:pointer;" aria-label="Delete">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                        <line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line>
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <!-- Notification 6 -->
                        <div class="history-item" data-id="hist-6">
                            <div class="history-icon-wrapper bg-rose-100 text-rose-600">SG</div>
                            <div style="flex: 1; text-align: left;">
                                <p class="history-title">{{ __('Sponsorship Granted') }}</p>
                                <p class="history-text">
                                    {!! __('Sponsor :name sponsored your challenge for <strong>:amount</strong>!', ['name' => 'Alpha Sport', 'amount' => '$500']) !!}
                                </p>
                                <span class="history-time">{{ __('1 week ago') }}</span>
                            </div>
                            <div style="display: flex; flex-direction: column; align-items: center; gap: 8px;">
                                <button class="history-delete-btn text-gray-400 hover:text-red-500 transition duration-150" style="background:none; border:none; padding:4px; cursor:pointer;" aria-label="Delete">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                        <line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Empty State -->
            <div id="history-empty" class="history-empty hidden">
                <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="#cbd5e1" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" style="margin: 0 auto 16px auto;">
                    <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                    <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                </svg>
                <h3 class="empty-title">{{ __('No notification history') }}</h3>
                <p class="empty-desc">{{ __('Your notifications history is completely clean.') }}</p>
                <a href="#" onclick="window.history.back(); return false;" class="btn btn-primary" style="text-decoration: none; padding: 10px 24px; border-radius: 8px; font-weight: 600;">{{ __('Back to Settings') }}</a>
            </div>
        </div>
    </main>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const historyWrapper = document.getElementById('history-content-wrapper');
    const emptyState = document.getElementById('history-empty');
    const clearAllBtn = document.getElementById('history-clear-all');
    const items = document.querySelectorAll('.history-item');
    
    // Mark read on click
    items.forEach(item => {
        item.addEventListener('click', function(e) {
            if (e.target.closest('.history-delete-btn')) return;
            const dot = this.querySelector('.history-unread-dot');
            if (dot) {
                dot.style.opacity = '0';
                setTimeout(() => dot.remove(), 200);
            }
        });
        
        // Delete individual item
        const deleteBtn = item.querySelector('.history-delete-btn');
        if (deleteBtn) {
            deleteBtn.addEventListener('click', function(e) {
                e.stopPropagation();
                item.classList.add('dismissed');
                setTimeout(() => {
                    item.remove();
                    checkEmptyState();
                }, 250);
            });
        }
    });
    
    // Clear all history
    if (clearAllBtn) {
        clearAllBtn.addEventListener('click', function() {
            const allSections = document.querySelectorAll('.date-section');
            allSections.forEach(section => {
                section.style.transition = 'all 0.3s ease-out';
                section.style.opacity = '0';
                section.style.transform = 'translateY(20px)';
                setTimeout(() => {
                    section.remove();
                    checkEmptyState();
                }, 300);
            });
        });
    }
    
    function checkEmptyState() {
        const remainingItems = document.querySelectorAll('.history-item');
        if (remainingItems.length === 0) {
            if (historyWrapper) historyWrapper.style.display = 'none';
            if (clearAllBtn) clearAllBtn.style.display = 'none';
            if (emptyState) {
                emptyState.classList.remove('hidden');
                emptyState.style.display = 'block';
            }
        } else {
            // Check each date-section, if empty, remove it
            const sections = document.querySelectorAll('.date-section');
            sections.forEach(section => {
                const list = section.querySelector('.history-list');
                if (list && list.children.length === 0) {
                    section.remove();
                }
            });
        }
    }
});
</script>
@endsection
