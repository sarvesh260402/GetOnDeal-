<!-- STICKY NAVBAR -->
<nav id="main-nav" class="fixed top-0 left-0 w-full z-[100] transition-all duration-500 border-b border-transparent bg-white/80 backdrop-blur-md">
    <div class="max-w-7xl mx-auto px-5 sm:px-8 py-4 sm:py-5 flex items-center justify-between">
        <!-- Logo -->
        <a href="index.php" class="flex items-center gap-1.5 group">
            <span style="color:#1E73BE;font-weight:800;font-size:26px;letter-spacing:-0.04em;">Get</span>
            <div class="w-7 h-7 rounded-full bg-[#F7931E] flex items-center justify-center text-white font-black text-sm shadow-[0_4px_10px_-2px_rgba(247,147,30,0.5)] group-hover:scale-110 transition-transform">%</div>
            <span style="color:#0F4C81;font-weight:800;font-size:26px;letter-spacing:-0.04em;">nDeal</span>
        </a>

        <!-- Desktop Nav -->
        <nav class="hidden lg:flex items-center gap-7">
            <?php
            $navLinks = ['Restaurants','Cafes','Nightlife','Resorts','Experiences'];
            foreach($navLinks as $link):
            ?>
            <a href="#deals" class="text-[15px] font-medium text-[#1A1A1A] hover:text-[#1E73BE] transition-colors"><?= $link ?></a>
            <?php endforeach; ?>
        </nav>

        <!-- Desktop CTA -->
        <div class="hidden md:flex items-center gap-3">
            <button class="hidden md:inline-flex items-center gap-1.5 text-sm font-medium text-[#1A1A1A] hover:text-[#1E73BE] transition-colors px-3 py-2 rounded-full">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-[#F7931E]"><path d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0"/><circle cx="12" cy="10" r="3"/></svg>
                Mumbai
                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
            </button>
            <a href="#" class="text-sm font-semibold text-[#1A1A1A] hover:text-[#1E73BE] px-3 py-2">Log in</a>
            <a href="#download" class="btn-orange text-sm" style="padding:0.625rem 1.25rem;">Get the App</a>
        </div>

        <!-- Mobile Toggle -->
        <button id="menu-toggle" class="lg:hidden p-2 rounded-lg text-[#1A1A1A]" aria-label="Open menu">
            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 12h16"/><path d="M4 18h16"/><path d="M4 6h16"/></svg>
        </button>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="lg:hidden bg-white border-t border-[#E6EAF0] px-5 py-4 space-y-3">
        <?php foreach($navLinks as $link): ?>
        <a href="#deals" class="block text-sm font-medium text-[#1A1A1A] py-2"><?= $link ?></a>
        <?php endforeach; ?>
        <div class="pt-2 flex gap-3">
            <a href="#" class="text-sm font-semibold text-[#1A1A1A] py-2">Log in</a>
            <a href="#download" class="btn-orange text-sm" style="padding:0.5rem 1rem;">Get the App</a>
        </div>
    </div>
</header>
