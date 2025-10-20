{{-- Social Media Share Card - Version Mobile Optimisée 2025 --}}
<div class="max-w-5xl mx-auto px-4 mt-6 mb-6">
    <div class="bg-white/80 backdrop-blur-xl rounded-3xl shadow-2xl border border-gray-200/50 overflow-hidden">
        
        <!-- Header élégant et mobile-optimisé -->
        <div class="bg-gradient-to-r from-indigo-50 via-purple-50 to-pink-50 px-4 py-3 border-b border-gray-200/50">
            <div class="flex items-center justify-between gap-3">
                <div class="flex items-center gap-2">
                    <div class="bg-gradient-to-br from-blue-500 to-purple-600 rounded-xl p-2 shadow-lg flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
                        </svg>
                    </div>
                    <div class="flex-1 min-w-0">
                        <h3 class="text-sm font-bold text-gray-900 leading-tight">Partager ce profil</h3>
                        <p class="text-xs text-gray-700 flex items-center gap-1 font-medium leading-tight mt-0.5">
                            <span class="text-sm">💡</span>
                            <span class="truncate">Partagez avec quelqu'un qui a besoin d'aide</span>
                        </p>
                    </div>
                </div>
                @auth
                    <div class="hidden lg:flex items-center gap-1.5 bg-white/60 backdrop-blur-sm px-2.5 py-1.5 rounded-full border border-gray-200/50 flex-shrink-0">
                        <span class="text-[10px] text-gray-600 font-medium">Code:</span>
                        <span class="text-[10px] font-bold text-blue-600">{{ Auth::user()->affiliate_code }}</span>
                    </div>
                @endauth
            </div>
        </div>

        <!-- Boutons sociaux optimisés mobile -->
        <div class="p-3.5">
            <div class="grid grid-cols-3 md:grid-cols-6 gap-2.5">
                
                <!-- WhatsApp -->
                <button onclick="shareToWhatsApp()" 
                    class="group relative bg-gradient-to-br from-green-50 to-green-100 hover:from-green-500 hover:to-green-600 rounded-xl p-3.5 transition-all duration-300 hover:scale-105 hover:shadow-lg border border-green-200 hover:border-green-500 active:scale-95">
                    <div class="flex flex-col items-center gap-1.5">
                        <i class="fab fa-whatsapp text-2xl text-green-600 group-hover:text-white transition-colors"></i>
                        <span class="text-[10px] font-bold text-green-700 group-hover:text-white transition-colors uppercase tracking-wider leading-tight">WhatsApp</span>
                    </div>
                </button>

                <!-- Facebook -->
                <button onclick="shareToFacebook()" 
                    class="group relative bg-gradient-to-br from-blue-50 to-blue-100 hover:from-blue-500 hover:to-blue-600 rounded-xl p-3.5 transition-all duration-300 hover:scale-105 hover:shadow-lg border border-blue-200 hover:border-blue-500 active:scale-95">
                    <div class="flex flex-col items-center gap-1.5">
                        <i class="fab fa-facebook text-2xl text-blue-600 group-hover:text-white transition-colors"></i>
                        <span class="text-[10px] font-bold text-blue-700 group-hover:text-white transition-colors uppercase tracking-wider leading-tight">Facebook</span>
                    </div>
                </button>

                <!-- Twitter -->
                <button onclick="shareToTwitter()" 
                    class="group relative bg-gradient-to-br from-gray-50 to-gray-100 hover:from-gray-800 hover:to-black rounded-xl p-3.5 transition-all duration-300 hover:scale-105 hover:shadow-lg border border-gray-200 hover:border-gray-800 active:scale-95">
                    <div class="flex flex-col items-center gap-1.5">
                        <i class="fab fa-x-twitter text-2xl text-gray-800 group-hover:text-white transition-colors"></i>
                        <span class="text-[10px] font-bold text-gray-700 group-hover:text-white transition-colors uppercase tracking-wider leading-tight">Twitter</span>
                    </div>
                </button>

                <!-- LinkedIn -->
                <button onclick="shareToLinkedIn()" 
                    class="group relative bg-gradient-to-br from-blue-50 to-blue-100 hover:from-blue-600 hover:to-blue-700 rounded-xl p-3.5 transition-all duration-300 hover:scale-105 hover:shadow-lg border border-blue-200 hover:border-blue-600 active:scale-95">
                    <div class="flex flex-col items-center gap-1.5">
                        <i class="fab fa-linkedin text-2xl text-blue-600 group-hover:text-white transition-colors"></i>
                        <span class="text-[10px] font-bold text-blue-700 group-hover:text-white transition-colors uppercase tracking-wider leading-tight">LinkedIn</span>
                    </div>
                </button>

                <!-- Email -->
                <button onclick="shareViaEmail()" 
                    class="group relative bg-gradient-to-br from-red-50 to-red-100 hover:from-red-500 hover:to-red-600 rounded-xl p-3.5 transition-all duration-300 hover:scale-105 hover:shadow-lg border border-red-200 hover:border-red-500 active:scale-95">
                    <div class="flex flex-col items-center gap-1.5">
                        <i class="fas fa-envelope text-2xl text-red-600 group-hover:text-white transition-colors"></i>
                        <span class="text-[10px] font-bold text-red-700 group-hover:text-white transition-colors uppercase tracking-wider leading-tight">Email</span>
                    </div>
                </button>

                <!-- Copy Link -->
                <button onclick="copyShareLink()" id="copyBtnShare" 
                    class="group relative bg-gradient-to-br from-purple-50 to-purple-100 hover:from-purple-500 hover:to-purple-600 rounded-xl p-3.5 transition-all duration-300 hover:scale-105 hover:shadow-lg border border-purple-200 hover:border-purple-500 active:scale-95">
                    <div class="flex flex-col items-center gap-1.5">
                        <i class="fas fa-link text-2xl text-purple-600 group-hover:text-white transition-colors"></i>
                        <span class="text-[10px] font-bold text-purple-700 group-hover:text-white transition-colors uppercase tracking-wider leading-tight">Copier</span>
                    </div>
                </button>

            </div>

            <!-- Message optimisé mobile -->
            <div class="mt-3 bg-gradient-to-r from-amber-50 via-yellow-50 to-amber-50 border border-amber-200/50 rounded-xl px-3 py-2.5">
                <p class="text-xs font-semibold text-amber-800 text-center flex items-center justify-center gap-2 leading-relaxed">
                    <svg class="w-4 h-4 text-amber-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                    </svg>
                    <span>Aidez votre réseau à trouver des services de qualité et gagnez des récompenses</span>
                </p>
            </div>
        </div>

    </div>
</div>

<!-- Hidden affiliate link -->
@auth
<input type="text" id="affiliateLinkShare" value="{{ url('/signup?code=' . Auth::user()->affiliate_code) }}" hidden>
@else
<input type="text" id="affiliateLinkShare" value="{{ $shareUrl ?? url()->current() }}" hidden>
@endauth

<script>
(function() {
    function getShareUrl() {
        const input = document.getElementById('affiliateLinkShare');
        if (!input) return window.location.href;
        
        let shareUrl = input.value;
        
        try {
            const urlObj = new URL(shareUrl, window.location.origin);
            urlObj.searchParams.set('utm_source', 'social');
            urlObj.searchParams.set('utm_medium', 'share');
            urlObj.searchParams.set('utm_campaign', 'referral');
            shareUrl = urlObj.toString();
        } catch (e) {
            console.error('UTM error:', e);
        }
        
        return shareUrl;
    }

    window.shareToWhatsApp = function() {
        const url = encodeURIComponent(getShareUrl());
        const text = encodeURIComponent("🌟 Check out this amazing service provider!");
        window.open(`https://api.whatsapp.com/send?text=${text}%20${url}`, '_blank', 'noopener,noreferrer');
    };

    window.shareToFacebook = function() {
        const url = encodeURIComponent(getShareUrl());
        window.open(`https://www.facebook.com/sharer/sharer.php?u=${url}`, '_blank', 'noopener,noreferrer,width=600,height=400');
    };

    window.shareToTwitter = function() {
        const url = encodeURIComponent(getShareUrl());
        const text = encodeURIComponent("Check out this amazing service provider! 🌟");
        window.open(`https://twitter.com/intent/tweet?url=${url}&text=${text}`, '_blank', 'noopener,noreferrer,width=600,height=400');
    };

    window.shareToLinkedIn = function() {
        const url = encodeURIComponent(getShareUrl());
        window.open(`https://www.linkedin.com/sharing/share-offsite/?url=${url}`, '_blank', 'noopener,noreferrer,width=600,height=400');
    };

    window.shareViaEmail = function() {
        const url = getShareUrl();
        const subject = encodeURIComponent("Check out this service provider!");
        const body = encodeURIComponent(`Hi,\n\nI found this great service provider that might interest you:\n\n${url}\n\nBest regards`);
        window.location.href = `mailto:?subject=${subject}&body=${body}`;
    };

    window.copyShareLink = function() {
        const url = getShareUrl();
        const btn = document.getElementById('copyBtnShare');
        
        navigator.clipboard.writeText(url).then(() => {
            const originalHTML = btn.innerHTML;
            
            btn.classList.remove('from-purple-50', 'to-purple-100', 'hover:from-purple-500', 'hover:to-purple-600', 'border-purple-200');
            btn.classList.add('from-green-500', 'to-green-600', 'border-green-500');
            btn.innerHTML = `
                <div class="flex flex-col items-center gap-2">
                    <i class="fas fa-check text-2xl text-white"></i>
                    <span class="text-[10px] font-semibold text-white uppercase tracking-wide">Copied!</span>
                </div>
            `;
            
            if (typeof toastr !== 'undefined') {
                toastr.success('Link copied to clipboard! 🎉');
            }
            
            setTimeout(() => {
                btn.classList.remove('from-green-500', 'to-green-600', 'border-green-500');
                btn.classList.add('from-purple-50', 'to-purple-100', 'hover:from-purple-500', 'hover:to-purple-600', 'border-purple-200');
                btn.innerHTML = originalHTML;
            }, 2000);
            
        }).catch(() => {
            if (typeof toastr !== 'undefined') {
                toastr.error('Failed to copy link');
            }
        });
    };
})();
</script>