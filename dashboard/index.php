<?php
/**
 * Admin Dashboard - Main Layout
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard | GetOnDeal Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,400;12..96,600;12..96,800&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Chart.js for Analytics -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #F8F9FB; color: #0B0B12; overflow-x: hidden; }
        .font-display { font-family: 'Bricolage Grotesque', sans-serif; }
        .sidebar { transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
        .sidebar-item { transition: all 0.2s ease; border-left: 3px solid transparent; }
        .sidebar-item.active { background: #EAF3FB; color: #1E73BE; border-left-color: #1E73BE; }
        .card { background: #FFFFFF; border: 1px solid #E6EAF0; border-radius: 1.5rem; transition: all 0.3s ease; }
        .card:hover { border-color: #D4E7F7; box-shadow: 0 10px 30px -15px rgba(15, 76, 129, 0.1); }
        .scrollbar-hide::-webkit-scrollbar { display: none; }
        .scrollbar-hide { -ms-overflow-style: none; scrollbar-width: none; }
        
        /* Shimmer loading */
        .shimmer { background: linear-gradient(90deg, #f0f0f0 25%, #f8f8f8 50%, #f0f0f0 75%); background-size: 200% 100%; animation: shimmer 1.5s infinite; }
        @keyframes shimmer { 0% { background-position: -200% 0; } 100% { background-position: 200% 0; } }
    </style>
    <!-- Custom CSS Architecture -->
    <link rel="stylesheet" href="assets/css/dashboard.css">
</head>
<body class="flex">
    <!-- Sidebar -->
    <aside id="sidebar" class="fixed left-0 top-0 h-screen w-64 bg-white border-r border-[#E6EAF0] z-40 sidebar">
        <div class="p-6 h-full flex flex-col">
            <!-- Logo -->
            <div class="flex items-center gap-2 mb-10">
                <div class="flex items-center">
                    <span style="color:#1E73BE;font-weight:800;font-size:20px;line-height:1;letter-spacing:-0.04em;">Get</span>
                    <span style="width:20px;height:20px;margin:0 1px;border-radius:9999px;background:radial-gradient(circle at 30% 30%,#FFA726,#F7931E 70%);display:inline-flex;align-items:center;justify-content:center;color:#fff;font-weight:800;font-size:12px;">%</span>
                    <span style="color:#0F4C81;font-weight:800;font-size:20px;line-height:1;letter-spacing:-0.04em;">nDeal</span>
                </div>
            </div>

            <!-- Nav -->
            <nav class="flex-1 space-y-1 scrollbar-hide overflow-y-auto">
                <p class="text-[10px] font-bold text-[#9AA3B2] uppercase tracking-[0.2em] mb-4 px-3">Main Menu</p>
                <button data-page="overview" class="sidebar-item active w-full flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-semibold text-[#5B6271] hover:bg-gray-50">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="7" height="9" x="3" y="3" rx="1"/><rect width="7" height="5" x="14" y="3" rx="1"/><rect width="7" height="9" x="14" y="12" rx="1"/><rect width="7" height="5" x="3" y="16" rx="1"/></svg>
                    Overview
                </button>
                <button data-page="listings" class="sidebar-item w-full flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-semibold text-[#5B6271] hover:bg-gray-50">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2H2v10h10V2z"/><path d="M22 2h-10v10h10V2z"/><path d="M12 12H2v10h10V12z"/><path d="M22 12h-10v10h10V12z"/></svg>
                    Listings
                </button>
                <button data-page="bookings" class="sidebar-item w-full flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-semibold text-[#5B6271] hover:bg-gray-50">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="4" rx="2" ry="2"/><line x1="16" x2="16" y1="2" y2="6"/><line x1="8" x2="8" y1="2" y2="6"/><line x1="3" x2="21" y1="10" y2="10"/></svg>
                    Bookings
                </button>
                <button data-page="reviews" class="sidebar-item w-full flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-semibold text-[#5B6271] hover:bg-gray-50">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                    Reviews
                </button>
                <button data-page="users" class="sidebar-item w-full flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-semibold text-[#5B6271] hover:bg-gray-50">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                    Users
                </button>

                <p class="text-[10px] font-bold text-[#9AA3B2] uppercase tracking-[0.2em] pt-6 mb-4 px-3">System</p>
                <button data-page="analytics" class="sidebar-item w-full flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-semibold text-[#5B6271] hover:bg-gray-50">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" x2="12" y1="20" y2="10"/><line x1="18" x2="18" y1="20" y2="4"/><line x1="6" x2="6" y1="20" y2="16"/></svg>
                    Analytics
                </button>
                <button data-page="media" class="sidebar-item w-full flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-semibold text-[#5B6271] hover:bg-gray-50">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="3" rx="2" ry="2"/><circle cx="9" cy="9" r="2"/><path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"/></svg>
                    Media Manager
                </button>
                <button data-page="settings" class="sidebar-item w-full flex items-center gap-3 px-4 py-3 rounded-lg text-sm font-semibold text-[#5B6271] hover:bg-gray-50">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12.22 2h-.44a2 2 0 0 0-2 2v.18a2 2 0 0 1-1 1.73l-.43.25a2 2 0 0 1-2 0l-.15-.08a2 2 0 0 0-2.73.73l-.22.38a2 2 0 0 0 .73 2.73l.15.1a2 2 0 0 1 1 1.72v.51a2 2 0 0 1-1 1.74l-.15.09a2 2 0 0 0-.73 2.73l.22.38a2 2 0 0 0 2.73.73l.15-.08a2 2 0 0 1 2 0l.43.25a2 2 0 0 1 1 1.73V20a2 2 0 0 0 2 2h.44a2 2 0 0 0 2-2v-.18a2 2 0 0 1 1-1.73l.43-.25a2 2 0 0 1 2 0l.15.08a2 2 0 0 0 2.73-.73l.22-.39a2 2 0 0 0-.73-2.73l-.15-.1a2 2 0 0 1-1-1.72v-.51a2 2 0 0 1 1-1.74l.15-.09a2 2 0 0 0 .73-2.73l-.22-.38a2 2 0 0 0-2.73-.73l-.15.08a2 2 0 0 1-2 0l-.43-.25a2 2 0 0 1-1-1.73V4a2 2 0 0 0-2-2z"/><circle cx="12" cy="12" r="3"/></svg>
                    Settings
                </button>
            </nav>

            <!-- User -->
            <div class="mt-auto pt-6 border-t border-[#E6EAF0]">
                <div class="flex items-center gap-3 mb-4">
                    <img id="admin-avatar" src="https://i.pravatar.cc/100?u=admin" class="w-10 h-10 rounded-full border-2 border-[#EAF3FB]">
                    <div class="overflow-hidden">
                        <p id="admin-name" class="font-bold text-sm text-[#0B0B12] truncate">Admin User</p>
                        <p id="admin-email" class="text-[10px] text-[#5B6271] truncate">admin@getondeal.com</p>
                    </div>
                </div>
                <button id="logout-btn" class="w-full flex items-center justify-center gap-2 py-2.5 rounded-lg text-xs font-bold text-red-500 bg-red-50 hover:bg-red-100 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" x2="9" y1="12" y2="12"/></svg>
                    Sign Out
                </button>
            </div>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="ml-64 flex-1 min-h-screen">
        <!-- Top Bar -->
        <header class="h-[72px] bg-white/80 backdrop-blur-md border-b border-[#E6EAF0] px-8 flex items-center justify-between sticky top-0 z-30">
            <div>
                <h2 id="page-title" class="font-display text-xl font-extrabold text-[#0B0B12]">Overview</h2>
            </div>
            <div class="flex items-center gap-4">
                <div class="relative hidden md:block">
                    <input type="text" placeholder="Search anything..." class="bg-[#F5F7FA] border border-[#E6EAF0] rounded-full px-5 py-2 text-sm outline-none focus:border-[#1E73BE] w-64 transition-all">
                    <svg class="absolute right-4 top-2.5 text-[#9AA3B2]" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.34-4.34"/></svg>
                </div>
                <button class="relative w-10 h-10 flex items-center justify-center rounded-full bg-[#F5F7FA] text-[#5B6271] hover:text-[#1E73BE] transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 8a6 6 0 0 1 12 0c0 7 3 9 3 9H3s3-2 3-9"/><path d="M10.3 21a1.94 1.94 0 0 0 3.4 0"/></svg>
                    <span class="absolute top-2 right-2 w-2 h-2 bg-[#F7931E] rounded-full ring-2 ring-white"></span>
                </button>
                <div class="h-8 w-px bg-[#E6EAF0]"></div>
                <button id="add-new-btn" class="bg-[#0B0B12] text-white text-xs font-bold px-4 py-2.5 rounded-full hover:bg-[#1E73BE] transition-all flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="M12 5v14"/></svg>
                    Add Listing
                </button>
            </div>
        </header>

        <!-- Dynamic Content Area -->
        <div id="content-area" class="p-8">
            <!-- Content will be injected here via dashboard.js -->
            <div class="flex items-center justify-center min-h-[400px]">
                <div class="flex flex-col items-center gap-4">
                    <div class="w-12 h-12 border-4 border-[#1E73BE] border-t-transparent rounded-full animate-spin"></div>
                    <p class="text-sm font-semibold text-[#5B6271]">Initializing Dashboard...</p>
                </div>
            </div>
        </div>
    </main>

    <!-- JS Logic -->
    <script src="assets/js/dashboard.js"></script>
</body>
</html>
