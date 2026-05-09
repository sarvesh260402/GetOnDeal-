<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch user data
$stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$stmt->close();

$name     = htmlspecialchars($user['name']);
$ref_code = htmlspecialchars($user['referral_code']);
$affiliate_id = htmlspecialchars($user['id']);

// Fetch total clicks
$stmt = $conn->prepare("SELECT COUNT(*) as total FROM clicks WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$total_clicks = $stmt->get_result()->fetch_assoc()['total'] ?? 0;
$stmt->close();

// Fetch earnings breakdown
$stmt = $conn->prepare("SELECT status, SUM(amount) as total FROM commissions WHERE user_id = ? GROUP BY status");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$earnings_result = $stmt->get_result();
$stmt->close();

$earnings_pending  = 0;
$earnings_approved = 0;
$earnings_paid     = 0;

while ($row = $earnings_result->fetch_assoc()) {
    if ($row['status'] === 'pending')  $earnings_pending  = $row['total'];
    if ($row['status'] === 'approved') $earnings_approved = $row['total'];
    if ($row['status'] === 'paid')     $earnings_paid     = $row['total'];
}

$total_earnings = $earnings_pending + $earnings_approved + $earnings_paid;

// Total conversions = rows in commissions table
$stmt = $conn->prepare("SELECT COUNT(*) as total FROM commissions WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$total_conversions = $stmt->get_result()->fetch_assoc()['total'] ?? 0;
$stmt->close();

$conv_rate = $total_clicks > 0 ? round(($total_conversions / $total_clicks) * 100, 1) : 0;

// Available for payout = approved only
$available_payout = $earnings_approved;
$min_payout = 500;
$needed = max(0, $min_payout - $available_payout);

// Recent transactions
$stmt = $conn->prepare("SELECT * FROM commissions WHERE user_id = ? ORDER BY created_at DESC LIMIT 10");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$transactions = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
$stmt->close();

// Payout history
$stmt = $conn->prepare("SELECT * FROM payouts WHERE user_id = ? ORDER BY created_at DESC LIMIT 10");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$payouts = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
$stmt->close();

$ref_link = "https://getondeal.com/index.php?ref=" . $ref_code;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#000000">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <title>Affiliate Dashboard</title>
    <style>
        *, ::before, ::after { box-sizing: border-box; border-width: 0; border-style: solid; border-color: #e5e7eb; }
        :root {
            --background: 210 17% 98%; --foreground: 0 0% 10%;
            --card: 0 0% 100%; --card-foreground: 0 0% 10%;
            --primary: 209 73% 43%; --primary-foreground: 0 0% 100%;
            --secondary: 210 17% 95%; --secondary-foreground: 0 0% 10%;
            --muted: 210 17% 95%; --muted-foreground: 0 0% 40%;
            --accent: 30 92% 54%; --accent-foreground: 0 0% 100%;
            --destructive: 0 84% 60%; --destructive-foreground: 0 0% 100%;
            --border: 210 17% 90%; --input: 210 17% 90%;
            --ring: 209 73% 43%; --radius: 0.75rem;
            --gd-blue: #1E73BE; --gd-blue-dark: #0F4C81;
            --gd-orange: #F7931E; --gd-bg: #F5F7FA; --gd-text: #1A1A1A;
        }
        * { border-color: hsl(var(--border)); }
        body {
            margin: 0;
            font-family: 'Poppins', -apple-system, BlinkMacSystemFont, sans-serif;
            -webkit-font-smoothing: antialiased;
            background: var(--gd-bg);
            color: var(--gd-text);
            line-height: 1.5;
        }
        h1, h2, h3, h4 { font-weight: 700; letter-spacing: -0.02em; margin: 0; }
        a { color: inherit; text-decoration: inherit; }
        button { cursor: pointer; font-family: inherit; }
        img, svg, video, canvas, audio, iframe, embed, object { display: block; vertical-align: middle; }

        /* Layout */
        .min-h-screen { min-height: 100vh; }
        .max-w-7xl { max-width: 80rem; margin-left: auto; margin-right: auto; }
        .px-4 { padding-left: 1rem; padding-right: 1rem; }
        .py-8 { padding-top: 2rem; padding-bottom: 2rem; }
        .p-4 { padding: 1rem; }
        .p-5 { padding: 1.25rem; }
        .p-6 { padding: 1.5rem; }
        .p-3 { padding: 0.75rem; }
        .px-3 { padding-left: 0.75rem; padding-right: 0.75rem; }
        .px-4b { padding-left: 1rem; padding-right: 1rem; }
        .py-1 { padding-top: 0.25rem; padding-bottom: 0.25rem; }
        .py-2 { padding-top: 0.5rem; padding-bottom: 0.5rem; }
        .py-3 { padding-top: 0.75rem; padding-bottom: 0.75rem; }
        .pt-0 { padding-top: 0; }
        .pb-4 { padding-bottom: 1rem; }
        .pl-8 { padding-left: 2rem; }
        .pr-8 { padding-right: 2rem; }
        .px-2-5 { padding-left: 0.625rem; padding-right: 0.625rem; }
        .py-0-5 { padding-top: 0.125rem; padding-bottom: 0.125rem; }

        .flex { display: flex; }
        .inline-flex { display: inline-flex; }
        .grid { display: grid; }
        .hidden { display: none; }
        .block { display: block; }

        .items-center { align-items: center; }
        .items-end { align-items: flex-end; }
        .justify-between { justify-content: space-between; }
        .justify-center { justify-content: center; }
        .flex-col { flex-direction: column; }
        .flex-row { flex-direction: row; }
        .flex-1 { flex: 1 1; }
        .flex-wrap { flex-wrap: wrap; }
        .flex-shrink-0 { flex-shrink: 0; }

        .gap-1 { gap: 0.25rem; }
        .gap-2 { gap: 0.5rem; }
        .gap-3 { gap: 0.75rem; }
        .gap-4 { gap: 1rem; }
        .gap-6 { gap: 1.5rem; }

        .mb-1 { margin-bottom: 0.25rem; }
        .mb-2 { margin-bottom: 0.5rem; }
        .mb-3 { margin-bottom: 0.75rem; }
        .mb-4 { margin-bottom: 1rem; }
        .mb-6 { margin-bottom: 1.5rem; }
        .mb-8 { margin-bottom: 2rem; }
        .mt-1 { margin-top: 0.25rem; }
        .mt-2 { margin-top: 0.5rem; }
        .mt-3 { margin-top: 0.75rem; }
        .mt-4 { margin-top: 1rem; }
        .mr-1 { margin-right: 0.25rem; }
        .mr-1-5 { margin-right: 0.375rem; }
        .ml-1 { margin-left: 0.25rem; }
        .ml-2 { margin-left: 0.5rem; }
        .ml-auto { margin-left: auto; }

        .w-full { width: 100%; }
        .w-9 { width: 2.25rem; }
        .w-4 { width: 1rem; }
        .h-9 { height: 2.25rem; }
        .h-16 { height: 4rem; }
        .h-4 { height: 1rem; }
        .h-px { height: 1px; }
        .w-px { width: 1px; }
        .w-max { width: max-content; }
        .min-w-0 { min-width: 0; }

        /* Grid */
        .grid-cols-2 { grid-template-columns: repeat(2, minmax(0, 1fr)); }
        .grid-cols-3 { grid-template-columns: repeat(3, minmax(0, 1fr)); }

        /* Typography */
        .text-xs { font-size: 0.75rem; line-height: 1rem; }
        .text-sm { font-size: 0.875rem; line-height: 1.25rem; }
        .text-base { font-size: 1rem; line-height: 1.5rem; }
        .text-lg { font-size: 1.125rem; line-height: 1.75rem; }
        .text-xl { font-size: 1.25rem; line-height: 1.75rem; }
        .text-2xl { font-size: 1.5rem; line-height: 2rem; }
        .text-3xl { font-size: 1.875rem; line-height: 2.25rem; }
        .text-4xl { font-size: 2.25rem; line-height: 2.5rem; }
        .font-medium { font-weight: 500; }
        .font-semibold { font-weight: 600; }
        .font-bold { font-weight: 700; }
        .font-extrabold { font-weight: 800; }
        .font-mono { font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, monospace; }
        .uppercase { text-transform: uppercase; }
        .tracking-wider { letter-spacing: 0.05em; }
        .tracking-widest { letter-spacing: 0.1em; }
        .leading-none { line-height: 1; }
        .whitespace-nowrap { white-space: nowrap; }
        .break-all { word-break: break-all; }
        .text-center { text-align: center; }
        .text-left { text-align: left; }
        .text-right { text-align: right; }

        /* Colors */
        .text-white { color: #fff; }
        .text-slate-400 { color: rgb(148 163 184); }
        .text-slate-500 { color: rgb(100 116 139); }
        .text-slate-600 { color: rgb(71 85 105); }
        .text-slate-700 { color: rgb(51 65 85); }
        .text-emerald-600 { color: rgb(5 150 105); }
        .text-emerald-700 { color: rgb(4 120 87); }
        .text-emerald-800 { color: rgb(6 95 70); }
        .text-amber-800 { color: rgb(146 64 14); }
        .text-sky-700 { color: rgb(3 105 161); }
        .text-pink-700 { color: rgb(190 24 93); }
        .text-orange-700 { color: rgb(194 65 12); }
        .text-rose-700 { color: rgb(190 18 60); }
        .text-primary { color: hsl(var(--primary)); }
        .text-muted-foreground { color: hsl(var(--muted-foreground)); }

        .bg-white { background-color: #fff; }
        .bg-emerald-100 { background-color: rgb(209 250 229); }
        .bg-blue-100 { background-color: rgb(219 234 254); }
        .bg-amber-100 { background-color: rgb(254 243 199); }
        .bg-rose-100 { background-color: rgb(255 228 230); }
        .bg-emerald-50 { background-color: rgb(236 253 245); }
        .bg-sky-50 { background-color: rgb(240 249 255); }
        .bg-pink-50 { background-color: rgb(253 242 248); }
        .bg-muted { background-color: hsl(var(--muted)); }

        /* Borders */
        .border { border-width: 1px; }
        .border-2 { border-width: 2px; }
        .border-b { border-bottom-width: 1px; }
        .border-t { border-top-width: 1px; }
        .border-dashed { border-style: dashed; }
        .border-slate-200 { border-color: rgb(226 232 240); }
        .border-emerald-300 { border-color: rgb(110 231 183); }
        .border-sky-300 { border-color: rgb(125 211 252); }
        .border-pink-300 { border-color: rgb(249 168 212); }
        .border-input { border-color: hsl(var(--input)); }
        .border-transparent { border-color: transparent; }

        /* Radius */
        .rounded-full { border-radius: 9999px; }
        .rounded-lg { border-radius: var(--radius); }
        .rounded-md { border-radius: calc(var(--radius) - 2px); }
        .rounded-sm { border-radius: calc(var(--radius) - 4px); }
        .rounded-xl { border-radius: 0.75rem; }
        .rounded-2xl { border-radius: 1rem; }

        /* Shadows */
        .shadow { --tw-shadow: 0 1px 3px 0 rgb(0 0 0/0.1),0 1px 2px -1px rgb(0 0 0/0.1); box-shadow: var(--tw-shadow); }
        .shadow-sm { --tw-shadow: 0 1px 2px 0 rgb(0 0 0/0.05); box-shadow: var(--tw-shadow); }
        .shadow-md { --tw-shadow: 0 4px 6px -1px rgb(0 0 0/0.1),0 2px 4px -2px rgb(0 0 0/0.1); box-shadow: var(--tw-shadow); }

        /* Position */
        .relative { position: relative; }
        .sticky { position: sticky; }
        .top-0 { top: 0; }
        .z-40 { z-index: 40; }

        /* Misc */
        .overflow-hidden { overflow: hidden; }
        .overflow-x-auto { overflow-x: auto; }
        .opacity-80 { opacity: 0.8; }
        .opacity-0 { opacity: 0; }
        .transition { transition-property: color,background-color,border-color,opacity,box-shadow,transform; transition-timing-function: cubic-bezier(0.4,0,0.2,1); transition-duration: 150ms; }
        .transition-colors { transition-property: color,background-color,border-color; transition-duration: 150ms; }
        .cursor-pointer { cursor: pointer; }
        .select-none { user-select: none; }
        .pointer-events-none { pointer-events: none; }
        .disabled\:opacity-50:disabled { opacity: 0.5; }

        /* Table */
        table { width: 100%; border-collapse: collapse; text-indent: 0; border-color: inherit; }
        th, td { padding: 0.75rem 1rem; text-align: left; border-bottom: 1px solid hsl(var(--border)); }
        th { font-size: 0.75rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em; color: rgb(100 116 139); }

        /* Brand */
        .gd-card { border-radius: 1rem; border-width: 1px; border-color: rgb(226 232 240/0.7); background-color: #fff; box-shadow: 0 1px 2px 0 rgb(0 0 0/0.05); }
        .gd-card-hover { transition: all 0.2s; }
        .gd-card-hover:hover { transform: translateY(-2px); box-shadow: 0 4px 6px -1px rgb(0 0 0/0.1),0 2px 4px -2px rgb(0 0 0/0.1); }
        .gd-bg { background: var(--gd-bg); }

        /* Navbar */
        nav { background-color: rgba(255,255,255,0.85); backdrop-filter: blur(12px); border-bottom: 1px solid rgb(226 232 240/0.8); position: sticky; top: 0; z-index: 40; }
        .nav-inner { max-width: 80rem; margin: 0 auto; padding: 0 1rem; height: 4rem; display: flex; align-items: center; justify-content: space-between; }
        .brand-logo { display: flex; align-items: center; gap: 0.25rem; font-weight: 800; font-size: 1.5rem; }
        .brand-pct { width: 2.25rem; height: 2.25rem; font-size: 1rem; display: inline-flex; align-items: center; justify-content: center; border-radius: 9999px; color: #fff; font-weight: 800; background: linear-gradient(135deg, #F7931E, #FFA726); box-shadow: 0 4px 12px rgba(247,147,30,0.35); }

        /* Buttons */
        .btn { display: inline-flex; align-items: center; justify-content: center; gap: 0.5rem; white-space: nowrap; border-radius: calc(var(--radius) - 2px); font-size: 0.875rem; font-weight: 500; transition: all 150ms; cursor: pointer; border: 1px solid transparent; outline: none; }
        .btn:focus-visible { box-shadow: 0 0 0 2px hsl(var(--ring)); }
        .btn-sm { height: 2rem; padding: 0 0.75rem; font-size: 0.75rem; }
        .btn-md { height: 2.25rem; padding: 0 1rem; }
        .btn-primary { background: var(--gd-blue); color: #fff; box-shadow: 0 1px 2px 0 rgb(0 0 0/0.05); }
        .btn-primary:hover { background: var(--gd-blue-dark); }
        .btn-outline { border-color: hsl(var(--input)); background: transparent; box-shadow: 0 1px 2px 0 rgb(0 0 0/0.05); }
        .btn-outline:hover { background: hsl(var(--accent)); }
        .btn-emerald { border-color: rgb(110 231 183); color: rgb(4 120 87); background: transparent; }
        .btn-emerald:hover { background: rgb(236 253 245); }
        .btn-sky { border-color: rgb(125 211 252); color: rgb(3 105 161); background: transparent; }
        .btn-sky:hover { background: rgb(240 249 255); }
        .btn-pink { border-color: rgb(249 168 212); color: rgb(190 24 93); background: transparent; }
        .btn-pink:hover { background: rgb(253 242 248); }
        .btn-green { background: rgb(5 150 105); color: #fff; }
        .btn-green:hover { background: rgb(4 120 87); }

        /* Badge */
        .badge { display: inline-flex; align-items: center; border-radius: calc(var(--radius) - 2px); padding: 0.125rem 0.625rem; font-size: 0.75rem; font-weight: 600; border: 1px solid transparent; }
        .badge-emerald { background: rgb(209 250 229); color: rgb(6 95 70); }
        .badge-blue { background: rgb(219 234 254); color: rgb(15 76 129); }
        .badge-amber { background: rgb(254 243 199); color: rgb(146 64 14); }
        .badge-rose { background: rgb(255 228 230); color: rgb(190 18 60); }
        .badge-slate { background: rgb(241 245 249); color: rgb(71 85 105); }

        /* Card */
        .card { background: hsl(var(--card)); border-radius: 0.75rem; border: 1px solid hsl(var(--border)); box-shadow: 0 1px 3px 0 rgb(0 0 0/0.1); overflow: hidden; }

        /* Referral link input */
        .ref-input { background: none; border: none; outline: none; width: 100%; font-family: ui-monospace,SFMono-Regular,Menlo,Monaco,Consolas,monospace; font-size: 0.875rem; color: rgb(51 65 85); cursor: text; }

        /* Responsive */
        @media (min-width: 768px) {
            .md\:flex-row { flex-direction: row; }
            .md\:grid-cols-3 { grid-template-columns: repeat(3, minmax(0, 1fr)); }
            .sm\:inline { display: inline; }
        }
        @media (min-width: 1024px) {
            .lg\:grid-cols-4 { grid-template-columns: repeat(4, minmax(0, 1fr)); }
            .lg\:grid-cols-3 { grid-template-columns: repeat(3, minmax(0, 1fr)); }
            .lg\:col-span-2 { grid-column: span 2 / span 2; }
            .lg\:flex-row { flex-direction: row; }
            .lg\:items-end { align-items: flex-end; }
            .lg\:justify-between { justify-content: space-between; }
        }
        @media (max-width: 640px) {
            .sm-hidden { display: none; }
        }

        /* Status badge colors */
        .status-pending  { background: rgb(254 243 199); color: rgb(146 64 14); }
        .status-approved { background: rgb(219 234 254); color: rgb(15 76 129); }
        .status-paid     { background: rgb(209 250 229); color: rgb(6 95 70); }
        .status-rejected { background: rgb(255 228 230); color: rgb(190 18 60); }

        /* Toast */
        #toast { position: fixed; bottom: 1.5rem; right: 1.5rem; background: #1e293b; color: #fff; padding: 0.75rem 1.25rem; border-radius: 0.5rem; font-size: 0.875rem; z-index: 9999; opacity: 0; transition: opacity 0.3s; pointer-events: none; }
        #toast.show { opacity: 1; }
    </style>
</head>
<body>
<div id="toast">Copied!</div>

<!-- NAVBAR -->
<nav>
    <div class="nav-inner">
        <a href="/">
            <div class="brand-logo">
                <span style="color: var(--gd-blue);">Get</span>
                <span class="brand-pct">%</span>
                <span style="color: var(--gd-blue);">nDeal</span>
            </div>
        </a>
        <div class="flex items-center gap-2">
            <span class="text-sm text-slate-600 sm-hidden" style="display:none;" id="nav-user-name" class="sm-inline">Hi, <strong><?= $name ?></strong></span>
            <a href="logout.php">
                <button class="btn btn-outline btn-md">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-right:0.25rem"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" x2="9" y1="12" y2="12"></line></svg>
                    Logout
                </button>
            </a>
        </div>
    </div>
</nav>

<!-- MAIN -->
<div style="background:#F5F7FA; min-height:calc(100vh - 4rem);">
    <div class="max-w-7xl px-4 py-8">

        <!-- Header -->
        <div class="flex flex-col lg:flex-row lg:items-end lg:justify-between gap-4 mb-8">
            <div>
                <h1 style="font-size:1.875rem; color:#0F4C81;">Hello, <?= $name ?> 👋</h1>
                <p class="text-slate-500 mt-1">Here's your affiliate performance.</p>
            </div>
            <span class="badge badge-emerald">ID: <span class="font-mono ml-1"><?= $affiliate_id ?></span></span>
        </div>

        <!-- Referral Link Card -->
        <div class="card mb-6" style="border: 2px dashed rgba(247,147,30,0.33);">
            <div class="p-5" style="padding: 1.25rem 1.5rem;">
                <div class="flex items-center gap-2 text-xs font-semibold uppercase tracking-wider mb-3" style="color:#F7931E;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="18" cy="5" r="3"></circle><circle cx="6" cy="12" r="3"></circle><circle cx="18" cy="19" r="3"></circle><line x1="8.59" x2="15.42" y1="13.51" y2="17.49"></line><line x1="15.41" x2="8.59" y1="6.51" y2="10.49"></line></svg>
                    Your referral link
                </div>
                <div class="flex flex-col gap-3" style="flex-direction:column;">
                    <div class="flex" style="flex-direction:row; gap:0.75rem; flex-wrap:wrap;">
                        <code id="ref-link-code" class="flex-1" style="display:flex; align-items:center; padding:0.75rem 1rem; border-radius:0.75rem; background:#F5F7FA; font-family:ui-monospace,monospace; font-size:0.875rem; color:rgb(51 65 85); word-break:break-all; min-width:0;">
                            <?= $ref_link ?>
                        </code>
                        <button class="btn btn-primary btn-md" onclick="copyLink()" style="white-space:nowrap; flex-shrink:0;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-right:0.375rem"><rect width="14" height="14" x="8" y="8" rx="2" ry="2"></rect><path d="M4 16c-1.1 0-2-.9-2-2V4c0-1.1.9-2 2-2h10c1.1 0 2 .9 2 2"></path></svg>
                            Copy
                        </button>
                    </div>
                    <div class="flex flex-wrap gap-2">
                        <button class="btn btn-sm btn-emerald" onclick="shareWhatsApp()">WhatsApp</button>
                        <button class="btn btn-sm btn-pink" onclick="shareInstagram()">Instagram</button>
                        <button class="btn btn-sm btn-sky" onclick="shareTwitter()">Twitter / X</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-2 mb-8" style="grid-template-columns: repeat(2, minmax(0,1fr)); gap:1rem;">
            <!-- Total Earnings -->
            <div class="card gd-card-hover">
                <div class="p-5">
                    <div class="flex items-center justify-between">
                        <div class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Total earnings</div>
                        <div style="width:2.25rem;height:2.25rem;border-radius:0.5rem;display:flex;align-items:center;justify-content:center;background:rgba(247,147,30,0.1);">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color:#F7931E;"><path d="M19 7V4a1 1 0 0 0-1-1H5a2 2 0 0 0 0 4h15a1 1 0 0 1 1 1v4h-3a2 2 0 0 0 0 4h3a1 1 0 0 0 1-1v-2a1 1 0 0 0-1-1"></path><path d="M3 5v14a2 2 0 0 0 2 2h15a1 1 0 0 0 1-1v-4"></path></svg>
                        </div>
                    </div>
                    <div class="mt-3 font-extrabold" style="font-size:1.875rem;color:#0F4C81;">₹<?= number_format($total_earnings, 2) ?></div>
                </div>
            </div>
            <!-- Total Clicks -->
            <div class="card gd-card-hover">
                <div class="p-5">
                    <div class="flex items-center justify-between">
                        <div class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Total clicks</div>
                        <div style="width:2.25rem;height:2.25rem;border-radius:0.5rem;display:flex;align-items:center;justify-content:center;background:rgba(30,115,190,0.1);">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color:#1E73BE;"><path d="M14 4.1 12 6"></path><path d="m5.1 8-2.9-.8"></path><path d="m6 12-1.9 2"></path><path d="M7.2 2.2 8 5.1"></path><path d="M9.037 9.69a.498.498 0 0 1 .653-.653l11 4.5a.5.5 0 0 1-.074.949l-4.349 1.041a1 1 0 0 0-.74.739l-1.04 4.35a.5.5 0 0 1-.95.074z"></path></svg>
                        </div>
                    </div>
                    <div class="mt-3 font-extrabold" style="font-size:1.875rem;color:#0F4C81;"><?= $total_clicks ?></div>
                </div>
            </div>
            <!-- Conversions -->
            <div class="card gd-card-hover">
                <div class="p-5">
                    <div class="flex items-center justify-between">
                        <div class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Conversions</div>
                        <div style="width:2.25rem;height:2.25rem;border-radius:0.5rem;display:flex;align-items:center;justify-content:center;background:rgba(15,76,129,0.1);">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color:#0F4C81;"><path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z"></path><path d="M3 6h18"></path><path d="M16 10a4 4 0 0 1-8 0"></path></svg>
                        </div>
                    </div>
                    <div class="mt-3 font-extrabold" style="font-size:1.875rem;color:#0F4C81;"><?= $total_conversions ?></div>
                </div>
            </div>
            <!-- Conv Rate -->
            <div class="card gd-card-hover">
                <div class="p-5">
                    <div class="flex items-center justify-between">
                        <div class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Conv. rate</div>
                        <div style="width:2.25rem;height:2.25rem;border-radius:0.5rem;display:flex;align-items:center;justify-content:center;background:rgba(30,115,190,0.1);">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color:#1E73BE;"><polyline points="22 7 13.5 15.5 8.5 10.5 2 17"></polyline><polyline points="16 7 22 7 22 13"></polyline></svg>
                        </div>
                    </div>
                    <div class="mt-3 font-extrabold" style="font-size:1.875rem;color:#0F4C81;"><?= $conv_rate ?><span style="font-size:1rem;color:rgb(148 163 184);font-weight:500;margin-left:0.25rem;">%</span></div>
                </div>
            </div>
        </div>

        <!-- Earnings Breakdown + Payout -->
        <div class="grid mb-8" style="gap:1.5rem; grid-template-columns: 1fr;">
            <div style="display:grid; gap:1.5rem; grid-template-columns:1fr;">

                <!-- Earnings breakdown -->
                <div class="card">
                    <div class="p-6">
                        <div class="text-sm font-semibold mb-4" style="color:#0F4C81;">Earnings breakdown</div>
                        <div style="display:grid; grid-template-columns: repeat(3, minmax(0,1fr)); gap:1rem;">
                            <div style="border-radius:0.75rem; background:#F5F7FA; padding:1rem;">
                                <span class="badge badge-amber" style="margin-bottom:0.5rem;">Pending</span>
                                <div class="font-bold" style="font-size:1.5rem; color:#0F4C81;">₹<?= number_format($earnings_pending, 2) ?></div>
                            </div>
                            <div style="border-radius:0.75rem; background:#F5F7FA; padding:1rem;">
                                <span class="badge badge-blue" style="margin-bottom:0.5rem;">Approved</span>
                                <div class="font-bold" style="font-size:1.5rem; color:#0F4C81;">₹<?= number_format($earnings_approved, 2) ?></div>
                            </div>
                            <div style="border-radius:0.75rem; background:#F5F7FA; padding:1rem;">
                                <span class="badge badge-emerald" style="margin-bottom:0.5rem;">Paid</span>
                                <div class="font-bold" style="font-size:1.5rem; color:#0F4C81;">₹<?= number_format($earnings_paid, 2) ?></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Available payout -->
                <div class="card" style="background: linear-gradient(135deg, #1E73BE, #0F4C81); color: #fff;">
                    <div class="p-6">
                        <div class="text-xs font-semibold uppercase tracking-wider" style="opacity:0.8;">Available for payout</div>
                        <div class="font-extrabold mt-2" style="font-size:2.25rem;">₹<?= number_format($available_payout, 2) ?></div>
                        <div class="text-xs mt-1" style="opacity:0.8;">Min. payout ₹<?= number_format($min_payout) ?></div>
                        <?php if ($needed > 0): ?>
                        <div class="mt-4 text-xs p-3" style="border-radius:0.5rem; background:rgba(255,255,255,0.1);">
                            Earn ₹<?= number_format($needed, 2) ?> more to request payout.
                        </div>
                        <?php else: ?>
                        <div class="mt-4" style="display:flex; gap:0.75rem; align-items:center; flex-wrap:wrap;">
                            <span style="font-size:0.875rem; opacity:0.9;">You're eligible to request a payout! 🎉</span>
                            <a href="request-payout.php">
                                <button class="btn btn-sm" style="background:#fff; color:#1E73BE; font-weight:700; border:none;">Request Payout</button>
                            </a>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Transactions -->
        <div class="card mb-8">
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="text-sm font-semibold" style="color:#0F4C81;">Recent transactions</div>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color:#F7931E;"><path d="M6 9H4.5a2.5 2.5 0 0 1 0-5H6"></path><path d="M18 9h1.5a2.5 2.5 0 0 0 0-5H18"></path><path d="M4 22h16"></path><path d="M10 14.66V17c0 .55-.47.98-.97 1.21C7.85 18.75 7 20.24 7 22"></path><path d="M14 14.66V17c0 .55.47.98.97 1.21C16.15 18.75 17 20.24 17 22"></path><path d="M18 2H6v7a6 6 0 0 0 12 0V2Z"></path></svg>
                </div>
                <?php if (empty($transactions)): ?>
                    <div class="text-center py-10 text-slate-400 text-sm">No transactions yet. Share your link to start earning!</div>
                <?php else: ?>
                    <div class="overflow-x-auto">
                        <table>
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Order / Ref</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($transactions as $tx): ?>
                                <tr>
                                    <td class="text-sm text-slate-600"><?= htmlspecialchars(date('d M Y', strtotime($tx['created_at']))) ?></td>
                                    <td class="text-sm font-mono text-slate-700"><?= htmlspecialchars($tx['order_id'] ?? $tx['id']) ?></td>
                                    <td class="text-sm font-semibold" style="color:#0F4C81;">₹<?= number_format($tx['amount'], 2) ?></td>
                                    <td>
                                        <span class="badge status-<?= htmlspecialchars($tx['status']) ?>"><?= ucfirst(htmlspecialchars($tx['status'])) ?></span>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Payout History -->
        <div class="card">
            <div class="p-6">
                <div class="text-sm font-semibold mb-4" style="color:#0F4C81;">Payout history</div>
                <?php if (empty($payouts)): ?>
                    <div class="text-center py-8 text-slate-400 text-sm">No payouts yet.</div>
                <?php else: ?>
                    <div class="overflow-x-auto">
                        <table>
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Amount</th>
                                    <th>Method</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($payouts as $p): ?>
                                <tr>
                                    <td class="text-sm text-slate-600"><?= htmlspecialchars(date('d M Y', strtotime($p['created_at']))) ?></td>
                                    <td class="text-sm font-semibold" style="color:#0F4C81;">₹<?= number_format($p['amount'], 2) ?></td>
                                    <td class="text-sm text-slate-600"><?= htmlspecialchars($p['method'] ?? '—') ?></td>
                                    <td>
                                        <span class="badge status-<?= htmlspecialchars($p['status']) ?>"><?= ucfirst(htmlspecialchars($p['status'])) ?></span>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        </div>

    </div>
</div>

<script>
var refLink = <?= json_encode($ref_link) ?>;

function showToast(msg) {
    var t = document.getElementById('toast');
    t.textContent = msg || 'Copied!';
    t.classList.add('show');
    setTimeout(function() { t.classList.remove('show'); }, 2000);
}

function copyLink() {
    if (navigator.clipboard && navigator.clipboard.writeText) {
        navigator.clipboard.writeText(refLink).then(function() {
            showToast('Referral link copied!');
        });
    } else {
        var ta = document.createElement('textarea');
        ta.value = refLink;
        document.body.appendChild(ta);
        ta.select();
        document.execCommand('copy');
        document.body.removeChild(ta);
        showToast('Referral link copied!');
    }
}

function shareWhatsApp() {
    var msg = encodeURIComponent("🛍️ Get amazing deals on GetOnDeal! Use my link: " + refLink);
    window.open("https://wa.me/?text=" + msg, '_blank');
}

function shareInstagram() {
    copyLink();
    showToast('Link copied — paste it in your Instagram bio or story!');
}

function shareTwitter() {
    var msg = encodeURIComponent("Get the best deals on @GetOnDeal 🎯 Use my referral link: " + refLink);
    window.open("https://twitter.com/intent/tweet?text=" + msg, '_blank');
}
</script>
</body>
</html>