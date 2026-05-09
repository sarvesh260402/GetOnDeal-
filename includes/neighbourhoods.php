<!-- NEIGHBOURHOODS -->
<section class="py-16 sm:py-24 bg-white">
    <div class="max-w-7xl mx-auto px-5 sm:px-8">
        <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 mb-10">
            <div>
                <p class="text-sm font-semibold text-[#F7931E] uppercase tracking-[0.2em] mb-2">Mumbai Neighbourhoods</p>
                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-[#0F4C81] leading-tight">Where will you go <br class="hidden sm:block"> tonight?</h2>
            </div>
        </div>

        <div class="grid grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-5">
            <?php
            $hoods = [
                ['name'=>'Bandra','tag'=>'Brunch & Bar Capital','count'=>'320 deals','img'=>'https://images.unsplash.com/photo-1570168007204-dfb528c6958f?w=900&q=80','extra'=>'lg:row-span-2 lg:h-auto h-56'],
                ['name'=>'Lower Parel','tag'=>'Fine Dining Hub','count'=>'210 deals','img'=>'https://images.unsplash.com/photo-1559339352-11d035aa65de?w=900&q=80','extra'=>'h-56'],
                ['name'=>'Andheri','tag'=>'Late Night Eats','count'=>'260 deals','img'=>'https://images.unsplash.com/photo-1555396273-367ea4eb4db5?w=900&q=80','extra'=>'h-56'],
                ['name'=>'Colaba','tag'=>'Heritage Cafés','count'=>'140 deals','img'=>'https://images.unsplash.com/photo-1543007630-9710e4a00a20?w=900&q=80','extra'=>'h-56'],
                ['name'=>'Powai','tag'=>'Lakeside Dining','count'=>'120 deals','img'=>'https://images.unsplash.com/photo-1559339352-11d035aa65de?w=900&q=80&sat=-20','extra'=>'h-56'],
                ['name'=>'Juhu','tag'=>'Beachside Vibes','count'=>'180 deals','img'=>'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=900&q=80','extra'=>'h-56'],
            ];
            foreach($hoods as $h):
            ?>
            <a href="#deals" class="relative rounded-3xl overflow-hidden group cursor-pointer <?= $h['extra'] ?> animate-on-scroll">
                <img alt="<?= htmlspecialchars($h['name']) ?>" class="absolute inset-0 w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" src="<?= $h['img'] ?>" loading="lazy">
                <div class="absolute inset-0 bg-gradient-to-t from-[#0F4C81]/90 via-[#0F4C81]/30 to-transparent"></div>
                <div class="absolute inset-0 p-5 flex flex-col justify-end text-white">
                    <p class="text-[11px] uppercase tracking-[0.2em] opacity-90 font-semibold"><?= $h['tag'] ?></p>
                    <div class="flex items-end justify-between mt-1">
                        <h3 class="text-2xl sm:text-3xl font-extrabold leading-tight"><?= $h['name'] ?></h3>
                        <div class="w-10 h-10 rounded-full bg-[#F7931E] flex items-center justify-center group-hover:scale-110 transition-transform">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M7 7h10v10"/><path d="M7 17 17 7"/></svg>
                        </div>
                    </div>
                    <p class="text-xs mt-2 opacity-90"><?= $h['count'] ?></p>
                </div>
            </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>
