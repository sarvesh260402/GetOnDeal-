<!-- SPOTLIGHT DEAL -->
<section class="py-20 sm:py-28 bg-white">
    <div class="max-w-7xl mx-auto px-5 sm:px-8">
        <div class="flex items-center gap-3 mb-8">
            <span class="w-10 h-10 rounded-full bg-[#FFF4E5] text-[#F7931E] flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M8.5 14.5A2.5 2.5 0 0 0 11 12c0-1.38-.5-2-1-3-1.072-2.143-.224-4.054 2-6 .5 2.5 2 4.9 4 6.5 2 1.6 3 3.5 3 5.5a7 7 0 1 1-14 0c0-1.153.433-2.294 1-3a2.5 2.5 0 0 0 2.5 2.5z"/></svg>
            </span>
            <p class="text-xs font-bold text-[#F7931E] uppercase tracking-[0.25em]">Spotlight · Deal of the night</p>
        </div>

        <div class="grid lg:grid-cols-12 gap-6 lg:gap-10 items-center">
            <!-- Image -->
            <div class="lg:col-span-7 relative animate-on-scroll">
                <div class="rounded-[2rem] overflow-hidden h-[440px] sm:h-[540px] relative">
                    <img alt="The Bombay Canteen" class="w-full h-full object-cover" src="https://images.unsplash.com/photo-1559925393-8be0ec4767c8?w=1600&q=80" loading="lazy">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
                    <div class="absolute top-5 left-5 flex gap-2">
                        <span class="bg-[#F7931E] text-white text-xs font-bold px-3 py-1.5 rounded-full">30% OFF</span>
                        <span class="bg-white/90 backdrop-blur text-[#0B0B12] text-xs font-bold px-3 py-1.5 rounded-full">Editor's Pick</span>
                    </div>
                    <div class="absolute bottom-5 left-5 right-5 text-white flex items-end justify-between">
                        <div>
                            <p class="text-xs opacity-80 uppercase tracking-widest">Lower Parel</p>
                            <h3 class="font-display text-3xl sm:text-5xl font-extrabold">The Bombay Canteen</h3>
                        </div>
                        <div class="hidden sm:flex items-center gap-2 bg-white/15 backdrop-blur-md px-3 py-1.5 rounded-full text-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="#FFA726" stroke="#FFA726" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11.525 2.295a.53.53 0 0 1 .95 0l2.31 4.679a2.123 2.123 0 0 0 1.595 1.16l5.166.756a.53.53 0 0 1 .294.904l-3.736 3.638a2.123 2.123 0 0 0-.611 1.878l.882 5.14a.53.53 0 0 1-.771.56l-4.618-2.428a2.122 2.122 0 0 0-1.973 0L6.396 21.01a.53.53 0 0 1-.77-.56l.881-5.139a2.122 2.122 0 0 0-.611-1.879L2.16 9.795a.53.53 0 0 1 .294-.906l5.165-.755a2.122 2.122 0 0 0 1.597-1.16z"/></svg>
                            <b>4.7</b><span class="opacity-70">(2,840)</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Info -->
            <div class="lg:col-span-5 lg:pl-4 animate-on-scroll">
                <p class="font-serif italic text-2xl text-[#1E73BE] mb-2">"Modern Indian"</p>
                <h3 class="font-display text-3xl sm:text-4xl font-extrabold text-[#0B0B12] leading-tight">The neighbourhood favourite, <br><span class="font-serif italic font-normal">tonight</span> at 30% off.</h3>
                <p class="mt-5 text-[#5B6271] text-base leading-relaxed">A love letter to Indian regional cooking, reimagined for the city that never sleeps. Tonight, the chef's tasting menu comes with a 30% discount and a complimentary cocktail.</p>

                <div class="mt-6 flex flex-wrap gap-2">
                    <?php foreach(["Editor's Pick","Brunch & Bar","Vegetarian options"] as $tag): ?>
                    <span class="text-xs font-medium text-[#0B0B12] bg-[#F5F7FA] border border-[#E6EAF0] px-3 py-1.5 rounded-full"><?= $tag ?></span>
                    <?php endforeach; ?>
                </div>

                <!-- Countdown -->
                <div class="mt-7 bg-[#0B0B12] rounded-2xl p-5 text-white">
                    <p class="text-[11px] uppercase tracking-[0.2em] text-white/60 mb-3 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="#FFA726" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                        Deal ends in
                    </p>
                    <div class="flex items-center gap-3">
                        <div class="text-center">
                            <p class="font-display text-3xl font-extrabold text-[#FFA726]" id="countdown-hrs">03</p>
                            <p class="text-[10px] uppercase tracking-widest text-white/60">Hrs</p>
                        </div>
                        <span class="text-[#FFA726] text-3xl font-extrabold">:</span>
                        <div class="text-center">
                            <p class="font-display text-3xl font-extrabold text-[#FFA726]" id="countdown-min">45</p>
                            <p class="text-[10px] uppercase tracking-widest text-white/60">Min</p>
                        </div>
                        <span class="text-[#FFA726] text-3xl font-extrabold">:</span>
                        <div class="text-center">
                            <p class="font-display text-3xl font-extrabold text-[#FFA726]" id="countdown-sec">21</p>
                            <p class="text-[10px] uppercase tracking-widest text-white/60">Sec</p>
                        </div>
                        <div class="ml-auto text-right">
                            <p class="text-[10px] text-white/50 uppercase tracking-widest">Pay</p>
                            <p class="font-display text-2xl font-extrabold">₹1,680<span class="text-sm text-white/50 line-through font-medium ml-1.5">₹2,400</span></p>
                        </div>
                    </div>
                </div>

                <div class="mt-5 flex gap-3 flex-wrap">
                    <a href="#deals" class="btn-orange text-sm">Book this table <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg></a>
                    <a href="#deals" class="btn-outline-blue text-sm">See similar</a>
                </div>
            </div>
        </div>
    </div>
</section>
