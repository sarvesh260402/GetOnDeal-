<section class="relative min-h-[90vh] flex items-center pt-24 pb-20 overflow-hidden bg-[#FFF9F0]">
    <!-- Background Elements -->
    <div class="absolute inset-0 z-0">
        <div class="absolute top-0 right-0 w-[800px] h-[800px] bg-[#D4E7F7]/30 rounded-full blur-[120px] -mr-96 -mt-96 animate-pulse"></div>
        <div class="absolute bottom-0 left-0 w-[600px] h-[600px] bg-[#FFA726]/10 rounded-full blur-[100px] -ml-48 -mb-48"></div>
    </div>

    <div class="max-w-7xl mx-auto px-5 sm:px-8 relative z-10 w-full">
        <div class="grid lg:grid-cols-12 gap-12 items-center">
            <div class="lg:col-span-8 animate-on-scroll">
                <p class="text-xs font-bold text-[#F7931E] uppercase tracking-[0.4em] mb-6">— Curating Mumbai's Finest</p>
                <h1 class="text-5xl sm:text-7xl lg:text-8xl font-black text-[#0B0B12] leading-[1] mb-8">
                    Mumbai's best tables, <br>
                    <span class="font-serif italic font-normal text-[#1E73BE]">unbelievable</span> prices.
                </h1>
                <p class="text-lg sm:text-xl text-[#5B6271] max-w-2xl mb-12 leading-relaxed">
                    Access exclusive <span class="text-[#0B0B12] font-bold">up to 50% off</span> deals at the city's most coveted restaurants, bars, and resorts.
                </p>

                <!-- Search Bar -->
                <div class="mt-8 bg-white rounded-[1.5rem] p-2 shadow-[0_25px_70px_-30px_rgba(15,76,129,0.45)] border border-[#E6EAF0] flex flex-col sm:flex-row gap-2">
                    <div class="flex items-center gap-2 px-4 sm:border-r sm:border-[#E6EAF0] py-3 sm:py-0 flex-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#1E73BE" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="shrink-0" aria-hidden="true"><path d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0"/><circle cx="12" cy="10" r="3"/></svg>
                        <select aria-label="Select City" class="bg-transparent outline-none text-sm font-medium text-[#0B0B12] w-full cursor-pointer">
                            <option selected>Mumbai</option>
                            <option>Bandra</option>
                            <option>Lower Parel</option>
                            <option>Andheri</option>
                            <option>Colaba</option>
                            <option>Powai</option>
                        </select>
                    </div>
                    <div class="flex items-center gap-2 px-4 py-3 sm:py-0 flex-[2]">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#5B6271" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="shrink-0" aria-hidden="true"><path d="m21 21-4.34-4.34"/><circle cx="11" cy="11" r="8"/></svg>
                        <input aria-label="Search for deals" placeholder="Try 'rooftop brunch under ₹999'" class="bg-transparent outline-none text-sm text-[#0B0B12] w-full placeholder-[#9AA3B2]" type="text">
                    </div>
                    <button class="btn-orange text-sm justify-center" style="padding:0.875rem 1.25rem;">Find deals <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg></button>
                </div>

                <!-- Quick Chips -->
                <div class="mt-5 flex flex-wrap gap-2">
                    <span class="text-xs text-[#5B6271] mr-1 self-center">Trending →</span>
                    <?php
                    $chips = ['Bottomless brunch','Date night picks','Live music','Rooftop bars','Alibaug villas'];
                    foreach($chips as $chip):
                    ?>
                    <button class="text-xs font-medium text-[#0B0B12] bg-white border border-[#E6EAF0] hover:border-[#F7931E] hover:text-[#F7931E] hover:bg-[#FFF4E5] transition-colors px-3.5 py-1.5 rounded-full">
                        <?= htmlspecialchars($chip) ?>
                    </button>
                    <?php endforeach; ?>
                </div>

                <!-- CTAs -->
                <div class="mt-9 flex items-center gap-4 flex-wrap">
                    <a href="#download" class="btn-dark text-sm">Download the app <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg></a>
                    <a href="#how" class="flex items-center gap-2.5 text-sm font-semibold text-[#0B0B12] hover:text-[#1E73BE] transition-colors group">
                        <span class="w-10 h-10 rounded-full bg-[#FFF4E5] text-[#F7931E] flex items-center justify-center group-hover:scale-110 transition-transform">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="#F7931E" stroke="#F7931E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="ml-0.5"><polygon points="6 3 20 12 6 21 6 3"/></svg>
                        </span>
                        Watch how it works <span class="text-[#5B6271] font-normal">· 2 min</span>
                    </a>
                </div>
            </div>

            <!-- Right Column - Hero Images -->
            <div class="lg:col-span-5 relative h-[460px] sm:h-[560px] hidden lg:block">
                <div class="absolute top-0 right-0 w-64 h-80 rounded-[1.5rem] overflow-hidden shadow-[0_30px_60px_-25px_rgba(15,76,129,0.45)] rotate-3 animate-on-scroll tilt-card">
                    <img alt="The Bombay Canteen" class="w-full h-full object-cover" src="https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?w=800&q=80" loading="lazy">
                    <div class="absolute bottom-0 left-0 right-0 p-3 bg-gradient-to-t from-black/70 to-transparent text-white">
                        <p class="text-[10px] uppercase tracking-widest opacity-80">Bandra</p>
                        <p class="font-bold text-sm">The Bombay Canteen</p>
                    </div>
                </div>
                <div class="absolute top-32 left-2 w-52 h-64 rounded-[1.5rem] overflow-hidden shadow-[0_30px_60px_-25px_rgba(15,76,129,0.45)] -rotate-3 animate-on-scroll tilt-card" style="animation-delay:0.1s">
                    <img alt="Interior" class="w-full h-full object-cover" src="https://images.unsplash.com/photo-1414235077428-338989a2e8c0?w=600&q=80" loading="lazy">
                </div>
                <div class="absolute bottom-2 right-6 w-56 h-44 rounded-[1.5rem] overflow-hidden shadow-[0_30px_60px_-25px_rgba(15,76,129,0.45)] rotate-2 animate-on-scroll tilt-card" style="animation-delay:0.2s">
                    <img alt="Dining" class="w-full h-full object-cover" src="https://images.unsplash.com/photo-1551632436-cbf8dd35adfa?w=600&q=80" loading="lazy">
                </div>
                <!-- Deal Float Card -->
                <div class="absolute bottom-12 left-0 bg-white rounded-2xl shadow-[0_25px_50px_-15px_rgba(15,76,129,0.4)] p-4 w-60 border border-[#E6EAF0] animate-on-scroll ring-orange-glow" style="animation-delay:0.3s">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-[10px] uppercase tracking-widest text-[#5B6271]">Tonight 8pm</span>
                        <span class="bg-[#FFF4E5] text-[#F7931E] text-[10px] font-bold px-2 py-0.5 rounded-full">50% OFF</span>
                    </div>
                    <p class="font-bold text-[#0B0B12] text-base leading-tight">Olive Bar & Kitchen</p>
                    <p class="text-xs text-[#5B6271] mt-0.5">Khar West · Mediterranean</p>
                    <div class="mt-3 flex items-center justify-between">
                        <span class="flex items-center gap-1 text-xs">
                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="#F7931E" stroke="#F7931E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11.525 2.295a.53.53 0 0 1 .95 0l2.31 4.679a2.123 2.123 0 0 0 1.595 1.16l5.166.756a.53.53 0 0 1 .294.904l-3.736 3.638a2.123 2.123 0 0 0-.611 1.878l.882 5.14a.53.53 0 0 1-.771.56l-4.618-2.428a2.122 2.122 0 0 0-1.973 0L6.396 21.01a.53.53 0 0 1-.77-.56l.881-5.139a2.122 2.122 0 0 0-.611-1.879L2.16 9.795a.53.53 0 0 1 .294-.906l5.165-.755a2.122 2.122 0 0 0 1.597-1.16z"/></svg>
                            <b>4.7</b><span class="text-[#5B6271]">(2.2k)</span>
                        </span>
                        <span class="text-xs font-bold text-[#1E73BE]">₹1,500 →</span>
                    </div>
                </div>
                <!-- Savings Badge -->
                <div class="absolute top-2 left-12 bg-[#0B0B12] text-white rounded-2xl px-4 py-3 animate-on-scroll flex items-center gap-3" style="animation-delay:0.4s">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#F7931E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9.937 15.5A2 2 0 0 0 8.5 14.063l-6.135-1.582a.5.5 0 0 1 0-.962L8.5 9.936A2 2 0 0 0 9.937 8.5l1.582-6.135a.5.5 0 0 1 .963 0L14.063 8.5A2 2 0 0 0 15.5 9.937l6.135 1.581a.5.5 0 0 1 0 .964L15.5 14.063a2 2 0 0 0-1.437 1.437l-1.582 6.135a.5.5 0 0 1-.963 0z"/><path d="M20 3v4"/><path d="M22 5h-4"/><path d="M4 17v2"/><path d="M5 18H3"/></svg>
                    <div>
                        <p class="text-[10px] uppercase tracking-widest text-white/60">Saved this month</p>
                        <p class="font-bold">₹4,21,860</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
