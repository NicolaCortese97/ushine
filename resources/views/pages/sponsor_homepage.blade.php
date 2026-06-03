@extends('layouts.app')

@section('content')
    <style>
        :root {
            --bg-card: #f5f5f5;
            --border-card: #e0e0e0;
            --bg-sidebar: #f5f5f5;
            --border-sidebar: #e0e0e0;
            --text-primary: #1a1a1a;
            --text-secondary: #333333;
            --text-muted: #666666;
            --bg-comment: #ececec;
            --bg-comment-section: #fafafa;
            --border-comment: #e8e8e8;
            --bg-body: #ffffff;
            --bg-pill: #ececec;
            --border-pill: #dcdcdc;
            --bg-input: #ffffff;
            --text-input: #333333;
            --border-input: #dddddd;
            --bg-form-post: #f0f0f0;
        }
        [data-theme="dark"], .dark {
            --bg-card: #18191a;
            --border-card: rgba(255, 255, 255, 0.08);
            --bg-sidebar: #18191a;
            --border-sidebar: rgba(255, 255, 255, 0.08);
            --text-primary: #f5f6f8;
            --text-secondary: #e4e6eb;
            --text-muted: #8a8d91;
            --bg-comment: #242526;
            --bg-comment-section: #1c1d1e;
            --border-comment: rgba(255, 255, 255, 0.06);
            --bg-body: #121212;
            --bg-pill: #242526;
            --border-pill: rgba(255, 255, 255, 0.1);
            --bg-input: #242526;
            --text-input: #f5f6f8;
            --border-input: rgba(255, 255, 255, 0.1);
            --bg-form-post: #18191a;
        }
        .homepage-container {
            display: flex;
            gap: 24px;
            align-items: flex-start;
            width: 100%;
        }
        .homepage-left-sidebar {
            width: 260px;
            flex-shrink: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            background:var(--bg-card);
            border:1px solid var(--border-card);
            border-radius: 8px;
            padding: 24px 16px;
            padding-top: 20px;
        }
        .homepage-feed {
            flex: 1;
            min-width: 0;
            display: flex;
            flex-direction: column;
            gap: 16px;
        }
        .homepage-scrollable-feed {
            max-height: calc(100vh - 180px);
            overflow-y: auto;
            padding-right: 12px;
        }
        /* Custom premium scrollbar track and thumb */
        .homepage-scrollable-feed::-webkit-scrollbar {
            width: 8px;
        }
        .homepage-scrollable-feed::-webkit-scrollbar-track {
            background:var(--bg-card);
            border-radius: 4px;
            border:1px solid var(--border-card);
        }
        .homepage-scrollable-feed::-webkit-scrollbar-thumb {
            background: #3b82f6;
            border-radius: 4px;
        }
        .homepage-scrollable-feed::-webkit-scrollbar-thumb:hover {
            background: #2563eb;
        }
        .homepage-sidebar {
            width: 280px;
            flex-shrink: 0;
            display: flex;
            flex-direction: column;
            gap: 24px;
        }
        @media (max-width: 1024px) {
            .homepage-container {
                flex-direction: column !important;
            }
            .homepage-left-sidebar, .homepage-sidebar {
                width: 100% !important;
            }
            .homepage-scrollable-feed {
                max-height: none !important;
                overflow-y: visible !important;
                padding-right: 0 !important;
            }
        }
    </style>

    <div class="homepage-container">
        
        {{-- Left Column: Profile & Stats Card --}}
        <div class="homepage-left-sidebar">
            {{-- Circular profile picture --}}
            <div style="width: 120px; height: 120px; border-radius: 50%; overflow: hidden; border:2px solid var(--border-pill); background:var(--bg-input); display: flex; align-items: center; justify-content: center; flex-shrink: 0; position: relative;">
                @if(auth()->user()->foto_profilo)
                    <img src="{{ auth()->user()->foto_profilo }}" style="width: 100%; height: 100%; object-fit: cover;" alt="Profile Picture" />
                @else
                    {{-- Default elegant grey avatar placeholder matching the image --}}
                    <div style="width: 100%; height: 100%; background:var(--bg-pill); display: flex; align-items: center; justify-content: center; color:var(--text-muted);">
                        <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                    </div>
                @endif
            </div>

            {{-- Full Name --}}
            <h3 style="font-size: 18px; font-weight: 700; color:var(--text-primary); margin-top: 14px; text-align: center; line-height: 1.2;">
                @if(auth()->check())
                    {{ auth()->user()->name }} {{ auth()->user()->cognome }}
                @else
                    Test Sponsor
                @endif
            </h3>

            {{-- Company / Subtitle --}}
            <p style="font-size: 13px; color:var(--text-muted); margin-top: 4px; text-align: center; font-weight: 500;">
                @if(auth()->check())
                    {{ ucfirst(auth()->user()->tipo_utente ?? 'User') }}
                @else
                    Tech Supporter AG
                @endif
            </p>

            {{-- Statistics Header --}}
            <h4 style="font-size: 14px; font-weight: 800; color:var(--text-primary); margin-top: 24px; margin-bottom: 12px; border-bottom: 1px solid #ddd; padding-bottom: 6px; width: 100%; text-align: left;">
                {{ __('Statistics') }}
            </h4>
            
            {{-- Statistics Grid --}}
            <div style="display: flex; flex-wrap: wrap; gap: 8px; width: 100%; justify-content: space-between;">
                {{-- XP Donated --}}
                <div style="width: 48%; background:var(--bg-pill); border:1px solid var(--border-pill); border-radius: 6px; padding: 12px 6px; text-align: center;">
                    <div style="font-size: 16px; font-weight: 800; color:var(--text-primary);">4000</div>
                    <div style="font-size: 10px; color:var(--text-muted); font-weight: 600; margin-top: 2px;">{{ __('XP Donated') }}</div>
                </div>
                {{-- Talents Supported --}}
                <div style="width: 48%; background:var(--bg-pill); border:1px solid var(--border-pill); border-radius: 6px; padding: 12px 6px; text-align: center;">
                    <div style="font-size: 16px; font-weight: 800; color:var(--text-primary);">2</div>
                    <div style="font-size: 10px; color:var(--text-muted); font-weight: 600; margin-top: 2px;">{{ __('Talents Supported') }}</div>
                </div>
                {{-- Certifications --}}
                <div style="width: 100%; background:var(--bg-pill); border:1px solid var(--border-pill); border-radius: 6px; padding: 12px 6px; text-align: center; margin-top: 8px;">
                    <div style="font-size: 16px; font-weight: 800; color:var(--text-primary);">0</div>
                    <div style="font-size: 10px; color:var(--text-muted); font-weight: 600; margin-top: 2px;">{{ __('Certifications') }}</div>
                </div>
            </div>

            {{-- Actions Section --}}
            <h4 style="font-size: 14px; font-weight: 800; color:var(--text-primary); margin-top: 24px; margin-bottom: 12px; border-bottom: 1px solid #ddd; padding-bottom: 6px; width: 100%; text-align: left;">
                {{ __('Actions') }}
            </h4>
            <div style="display: flex; flex-direction: column; gap: 8px; width: 100%;">
                <a href="{{ route('profileInfo') }}" style="width: 100%; padding: 10px; background:var(--bg-pill); color:var(--text-primary); font-weight: 700; font-size: 12px; border-radius: 6px; border:1px solid var(--border-pill); cursor: pointer; transition: background 0.2s; text-align: center; text-decoration: none; display: block; box-sizing: border-box;">
                    {{ __('View Stats') }}
                </a>
                <button type="button" style="width: 100%; padding: 10px; background:var(--bg-pill); color:var(--text-primary); font-weight: 700; font-size: 12px; border-radius: 6px; border:1px solid var(--border-pill); cursor: pointer; transition: background 0.2s;">
                    {{ __('My Certifications') }}
                </button>
                <button type="button" style="width: 100%; padding: 10px; background:var(--bg-pill); color:var(--text-primary); font-weight: 700; font-size: 12px; border-radius: 6px; border:1px solid var(--border-pill); cursor: pointer; transition: background 0.2s;">
                    {{ __('Donation Stats') }}
                </button>
                <button type="button" style="width: 100%; padding: 10px; background:var(--bg-pill); color:var(--text-primary); font-weight: 700; font-size: 12px; border-radius: 6px; border:1px solid var(--border-pill); cursor: pointer; transition: background 0.2s;">
                    {{ __('Investment History') }}
                </button>
            </div>
        </div>

        {{-- Feed Column --}}
        <div class="homepage-feed">
            {{-- Title: Posts from Sponsored Talents --}}
            <h2 style="font-size: 22px; font-weight: 800; color:var(--text-primary); margin-top: 4px; margin-bottom: 8px;">
                {{ __('Posts from Sponsored Talents') }}
            </h2>

            {{-- Mock or Dynamic Posts List --}}
            <div class="homepage-scrollable-feed">
                @if(isset($posts) && !$posts->isEmpty())
                    @foreach($posts as $post)
                        {{-- Card post --}}
                        <div style="background:var(--bg-card); border-radius:8px; border:1px solid var(--border-card); overflow:hidden; margin-bottom: 20px;">

                            {{-- Header: avatar + nome + tipo utente + cestino --}}
                            <div style="display:flex; align-items:center; justify-content:space-between; padding:14px 16px 8px 16px;">
                                <div style="display:flex; align-items:center; gap:12px;">
                                    {{-- Avatar --}}
                                    @if($post->user->foto_profilo)
                                        <img src="{{ $post->user->foto_profilo }}"
                                            style="width:42px; height:42px; border-radius:50%; object-fit:cover; flex-shrink:0;"
                                            alt="Avatar" />
                                    @else
                                        <div
                                            style="width:42px; height:42px; border-radius:50%; background:#4a90e2; color:#fff; display:flex; align-items:center; justify-content:center; font-weight:700; font-size:15px; flex-shrink:0;">
                                            {{ strtoupper(substr($post->user->name, 0, 1)) }}{{ strtoupper(substr($post->user->cognome ?? '', 0, 1)) }}
                                        </div>
                                    @endif
                                    {{-- Nome e tipo utente --}}
                                    <div>
                                        <div style="font-weight:700; font-size:14px; color:var(--text-primary); line-height:1.2;">
                                            {{ $post->user->name }} {{ $post->user->cognome }}</div>
                                        <div style="font-size:12px; color:var(--text-muted); margin-top:1px;">
                                            {{ ucfirst($post->user->tipo_utente ?? 'User') }}</div>
                                    </div>
                                </div>
                                {{-- Cestino elimina (solo proprietario e non sponsor) --}}
                                @if($post->user_id === auth()->id() && auth()->user()->tipo_utente !== 'Sponsor')
                                    <form id="del-{{ $post->post_id }}" action="{{ route('posts.destroy', $post) }}" method="POST">
                                        @csrf @method('DELETE')
                                        <button type="submit" onclick="return confirm('Eliminare questo post?')"
                                            style="background:none; border:none; cursor:pointer; color:#ef4444; padding:4px; display:flex; align-items:center;"
                                            title="Elimina post">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M3 6h18" />
                                                <path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6" />
                                                <path d="M8 6V4a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2" />
                                            </svg>
                                        </button>
                                    </form>
                                @endif
                            </div>

                            {{-- Contenuto testo --}}
                            @if(!empty($post->contenuto))
                                <div style="padding:4px 16px 14px 16px; font-size:14px; color:var(--text-secondary); line-height:1.6;">
                                    {{ $post->contenuto }}
                                </div>
                            @endif

                            {{-- Media post --}}
                            @if($post->media_path)
                                <div style="border-top:1px solid var(--border-card); border-bottom:1px solid var(--border-card); background:#000; display:flex; justify-content:center;">
                                    @if($post->media_type === 'video')
                                        <video src="{{ Storage::url($post->media_path) }}" controls style="max-height:500px; width:100%; object-fit:contain;"></video>
                                    @else
                                        <img src="{{ Storage::url($post->media_path) }}" style="max-height:500px; width:100%; object-fit:contain;" alt="Post media">
                                    @endif
                                </div>
                            @endif

                            {{-- Barra reazioni --}}
                            @php $hasLiked = $post->likes->where('user_id', auth()->id())->isNotEmpty(); @endphp
                            <div style="display:flex; align-items:center; justify-content:space-between; border-top:1px solid var(--border-card); padding:10px 16px;"
                                x-data="{
                                        liked: {{ $hasLiked ? 'true' : 'false' }},
                                        likesCount: {{ $post->likes->count() }},
                                        dislikeCount: 0, disliked: false,
                                        heartCount: 0, hearted: false,
                                        trophyCount: 0, trophied: false,
                                        smileCount: 0, smiled: false,
                                        toggleLike() {
                                            axios.post('{{ route('likes.toggle', $post) }}')
                                                .then(res => {
                                                    this.liked = res.data.status === 'liked';
                                                    this.likesCount = res.data.likes_count;
                                                });
                                        },
                                        toggleReaction(field, countField) {
                                            this[field] = !this[field];
                                            this[countField] += this[field] ? 1 : -1;
                                        }
                                    }">
                                {{-- Reazioni sinistra --}}
                                <div style="display:flex; align-items:center; gap:16px; color:var(--text-secondary); font-size:13px;">
                                    {{-- Like --}}
                                    <button @click="toggleLike"
                                        style="background:none; border:none; cursor:pointer; display:flex; align-items:center; gap:4px; font-size:13px; padding:0;"
                                        :style="liked ? 'color:#3b82f6' : 'color:var(--text-secondary)'">
                                        <svg x-show="!liked" xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <path
                                                d="M7 11v8a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1v-7a1 1 0 0 1 1-1h3a4 4 0 0 0 4-4V6a2 2 0 0 1 4 0v5h3a2 2 0 0 1 2 2l-1 5a2 2 0 0 1-2 2H8" />
                                        </svg>
                                        <svg x-show="liked" style="display:none;" xmlns="http://www.w3.org/2000/svg" width="20"
                                            height="20" viewBox="0 0 24 24" fill="currentColor" stroke="currentColor" stroke-width="1.8"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <path
                                                d="M7 11v8a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1v-7a1 1 0 0 1 1-1h3a4 4 0 0 0 4-4V6a2 2 0 0 1 4 0v5h3a2 2 0 0 1 2 2l-1 5a2 2 0 0 1-2 2H8" />
                                        </svg>
                                    </button>
                                    <span x-text="likesCount"></span>
                                    {{-- Dislike --}}
                                    <button @click="toggleReaction('disliked','dislikeCount')"
                                        style="background:none; border:none; cursor:pointer; display:flex; align-items:center; gap:4px; font-size:13px; padding:0;"
                                        :style="disliked ? 'color:#ef4444' : 'color:var(--text-secondary)'">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                            <path
                                                d="M17 13v-8a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1h-3a4 4 0 0 0-4 4v2a2 2 0 0 1-4 0v-5H6a2 2 0 0 1-2-2l1-5a2 2 0 0 1 2-2h12" />
                                        </svg>
                                    </button>
                                    <span x-text="dislikeCount"></span>
                                    {{-- Heart --}}
                                    <button @click="toggleReaction('hearted','heartCount')"
                                        style="background:none; border:none; cursor:pointer; display:flex; align-items:center; gap:4px; font-size:13px; padding:0;"
                                        :style="hearted ? 'color:#ec4899' : 'color:var(--text-secondary)'">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M19.5 12.572l-7.5 7.428l-7.5-7.428a5 5 0 1 1 7.5-6.566a5 5 0 1 1 7.5 6.566" />
                                        </svg>
                                    </button>
                                    <span x-text="heartCount"></span>
                                    {{-- Trophy --}}
                                    <button @click="toggleReaction('trophied','trophyCount')"
                                        style="background:none; border:none; cursor:pointer; display:flex; align-items:center; gap:4px; font-size:13px; padding:0;"
                                        :style="trophied ? 'color:#f59e0b' : 'color:var(--text-secondary)'">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M8 21l8 0" />
                                            <path d="M12 17l0 4" />
                                            <path d="M7 4l10 0" />
                                            <path d="M17 4v8a5 5 0 0 1-10 0v-8" />
                                            <path d="M5 9m-2 0a2 2 0 1 0 4 0a2 2 0 1 0-4 0" />
                                            <path d="M19 9m-2 0a2 2 0 1 0 4 0a2 2 0 1 0-4 0" />
                                        </svg>
                                    </button>
                                    <span x-text="trophyCount"></span>
                                    {{-- Smile --}}
                                    <button @click="toggleReaction('smiled','smileCount')"
                                        style="background:none; border:none; cursor:pointer; display:flex; align-items:center; gap:4px; font-size:13px; padding:0;"
                                        :style="smiled ? 'color:#f59e0b' : 'color:var(--text-secondary)'">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                            <circle cx="12" cy="12" r="9" />
                                            <line x1="9" y1="10" x2="9.01" y2="10" />
                                            <line x1="15" y1="10" x2="15.01" y2="10" />
                                            <path d="M9.5 15a3.5 3.5 0 0 0 5 0" />
                                        </svg>
                                    </button>
                                    <span x-text="smileCount"></span>
                                </div>
                                {{-- Commenti destra --}}
                                <div style="display:flex; align-items:center; gap:5px; color:var(--text-secondary); font-size:13px;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                        <path
                                            d="M3 20l1.3-3.9c-2.324-3.437-1.426-7.872 2.1-10.374c3.526-2.501 8.59-2.296 11.845.48c3.255 2.777 3.695 7.266 1.029 10.501c-2.666 3.235-7.615 4.215-11.574 2.293L3 20" />
                                    </svg>
                                    <span>{{ $post->comments->count() }}</span>
                                </div>
                            </div>

                            {{-- Commenti esistenti --}}
                            @if($post->comments->count())
                                @php $totalComments = $post->comments->count(); @endphp
                                <div style="border-top:1px solid var(--border-comment); background:var(--bg-comment-section);"
                                    x-data="{ expanded: false, limit: 3, total: {{ $totalComments }} }">

                                    <div style="display:flex; flex-direction:column; gap:10px; padding:8px 16px 10px 16px;">
                                        @foreach($post->comments as $i => $comment)
                                            @php $hasLikedComment = $comment->likes->where('user_id', auth()->id())->isNotEmpty(); @endphp
                                            <div style="display:flex; align-items:flex-start; gap:10px;" x-show="expanded || {{ $i }} < limit"
                                                x-data="{
                                                        commentLiked: {{ $hasLikedComment ? 'true' : 'false' }},
                                                        commentLikesCount: {{ $comment->likes->count() }},
                                                        toggleCommentLike() {
                                                            axios.post('{{ route('comment.likes.toggle', $comment) }}')
                                                                .then(res => {
                                                                    this.commentLiked = res.data.status === 'liked';
                                                                    this.commentLikesCount = res.data.likes_count;
                                                                });
                                                        }
                                                    }">
                                                {{-- Bolla commento --}}
                                                <div
                                                    style="background:var(--bg-pill); border-radius:12px; padding:8px 12px; flex:1; position:relative;">
                                                    <div
                                                        style="display:flex; align-items:center; justify-content:space-between; margin-bottom:3px;">
                                                        {{-- Avatar, nome e cognome, created_at del commento --}}
                                                        <div style="display:flex; align-items:center; gap:10px;">
                                                            @if($comment->user->foto_profilo)
                                                                <img src="{{ $comment->user->foto_profilo }}"
                                                                    style="width:30px; height:30px; border-radius:50%; object-fit:cover; flex-shrink:0; margin-top:2px;"
                                                                    alt="Avatar" />
                                                            @else
                                                                <div
                                                                    style="width:30px; height:30px; border-radius:50%; background:#9ca3af; color:#fff; display:flex; align-items:center; justify-content:center; font-size:11px; font-weight:700; flex-shrink:0; margin-top:2px;">
                                                                    {{ strtoupper(substr($comment->user->name, 0, 1)) }}
                                                                </div>
                                                            @endif
                                                            <div style="display:flex; flex-direction:column;">
                                                                <span
                                                                    style="font-size:12px; font-weight:700; color:var(--text-primary);">{{ $comment->user->name }}
                                                                    {{ $comment->user->cognome }}</span>
                                                                <span
                                                                    style="font-size:11px; color:var(--text-muted); margin-left:8px;">{{ $comment->created_at->diffForHumans() }}</span>
                                                            </div>
                                                        </div>
                                                        {{-- Cestino commento --}}
                                                        @if($comment->user_id === auth()->id())
                                                            <form action="{{ route('comments.destroy', $comment) }}" method="POST" style="margin:0;"
                                                                onsubmit="return confirm('{{ __('Delete comment?') }}');">
                                                                @csrf @method('DELETE')
                                                                <button type="submit"
                                                                    style="background:none; border:none; cursor:pointer; color:#ef4444; padding:2px; display:flex; align-items:center;"
                                                                    title="{{ __('Delete comment') }}">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"
                                                                        stroke-linecap="round" stroke-linejoin="round">
                                                                        <path d="M3 6h18" />
                                                                        <path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6" />
                                                                        <path d="M8 6V4a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2" />
                                                                    </svg>
                                                                </button>
                                                            </form>
                                                        @endif
                                                    </div>
                                                    <p style="font-size:13px; color:var(--text-secondary); margin:0 0 6px 0; line-height:1.5;">
                                                        {{ $comment->testo }}</p>
                                                    {{-- Like commento --}}
                                                    <button @click="toggleCommentLike"
                                                        style="background:none; border:none; cursor:pointer; display:flex; align-items:center; gap:4px; font-size:12px; padding:0;"
                                                        :style="commentLiked ? 'color:#3b82f6' : 'color:var(--text-muted)'">
                                                        <span style="display:inline-flex; align-items:center;">
                                                            <svg x-show="!commentLiked" xmlns="http://www.w3.org/2000/svg" width="14"
                                                                height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                                <path
                                                                    d="M7 11v8a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1v-7a1 1 0 0 1 1-1h3a4 4 0 0 0 4-4V6a2 2 0 0 1 4 0v5h3a2 2 0 0 1 2 2l-1 5a2 2 0 0 1-2 2H8" />
                                                            </svg>
                                                            <svg x-show="commentLiked" style="display:none;" xmlns="http://www.w3.org/2000/svg"
                                                                width="14" height="14" viewBox="0 0 24 24" fill="currentColor"
                                                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                                stroke-linejoin="round">
                                                                <path
                                                                    d="M7 11v8a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1v-7a1 1 0 0 1 1-1h3a4 4 0 0 0 4-4V6a2 2 0 0 1 4 0v5h3a2 2 0 0 1 2 2l-1 5a2 2 0 0 1-2 2H8" />
                                                            </svg>
                                                        </span>
                                                        <span x-text="commentLikesCount"></span>
                                                    </button>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    {{-- Link "Vedi tutti N commenti" se > 3 e non espanso --}}
                                    <template x-if="!expanded && total > limit">
                                        <button @click="expanded = true"
                                            style="display:block; width:100%; text-align:left; background:none; border:none; cursor:pointer; padding:8px 16px 4px 16px; font-size:13px; font-weight:600; color:#3b82f6;">
                                            <span x-text="'{{ __('Load') }} ' + (total - limit) + ' {{ __('more comments...') }}'"></span>
                                        </button>
                                    </template>

                                    {{-- Link "Nascondi commenti" quando espanso --}}
                                    <template x-if="expanded && total > limit">
                                        <button @click="expanded = false"
                                            style="display:block; width:100%; text-align:left; background:none; border:none; cursor:pointer; padding:8px 16px 4px 16px; font-size:13px; font-weight:600; color:var(--text-muted);">
                                            {{ __('Hide comments') }}
                                        </button>
                                    </template>
                                </div>
                            @endif

                            {{-- Form nuovo commento --}}
                            <div style="border-top:1px solid var(--border-comment); padding:10px 16px; background:var(--bg-card);">
                                <form action="{{ route('comments.store', $post) }}" method="POST"
                                    style="display:flex; align-items:center; gap:10px;">
                                    @csrf
                                    @if(auth()->user()->foto_profilo)
                                        <img src="{{ auth()->user()->foto_profilo }}"
                                            style="width:30px; height:30px; border-radius:50%; object-fit:cover; flex-shrink:0;"
                                            alt="Avatar" />
                                    @else
                                        <div
                                            style="width:30px; height:30px; border-radius:50%; background:#4a90e2; color:#fff; display:flex; align-items:center; justify-content:center; font-size:11px; font-weight:700; flex-shrink:0;">
                                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                        </div>
                                    @endif
                                    <input type="text" name="testo"
                                        style="flex:1; border:1px solid var(--border-input); border-radius:20px; padding:7px 14px; font-size:13px; outline:none; background:var(--bg-input); color:var(--text-secondary);"
                                        placeholder="{{ __('Write a comment...') }}" required />
                                    <button type="submit"
                                        style="background:#3b82f6; color:#fff; border:none; border-radius:20px; padding:7px 16px; font-size:13px; font-weight:600; cursor:pointer; white-space:nowrap;">
                                        {{ __('Publish') }}
                                    </button>
                                </form>
                            </div>

                        </div>
                    @endforeach
                @else
                    {{-- Card Post 1 --}}
                    <div style="background:var(--bg-card); border-radius:8px; border:1px solid var(--border-card); overflow:hidden; margin-bottom: 20px;">
                        {{-- Header: avatar + nome + tipo utente --}}
                        <div style="display:flex; align-items:center; justify-content:space-between; padding:14px 16px 8px 16px;">
                            <div style="display:flex; align-items:center; gap:12px;">
                                {{-- Avatar --}}
                                <div style="width:42px; height:42px; border-radius:50%; background:#3b82f6; color:#fff; display:flex; align-items:center; justify-content:center; font-weight:700; font-size:14px; flex-shrink:0;">
                                    TT1
                                </div>
                                {{-- Nome e tipo utente --}}
                                <div>
                                    <div style="font-weight:700; font-size:14px; color:var(--text-primary); line-height:1.2;">
                                        Test Test1
                                    </div>
                                    <div style="font-size:12px; color:var(--text-muted); margin-top:1px;">
                                        Sport
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Contenuto testo --}}
                        <div style="padding:4px 16px 14px 16px; font-size:14px; color:var(--text-secondary); line-height:1.6;">
                            Ciao
                        </div>

                        {{-- Barra reazioni --}}
                        <div style="display:flex; align-items:center; justify-content:space-between; border-top:1px solid var(--border-card); padding:10px 16px; color:var(--text-secondary); font-size:13px;">
                            <div style="display:flex; align-items:center; gap:16px;">
                                {{-- Thumbs Up --}}
                                <div style="display:flex; align-items:center; gap:4px; cursor:pointer;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M7 11v8a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1v-7a1 1 0 0 1 1-1h3a4 4 0 0 0 4-4V6a2 2 0 0 1 4 0v5h3a2 2 0 0 1 2 2l-1 5a2 2 0 0 1-2 2H8" />
                                    </svg>
                                    <span>0</span>
                                </div>
                                {{-- Thumbs Down --}}
                                <div style="display:flex; align-items:center; gap:4px; cursor:pointer;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M17 13v-8a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1h-3a4 4 0 0 0-4 4v2a2 2 0 0 1-4 0v-5H6a2 2 0 0 1-2-2l1-5a2 2 0 0 1 2-2h12" />
                                    </svg>
                                    <span>0</span>
                                </div>
                                {{-- Heart --}}
                                <div style="display:flex; align-items:center; gap:4px; cursor:pointer;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M19.5 12.572l-7.5 7.428l-7.5-7.428a5 5 0 1 1 7.5-6.566a5 5 0 1 1 7.5 6.566" />
                                    </svg>
                                    <span>0</span>
                                </div>
                                {{-- Trophy --}}
                                <div style="display:flex; align-items:center; gap:4px; cursor:pointer;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M8 21l8 0" />
                                        <path d="M12 17l0 4" />
                                        <path d="M7 4l10 0" />
                                        <path d="M17 4v8a5 5 0 0 1-10 0v-8" />
                                        <path d="M5 9m-2 0a2 2 0 1 0 4 0a2 2 0 1 0-4 0" />
                                        <path d="M19 9m-2 0a2 2 0 1 0 4 0a2 2 0 1 0-4 0" />
                                    </svg>
                                    <span>0</span>
                                </div>
                                {{-- Smile --}}
                                <div style="display:flex; align-items:center; gap:4px; cursor:pointer;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                        <circle cx="12" cy="12" r="9" />
                                        <line x1="9" y1="10" x2="9.01" y2="10" />
                                        <line x1="15" y1="10" x2="15.01" y2="10" />
                                        <path d="M9.5 15a3.5 3.5 0 0 0 5 0" />
                                    </svg>
                                    <span>0</span>
                                </div>
                            </div>
                            {{-- Commenti destra --}}
                            <div style="display:flex; align-items:center; gap:5px; cursor:pointer;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M3 20l1.3-3.9c-2.324-3.437-1.426-7.872 2.1-10.374c3.526-2.501 8.59-2.296 11.845.48c3.255 2.777 3.695 7.266 1.029 10.501c-2.666 3.235-7.615 4.215-11.574 2.293L3 20" />
                                </svg>
                                <span>0</span>
                            </div>
                        </div>
                    </div>

                    {{-- Card Mock Post 2 --}}
                    <div style="background:var(--bg-card); border-radius:8px; border:1px solid var(--border-card); overflow:hidden; margin-bottom: 20px;">
                        {{-- Header --}}
                        <div style="display:flex; align-items:center; justify-content:space-between; padding:14px 16px 8px 16px;">
                            <div style="display:flex; align-items:center; gap:12px;">
                                <div style="width:42px; height:42px; border-radius:50%; background:#3b82f6; color:#fff; display:flex; align-items:center; justify-content:center; font-weight:700; font-size:14px; flex-shrink:0;">
                                    TT4
                                </div>
                                <div>
                                    <div style="font-weight:700; font-size:14px; color:var(--text-primary); line-height:1.2;">
                                        Test Test4
                                    </div>
                                    <div style="font-size:12px; color:var(--text-muted); margin-top:1px;">
                                        Musica
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Contenuto testo --}}
                        <div style="padding:4px 16px 14px 16px; font-size:14px; color:var(--text-secondary); line-height:1.6;">
                            Ciao00
                        </div>

                        {{-- Barra reazioni --}}
                        <div style="display:flex; align-items:center; justify-content:space-between; border-top:1px solid var(--border-card); padding:10px 16px; color:var(--text-secondary); font-size:13px;">
                            <div style="display:flex; align-items:center; gap:16px;">
                                <div style="display:flex; align-items:center; gap:4px; cursor:pointer;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M7 11v8a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1v-7a1 1 0 0 1 1-1h3a4 4 0 0 0 4-4V6a2 2 0 0 1 4 0v5h3a2 2 0 0 1 2 2l-1 5a2 2 0 0 1-2 2H8" />
                                    </svg>
                                    <span>0</span>
                                </div>
                                <div style="display:flex; align-items:center; gap:4px; cursor:pointer;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M17 13v-8a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1h-3a4 4 0 0 0-4 4v2a2 2 0 0 1-4 0v-5H6a2 2 0 0 1-2-2l1-5a2 2 0 0 1 2-2h12" />
                                    </svg>
                                    <span>0</span>
                                </div>
                                <div style="display:flex; align-items:center; gap:4px; cursor:pointer;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M19.5 12.572l-7.5 7.428l-7.5-7.428a5 5 0 1 1 7.5-6.566a5 5 0 1 1 7.5 6.566" />
                                    </svg>
                                    <span>0</span>
                                </div>
                                <div style="display:flex; align-items:center; gap:4px; cursor:pointer;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M8 21l8 0" />
                                        <path d="M12 17l0 4" />
                                        <path d="M7 4l10 0" />
                                        <path d="M17 4v8a5 5 0 0 1-10 0v-8" />
                                        <path d="M5 9m-2 0a2 2 0 1 0 4 0a2 2 0 1 0-4 0" />
                                        <path d="M19 9m-2 0a2 2 0 1 0 4 0a2 2 0 1 0-4 0" />
                                    </svg>
                                    <span>0</span>
                                </div>
                                <div style="display:flex; align-items:center; gap:4px; cursor:pointer;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                        <circle cx="12" cy="12" r="9" />
                                        <line x1="9" y1="10" x2="9.01" y2="10" />
                                        <line x1="15" y1="10" x2="15.01" y2="10" />
                                        <path d="M9.5 15a3.5 3.5 0 0 0 5 0" />
                                    </svg>
                                    <span>0</span>
                                </div>
                            </div>
                            <div style="display:flex; align-items:center; gap:5px; cursor:pointer;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M3 20l1.3-3.9c-2.324-3.437-1.426-7.872 2.1-10.374c3.526-2.501 8.59-2.296 11.845.48c3.255 2.777 3.695 7.266 1.029 10.501c-2.666 3.235-7.615 4.215-11.574 2.293L3 20" />
                                </svg>
                                <span>0</span>
                            </div>
                        </div>
                    </div>

                    {{-- Card Mock Post 3 --}}
                    <div style="background:var(--bg-card); border-radius:8px; border:1px solid var(--border-card); overflow:hidden; margin-bottom: 20px;">
                        {{-- Header --}}
                        <div style="display:flex; align-items:center; justify-content:space-between; padding:14px 16px 8px 16px;">
                            <div style="display:flex; align-items:center; gap:12px;">
                                <div style="width:42px; height:42px; border-radius:50%; background:#3b82f6; color:#fff; display:flex; align-items:center; justify-content:center; font-weight:700; font-size:14px; flex-shrink:0;">
                                    TT1
                                </div>
                                <div>
                                    <div style="font-weight:700; font-size:14px; color:var(--text-primary); line-height:1.2;">
                                        Test Test1
                                    </div>
                                    <div style="font-size:12px; color:var(--text-muted); margin-top:1px;">
                                        Sport
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Contenuto testo --}}
                        <div style="padding:4px 16px 14px 16px; font-size:14px; color:var(--text-secondary); line-height:1.6;">
                            Ciao000
                        </div>

                        {{-- Barra reazioni --}}
                        <div style="display:flex; align-items:center; justify-content:space-between; border-top:1px solid var(--border-card); padding:10px 16px; color:var(--text-secondary); font-size:13px;">
                            <div style="display:flex; align-items:center; gap:16px;">
                                <div style="display:flex; align-items:center; gap:4px; cursor:pointer;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M7 11v8a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1v-7a1 1 0 0 1 1-1h3a4 4 0 0 0 4-4V6a2 2 0 0 1 4 0v5h3a2 2 0 0 1 2 2l-1 5a2 2 0 0 1-2 2H8" />
                                    </svg>
                                    <span>0</span>
                                </div>
                                <div style="display:flex; align-items:center; gap:4px; cursor:pointer;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M17 13v-8a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1h-3a4 4 0 0 0-4 4v2a2 2 0 0 1-4 0v-5H6a2 2 0 0 1-2-2l1-5a2 2 0 0 1 2-2h12" />
                                    </svg>
                                    <span>0</span>
                                </div>
                                <div style="display:flex; align-items:center; gap:4px; cursor:pointer;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M19.5 12.572l-7.5 7.428l-7.5-7.428a5 5 0 1 1 7.5-6.566a5 5 0 1 1 7.5 6.566" />
                                    </svg>
                                    <span>0</span>
                                </div>
                                <div style="display:flex; align-items:center; gap:4px; cursor:pointer;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M8 21l8 0" />
                                        <path d="M12 17l0 4" />
                                        <path d="M7 4l10 0" />
                                        <path d="M17 4v8a5 5 0 0 1-10 0v-8" />
                                        <path d="M5 9m-2 0a2 2 0 1 0 4 0a2 2 0 1 0-4 0" />
                                        <path d="M19 9m-2 0a2 2 0 1 0 4 0a2 2 0 1 0-4 0" />
                                    </svg>
                                    <span>0</span>
                                </div>
                                <div style="display:flex; align-items:center; gap:4px; cursor:pointer;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                        <circle cx="12" cy="12" r="9" />
                                        <line x1="9" y1="10" x2="9.01" y2="10" />
                                        <line x1="15" y1="10" x2="15.01" y2="10" />
                                        <path d="M9.5 15a3.5 3.5 0 0 0 5 0" />
                                    </svg>
                                    <span>0</span>
                                </div>
                            </div>
                            <div style="display:flex; align-items:center; gap:5px; cursor:pointer;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M3 20l1.3-3.9c-2.324-3.437-1.426-7.872 2.1-10.374c3.526-2.501 8.59-2.296 11.845.48c3.255 2.777 3.695 7.266 1.029 10.501c-2.666 3.235-7.615 4.215-11.574 2.293L3 20" />
                                </svg>
                                <span>0</span>
                            </div>
                        </div>
                    </div>

                    {{-- Card Mock Post 4 (with Image) --}}
                    <div style="background:var(--bg-card); border-radius:8px; border:1px solid var(--border-card); overflow:hidden; margin-bottom: 20px;">
                        {{-- Header --}}
                        <div style="display:flex; align-items:center; justify-content:space-between; padding:14px 16px 8px 16px;">
                            <div style="display:flex; align-items:center; gap:12px;">
                                <div style="width:42px; height:42px; border-radius:50%; background:#3b82f6; color:#fff; display:flex; align-items:center; justify-content:center; font-weight:700; font-size:14px; flex-shrink:0;">
                                    TT4
                                </div>
                                <div>
                                    <div style="font-weight:700; font-size:14px; color:var(--text-primary); line-height:1.2;">
                                        Test Test4
                                    </div>
                                    <div style="font-size:12px; color:var(--text-muted); margin-top:1px;">
                                        Musica
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Contenuto testo --}}
                        <div style="padding:4px 16px 10px 16px; font-size:14px; color:var(--text-secondary); line-height:1.6;">
                            My image
                        </div>

                        {{-- Image media matching the gray sun/mountain placeholder --}}
                        <div style="border-top:1px solid var(--border-card); border-bottom:1px solid var(--border-card); background:var(--bg-pill); display:flex; justify-content:center; align-items:center; height:340px; position:relative;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="96" height="96" viewBox="0 0 24 24" fill="none" stroke="#a3a3a3" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                                <circle cx="8.5" cy="8.5" r="1.5"></circle>
                                <polyline points="21 15 16 10 5 21"></polyline>
                            </svg>
                        </div>

                        {{-- Barra reazioni --}}
                        <div style="display:flex; align-items:center; justify-content:space-between; border-top:1px solid var(--border-card); padding:10px 16px; color:var(--text-secondary); font-size:13px;">
                            <div style="display:flex; align-items:center; gap:16px;">
                                <div style="display:flex; align-items:center; gap:4px; cursor:pointer;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M7 11v8a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1v-7a1 1 0 0 1 1-1h3a4 4 0 0 0 4-4V6a2 2 0 0 1 4 0v5h3a2 2 0 0 1 2 2l-1 5a2 2 0 0 1-2 2H8" />
                                    </svg>
                                    <span>0</span>
                                </div>
                                <div style="display:flex; align-items:center; gap:4px; cursor:pointer;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M17 13v-8a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1h-3a4 4 0 0 0-4 4v2a2 2 0 0 1-4 0v-5H6a2 2 0 0 1-2-2l1-5a2 2 0 0 1 2-2h12" />
                                    </svg>
                                    <span>0</span>
                                </div>
                                <div style="display:flex; align-items:center; gap:4px; cursor:pointer;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M19.5 12.572l-7.5 7.428l-7.5-7.428a5 5 0 1 1 7.5-6.566a5 5 0 1 1 7.5 6.566" />
                                    </svg>
                                    <span>0</span>
                                </div>
                                <div style="display:flex; align-items:center; gap:4px; cursor:pointer;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M8 21l8 0" />
                                        <path d="M12 17l0 4" />
                                        <path d="M7 4l10 0" />
                                        <path d="M17 4v8a5 5 0 0 1-10 0v-8" />
                                        <path d="M5 9m-2 0a2 2 0 1 0 4 0a2 2 0 1 0-4 0" />
                                        <path d="M19 9m-2 0a2 2 0 1 0 4 0a2 2 0 1 0-4 0" />
                                    </svg>
                                    <span>0</span>
                                </div>
                                <div style="display:flex; align-items:center; gap:4px; cursor:pointer;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                        <circle cx="12" cy="12" r="9" />
                                        <line x1="9" y1="10" x2="9.01" y2="10" />
                                        <line x1="15" y1="10" x2="15.01" y2="10" />
                                        <path d="M9.5 15a3.5 3.5 0 0 0 5 0" />
                                    </svg>
                                    <span>0</span>
                                </div>
                            </div>
                            <div style="display:flex; align-items:center; gap:5px; cursor:pointer;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M3 20l1.3-3.9c-2.324-3.437-1.426-7.872 2.1-10.374c3.526-2.501 8.59-2.296 11.845.48c3.255 2.777 3.695 7.266 1.029 10.501c-2.666 3.235-7.615 4.215-11.574 2.293L3 20" />
                                </svg>
                                <span>0</span>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        {{-- Right Column: Sidebar --}}
        <div class="homepage-sidebar">
            {{-- Recent Donations --}}
            <div>
                <h3 style="font-size:16px; font-weight:800; color:var(--text-primary); margin-bottom:12px;">{{ __('Recent Donations') }}</h3>
                <div style="background:var(--bg-card); border:1px solid var(--border-card); border-radius:8px; padding:24px 16px; text-align:center; color:var(--text-muted); font-size:13px;">
                    {{ __('No donations yet') }}
                </div>
            </div>

            {{-- Recommended Talents --}}
            <div>
                <h3 style="font-size:16px; font-weight:800; color:var(--text-primary); margin-bottom:12px;">{{ __('Recommended Talents') }}</h3>
                <div style="display:flex; flex-direction:column; gap:10px;">
                    {{-- Item 1 --}}
                    <div style="display:flex; align-items:center; gap:12px; background:var(--bg-card); border:1px solid var(--border-card); border-radius:8px; padding:12px 16px;">
                        <div style="width:36px; height:36px; border-radius:50%; background:#3b82f6; color:#fff; display:flex; align-items:center; justify-content:center; font-weight:700; font-size:11px; flex-shrink:0;">
                            TT6
                        </div>
                        <div>
                            <div style="font-weight:700; font-size:13px; color:var(--text-primary); line-height:1.2;">Test Test6</div>
                            <div style="font-size:11px; color:var(--text-muted); margin-top:1px;">{{ __('Sport') }}</div>
                        </div>
                    </div>
                    {{-- Item 2 --}}
                    <div style="display:flex; align-items:center; gap:12px; background:var(--bg-card); border:1px solid var(--border-card); border-radius:8px; padding:12px 16px;">
                        <div style="width:36px; height:36px; border-radius:50%; background:#10b981; color:#fff; display:flex; align-items:center; justify-content:center; font-weight:700; font-size:11px; flex-shrink:0;">
                            TT2
                        </div>
                        <div>
                            <div style="font-weight:700; font-size:13px; color:var(--text-primary); line-height:1.2;">Test Test2</div>
                            <div style="font-size:11px; color:var(--text-muted); margin-top:1px;">{{ __('Literature') }}</div>
                        </div>
                    </div>
                    {{-- Item 3 --}}
                    <div style="display:flex; align-items:center; gap:12px; background:var(--bg-card); border:1px solid var(--border-card); border-radius:8px; padding:12px 16px;">
                        <div style="width:36px; height:36px; border-radius:50%; background:#f59e0b; color:#fff; display:flex; align-items:center; justify-content:center; font-weight:700; font-size:11px; flex-shrink:0;">
                            TT3
                        </div>
                        <div>
                            <div style="font-weight:700; font-size:13px; color:var(--text-primary); line-height:1.2;">Test Test3</div>
                            <div style="font-size:11px; color:var(--text-muted); margin-top:1px;">{{ __('Dance') }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
