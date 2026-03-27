@extends('layouts.guest')

@section('title', 'Ushine - Unleash Your Potential')

@section('content')
<div class="min-h-screen bg-[#F8F9FC]">
    <!-- Header -->
    <header class="border-b border-[#E6E9F4]">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <!-- Logo e Titolo -->
                <div class="flex items-center gap-4">
                    <div class="w-4 h-4">
                        <svg class="w-4 h-4 text-[#0D0F1C]" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 2L15 8.5L22 9.5L17 14L18.5 21L12 17.5L5.5 21L7 14L2 9.5L9 8.5L12 2Z"/>
                        </svg>
                    </div>
                    <span class="text-lg font-bold text-[#0D0F1C] tracking-tight">Ushine</span>
                </div>

                <!-- Navigation Links -->
                <div class="hidden md:flex items-center gap-9">
                    <a href="#" class="text-sm font-medium text-[#0D0F1C]">About</a>
                    <a href="#" class="text-sm font-medium text-[#0D0F1C]">How it Works</a>
                    <a href="#" class="text-sm font-medium text-[#0D0F1C]">Talents</a>
                    <a href="#" class="text-sm font-medium text-[#0D0F1C]">Sponsors</a>
                </div>

                <!-- Buttons -->
                <div class="flex items-center gap-2">
                    <a href="{{ route('register') }}" 
                       class="h-10 px-4 bg-[#607AFB] rounded-xl flex items-center justify-center hover:bg-[#4F64D9] transition-colors">
                        <span class="text-sm font-bold text-white tracking-wide">Register</span>
                    </a>
                    <a href="{{ route('login') }}" 
                       class="h-10 px-4 bg-[#E6E9F4] rounded-xl flex items-center justify-center hover:bg-[#D9DEEB] transition-colors">
                        <span class="text-sm font-bold text-[#0D0F1C] tracking-wide">Login</span>
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="container mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <div class="max-w-6xl mx-auto">
            <div class="relative h-[480px] rounded-xl overflow-hidden">
                <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuBDGdYChhzQZBgFEY-S-nFv9Ttyz1vq_2i2TEg-6b3Jf0z2Pv6CsStzrg6VZAtpqP4ud7qcAQiQquq3UWbs4B02vXL0F4_C-oRLTjD7IhzfNYamngwNsO9l56efOAtSQAZFBjrDaZzeuyALRvNSNnsfpmfqDjiA9Y3Y1Wfqg3N7a9SIVSJ0SLYQs-35woUugtxbbqkDT3kQdVCiwqTdBgKCYaoVPNuvjMsV7kSFDsNRyVsXGN7K38awqmX1owfO0KuTMe3FHPT8v4SX" 
                     alt="Hero Background"
                     class="absolute inset-0 w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-black/10 rounded-xl"></div>
                <div class="relative h-full flex items-center justify-center text-center px-8">
                    <div class="max-w-3xl">
                        <h1 class="text-4xl md:text-5xl lg:text-6xl font-black text-white tracking-tight leading-tight">
                            Unleash Your Potential, Connect with Sponsors
                        </h1>
                        <p class="mt-4 text-base md:text-lg text-white leading-relaxed">
                            Ushine is a social crowdfunding platform designed to empower emerging talents. Share your passion, connect with sponsors, and embark on a journey of growth and collaboration.
                        </p>
                        <div class="mt-8">
                            <a href="{{ route('register') }}" 
                               class="inline-flex h-12 px-5 bg-[#607AFB] rounded-xl items-center justify-center hover:bg-[#4F64D9] transition-colors">
                                <span class="text-base font-bold text-white tracking-wide">Start Your Journey</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- How Ushine Empowers You Section -->
    <section class="container mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="max-w-6xl mx-auto">
            <div class="mb-4">
                <span class="text-lg font-bold text-[#0D0F1C] tracking-tight">How Ushine Empowers You</span>
            </div>
            <h2 class="text-3xl md:text-4xl font-bold text-[#0D0F1C] tracking-tight mb-4">
                Key Benefits
            </h2>
            <p class="text-base text-[#0D0F1C] leading-relaxed max-w-2xl mb-10">
                Ushine provides a platform for emerging talents to connect with sponsors through a gamified donation system. Here's how you can benefit:
            </p>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <!-- Feature Card 1 -->
                <div class="p-4 border border-[#CED2E9] rounded-lg bg-[#F8F9FC]">
                    <svg class="w-6 h-6 text-[#0D0F1C] mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                    <h3 class="text-base font-bold text-[#0D0F1C] mb-1">Share Your Talent</h3>
                    <p class="text-sm text-[#47569E] leading-relaxed">
                        Showcase your unique skills and passions to a global audience of potential sponsors.
                    </p>
                </div>
                
                <!-- Feature Card 2 -->
                <div class="p-4 border border-[#CED2E9] rounded-lg bg-[#F8F9FC]">
                    <svg class="w-6 h-6 text-[#0D0F1C] mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <h3 class="text-base font-bold text-[#0D0F1C] mb-1">Receive Support</h3>
                    <p class="text-sm text-[#47569E] leading-relaxed">
                        Receive financial and mentorship support from sponsors who believe in your vision.
                    </p>
                </div>
                
                <!-- Feature Card 3 -->
                <div class="p-4 border border-[#CED2E9] rounded-lg bg-[#F8F9FC]">
                    <svg class="w-6 h-6 text-[#0D0F1C] mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                    <h3 class="text-base font-bold text-[#0D0F1C] mb-1">Grow Together</h3>
                    <p class="text-sm text-[#47569E] leading-relaxed">
                        Collaborate with fellow talents, learn from experienced mentors, and expand your network.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Talents Section -->
    <section class="container mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="max-w-6xl mx-auto">
            <div class="mb-4">
                <span class="text-lg font-bold text-[#0D0F1C] tracking-tight">Featured Talents</span>
            </div>
            
            <div class="overflow-x-auto pb-4">
                <div class="flex gap-3">
                    <!-- Talent Card 1 -->
                    <div class="flex-shrink-0 w-60">
                        <div class="w-60 h-80 rounded-xl overflow-hidden">
                            <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuBOWnwiZfgamlW_aB5Rq8hMVKJ0nksQUsJS_sAYO4NeNW1S75THPl-QMsm2vvMeFYtcEh86o06rjF5WZSrGJsVZYCXcGYKchnRNci5xmuuw3s-TGYyEn1wm6pw_OkInP1lqYBIPfuEXallbutIObtHEfUSxY0Jh99qudEO5WrmH2-puTl0L_XVUxSWz1m3KtOt1p-ziTtS8u3H6nK6Pi9y7_4eEsS6FPYpkzC1-7AzZVaM6CCVB0v92yQ8Njol8xEBJKtQHflaU1DDW" 
                                 alt="Ava Carter"
                                 class="w-full h-full object-cover">
                        </div>
                        <div class="mt-4">
                            <h4 class="text-base font-medium text-[#0D0F1C]">Ava Carter</h4>
                            <p class="text-sm text-[#47569E]">Singer-songwriter</p>
                        </div>
                    </div>
                    
                    <!-- Talent Card 2 -->
                    <div class="flex-shrink-0 w-60">
                        <div class="w-60 h-80 rounded-xl overflow-hidden">
                            <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuC_sovq1joeNVJp-gfEGp_uGvzs10S4kb6T-UN1Y7wvf4gvi_84fBai_F0VzxGBC9_K15kytVNGRF3owLvPkKRxVMgt0dKx8N4_2DeKer-KRyebSpwtHrdJHDthyyGCnnQEsHtWWzcyMOukeQ6O_J22L9Axt6Km8a2TDCa0xphv3HcOzpbhOSVs6vvvLc6gn4fUbkZS2-ZN7FsUnHnA8UUn8L1tu-y3aPqdihd0PGktMjQ_D85qGMn_6PaC_E-YCu0riPAz51EwyQcx" 
                                 alt="Ethan Blake"
                                 class="w-full h-full object-cover">
                        </div>
                        <div class="mt-4">
                            <h4 class="text-base font-medium text-[#0D0F1C]">Ethan Blake</h4>
                            <p class="text-sm text-[#47569E]">Contemporary dancer</p>
                        </div>
                    </div>
                    
                    <!-- Talent Card 3 -->
                    <div class="flex-shrink-0 w-60">
                        <div class="w-60 h-80 rounded-xl overflow-hidden">
                            <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuC7RW78g0ApGkzdTQqOGqpwuNNW1fGBmED1HdvX_RBa09txh905RZseuhGH3fjuw2-_qBBbHZ7mLKGqnD9Due2s-uEPYddhw-tI7ya5C7sicmB7pnjU4575vXHHlCgS_EkWJ31GDN1xCqYw-qWn0b3l9Mu4Aw7v3NKK7YeM69uj4w3Vc3R5_HtgULdnN2W7dXYMSYMcPgPjp5W5roxWjXy3AilbRKPTtwpXIvuTstqA7gl5YvQhQgRjtIBwflKS9CLmJZuSfZlU-0O5" 
                                 alt="Sophia Bennett"
                                 class="w-full h-full object-cover">
                        </div>
                        <div class="mt-4">
                            <h4 class="text-base font-medium text-[#0D0F1C]">Sophia Bennett</h4>
                            <p class="text-sm text-[#47569E]">Visual artist</p>
                        </div>
                    </div>
                    
                    <!-- Talent Card 4 -->
                    <div class="flex-shrink-0 w-60">
                        <div class="w-60 h-80 rounded-xl overflow-hidden">
                            <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuDaUGPj7QRp1iVo37Q7IrmdTcUyfJ_rngRWCl3k0pA4JxYygI2p2D93UPg6OF5X7WXC4FZ-Ts9wB2FHGVWK8_0uu1Q0vG4xt3AHcDrvVEQghtRW2y3fCIgLBexFZEiX1IO-EI2AjUg6nZYwrNilpVneOdFoPiczSTsyttQBrEuMEwFbuDhec5DiZKyea5noL_5bFaIQKd6jL8Ln62wu1RX3O81hqULrBbSZRo8kEdI2JlLGCW3CqPm4m_Tuluu3x2VRgWwWrFHIGaCb" 
                                 alt="Liam Harper"
                                 class="w-full h-full object-cover">
                        </div>
                        <div class="mt-4">
                            <h4 class="text-base font-medium text-[#0D0F1C]">Liam Harper</h4>
                            <p class="text-sm text-[#47569E]">Jazz musician</p>
                        </div>
                    </div>
                    
                    <!-- Talent Card 5 -->
                    <div class="flex-shrink-0 w-60">
                        <div class="w-60 h-80 rounded-xl overflow-hidden">
                            <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuCuAj_PSXcmpPSj3mxlA2KmJWsMGTsGp4CxczzXDY8pdVhANgchgomewgAKsMLU1n5S0UZJdx8Rbsv5Pm0R3m4nneS25eIb2X6pxt6R5rS2hl4YvAT_8GcltKK9i4QiUlesooMKZPNNE4aX9dBXjqrBZbN3gxNxE7ODRVJF8NhEKQosPQ73wNDWz9_a1zJTv1g1fRIJxSV6LHTDfNuzCJTtpQbAXkjDoZ7fOVs6tJajynIC3bftI3_pIPVwMGeV5ZNKMwYmlww1bpFc" 
                                 alt="Olivia Hayes"
                                 class="w-full h-full object-cover">
                        </div>
                        <div class="mt-4">
                            <h4 class="text-base font-medium text-[#0D0F1C]">Olivia Hayes</h4>
                            <p class="text-sm text-[#47569E]">Creative writer</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Join Community Section -->
    <section class="container mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="max-w-3xl mx-auto text-center">
            <h2 class="text-3xl md:text-4xl font-bold text-[#0D0F1C] tracking-tight mb-8">
                Ready to Shine? Join Our Community
            </h2>
            <a href="{{ route('register') }}" 
               class="inline-flex h-12 px-5 bg-[#607AFB] rounded-xl items-center justify-center hover:bg-[#4F64D9] transition-colors">
                <span class="text-base font-bold text-white tracking-wide">Join Ushine Today</span>
            </a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="border-t border-[#E6E9F4] mt-16">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-10">
            <div class="flex flex-wrap justify-center gap-8 mb-6">
                <a href="#" class="text-base text-[#47569E] hover:text-[#0D0F1C] transition-colors">About</a>
                <a href="#" class="text-base text-[#47569E] hover:text-[#0D0F1C] transition-colors">Contact</a>
                <a href="#" class="text-base text-[#47569E] hover:text-[#0D0F1C] transition-colors">Terms of Service</a>
                <a href="#" class="text-base text-[#47569E] hover:text-[#0D0F1C] transition-colors">Privacy Policy</a>
            </div>
            <div class="flex justify-center gap-4 mb-6">
                <a href="#" class="text-[#47569E] hover:text-[#0D0F1C] transition-colors">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"/>
                    </svg>
                </a>
                <a href="#" class="text-[#47569E] hover:text-[#0D0F1C] transition-colors">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z"/>
                    </svg>
                </a>
                <a href="#" class="text-[#47569E] hover:text-[#0D0F1C] transition-colors">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M16 8a6 6 0 016 6v7h-4v-7a2 2 0 00-2-2 2 2 0 00-2 2v7h-4v-7a6 6 0 016-6zM2 9h4v12H2z"/>
                        <circle cx="4" cy="4" r="2"/>
                    </svg>
                </a>
            </div>
            <p class="text-center text-base text-[#47569E]">
                © 2024 Ushine. All rights reserved.
            </p>
        </div>
    </footer>
</div>
@endsection