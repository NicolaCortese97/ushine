@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto space-y-4">

    <!-- Form Nuovo Post -->
    <div style="background-color:#f0f0f0; border-radius:8px; overflow:hidden; border:1px solid #e0e0e0;">
        <form action="{{ route('posts.store') }}" method="POST">
            @csrf
            {{-- Riga avatar + testo --}}
            <div style="display:flex; align-items:flex-start; gap:12px; padding:16px 16px 8px 16px;">
                {{-- Avatar: foto profilo reale oppure iniziali --}}
                @if(auth()->user()->foto_profilo)
                    <img src="{{ auth()->user()->foto_profilo }}"
                         style="width:36px; height:36px; border-radius:50%; object-fit:cover; flex-shrink:0; margin-top:2px;"
                         alt="Avatar" />
                @else
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=random"
                         style="width:36px; height:36px; border-radius:50%; object-fit:cover; flex-shrink:0; margin-top:2px;"
                         alt="Avatar" />
                @endif
                <textarea
                    name="contenuto"
                    rows="3"
                    style="width:100%; background:transparent; border:none; outline:none; resize:none; font-size:14px; color:#555; line-height:1.5;"
                    placeholder="Share your latest updates..."
                    required
                ></textarea>
            </div>

            {{-- Riga icone + pulsante Post --}}
            <div style="display:flex; align-items:center; justify-content:space-between; padding:4px 16px 12px 16px;">
                <div style="display:flex; gap:12px;">
                    {{-- Icona Foto (SVG inline) --}}
                    <button type="button" aria-label="Foto" style="background:none; border:none; cursor:pointer; color:#444; padding:0; display:flex; align-items:center;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M4 8v-2a2 2 0 0 1 2 -2h2"/><path d="M4 16v2a2 2 0 0 0 2 2h2"/>
                            <path d="M16 4h2a2 2 0 0 1 2 2v2"/><path d="M16 20h2a2 2 0 0 0 2 -2v-2"/>
                            <line x1="9" y1="12" x2="15" y2="12"/>
                            <circle cx="9" cy="12" r="1"/><circle cx="15" cy="12" r="1"/>
                        </svg>
                    </button>
                    {{-- Icona Video (SVG inline) --}}
                    <button type="button" aria-label="Video" style="background:none; border:none; cursor:pointer; color:#444; padding:0; display:flex; align-items:center;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M15 10l4.553 -2.276a1 1 0 0 1 1.447 .894v6.764a1 1 0 0 1 -1.447 .894l-4.553 -2.276v-4z"/>
                            <rect x="3" y="8" width="12" height="8" rx="1"/>
                        </svg>
                    </button>
                </div>
                <button type="submit" style="background-color:#3b82f6; color:#fff; border:none; font-size:13px; font-weight:600; padding:6px 20px; border-radius:6px; cursor:pointer;">
                    Post
                </button>
            </div>
        </form>
    </div>

    {{-- Titolo sezione feed --}}
    <h2 class="text-xl font-bold text-base-content pt-2">Latest Updates</h2>

    {{-- Lista post --}}
    @if($posts->isEmpty())
        <div class="flex flex-col items-center justify-center py-24 text-base-content/60">
            <span class="icon-[tabler--clipboard-plus] size-16 mb-4 text-base-content/40"></span>
            <p class="text-lg font-bold text-base-content">No posts yet</p>
            <p class="text-sm mt-1">Be the first to share your updates!</p>
        </div>
    @else
        <div class="space-y-4">
            @foreach($posts as $post)
            <div class="bg-base-100 border border-base-200/70 rounded-xl p-5 space-y-4 hover:shadow-sm transition-shadow">

                {{-- Intestazione post --}}
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-blue-500 text-white flex items-center justify-center text-sm font-bold shrink-0">
                        {{ strtoupper(substr($post->user->name, 0, 1)) }}{{ strtoupper(substr($post->user->cognome, 0, 1)) }}
                    </div>
                    <div>
                        <h6 class="text-sm font-semibold text-base-content leading-tight">{{ $post->user->name }} {{ $post->user->cognome }}</h6>
                        <p class="text-xs text-base-content/50">{{ $post->created_at->diffForHumans() }}</p>
                    </div>
                </div>

                {{-- Contenuto --}}
                <p class="text-sm text-base-content/90 leading-relaxed">{{ $post->contenuto }}</p>

                {{-- Reazioni --}}
                @php $hasLiked = $post->likes->where('user_id', auth()->id())->isNotEmpty(); @endphp
                <div class="flex items-center justify-between border-t border-base-200/60 pt-3"
                    x-data="{
                        liked: {{ $hasLiked ? 'true' : 'false' }},
                        likesCount: {{ $post->likes->count() }},
                        toggleLike() {
                            axios.post('{{ route('likes.toggle', $post) }}')
                                .then(res => {
                                    this.liked = res.data.status === 'liked';
                                    this.likesCount = res.data.likes_count;
                                });
                        }
                    }">
                    <div class="flex gap-3 text-base-content/60 text-sm">
                        <button @click="toggleLike" class="flex items-center gap-1 hover:text-blue-500 transition-colors" :class="liked ? 'text-blue-500' : ''">
                            <span class="size-5" :class="liked ? 'icon-[tabler--thumb-up-filled]' : 'icon-[tabler--thumb-up]'"></span>
                            <span x-text="likesCount"></span>
                        </button>
                        <button class="flex items-center gap-1 hover:text-red-500 transition-colors">
                            <span class="icon-[tabler--thumb-down] size-5"></span><span>0</span>
                        </button>
                        <button class="flex items-center gap-1 hover:text-red-400 transition-colors">
                            <span class="icon-[tabler--heart] size-5"></span><span>0</span>
                        </button>
                        <button class="flex items-center gap-1 hover:text-yellow-500 transition-colors">
                            <span class="icon-[tabler--trophy] size-5"></span><span>0</span>
                        </button>
                        <button class="flex items-center gap-1 hover:text-yellow-400 transition-colors">
                            <span class="icon-[tabler--mood-smile] size-5"></span><span>0</span>
                        </button>
                    </div>
                    <div class="flex items-center gap-3">
                        <span class="flex items-center gap-1 text-base-content/50 text-sm">
                            <span class="icon-[tabler--message-circle] size-5"></span>
                            {{ $post->comments->count() }}
                        </span>
                        <button class="text-xs text-amber-500 hover:text-amber-600 font-medium flex items-center gap-1 transition-colors">
                            <span class="icon-[tabler--flag] size-4"></span> Segnala
                        </button>
                        @if($post->user_id === auth()->id())
                        <button type="button"
                            class="text-xs text-red-500 hover:text-red-600 font-medium flex items-center gap-1 transition-colors"
                            onclick="if(confirm('Eliminare questo post?')) document.getElementById('del-{{ $post->post_id }}').submit();">
                            <span class="icon-[tabler--trash] size-4"></span> Elimina
                        </button>
                        <form id="del-{{ $post->post_id }}" action="{{ route('posts.destroy', $post) }}" method="POST" class="hidden">
                            @csrf @method('DELETE')
                        </form>
                        @endif
                    </div>
                </div>

                {{-- Commenti --}}
                @if($post->comments->count())
                <div class="space-y-3 border-t border-base-200/60 pt-3">
                    @foreach($post->comments as $comment)
                    <div class="flex gap-2">
                        <div class="w-7 h-7 rounded-full bg-base-300 text-base-content/70 flex items-center justify-center text-xs font-bold shrink-0">
                            {{ strtoupper(substr($comment->user->name, 0, 1)) }}
                        </div>
                        <div class="bg-base-200/50 rounded-lg px-3 py-2 flex-1 relative group">
                            <span class="text-xs font-semibold">{{ $comment->user->name }} {{ $comment->user->cognome }}</span>
                            <span class="text-xs text-base-content/40 ml-2">{{ $comment->created_at->diffForHumans() }}</span>
                            <p class="text-sm text-base-content/80 mt-0.5">{{ $comment->testo }}</p>
                            @if($comment->user_id === auth()->id())
                            <div class="absolute -right-1.5 -top-1.5 opacity-0 group-hover:opacity-100 transition-opacity">
                                <form action="{{ route('comments.destroy', $comment) }}" method="POST"
                                    onsubmit="return confirm('Eliminare il commento?');">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="w-5 h-5 rounded-full bg-red-500 text-white flex items-center justify-center shadow-sm hover:bg-red-600">
                                        <span class="icon-[tabler--x] size-3"></span>
                                    </button>
                                </form>
                            </div>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif

                {{-- Form commento --}}
                <form action="{{ route('comments.store', $post) }}" method="POST" class="flex gap-2 pt-1">
                    @csrf
                    <div class="w-7 h-7 rounded-full bg-blue-500 text-white flex items-center justify-center text-xs font-bold shrink-0">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                    <div class="join flex-1">
                        <input type="text" name="testo"
                            class="input input-sm input-bordered join-item flex-1 bg-base-100 text-sm"
                            placeholder="Scrivi un commento..." required />
                        <button type="submit" class="btn btn-sm bg-blue-500 hover:bg-blue-600 text-white border-none join-item font-semibold">
                            Pubblica
                        </button>
                    </div>
                </form>

            </div>
            @endforeach
        </div>
    @endif

</div>
@endsection
