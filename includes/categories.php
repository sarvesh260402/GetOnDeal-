<!-- CATEGORIES -->
<?php 
require_once __DIR__ . '/../data/categories.php'; 
require_once __DIR__ . '/api_helper.php';

$apiCats = ApiClient::get('/cms/categories');
$displayCategories = (!empty($apiCats)) ? $apiCats : $categories;
?>
<section id="categories" class="py-16 sm:py-24 bg-white overflow-hidden">
    <div class="max-w-7xl mx-auto px-5 sm:px-8">
        <div class="flex flex-col lg:flex-row lg:items-end justify-between gap-6 mb-12">
            <div class="max-w-2xl">
                <p class="text-xs font-bold text-[#F7931E] uppercase tracking-[0.25em] mb-3">— Explore</p>
                <h2 class="font-display text-4xl sm:text-5xl lg:text-[4rem] font-extrabold text-[#0B0B12] leading-[0.95]">What's the <span class="font-serif italic font-normal text-[#1E73BE]">mood</span> tonight?</h2>
            </div>
            <div class="flex items-center gap-4">
                <p class="text-sm text-[#5B6271] max-w-xs">Six worlds, infinite ways to discover Mumbai. Pick where you want to go.</p>
                <a href="#deals" class="shrink-0 w-12 h-12 rounded-full bg-[#0B0B12] text-white flex items-center justify-center hover:bg-[#1E73BE] transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M7 7h10v10"/><path d="M7 17 17 7"/></svg>
                </a>
            </div>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4 sm:gap-6">
            <?php foreach($displayCategories as $c): ?>
            <a href="listings.php?cat=<?= $c['slug'] ?>" class="group relative rounded-3xl overflow-hidden cursor-pointer <?= $c['extra'] ?> animate-on-scroll">
                <img alt="<?= htmlspecialchars($c['label']) ?>" class="absolute inset-0 w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" src="<?= $c['img'] ?>" loading="lazy">
                <div class="absolute inset-0 bg-gradient-to-t <?= $c['bg'] ?> via-[#0B0B12]/30 to-transparent"></div>
                <div class="absolute top-4 right-4 w-10 h-10 rounded-full bg-white/15 backdrop-blur-md flex items-center justify-center text-white opacity-0 group-hover:opacity-100 transition-opacity">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M7 7h10v10"/><path d="M7 17 17 7"/></svg>
                </div>
                <span class="absolute top-4 left-4 text-[10px] font-bold uppercase tracking-widest px-2.5 py-1 rounded-full <?= $c['badge'] ?>"><?= $c['count'] ?></span>
                <div class="absolute inset-0 p-5 sm:p-6 flex flex-col justify-end text-white">
                    <h3 class="font-display text-2xl sm:text-3xl font-extrabold leading-tight"><?= $c['label'] ?></h3>
                    <p class="text-xs sm:text-sm opacity-90 mt-1"><?= $c['desc'] ?></p>
                </div>
            </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>
