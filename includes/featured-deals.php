<!-- FEATURED DEALS -->
<?php 
require_once __DIR__ . '/api_helper.php';

$apiRes = fetchFromApi('/listings?isFeatured=true');
$displayDeals = (isset($apiRes['success']) && $apiRes['success'] && !empty($apiRes['items'])) ? $apiRes['items'] : [];
?>
<section id="deals" class="py-20 sm:py-28 cream-bg">
    <div class="max-w-7xl mx-auto px-5 sm:px-8">
        <div class="flex flex-col lg:flex-row lg:items-end justify-between gap-10 mb-16">
            <div class="max-w-2xl animate-on-scroll">
                <p class="text-xs font-bold text-[#F7931E] uppercase tracking-[0.25em] mb-3">— This Week</p>
                <h2 class="text-4xl sm:text-5xl font-extrabold text-[#0B0B12] leading-[1.1] mb-6">
                    Mumbai's <span class="text-[#1E73BE]">Exclusive</span> Deals.
                </h2>
                <p class="text-[#5B6271] text-lg max-w-xl">Curated hospitality experiences across the city at unbelievable prices. Claim yours before they're gone.</p>
            </div>
            
            <div class="flex items-center gap-3 overflow-x-auto scrollbar-hide pb-2 lg:pb-0 animate-on-scroll">
                <?php 
                $tabs = ['All Deals', 'Restaurants', 'Cafes', 'Nightlife', 'Resorts'];
                foreach($tabs as $i=>$tab): ?>
                <button class="tab-btn <?= $i===0 ? 'active' : 'bg-white border border-[#E6EAF0] text-[#5B6271]' ?>" onclick="filterDeals(this, '<?= $tab ?>')">
                    <?= $tab ?>
                </button>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Cards -->
        <div id="deals-track" class="flex gap-5 overflow-x-auto scrollbar-hide snap-x snap-mandatory pb-4 -mx-5 sm:-mx-8 px-5 sm:px-8">
            <?php foreach($displayDeals as $i=>$d): ?>
            <div class="deal-card min-w-[320px] sm:min-w-[380px] snap-start animate-on-scroll" data-cat="<?= $d['category'] ?>">
                <div class="card-img-container relative h-60 overflow-hidden rounded-2xl mb-4">
                    <img alt="<?= htmlspecialchars($d['name']) ?>" 
                         class="w-full h-full object-cover transition-transform duration-1000 ease-out" 
                         src="<?= $d['img'] ?>" 
                         loading="<?= $i < 2 ? 'eager' : 'lazy' ?>"
                         width="400" height="280"
                         <?= $i === 0 ? 'fetchpriority="high"' : '' ?>>
                    <div class="absolute top-4 left-4">
                        <span class="badge badge-orange bg-white shadow-sm font-bold"><?= $d['discount'] ?> OFF</span>
                    </div>
                    <?php if(isset($d['tag'])): ?>
                    <div class="absolute top-4 right-4">
                        <span class="px-3 py-1.5 rounded-xl bg-black/30 backdrop-blur-md text-white text-[10px] font-bold uppercase tracking-widest border border-white/20"><?= $d['tag'] ?></span>
                    </div>
                    <?php endif; ?>
                </div>
                
                <div class="px-8 pb-8 pt-2">
                    <div class="flex items-center justify-between mb-3">
                        <p class="text-[10px] font-bold text-[#9AA3B2] uppercase tracking-[0.2em]"><?= $d['area'] ?> · <?= $d['cat'] ?></p>
                        <div class="flex items-center gap-1">
                            <svg class="text-[#F7931E]" xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="currentColor"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                            <span class="text-xs font-bold text-[#0B0B12]"><?= $d['rating'] ?></span>
                        </div>
                    </div>
                    
                    <h3 class="text-xl font-bold text-[#0B0B12] mb-6 leading-tight"><?= $d['name'] ?></h3>
                    
                    <div class="flex items-center justify-between pt-6 border-t border-[#F0F2F5]">
                        <div>
                            <p class="text-[10px] text-[#9AA3B2] uppercase tracking-widest font-bold mb-1">Deal Price</p>
                            <p class="text-2xl font-black text-[#0B0B12]">₹<?= number_format($d['price']) ?><span class="text-xs text-[#9AA3B2] line-through font-medium ml-2">₹<?= number_format($d['orig']) ?></span></p>
                        </div>
                        <button class="btn-primary" data-action="book" data-id="<?= isset($d['_id']) ? $d['_id'] : 'deal_'.$i ?>">
                            Claim
                        </button>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <div class="flex justify-center mt-12">
            <a href="#download" class="btn-outline-blue">Explore 2,000+ deals →</a>
        </div>
    </div>
</section>
