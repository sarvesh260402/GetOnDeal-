<!-- HOW IT WORKS -->
<section id="how" class="py-20 sm:py-28 bg-white relative overflow-hidden">
    <div class="absolute inset-0 dot-pattern opacity-40 pointer-events-none"></div>
    <div class="relative max-w-7xl mx-auto px-5 sm:px-8">
        <div class="max-w-3xl mb-14 animate-on-scroll">
            <p class="text-xs font-bold text-[#F7931E] uppercase tracking-[0.25em] mb-3">— How it works</p>
            <h2 class="font-display text-4xl sm:text-5xl lg:text-[4rem] font-extrabold text-[#0B0B12] leading-[0.95]">Save more in <span class="font-serif italic font-normal text-[#1E73BE]">four</span> simple steps.</h2>
        </div>

        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-px bg-[#E6EAF0] rounded-3xl overflow-hidden border border-[#E6EAF0] animate-on-scroll">
            <?php
            $steps = [
                ['n'=>'01','title'=>'Discover','desc'=>'Browse handpicked cafes, restaurants, resorts & experiences across Mumbai.','icon'=>'<path d="m21 21-4.34-4.34"/><circle cx="11" cy="11" r="8"/>'],
                ['n'=>'02','title'=>'Pick a deal','desc'=>'Real prices, real reviews, exclusive member savings — no fine print.','icon'=>'<path d="M3.85 8.62a4 4 0 0 1 4.78-4.77 4 4 0 0 1 6.74 0 4 4 0 0 1 4.78 4.78 4 4 0 0 1 0 6.74 4 4 0 0 1-4.77 4.78 4 4 0 0 1-6.75 0 4 4 0 0 1-4.78-4.77 4 4 0 0 1 0-6.76Z"/><path d="m15 9-6 6"/><path d="M9 9h.01"/><path d="M15 15h.01"/>'],
                ['n'=>'03','title'=>'Book in seconds','desc'=>'Reserve a table, lock a stay, or grab tickets — all in two taps.','icon'=>'<path d="M8 2v4"/><path d="M16 2v4"/><rect width="18" height="18" x="3" y="4" rx="2"/><path d="M3 10h18"/><path d="m9 16 2 2 4-4"/>'],
                ['n'=>'04','title'=>'Show up & save','desc'=>'Flash your QR at the venue. Enjoy. We handle the rest.','icon'=>'<path d="M5.8 11.3 2 22l10.7-3.79"/><path d="M4 3h.01"/><path d="M22 8h.01"/><path d="M15 2h.01"/><path d="M22 20h.01"/><path d="m22 2-2.24.75a2.9 2.9 0 0 0-1.96 3.12c.1.86-.57 1.63-1.45 1.63h-.38c-.86 0-1.6.6-1.76 1.44L14 10"/><path d="m22 13-.82-.33c-.86-.34-1.82.2-1.98 1.11c-.11.7-.72 1.22-1.43 1.22H17"/><path d="m11 2 .33.82c.34.86-.2 1.82-1.11 1.98C9.52 4.9 9 5.52 9 6.23V7"/><path d="M11 13c1.93 1.93 2.83 4.17 2 5-.83.83-3.07-.07-5-2-1.93-1.93-2.83-4.17-2-5 .83-.83 3.07.07 5 2Z"/>'],
            ];
            foreach($steps as $s):
            ?>
            <div class="bg-white p-7 sm:p-8 relative group hover:bg-[#FFFCF5] transition-colors">
                <span class="font-display num-shadow text-7xl font-extrabold leading-none block"><?= $s['n'] ?></span>
                <div class="mt-6 w-12 h-12 rounded-2xl bg-[#0B0B12] text-white flex items-center justify-center group-hover:bg-[#F7931E] transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><?= $s['icon'] ?></svg>
                </div>
                <h3 class="font-display font-bold text-[#0B0B12] text-2xl mt-5"><?= $s['title'] ?></h3>
                <p class="text-sm text-[#5B6271] leading-relaxed mt-3"><?= $s['desc'] ?></p>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
