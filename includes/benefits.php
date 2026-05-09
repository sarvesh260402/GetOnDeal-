<!-- BENEFITS -->
<section class="py-16 sm:py-24 bg-white relative overflow-hidden">
    <div class="absolute inset-0 dot-pattern opacity-30 pointer-events-none"></div>
    <div class="relative max-w-7xl mx-auto px-5 sm:px-8 grid lg:grid-cols-12 gap-12 items-center">
        <div class="lg:col-span-5 animate-on-scroll">
            <p class="text-sm font-semibold text-[#F7931E] uppercase tracking-[0.2em] mb-2">Why GetOnDeal</p>
            <h2 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-[#0F4C81] leading-tight">Smart deals.<br><span class="text-[#F7931E]">Better experiences.</span></h2>
            <p class="mt-5 text-[#5B6271] text-base leading-relaxed max-w-md">We're not another coupon site. GetOnDeal is your trusted local guide to Mumbai's best food, stays, and nights — at prices that actually feel fair.</p>
            <div class="mt-8 grid grid-cols-3 gap-4 max-w-md">
                <div><p class="text-3xl font-extrabold text-[#1E73BE]">200K+</p><p class="text-xs text-[#5B6271] mt-1">Happy members</p></div>
                <div><p class="text-3xl font-extrabold text-[#1E73BE]">2,500+</p><p class="text-xs text-[#5B6271] mt-1">Partner venues</p></div>
                <div><p class="text-3xl font-extrabold text-[#1E73BE]">₹4 Cr+</p><p class="text-xs text-[#5B6271] mt-1">Saved by users</p></div>
            </div>
        </div>

        <div class="lg:col-span-7 grid sm:grid-cols-2 gap-4 animate-on-scroll">
            <?php
            $features = [
                ['title'=>'Genuine offers, no hidden terms','desc'=>'Every deal is verified with the venue. What you see is exactly what you pay.','icon'=>'shield','bg'=>'bg-[#EAF3FB] text-[#1E73BE]','offset'=>'sm:translate-y-4'],
                ['title'=>'Handpicked, never random','desc'=>"Our local curators visit each venue. Only the spots we'd send our own friends to make the cut.",'icon'=>'badge','bg'=>'bg-[#FFF4E5] text-[#F7931E]','offset'=>''],
                ['title'=>'Member-only experiences','desc'=>"Chef's table dinners, secret rooftop sessions, and city tours — built just for our community.",'icon'=>'sparkles','bg'=>'bg-[#EAF3FB] text-[#1E73BE]','offset'=>'sm:translate-y-4'],
                ['title'=>'Real reviews from real Mumbaikars','desc'=>'No paid placements. Honest ratings from people who actually showed up.','icon'=>'heart','bg'=>'bg-[#FFF4E5] text-[#F7931E]','offset'=>''],
            ];
            foreach($features as $f):
            ?>
            <div class="bg-white border border-[#E6EAF0] rounded-2xl p-6 hover:border-[#D4E7F7] hover:shadow-[0_15px_40px_-20px_rgba(15,76,129,0.3)] transition-all <?= $f['offset'] ?>">
                <div class="w-11 h-11 rounded-xl flex items-center justify-center mb-4 <?= $f['bg'] ?>">
                    <?php if($f['icon']==='shield'): ?>
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z"/><path d="m9 12 2 2 4-4"/></svg>
                    <?php elseif($f['icon']==='badge'): ?>
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M3.85 8.62a4 4 0 0 1 4.78-4.77 4 4 0 0 1 6.74 0 4 4 0 0 1 4.78 4.78 4 4 0 0 1 0 6.74 4 4 0 0 1-4.77 4.78 4 4 0 0 1-6.75 0 4 4 0 0 1-4.78-4.77 4 4 0 0 1 0-6.76Z"/><path d="m9 12 2 2 4-4"/></svg>
                    <?php elseif($f['icon']==='sparkles'): ?>
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M9.937 15.5A2 2 0 0 0 8.5 14.063l-6.135-1.582a.5.5 0 0 1 0-.962L8.5 9.936A2 2 0 0 0 9.937 8.5l1.582-6.135a.5.5 0 0 1 .963 0L14.063 8.5A2 2 0 0 0 15.5 9.937l6.135 1.581a.5.5 0 0 1 0 .964L15.5 14.063a2 2 0 0 0-1.437 1.437l-1.582 6.135a.5.5 0 0 1-.963 0z"/><path d="M20 3v4"/><path d="M22 5h-4"/><path d="M4 17v2"/><path d="M5 18H3"/></svg>
                    <?php else: ?>
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z"/><path d="M12 5 9.04 7.96a2.17 2.17 0 0 0 0 3.08c.82.82 2.13.85 3 .07l2.07-1.9a2.82 2.82 0 0 1 3.79 0l2.96 2.66"/><path d="m18 15-2-2"/><path d="m15 18-2-2"/></svg>
                    <?php endif; ?>
                </div>
                <h3 class="font-bold text-[#1A1A1A] text-[17px] mb-2 leading-snug"><?= $f['title'] ?></h3>
                <p class="text-sm text-[#5B6271] leading-relaxed"><?= $f['desc'] ?></p>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
