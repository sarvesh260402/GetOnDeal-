<!-- TESTIMONIALS -->
<?php require_once __DIR__ . '/../data/testimonials.php'; ?>
<section class="py-20 sm:py-28 bg-[#0B0B12] relative overflow-hidden">
    <!-- Blur Orbs -->
    <div class="absolute top-0 right-0 w-[30rem] h-[30rem] bg-[#F7931E]/10 blur-[120px] rounded-full"></div>
    <div class="absolute bottom-0 left-0 w-[30rem] h-[30rem] bg-[#1E73BE]/10 blur-[120px] rounded-full"></div>

    <div class="relative max-w-7xl mx-auto px-5 sm:px-8 grid lg:grid-cols-12 gap-12 items-center">
        <div class="lg:col-span-5 animate-on-scroll">
            <p class="text-xs font-bold text-[#F7931E] uppercase tracking-[0.25em] mb-3">— Testimonials</p>
            <h2 class="font-display text-4xl sm:text-5xl lg:text-6xl font-extrabold text-white leading-[0.95]">Real members.<br><span class="font-serif italic font-normal text-[#FFA726]">Really good times.</span></h2>
            <p class="mt-6 text-white/60 text-base leading-relaxed max-w-md">Join 200,000+ Mumbaikars who are discovering the city's best spots at prices that actually make sense.</p>
            
            <div class="mt-10 flex items-center gap-4">
                <button id="test-prev" class="w-12 h-12 rounded-full border border-white/10 bg-white/5 text-white hover:bg-white hover:text-[#0B0B12] flex items-center justify-center transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
                </button>
                <button id="test-next" class="w-12 h-12 rounded-full border border-white/10 bg-white/5 text-white hover:bg-white hover:text-[#0B0B12] flex items-center justify-center transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6 6-6"/></svg>
                </button>
                <div class="ml-4 flex gap-2">
                    <?php foreach($testimonials as $i=>$t): ?>
                    <span class="testimonial-dot w-2 h-2 rounded-full bg-white/20 transition-all"></span>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <div class="lg:col-span-7 animate-on-scroll">
            <div class="relative">
                <?php foreach($testimonials as $i=>$t): ?>
                <div class="testimonial-item bg-white rounded-[2rem] p-8 sm:p-12 shadow-2xl" style="display: <?= $i===0 ? 'block' : 'none' ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="#F7931E" stroke="none" class="opacity-20 mb-6"><path d="M14.017 21L14.017 18C14.017 16.8954 14.9124 16 16.017 16H19.017C19.5693 16 20.017 15.5523 20.017 15V9C20.017 8.44772 19.5693 8 19.017 8H16.017C15.4647 8 15.017 8.44772 15.017 9V12C15.017 12.5523 14.5693 13 14.017 13H12.017C11.4647 13 11.017 12.5523 11.017 12V9C11.017 6.23858 13.2556 4 16.017 4H17.017C17.5693 4 18.017 3.55228 18.017 3V2C18.017 1.44772 17.5693 1 17.017 1H16.017C11.5987 1 8.017 4.58172 8.017 9V15C8.017 18.3137 10.7033 21 14.017 21ZM5.017 21L5.017 18C5.017 16.8954 5.91242 16 7.017 16H10.017C10.5693 16 11.017 15.5523 11.017 15V9C11.017 8.44772 10.5693 8 10.017 8H7.017C6.46472 8 6.017 8.44772 6.017 9V12C6.017 12.5523 5.56929 13 5.017 13H3.017C2.46472 13 2.017 12.5523 2.017 12V9C2.017 6.23858 4.25558 4 7.017 4H8.017C8.56929 4 9.017 3.55228 9.017 3V2C9.017 1.44772 8.56929 1 8.017 1H7.017C2.59872 1 0.017 4.58172 0.017 9V15C0.017 18.3137 2.7033 21 6.017 21H5.017Z"/></svg>
                    <div class="flex gap-1 mb-6">
                        <?php for($j=0;$j<5;$j++): ?>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="#F7931E" stroke="#F7931E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11.525 2.295a.53.53 0 0 1 .95 0l2.31 4.679a2.123 2.123 0 0 0 1.595 1.16l5.166.756a.53.53 0 0 1 .294.904l-3.736 3.638a2.123 2.123 0 0 0-.611 1.878l.882 5.14a.53.53 0 0 1-.771.56l-4.618-2.428a2.122 2.122 0 0 0-1.973 0L6.396 21.01a.53.53 0 0 1-.77-.56l.881-5.139a2.122 2.122 0 0 0-.611-1.879L2.16 9.795a.53.53 0 0 1 .294-.906l5.165-.755a2.122 2.122 0 0 0 1.597-1.16z"/></svg>
                        <?php endfor; ?>
                    </div>
                    <p class="font-display text-xl sm:text-2xl font-bold text-[#0B0B12] leading-relaxed mb-10 italic">"<?= $t['quote'] ?>"</p>
                    <div class="flex items-center gap-4">
                        <img src="<?= $t['avatar'] ?>" alt="<?= $t['name'] ?>" class="w-14 h-14 rounded-full object-cover">
                        <div>
                            <p class="font-bold text-[#0B0B12] text-lg"><?= $t['name'] ?></p>
                            <p class="text-xs text-[#5B6271] uppercase tracking-widest"><?= $t['role'] ?> · <?= $t['reviews'] ?> reviews</p>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>
