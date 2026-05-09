<!-- LIVE ACTIVITY -->
<section class="bg-[#0B0B12] py-6 overflow-hidden border-y border-white/5">
    <div class="flex items-center gap-3 max-w-7xl mx-auto px-5 sm:px-8 mb-3">
        <span class="w-2 h-2 rounded-full bg-green-400 live-dot"></span>
        <span class="text-[11px] uppercase tracking-[0.25em] font-bold text-white/70">Live · Tonight in Mumbai</span>
    </div>
    <div class="flex whitespace-nowrap marquee-track">
        <?php
        $bookings = [
            ['name'=>'Aanya','venue'=>'Olive Bar & Kitchen','area'=>'Khar','saved'=>'₹1,400','time'=>'2 min ago'],
            ['name'=>'Rohan','venue'=>"Toto's Garage",'area'=>'Bandra','saved'=>'₹920','time'=>'4 min ago'],
            ['name'=>'Priya + 3','venue'=>'Suzette','area'=>'Bandra','saved'=>'₹780','time'=>'6 min ago'],
            ['name'=>'Karan','venue'=>'U Tan Beach Resort','area'=>'Alibaug','saved'=>'₹2,000','time'=>'8 min ago'],
            ['name'=>'Megha','venue'=>'Antisocial','area'=>'Khar','saved'=>'₹650','time'=>'11 min ago'],
            ['name'=>'Vihaan','venue'=>'Kitsu Cafe','area'=>'Bandra','saved'=>'₹540','time'=>'13 min ago'],
            ['name'=>'Sara','venue'=>'Bombay Canteen','area'=>'Lower Parel','saved'=>'₹1,100','time'=>'15 min ago'],
            ['name'=>'Aryan','venue'=>'Hot Air Balloon Ride','area'=>'Lonavala','saved'=>'₹1,500','time'=>'18 min ago'],
        ];
        $allBookings = array_merge($bookings, $bookings);
        foreach($allBookings as $b):
        ?>
        <div class="flex items-center gap-3 px-6 text-sm text-white/85">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#4ade80" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="shrink-0"><circle cx="12" cy="12" r="10"/><path d="m9 12 2 2 4-4"/></svg>
            <span><b class="text-white"><?= $b['name'] ?></b> just booked <b class="text-[#FFA726]"><?= $b['venue'] ?></b> in <?= $b['area'] ?></span>
            <span class="text-white/50">·</span>
            <span class="text-white/60">saved <b class="text-white"><?= $b['saved'] ?></b></span>
            <span class="text-white/40 italic"><?= $b['time'] ?></span>
            <span class="text-white/20 text-lg ml-3">•</span>
        </div>
        <?php endforeach; ?>
    </div>
</section>
