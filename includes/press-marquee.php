<!-- PRESS MARQUEE -->
<div class="border-y border-[#E6EAF0] bg-white py-6 overflow-hidden">
    <div class="flex items-center gap-12 whitespace-nowrap marquee-slow">
        <?php
        $press = ['TIMES FOOD','LBB','MID-DAY','HINDUSTAN TIMES','YOURSTORY','MUMBAI MIRROR','FORBES INDIA','VOGUE INDIA'];
        $duplicatedPress = array_merge($press, $press); // Seamless loop
        foreach($duplicatedPress as $p):
        ?>
        <span class="text-[#9AA3B2] text-base sm:text-lg font-bold tracking-[0.18em] flex items-center gap-12">
            <?= htmlspecialchars($p) ?> <span class="w-1.5 h-1.5 rounded-full bg-[#F7931E]/60"></span>
        </span>
        <?php endforeach; ?>
    </div>
</div>
