<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Become a Partner | GetOnDeal</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,400;12..96,600;12..96,800&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; background: #0B0B12; color: #fff; }
        .font-display { font-family: 'Bricolage Grotesque', sans-serif; }
        .glass-card { background: rgba(255, 255, 255, 0.03); backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.08); }
        .step-num { width: 32px; height: 32px; border-radius: 9999px; background: rgba(255, 255, 255, 0.1); display: flex; items-center; justify-content: center; font-weight: 800; font-size: 14px; }
        .step-num.active { background: #F7931E; color: white; }
    </style>
</head>
<body class="min-h-screen py-20 px-5 flex items-center justify-center">
    <div class="w-full max-w-4xl grid lg:grid-cols-2 gap-12 items-center">
        <!-- Left Side: Value Prop -->
        <div class="hidden lg:block">
            <div class="flex items-center gap-2 mb-10">
                <span style="color:#1E73BE;font-weight:800;font-size:32px;">Get</span>
                <span style="width:34px;height:34px;border-radius:9999px;background:#F7931E;display:inline-flex;align-items:center;justify-content:center;color:#fff;font-size:20px;">%</span>
                <span style="color:#fff;font-weight:800;font-size:32px;">nDeal</span>
            </div>
            <h1 class="font-display text-5xl font-extrabold leading-tight text-white mb-6">Earn by sharing <span class="text-[#F7931E]">exclusive</span> Mumbai deals.</h1>
            <p class="text-white/50 text-lg leading-relaxed mb-10">Join our partner network and get paid for every lead, claim, and booking generated through your unique referral links.</p>
            
            <div class="space-y-6">
                <div class="flex gap-4">
                    <div class="step-num active">1</div>
                    <div><p class="font-bold">Apply & Get Approved</p><p class="text-sm text-white/40">Our team reviews all partner applications within 24 hours.</p></div>
                </div>
                <div class="flex gap-4">
                    <div class="step-num">2</div>
                    <div><p class="font-bold">Share Your Links</p><p class="text-sm text-white/40">Use our dashboard to generate custom referral links for any deal.</p></div>
                </div>
                <div class="flex gap-4">
                    <div class="step-num">3</div>
                    <div><p class="font-bold">Track & Earn</p><p class="text-sm text-white/40">Monitor clicks and conversions with real-time analytics.</p></div>
                </div>
            </div>
        </div>

        <!-- Right Side: Form -->
        <div class="glass-card rounded-[3rem] p-8 sm:p-12">
            <h2 class="font-display text-2xl font-extrabold mb-8">Partner Application</h2>
            <form id="signup-form" class="space-y-6">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-[10px] font-bold text-white/40 uppercase tracking-widest mb-2">Full Name</label>
                        <input type="text" required class="w-full bg-white/5 border border-white/10 rounded-xl px-5 py-3 text-sm text-white outline-none focus:border-[#F7931E]">
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-white/40 uppercase tracking-widest mb-2">Email</label>
                        <input type="email" required class="w-full bg-white/5 border border-white/10 rounded-xl px-5 py-3 text-sm text-white outline-none focus:border-[#F7931E]">
                    </div>
                </div>
                <div>
                    <label class="block text-[10px] font-bold text-white/40 uppercase tracking-widest mb-2">Website / Social Profile</label>
                    <input type="url" placeholder="https://instagram.com/yourprofile" class="w-full bg-white/5 border border-white/10 rounded-xl px-5 py-3 text-sm text-white outline-none focus:border-[#F7931E]">
                </div>
                <div>
                    <label class="block text-[10px] font-bold text-white/40 uppercase tracking-widest mb-2">Promotional Strategy</label>
                    <textarea rows="3" placeholder="How will you promote GetOnDeal?" class="w-full bg-white/5 border border-white/10 rounded-xl px-5 py-3 text-sm text-white outline-none focus:border-[#F7931E]"></textarea>
                </div>
                <div class="pt-4">
                    <button type="submit" class="w-full bg-[#F7931E] text-white font-bold py-4 rounded-xl hover:opacity-90 transition-opacity">Submit Application</button>
                </div>
                <p class="text-center text-[10px] text-white/30 uppercase tracking-widest">Secure Application · Payouts via UPI/Bank</p>
            </form>
            <div id="success-msg" class="hidden text-center">
                <div class="w-16 h-16 rounded-full bg-green-500/20 text-green-500 flex items-center justify-center mx-auto mb-6">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5"/></svg>
                </div>
                <h3 class="text-xl font-bold mb-2">Application Submitted</h3>
                <p class="text-sm text-white/50 leading-relaxed">Thank you for your interest! Our team will review your application and email you with your access credentials within 24 hours.</p>
                <a href="../index.php" class="inline-block mt-8 text-[#F7931E] font-bold text-sm">Back to Home</a>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('signup-form').addEventListener('submit', (e) => {
            e.preventDefault();
            document.getElementById('signup-form').classList.add('hidden');
            document.getElementById('success-msg').classList.remove('hidden');
        });
    </script>
</body>
</html>
