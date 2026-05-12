<?php
/**
 * Admin Login Page
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Login | GetOnDeal</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,400;12..96,600;12..96,800&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="../assets/js/config.js"></script>
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #F8F9FB; }
        .font-display { font-family: 'Bricolage Grotesque', sans-serif; }
        .login-card { box-shadow: 0 20px 50px -20px rgba(15, 76, 129, 0.15); }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-5">
    <div class="w-full max-w-md">
        <!-- Logo -->
        <div class="flex justify-center mb-10">
            <div class="flex items-center">
                <span style="color:#1E73BE;font-weight:800;font-size:32px;line-height:1;letter-spacing:-0.04em;">Get</span>
                <span style="width:34px;height:34px;margin:0 1.5px;border-radius:9999px;background:radial-gradient(circle at 30% 30%,#FFA726,#F7931E 70%);display:inline-flex;align-items:center;justify-content:center;color:#fff;font-weight:800;font-size:20px;box-shadow:rgba(247,147,30,0.6) 0px 4px 10px -4px;">%</span>
                <span style="color:#0F4C81;font-weight:800;font-size:32px;line-height:1;letter-spacing:-0.04em;">nDeal</span>
            </div>
        </div>

        <div class="bg-white rounded-[2rem] p-8 sm:p-10 border border-[#E6EAF0] login-card">
            <div class="mb-8">
                <h1 class="font-display text-2xl font-extrabold text-[#0B0B12]">Welcome Back</h1>
                <p class="text-sm text-[#5B6271] mt-1">Sign in to manage the GetOnDeal platform.</p>
            </div>

            <form id="login-form" class="space-y-5">
                <div>
                    <label class="block text-xs font-bold text-[#0B0B12] uppercase tracking-wider mb-2">Email Address</label>
                    <input type="email" id="email" required class="w-full bg-[#F5F7FA] border border-[#E6EAF0] rounded-xl px-5 py-3.5 outline-none focus:border-[#1E73BE] transition-colors text-sm" placeholder="admin@getondeal.com">
                </div>
                <div>
                    <div class="flex items-center justify-between mb-2">
                        <label class="block text-xs font-bold text-[#0B0B12] uppercase tracking-wider">Password</label>
                        <a href="#" class="text-xs font-semibold text-[#1E73BE] hover:underline">Forgot?</a>
                    </div>
                    <input type="password" id="password" required class="w-full bg-[#F5F7FA] border border-[#E6EAF0] rounded-xl px-5 py-3.5 outline-none focus:border-[#1E73BE] transition-colors text-sm" placeholder="••••••••">
                </div>
                <div class="pt-2">
                    <button type="submit" id="login-btn" class="w-full bg-[#0B0B12] text-white font-bold py-4 rounded-xl hover:bg-[#1E73BE] transition-all flex items-center justify-center gap-2 group">
                        Sign in to Dashboard
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="group-hover:translate-x-1 transition-transform"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                    </button>
                </div>
            </form>

            <div id="error-msg" class="mt-4 p-4 bg-red-50 text-red-600 text-xs font-semibold rounded-lg hidden"></div>
        </div>

        <p class="text-center text-[#9AA3B2] text-[11px] mt-8 uppercase tracking-[0.2em] font-bold">Secure Admin Access · GetOnDeal 2026</p>
    </div>

    <script>
        const loginForm = document.getElementById('login-form');
        const errorMsg = document.getElementById('error-msg');
        const loginBtn = document.getElementById('login-btn');
        let csrfToken = null;

        loginForm.addEventListener('submit', async (e) => {
            e.preventDefault();
            errorMsg.classList.add('hidden');
            loginBtn.disabled = true;
            loginBtn.innerHTML = 'Signing in...';

            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;

            const API_URL = window.GOD_CONFIG?.API_BASE_URL || 'https://getondeal-app.onrender.com/api';

            try {
                if (!csrfToken) {
                    const csrfResponse = await fetch(`${API_URL}/auth/csrf-token`, { credentials: 'include' });
                    const csrfData = await csrfResponse.json();
                    csrfToken = csrfData?.csrfToken || null;
                }
                const response = await fetch(`${API_URL}/auth/login`, {
                    method: 'POST',
                    credentials: 'include',
                    headers: { 
                        'Content-Type': 'application/json',
                        ...(csrfToken ? { 'X-CSRF-Token': csrfToken } : {})
                    },
                    body: JSON.stringify({ email, password })
                });

                const data = await response.json();

                if (response.ok) {
                    if (data.role !== 'admin') {
                        throw new Error('Access denied. Admin only.');
                    }
                    localStorage.setItem('god_token', data.token);
                    localStorage.setItem('god_user', JSON.stringify(data));
                    window.location.href = 'index.php';
                } else {
                    throw new Error(data.message || 'Login failed');
                }
            } catch (err) {
                errorMsg.textContent = err.message;
                errorMsg.classList.remove('hidden');
                loginBtn.disabled = false;
                loginBtn.innerHTML = `Sign in to Dashboard <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>`;
            }
        });
    </script>
</body>
</html>
