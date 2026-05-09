<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Affiliate Login | GetOnDeal</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,400;12..96,600;12..96,800&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; background: #0B0B12; color: #fff; }
        .font-display { font-family: 'Bricolage Grotesque', sans-serif; }
        .glass-card { background: rgba(255, 255, 255, 0.03); backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.08); }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-5">
    <div class="w-full max-w-md">
        <div class="flex justify-center mb-10">
            <div class="flex items-center">
                <span style="color:#1E73BE;font-weight:800;font-size:32px;line-height:1;letter-spacing:-0.04em;">Get</span>
                <span style="width:34px;height:34px;margin:0 1.5px;border-radius:9999px;background:radial-gradient(circle at 30% 30%,#FFA726,#F7931E 70%);display:inline-flex;align-items:center;justify-content:center;color:#fff;font-weight:800;font-size:20px;box-shadow:rgba(247,147,30,0.6) 0px 4px 10px -4px;">%</span>
                <span style="color:#fff;font-weight:800;font-size:32px;line-height:1;letter-spacing:-0.04em;">nDeal</span>
            </div>
        </div>

        <div class="glass-card rounded-[2.5rem] p-8 sm:p-10">
            <div class="mb-8">
                <h1 class="font-display text-2xl font-extrabold text-white">Affiliate Partners</h1>
                <p class="text-sm text-white/50 mt-1">Monetize your traffic by sharing premium deals.</p>
            </div>

            <form id="affiliate-login" class="space-y-5">
                <div>
                    <label class="block text-xs font-bold text-white/40 uppercase tracking-wider mb-2">Partner Email</label>
                    <input type="email" id="email" required class="w-full bg-white/5 border border-white/10 rounded-xl px-5 py-3.5 outline-none focus:border-[#F7931E] transition-colors text-sm text-white" placeholder="partner@getondeal.com">
                </div>
                <div>
                    <div class="flex items-center justify-between mb-2">
                        <label class="block text-xs font-bold text-white/40 uppercase tracking-wider">Access Key</label>
                    </div>
                    <input type="password" id="password" required class="w-full bg-white/5 border border-white/10 rounded-xl px-5 py-3.5 outline-none focus:border-[#F7931E] transition-colors text-sm text-white" placeholder="••••••••">
                </div>
                <div class="pt-2">
                    <button type="submit" id="login-btn" class="w-full bg-[#F7931E] text-white font-bold py-4 rounded-xl hover:bg-[#FFA726] transition-all flex items-center justify-center gap-2 group">
                        Enter Dashboard
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="group-hover:translate-x-1 transition-transform"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                    </button>
                </div>
            </form>

            <div class="mt-8 pt-8 border-t border-white/5 text-center">
                <p class="text-sm text-white/40">Not a partner yet?</p>
                <a href="signup.php" class="text-sm font-bold text-[#F7931E] hover:underline mt-1 inline-block">Apply for Affiliate Access →</a>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('affiliate-login').addEventListener('submit', async (e) => {
            e.preventDefault();
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            
            // Logic similar to admin login but with affiliate role check
            const res = await fetch('http://localhost:5000/api/auth/login', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ email, password })
            });
            const data = await res.json();
            if (res.ok && (data.role === 'affiliate' || data.role === 'admin')) {
                localStorage.setItem('aff_token', data.token);
                localStorage.setItem('aff_user', JSON.stringify(data));
                window.location.href = 'index.php';
            } else {
                alert(data.message || 'Access Denied');
            }
        });
    </script>
</body>
</html>
