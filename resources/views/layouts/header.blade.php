<div class="bg-base-100 border-base-content/20 {{ request()->routeIs('homepage') ? 'lg:ps-75' : '' }} sticky top-0 z-50 flex border-b">
    <div class="mx-auto w-full max-w-7xl">
        <nav class="navbar py-2">
            <div class="navbar-start items-center gap-4">
                <button type="button" class="btn btn-soft btn-square btn-sm lg:hidden" aria-haspopup="dialog"
                    aria-expanded="false" aria-controls="layout-sidebar" data-overlay="#layout-sidebar">
                    <span class="icon-[tabler--menu-2] size-4.5"></span>
                </button>
                <a href="{{ route('homepage') }}" class="flex items-center gap-2">
                    <svg class="w-4 h-4 text-base-content" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 2L15 8.5L22 9.5L17 14L18.5 21L12 17.5L5.5 21L7 14L2 9.5L9 8.5L12 2Z"/>
                    </svg>
                    <span class="text-lg font-bold text-base-content tracking-tight">Ushine</span>
                </a>
            </div>

            <div class="navbar-end items-end gap-6">
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
