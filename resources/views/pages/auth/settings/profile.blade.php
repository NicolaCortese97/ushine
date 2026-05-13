@extends('layouts.guest')



@section('content')
<div class="min-h-screen bg-base-100 font-sans text-base-content">
    <!-- Header -->
    <header class="bg-base-100 border-b border-base-200 sticky top-0 z-50">
        <div class="max-w-4xl mx-auto px-4 h-16 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <a href="{{ route('settings.index') }}" class="inline-flex items-center justify-center p-2 rounded-full hover:bg-base-200 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-base-content" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                </a>
                <a href="{{ route('homepage') }}" class="flex items-center gap-2 ml-2">
                    <svg class="w-4 h-4 text-base-content" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 2L15 8.5L22 9.5L17 14L18.5 21L12 17.5L5.5 21L7 14L2 9.5L9 8.5L12 2Z"/>
                    </svg>
                    <span class="text-lg font-bold text-base-content tracking-tight">Ushine</span>
                </a>
            </div>
            
            <h1 class="text-xl font-bold">Edit Profile</h1>
        </div>
    </header>

    <main class="max-w-4xl mx-auto px-4 py-8">
        @session('status')
            <div class="alert alert-soft alert-success flex items-center gap-1 mb-6 border-0" role="alert">
                <svg class="size-5 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" />
                </svg>
                <span>{{ $value }}</span>
            </div>
        @endsession

        <!-- Sezione Foto Profilo -->
        <div class="mb-8">
            <h5 class="text-base-content text-lg font-medium mb-4">Profile Picture</h5>
            <div class="flex items-center gap-4">
                <!-- Avatar Preview -->
                <div class="shrink-0 relative group">
                    @if(auth()->user()->foto_profilo)
                        <img src="{{ auth()->user()->foto_profilo }}" alt="Avatar" class="w-16 h-16 rounded-full object-cover border border-base-300 shadow-sm" />
                    @else
                        <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=random" alt="Avatar" class="w-16 h-16 rounded-full object-cover shadow-sm" />
                    @endif
                </div>

                <!-- Azioni Foto -->
                <div class="flex flex-col gap-2">
                    <form action="{{ route('settings.profile.photo.update') }}" method="POST" enctype="multipart/form-data" id="photo-upload-form">
                        @csrf
                        <label class="btn btn-primary btn-sm cursor-pointer flex items-center justify-center px-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                            </svg>
                            Choose Photo
                            <input type="file" name="foto_profilo" style="display:none;" accept="image/jpeg,image/png,image/jpg,image/webp" required onchange="document.getElementById('photo-upload-form').submit();" />
                        </label>
                    </form>
                    
                    @if(auth()->user()->foto_profilo)
                    <form action="{{ route('settings.profile.photo.destroy') }}" method="POST" onsubmit="return confirm('Are you sure you want to remove your profile picture?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-error btn-sm w-full flex items-center justify-center px-4">
                            Remove picture
                        </button>
                    </form>
                    @endif

                    @error('foto_profilo')
                        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <p class="text-xs text-base-content/60 mt-3">Recommended size: 256x256px. Max 2MB.</p>
        </div>

        <div class="divider"></div>

        <form method="POST" action="{{ route('settings.profile.update') }}" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                <!-- Name Input -->
                <div>
                    <label class="label-text" for="name">Name</label>
                    <input
                        type="text"
                        id="name"
                        name="name"
                        class="input"
                        placeholder="Enter your name"
                        value="{{ old('name', $user->name) }}"
                        required
                        autofocus
                    />
                    @error('name')
                        <p class="mt-1.5 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Cognome Input -->
                <div>
                    <label class="label-text" for="cognome">Surname</label>
                    <input
                        type="text"
                        id="cognome"
                        name="cognome"
                        class="input"
                        placeholder="Enter your surname"
                        value="{{ old('cognome', $user->cognome) }}"
                        required
                    />
                    @error('cognome')
                        <p class="mt-1.5 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Language Input -->
            <div>
                <label class="label-text" for="lingua">Language</label>
                <select id="lingua" name="lingua" class="select w-full border border-base-content/20 bg-base-100 px-4 py-2 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary/20 transition-all duration-200">
                    <option value="" disabled {{ old('lingua', $user->lingua) ? '' : 'selected' }}>Select your language</option>
                    <option value="Italiano" {{ old('lingua', $user->lingua) == 'Italiano' ? 'selected' : '' }}>Italiano</option>
                    <option value="English" {{ old('lingua', $user->lingua) == 'English' ? 'selected' : '' }}>English</option>
                    <option value="Español" {{ old('lingua', $user->lingua) == 'Español' ? 'selected' : '' }}>Español</option>
                    <option value="Français" {{ old('lingua', $user->lingua) == 'Français' ? 'selected' : '' }}>Français</option>
                    <option value="Deutsch" {{ old('lingua', $user->lingua) == 'Deutsch' ? 'selected' : '' }}>Deutsch</option>
                </select>
                @error('lingua')
                    <p class="mt-1.5 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- CAMPO BIO -->
            <div>
                <label class="label-text mb-2 block" for="bio">Bio</label>
                <textarea
                    id="bio"
                    name="bio"
                    rows="6"
                    class="textarea textarea-bordered w-full resize-y"
                    placeholder="Tell your story..."
                    style="min-height: 150px; padding: 12px; font-size: 14px; line-height: 1.5;"
                >{{ old('bio', $user->bio) }}</textarea>
                @error('bio')
                    <p class="mt-1.5 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
                <p class="mt-1 text-xs text-gray-500">Max 1,000,000 characters (includes images)</p>
            </div>

            <!-- SEZIONE CATEGORIE -->
            <div>
                <label class="label-text mb-4 block" for="categories">Categories</label>
                <div class="flex flex-wrap gap-3">
                    @php
                        $allCategories = \App\Models\Category::all();
                        $userCategoryIds = auth()->user()->categories->pluck('id')->toArray();
                    @endphp
                    @foreach($allCategories as $category)
                        <label class="cursor-pointer">
                            <input type="checkbox" name="categories[]" value="{{ $category->id }}" class="hidden category-checkbox" {{ in_array($category->id, old('categories', $userCategoryIds)) ? 'checked' : '' }}>
                            <div class="category-chip px-4 py-2 rounded-lg font-medium text-sm transition-colors duration-200 border border-base-content/20 flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 check-icon hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" /></svg>
                                {{ $category->name }}
                            </div>
                        </label>
                    @endforeach
                </div>
                @error('categories')
                    <p class="mt-1.5 text-sm text-error">{{ $message }}</p>
                @enderror
            </div>

            {{-- <!-- Email Input -->

            <div>
                <label class="label-text" for="email">Email</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    class="input"
                    placeholder="Enter your email"
                    value="{{ old('email', $user->email) }}"
                    required
                />
                @error('email')
                    <p class="mt-1.5 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div> --}}

            <!-- Submit Button -->
            <div class="flex gap-3 mt-6">
                <button type="submit" class="btn btn-primary">Save</button>
                <!-- <button type="button" class="btn btn-soft btn-secondary">Cancel</button> -->
            </div>
        </form>

        <!-- Delete Account Section -->
        <div class="border-base-content/20 mt-8 border-t pt-8">
            <h5 class="text-base-content text-lg font-medium">Delete Account</h5>
            <div class="mt-4">
                <div class="alert alert-soft alert-warning mb-4 border-0" role="alert">
                    <h5 class="text-lg font-medium">Are you sure you want to delete your account?</h5>
                    <p>Once you delete your account, there is no going back. Please be certain.</p>
                </div>
                <form method="POST" action="{{ route('settings.profile.destroy') }}"
                      onsubmit="return confirm('Are you sure you want to delete your account? This action cannot be undone.');">
                    @csrf
                    @method('DELETE')
                    <div class="mb-4 flex items-center gap-2">
                        <input type="checkbox" class="checkbox checkbox-primary checkbox-sm" id="checkboxPrimary" />
                        <label class="label-text text-base" for="checkboxPrimary">I confirm my account deactivation</label>
                    </div>
                    <button type="submit" class="btn btn-error">Deactivate Account</button>
                </form>
            </div>
        </div>
    </main>
</div>

    <!-- Includi TinyMCE via CDNJS per evitare l'avviso della licenza -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.8.3/tinymce.min.js" referrerpolicy="origin"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            tinymce.init({
                selector: '#bio',
                license_key: 'gpl',
                plugins: 'lists link image', // Aggiunto 'image', rimosso 'code'
                toolbar: 'undo redo | blocks | bold italic forecolor backcolor | alignleft aligncenter alignright | bullist numlist outdent indent | link image', // Aggiunti colori e immagine, rimosso 'code'
                menubar: false,
                height: 300,
                promotion: false,
                branding: false, // Rimuove la scritta "Powered by TinyMCE" a destra
                elementpath: false, // Nasconde le indicazioni dei tag (p, strong, ecc.) in basso a sinistra
                // Configurazioni base per le immagini (permette di inserire URL o incollare immagini come base64)
                image_title: true,
                automatic_uploads: true,
                file_picker_types: 'image',
                /* images_upload_url: '/tuo-endpoint-laravel-per-upload', // Scommenta questa riga in futuro se vorrai salvare le immagini sul server */
            });
        });
    </script>

    @push('scripts')
    <style>
        /* Stili per i chip selezionati/deselezionati */
        .category-checkbox:checked + .category-chip {
            background-color: var(--color-primary);
            color: white;
            border-color: var(--color-primary);
        }
        .category-checkbox:not(:checked) + .category-chip {
            background-color: #3f3f46;
            color: #d4d4d8;
            border-color: #3f3f46;
        }
        .category-checkbox:checked + .category-chip .check-icon {
            display: inline-block;
        }
        [data-theme="light"] .category-checkbox:not(:checked) + .category-chip {
            background-color: #4b5563;
            color: white;
        }
    </style>
    @endpush
@endsection
