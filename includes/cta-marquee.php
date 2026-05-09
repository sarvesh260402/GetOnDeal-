<!-- CTA MARQUEE -->
<section class="bg-[#F7931E] py-5 overflow-hidden">
    <div class="flex items-center gap-12 whitespace-nowrap marquee-slow">
        <?php
        $ctaTexts = ["Exclusive deals you'll love →", "Handpicked places trusted by us →", "Member benefits & special access →", "Experiences that create memories →", "Get on. Save more. Experience better."];
        $allCta = array_merge($ctaTexts, $ctaTexts);
        foreach($allCta as $t):
        ?>
        <span class="text-white text-xl sm:text-2xl font-bold uppercase tracking-wide flex items-center gap-12">
            <?= htmlspecialchars($t) ?> <span class="w-2 h-2 rounded-full bg-white/40"></span>
        </span>
        <?php endforeach; ?>
    </div>
</section>
