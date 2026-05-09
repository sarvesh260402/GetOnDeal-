<!-- MEMBERSHIP -->
<section class="py-20 sm:py-28 bg-white">
    <div class="max-w-7xl mx-auto px-5 sm:px-8">
        <div class="grid lg:grid-cols-12 gap-8 mb-14 animate-on-scroll">
            <div class="lg:col-span-7">
                <p class="text-xs font-bold text-[#F7931E] uppercase tracking-[0.25em] mb-3">— Membership</p>
                <h2 class="font-display text-4xl sm:text-5xl lg:text-[4rem] font-extrabold text-[#0B0B12] leading-[0.95]">The smart way to <br><span class="font-serif italic font-normal text-[#1E73BE]">eat, drink & escape.</span></h2>
            </div>
            <p class="lg:col-span-5 text-[#5B6271] text-base leading-relaxed self-end">Pay nothing, get plenty. Or unlock Plus & Insider for serious savings, member experiences, and Mumbai's best concierge — all built for people who actually go out.</p>
        </div>

        <div class="grid md:grid-cols-3 gap-5 animate-on-scroll">
            <!-- Free -->
            <div class="relative rounded-3xl p-7 sm:p-8 flex flex-col bg-white border border-[#E6EAF0] text-[#0B0B12]">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-11 h-11 rounded-xl flex items-center justify-center bg-[#FFF4E5] text-[#F7931E]">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 14a1 1 0 0 1-.78-1.63l9.9-10.2a.5.5 0 0 1 .86.46l-1.92 6.02A1 1 0 0 0 13 10h7a1 1 0 0 1 .78 1.63l-9.9 10.2a.5.5 0 0 1-.86-.46l1.92-6.02A1 1 0 0 0 11 14z"/></svg>
                    </div>
                    <h3 class="font-display text-2xl font-extrabold">Free</h3>
                </div>
                <div class="mb-6"><span class="font-display text-5xl font-extrabold">₹0</span><span class="text-sm ml-1 text-[#5B6271]">forever</span></div>
                <ul class="space-y-3 mb-8 flex-1">
                    <?php foreach(['Daily curated deals','Up to 25% off at 500+ venues','Real reviews & ratings','Basic concierge support'] as $p): ?>
                    <li class="flex items-start gap-3 text-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#1E73BE" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="shrink-0 mt-0.5"><path d="M20 6 9 17l-5-5"/></svg>
                        <span class="text-[#0B0B12]"><?= $p ?></span>
                    </li>
                    <?php endforeach; ?>
                </ul>
                <button class="w-full text-center rounded-full px-5 py-3.5 font-semibold text-sm transition-all bg-[#0B0B12] text-white hover:bg-[#1E73BE]">Start free</button>
            </div>

            <!-- Plus (Featured) -->
            <div class="relative rounded-3xl p-7 sm:p-8 flex flex-col bg-[#0B0B12] text-white shadow-[0_30px_70px_-30px_rgba(11,11,18,0.5)]">
                <span class="absolute -top-3 left-7 bg-[#F7931E] text-white text-[10px] font-bold uppercase tracking-widest px-3 py-1.5 rounded-full">Most popular</span>
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-11 h-11 rounded-xl flex items-center justify-center bg-[#F7931E]">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9.937 15.5A2 2 0 0 0 8.5 14.063l-6.135-1.582a.5.5 0 0 1 0-.962L8.5 9.936A2 2 0 0 0 9.937 8.5l1.582-6.135a.5.5 0 0 1 .963 0L14.063 8.5A2 2 0 0 0 15.5 9.937l6.135 1.581a.5.5 0 0 1 0 .964L15.5 14.063a2 2 0 0 0-1.437 1.437l-1.582 6.135a.5.5 0 0 1-.963 0z"/><path d="M20 3v4"/><path d="M22 5h-4"/><path d="M4 17v2"/><path d="M5 18H3"/></svg>
                    </div>
                    <h3 class="font-display text-2xl font-extrabold">Plus</h3>
                </div>
                <div class="mb-6"><span class="font-display text-5xl font-extrabold">₹299</span><span class="text-sm ml-1 text-white/60">/month</span></div>
                <ul class="space-y-3 mb-8 flex-1">
                    <?php foreach(['Up to 50% off at 2,500+ venues','Member-only experiences','Priority bookings on weekends','₹500 free credits monthly','Cancel anytime'] as $p): ?>
                    <li class="flex items-start gap-3 text-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#FFA726" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="shrink-0 mt-0.5"><path d="M20 6 9 17l-5-5"/></svg>
                        <span class="text-white/90"><?= $p ?></span>
                    </li>
                    <?php endforeach; ?>
                </ul>
                <button class="w-full text-center rounded-full px-5 py-3.5 font-semibold text-sm transition-all bg-[#F7931E] text-white hover:bg-[#e3850e]">Try 14 days free</button>
            </div>

            <!-- Insider -->
            <div class="relative rounded-3xl p-7 sm:p-8 flex flex-col bg-white border border-[#E6EAF0] text-[#0B0B12]">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-11 h-11 rounded-xl flex items-center justify-center bg-[#FFF4E5] text-[#F7931E]">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11.562 3.266a.5.5 0 0 1 .876 0L15.39 8.87a1 1 0 0 0 1.516.294L21.183 5.5a.5.5 0 0 1 .798.519l-2.834 10.246a1 1 0 0 1-.956.734H5.81a1 1 0 0 1-.957-.734L2.02 6.02a.5.5 0 0 1 .798-.519l4.276 3.664a1 1 0 0 0 1.516-.294z"/><path d="M5 21h14"/></svg>
                    </div>
                    <h3 class="font-display text-2xl font-extrabold">Insider</h3>
                </div>
                <div class="mb-6"><span class="font-display text-5xl font-extrabold">₹999</span><span class="text-sm ml-1 text-[#5B6271]">/year</span></div>
                <ul class="space-y-3 mb-8 flex-1">
                    <?php foreach(['Everything in Plus','Concierge for restaurant bookings','Personal travel planner','Early access to secret villas','Limited edition merch'] as $p): ?>
                    <li class="flex items-start gap-3 text-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#1E73BE" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="shrink-0 mt-0.5"><path d="M20 6 9 17l-5-5"/></svg>
                        <span class="text-[#0B0B12]"><?= $p ?></span>
                    </li>
                    <?php endforeach; ?>
                </ul>
                <button class="w-full text-center rounded-full px-5 py-3.5 font-semibold text-sm transition-all border border-[#0B0B12] text-[#0B0B12] hover:bg-[#0B0B12] hover:text-white">Apply now</button>
            </div>
        </div>
    </div>
</section>
