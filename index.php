<?php
/**
 * GetOnDeal - Premium Discovery & Booking Platform
 * Production-grade modular implementation
 */

// Referral Logic
if (isset($_GET['ref'])) {
    setcookie("referral_code", $_GET['ref'], time() + (86400 * 30), "/");
}

// Data Requirements
require_once __DIR__ . '/data/deals.php';
require_once __DIR__ . '/data/categories.php';
require_once __DIR__ . '/data/testimonials.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#1E73BE">
    <title>GetOnDeal – Mumbai's Best Tables at Unbelievable Prices</title>
    
    <!-- SEO Meta Tags -->
    <meta name="description" content="Discover Mumbai's best cafes, restaurants, nightlife and villas with exclusive deals up to 50% off. Handpicked by locals, verified by us.">
    <meta property="og:title" content="GetOnDeal – Mumbai's Best Tables at Unbelievable Prices">
    <meta property="og:description" content="Join 200,000+ members saving on Mumbai's premium experiences.">
    <meta property="og:type" content="website">
    
    <!-- Preload Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,400;12..96,600;12..96,800&family=Instrument+Serif:ital@0;1&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Tailwind (For layout utilities) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
    tailwind.config = {
        theme: {
            extend: {
                colors: {
                    'god-blue': '#1E73BE',
                    'god-blue-dark': '#0F4C81',
                    'god-orange': '#F7931E',
                    'god-orange-light': '#FFA726',
                    'god-cream': '#FFF9F0',
                    'god-text': '#0B0B12',
                    'god-muted': '#5B6271',
                    'god-border': '#E6EAF0',
                }
            }
        }
    }
    </script>
    
    <!-- Custom CSS Architecture -->
    <link rel="stylesheet" href="assets/css/global.css">
    <link rel="stylesheet" href="assets/css/animations.css">
    <link rel="stylesheet" href="assets/css/components.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
</head>
<body class="bg-white text-[#0B0B12]">

    <?php require_once 'includes/navbar.php'; ?>

    <main>
        <?php require_once 'includes/hero.php'; ?>
        <?php require_once 'includes/press-marquee.php'; ?>
        <?php require_once 'includes/live-activity.php'; ?>
        <?php require_once 'includes/categories.php'; ?>
        <?php require_once 'includes/spotlight.php'; ?>
        <?php require_once 'includes/featured-deals.php'; ?>
        <?php require_once 'includes/neighbourhoods.php'; ?>
        <?php require_once 'includes/how-it-works.php'; ?>
        <?php require_once 'includes/benefits.php'; ?>
        <?php require_once 'includes/membership.php'; ?>
        <?php require_once 'includes/cta-marquee.php'; ?>
        <?php require_once 'includes/testimonials.php'; ?>
        <?php require_once 'includes/app-download.php'; ?>
    </main>

    <?php require_once 'includes/footer.php'; ?>

    <!-- Performance-optimized JS -->
    <script src="assets/js/tracking.js" defer></script>
    <script src="assets/js/mobile-menu.js" defer></script>
    <script src="assets/js/countdown.js" defer></script>
    <script src="assets/js/filters.js" defer></script>
    <script src="assets/js/slider.js" defer></script>
    <script src="assets/js/app.js" defer></script>
</body>
</html>