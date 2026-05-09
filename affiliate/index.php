<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Affiliate Dashboard | GetOnDeal</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,400;12..96,600;12..96,800&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body { font-family: 'Poppins', sans-serif; background: #0B0B12; color: #fff; }
        .font-display { font-family: 'Bricolage Grotesque', sans-serif; }
        .glass-card { background: rgba(255, 255, 255, 0.03); backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.08); border-radius: 2rem; }
        .sidebar { background: rgba(255, 255, 255, 0.02); border-right: 1px solid rgba(255, 255, 255, 0.05); }
        .nav-item { transition: all 0.2s ease; }
        .nav-item.active { background: #F7931E; color: white; }
        .accent-gradient { background: linear-gradient(135deg, #F7931E, #FFA726); }
        .stat-card:hover { transform: translateY(-5px); transition: all 0.3s ease; border-color: rgba(247, 147, 30, 0.3); }
    </style>
</head>
<body class="flex min-h-screen">
    <!-- Sidebar -->
    <aside class="w-64 sidebar hidden lg:flex flex-col p-8 sticky top-0 h-screen">
        <div class="flex items-center gap-2 mb-12">
            <span style="color:#1E73BE;font-weight:800;font-size:24px;">Get</span>
            <span style="width:24px;height:24px;border-radius:9999px;background:#F7931E;display:inline-flex;align-items:center;justify-content:center;color:#fff;font-size:14px;">%</span>
            <span style="color:#fff;font-weight:800;font-size:24px;">nDeal</span>
        </div>

        <nav class="space-y-2 flex-1">
            <a href="#" class="nav-item active flex items-center gap-3 px-5 py-3.5 rounded-2xl text-sm font-bold">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="7" height="9" x="3" y="3" rx="1"/><rect width="7" height="5" x="14" y="3" rx="1"/><rect width="7" height="9" x="14" y="12" rx="1"/><rect width="7" height="5" x="3" y="16" rx="1"/></svg>
                Overview
            </li>
            <a href="#" class="nav-item flex items-center gap-3 px-5 py-3.5 rounded-2xl text-sm font-bold text-white/50 hover:text-white hover:bg-white/5">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"/><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"/></svg>
                My Links
            </a>
            <a href="#" class="nav-item flex items-center gap-3 px-5 py-3.5 rounded-2xl text-sm font-bold text-white/50 hover:text-white hover:bg-white/5">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" x2="12" y1="20" y2="10"/><line x1="18" x2="18" y1="20" y2="4"/><line x1="6" x2="6" y1="20" y2="16"/></svg>
                Performance
            </a>
            <a href="#" class="nav-item flex items-center gap-3 px-5 py-3.5 rounded-2xl text-sm font-bold text-white/50 hover:text-white hover:bg-white/5">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                Resources
            </a>
        </nav>

        <div class="mt-auto p-5 glass-card">
            <p class="text-[10px] font-bold text-white/30 uppercase tracking-widest mb-3">Your Promo Code</p>
            <div class="flex items-center justify-between gap-2">
                <span id="aff-code" class="text-sm font-bold text-[#F7931E]">MUMBAI50</span>
                <button onclick="copyCode()" class="text-white/40 hover:text-white"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect width="14" height="14" x="8" y="8" rx="2" ry="2"/><path d="M4 16c-1.1 0-2-.9-2-2V4c0-1.1.9-2 2-2h10c1.1 0 2 .9 2 2"/></svg></button>
            </div>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-5 lg:p-12 overflow-y-auto">
        <header class="flex items-center justify-between mb-12">
            <div>
                <h1 class="font-display text-3xl font-extrabold text-white">Partner Overview</h1>
                <p class="text-white/40 text-sm mt-1">Track your referrals and earnings in real-time.</p>
            </div>
            <div class="flex items-center gap-5">
                <div class="text-right hidden sm:block">
                    <p id="aff-name" class="font-bold text-sm">Aditya K.</p>
                    <p class="text-xs text-[#F7931E] font-bold">Gold Partner</p>
                </div>
                <img src="https://i.pravatar.cc/100?u=aff" class="w-12 h-12 rounded-2xl border-2 border-white/5">
            </div>
        </header>

        <!-- Stats -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
            <div class="glass-card p-8 stat-card">
                <p class="text-xs font-bold text-white/40 uppercase tracking-widest mb-4">Total Earnings</p>
                <div class="flex items-end justify-between">
                    <h3 class="text-4xl font-extrabold text-white">₹12,840</h3>
                    <span class="text-xs font-bold text-[#F7931E] mb-1">↑ 12%</span>
                </div>
            </div>
            <div class="glass-card p-8 stat-card">
                <p class="text-xs font-bold text-white/40 uppercase tracking-widest mb-4">Total Clicks</p>
                <div class="flex items-end justify-between">
                    <h3 class="text-4xl font-extrabold text-white">2,450</h3>
                    <span class="text-xs font-bold text-white/20 mb-1">Last 30d</span>
                </div>
            </div>
            <div class="glass-card p-8 stat-card">
                <p class="text-xs font-bold text-white/40 uppercase tracking-widest mb-4">Conversions</p>
                <div class="flex items-end justify-between">
                    <h3 class="text-4xl font-extrabold text-white">184</h3>
                    <span class="text-xs font-bold text-green-500 mb-1">7.5% CR</span>
                </div>
            </div>
            <div class="glass-card p-8 stat-card">
                <p class="text-xs font-bold text-white/40 uppercase tracking-widest mb-4">Payout Pending</p>
                <div class="flex items-end justify-between">
                    <h3 class="text-4xl font-extrabold text-white">₹4,200</h3>
                    <button class="text-[10px] font-bold text-white bg-white/10 px-3 py-1.5 rounded-full hover:bg-[#F7931E]">Withdraw</button>
                </div>
            </div>
        </div>

        <div class="grid lg:grid-cols-3 gap-8">
            <!-- Link Generator -->
            <div class="lg:col-span-2 glass-card p-8">
                <h3 class="font-bold text-white mb-6">Create Referral Link</h3>
                <div class="flex flex-col sm:flex-row gap-3">
                    <div class="flex-1 bg-white/5 border border-white/10 rounded-2xl p-2 flex items-center gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="ml-2 text-white/30"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"/><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"/></svg>
                        <input type="text" id="target-url" placeholder="Paste any deal URL here..." class="bg-transparent border-none outline-none text-sm w-full text-white placeholder-white/20">
                    </div>
                    <button onclick="generateLink()" class="accent-gradient text-white text-sm font-bold px-8 py-4 rounded-2xl hover:opacity-90 transition-opacity">Generate</button>
                </div>
                <div id="result-link" class="mt-4 p-4 bg-white/5 rounded-xl border border-white/10 hidden items-center justify-between">
                    <span class="text-sm text-[#F7931E] font-medium truncate" id="gen-url"></span>
                    <button onclick="copyGenerated()" class="text-xs font-bold text-white/40 hover:text-white uppercase tracking-widest">Copy</button>
                </div>
            </div>

            <!-- Leaderboard -->
            <div class="glass-card p-8">
                <h3 class="font-bold text-white mb-6">Top Partners</h3>
                <div class="space-y-6">
                    ${[1,2,3].map((i) => `
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <span class="text-xs font-bold text-white/20">0${i}</span>
                            <img src="https://i.pravatar.cc/100?u=${i}" class="w-8 h-8 rounded-full">
                            <span class="text-sm font-bold">${['Rohan M.', 'Priya S.', 'Karan J.'][i-1]}</span>
                        </div>
                        <span class="text-xs font-bold text-[#F7931E]">₹${[45000, 38000, 31000][i-1]}</span>
                    </div>
                    `).join('')}
                </div>
            </div>
        </div>

        <!-- Recent Clicks -->
        <div class="mt-8 glass-card p-0 overflow-hidden">
            <div class="p-8 border-b border-white/5 flex items-center justify-between">
                <h3 class="font-bold text-white">Real-time Traffic</h3>
                <span class="flex items-center gap-2 text-[10px] uppercase font-bold text-green-500">
                    <span class="w-1.5 h-1.5 rounded-full bg-green-500 animate-pulse"></span>
                    Live Tracking
                </span>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-white/2 border-b border-white/5">
                        <tr class="text-[10px] font-bold text-white/30 uppercase tracking-[0.2em]">
                            <th class="px-8 py-5">Source</th>
                            <th class="px-8 py-5">Deal Name</th>
                            <th class="px-8 py-5">Location</th>
                            <th class="px-8 py-5">Status</th>
                            <th class="px-8 py-5 text-right">Time</th>
                        </tr>
                    </thead>
                    <tbody id="traffic-body">
                        <!-- Populated via JS -->
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <script>
        // Check Auth
        const token = localStorage.getItem('aff_token');
        if (!token) window.location.href = 'login.php';

        function generateLink() {
            const url = document.getElementById('target-url').value;
            if (!url) return;
            const res = document.getElementById('result-link');
            const gen = document.getElementById('gen-url');
            gen.textContent = url + (url.includes('?') ? '&' : '?') + 'ref=MUMBAI50';
            res.classList.remove('hidden');
            res.classList.add('flex');
        }

        // Mock Traffic Data
        const venues = ['Olive Bar', 'The Bombay Canteen', 'Suzette', 'Toto Garage', 'Antisocial'];
        const sources = ['Instagram', 'WhatsApp', 'Direct', 'Facebook', 'Twitter'];
        
        function populateTraffic() {
            const body = document.getElementById('traffic-body');
            body.innerHTML = Array(6).fill(0).map(() => `
                <tr class="border-b border-white/5 hover:bg-white/2 transition-colors">
                    <td class="px-8 py-5 text-sm font-medium text-white/70">${sources[Math.floor(Math.random()*sources.length)]}</td>
                    <td class="px-8 py-5 text-sm font-bold">${venues[Math.floor(Math.random()*venues.length)]}</td>
                    <td class="px-8 py-5 text-sm text-white/40 italic">Bandra, Mumbai</td>
                    <td class="px-8 py-5"><span class="text-[10px] font-bold text-white/40 uppercase bg-white/5 px-2 py-1 rounded">Click</span></td>
                    <td class="px-8 py-5 text-right text-xs text-white/20 font-bold">${Math.floor(Math.random()*60)}s ago</td>
                </tr>
            `).join('');
        }
        populateTraffic();
    </script>
</body>
</html>
