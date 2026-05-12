/**
 * GetOnDeal Admin Dashboard Logic
 */

const API_BASE = window.GOD_CONFIG?.API_BASE_URL || 'https://getondeal-app.onrender.com/api';
let csrfToken = null;

const escapeHtml = (value) => String(value ?? '')
    .replace(/&/g, '&amp;')
    .replace(/</g, '&lt;')
    .replace(/>/g, '&gt;')
    .replace(/"/g, '&quot;')
    .replace(/'/g, '&#39;');

// Auth Guard
const checkAuth = () => {
    const token = localStorage.getItem('god_token');
    const user = JSON.parse(localStorage.getItem('god_user'));

    if (!token || !user || user.role !== 'admin') {
        window.location.href = 'login.php';
        return null;
    }
    
    // Update Profile UI
    document.getElementById('admin-name').textContent = user.name;
    document.getElementById('admin-email').textContent = user.email;
    if (user.profilePicture) document.getElementById('admin-avatar').src = user.profilePicture;
    
    return token;
};

const token = checkAuth();

// API Helper
const apiFetch = async (endpoint, options = {}) => {
    if (!csrfToken) {
        try {
            const csrfResponse = await fetch(`${API_BASE}/auth/csrf-token`, { credentials: 'include' });
            const csrfData = await csrfResponse.json();
            csrfToken = csrfData?.csrfToken || null;
        } catch (err) {
            console.warn('CSRF bootstrap failed:', err);
        }
    }

    const mergedHeaders = {
        'Authorization': `Bearer ${token}`,
        'Content-Type': 'application/json',
        ...(csrfToken ? { 'X-CSRF-Token': csrfToken } : {}),
        ...(options.headers || {})
    };
    const defaultOptions = {
        credentials: 'include',
        headers: {
            ...mergedHeaders
        }
    };
    
    try {
        const response = await fetch(`${API_BASE}${endpoint}`, { ...defaultOptions, ...options });
        if (response.status === 401) {
            localStorage.removeItem('god_token');
            window.location.href = 'login.php';
        }
        return await response.json();
    } catch (err) {
        console.error('Fetch Error:', err);
        return { error: true, message: err.message };
    }
};

// Page Router
const routes = {
    overview: async () => {
        document.getElementById('page-title').textContent = 'Dashboard Overview';
        const content = document.getElementById('content-area');
        
        content.innerHTML = `
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
                <div class="card p-6">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-10 h-10 rounded-xl bg-blue-50 text-[#1E73BE] flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2v20"/><path d="m17 5-5-3-5 3"/><path d="m17 19-5 3-5-3"/><path d="M2 12h20"/><path d="m5 7 3 5-3 5"/><path d="m19 7-3 5 3 5"/></svg>
                        </div>
                        <span class="text-xs font-bold text-green-500 bg-green-50 px-2 py-1 rounded-full">+12.5%</span>
                    </div>
                    <p class="text-xs font-bold text-[#5B6271] uppercase tracking-widest">Total Revenue</p>
                    <h3 class="text-3xl font-extrabold text-[#0B0B12] mt-1">₹4,21,860</h3>
                </div>
                <div class="card p-6">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-10 h-10 rounded-xl bg-orange-50 text-[#F7931E] flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="4" rx="2" ry="2"/><line x1="16" x2="16" y1="2" y2="6"/><line x1="8" x2="8" y1="2" y2="6"/><line x1="3" x2="21" y1="10" y2="10"/></svg>
                        </div>
                        <span class="text-xs font-bold text-green-500 bg-green-50 px-2 py-1 rounded-full">+8%</span>
                    </div>
                    <p class="text-xs font-bold text-[#5B6271] uppercase tracking-widest">Active Bookings</p>
                    <h3 class="text-3xl font-extrabold text-[#0B0B12] mt-1">1,284</h3>
                </div>
                <div class="card p-6">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-10 h-10 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>
                        </div>
                        <span class="text-xs font-bold text-[#5B6271] bg-gray-100 px-2 py-1 rounded-full">Static</span>
                    </div>
                    <p class="text-xs font-bold text-[#5B6271] uppercase tracking-widest">Total Users</p>
                    <h3 class="text-3xl font-extrabold text-[#0B0B12] mt-1">12,450</h3>
                </div>
                <div class="card p-6">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-10 h-10 rounded-xl bg-teal-50 text-teal-600 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20h.01"/><path d="M7 16.4V4c0-.5.4-.9.9-.9h8.2c.5 0 .9.4.9.9v12.4M12 15l-3.5-3.5"/><path d="m15.5 11.5-3.5 3.5"/></svg>
                        </div>
                        <span class="text-xs font-bold text-red-500 bg-red-50 px-2 py-1 rounded-full">-2.4%</span>
                    </div>
                    <p class="text-xs font-bold text-[#5B6271] uppercase tracking-widest">Conversion Rate</p>
                    <h3 class="text-3xl font-extrabold text-[#0B0B12] mt-1">4.2%</h3>
                </div>
            </div>

            <div class="grid lg:grid-cols-3 gap-8">
                <!-- Analytics Chart -->
                <div class="lg:col-span-2 card p-8">
                    <div class="flex items-center justify-between mb-8">
                        <div>
                            <h4 class="font-bold text-[#0B0B12]">Revenue Growth</h4>
                            <p class="text-xs text-[#5B6271]">Weekly insights across all categories</p>
                        </div>
                        <select class="bg-[#F5F7FA] border border-[#E6EAF0] rounded-lg px-3 py-1.5 text-xs font-semibold outline-none">
                            <option>Last 7 Days</option>
                            <option>Last 30 Days</option>
                        </select>
                    </div>
                    <div class="h-80 w-full">
                        <canvas id="revenueChart"></canvas>
                    </div>
                </div>

                <!-- Recent Activity -->
                <div class="card p-8">
                    <h4 class="font-bold text-[#0B0B12] mb-6">Recent Activity</h4>
                    <div class="space-y-6">
                        ${[1,2,3,4,5].map(() => `
                        <div class="flex gap-4">
                            <div class="w-8 h-8 rounded-full bg-blue-50 text-[#1E73BE] flex items-center justify-center shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0"/><circle cx="12" cy="10" r="3"/></svg>
                            </div>
                            <div>
                                <p class="text-sm text-[#0B0B12] leading-snug"><b>New Booking</b> at Olive Bar & Kitchen</p>
                                <p class="text-xs text-[#9AA3B2] mt-0.5">2 minutes ago</p>
                            </div>
                        </div>
                        `).join('')}
                    </div>
                    <button class="w-full text-center text-xs font-bold text-[#1E73BE] mt-8 hover:underline">View all activity</button>
                </div>
            </div>
        `;

        // Initialize Chart
        const ctx = document.getElementById('revenueChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
                datasets: [{
                    label: 'Revenue',
                    data: [12000, 19000, 15000, 25000, 22000, 30000, 45000],
                    borderColor: '#1E73BE',
                    borderWidth: 3,
                    tension: 0.4,
                    fill: true,
                    backgroundColor: 'rgba(30, 115, 190, 0.05)'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    y: { beginAtZero: true, grid: { color: '#F0F2F5' } },
                    x: { grid: { display: false } }
                }
            }
        });
    },

    listings: async () => {
        document.getElementById('page-title').textContent = 'Manage Listings';
        const content = document.getElementById('content-area');
        content.innerHTML = `
            <div class="card p-0 overflow-hidden">
                <div class="p-6 border-b border-[#E6EAF0] flex items-center justify-between bg-gray-50/50">
                    <div class="flex items-center gap-4">
                        <div class="relative">
                            <input type="text" placeholder="Filter listings..." class="bg-white border border-[#E6EAF0] rounded-lg px-4 py-2 text-sm outline-none focus:border-[#1E73BE] w-64">
                        </div>
                        <select class="bg-white border border-[#E6EAF0] rounded-lg px-4 py-2 text-sm outline-none">
                            <option>All Categories</option>
                            <option>Restaurants</option>
                            <option>Cafes</option>
                        </select>
                    </div>
                    <button onclick="routes.showCreateDeal()" class="bg-[#1E73BE] text-white text-xs font-bold px-4 py-2 rounded-lg hover:bg-[#165a96]">Add New Deal</button>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="bg-gray-50 text-[#9AA3B2] uppercase text-[10px] font-bold tracking-widest border-b border-[#E6EAF0]">
                                <th class="px-6 py-4">Listing</th>
                                <th class="px-6 py-4">Category</th>
                                <th class="px-6 py-4">Area</th>
                                <th class="px-6 py-4">Price</th>
                                <th class="px-6 py-4">Status</th>
                                <th class="px-6 py-4 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="listings-table-body">
                            <tr><td colspan="6" class="px-6 py-12 text-center text-sm text-[#5B6271]">Loading listings...</td></tr>
                        </tbody>
                    </table>
                </div>
            </div>
        `;

        const data = await apiFetch('/listings');
        const tbody = document.getElementById('listings-table-body');
        
        const items = Array.isArray(data) ? data : (data?.items || []);
        if (items.length > 0) {
            tbody.innerHTML = items.map(item => `
                <tr class="border-b border-[#F0F2F5] hover:bg-gray-50 transition-colors group">
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            <img src="${escapeHtml(item.img)}" alt="${escapeHtml(item.name)}" class="w-10 h-10 rounded-lg object-cover">
                            <div>
                                <p class="font-bold text-sm text-[#0B0B12]">${escapeHtml(item.name)}</p>
                                <p class="text-[10px] text-[#5B6271] uppercase tracking-wider">${escapeHtml(item.cuisine || 'Modern Indian')}</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-sm font-medium text-[#5B6271]">${escapeHtml(item.category)}</td>
                    <td class="px-6 py-4 text-sm text-[#5B6271]">${escapeHtml(item.area)}</td>
                    <td class="px-6 py-4 text-sm font-bold text-[#0B0B12]">₹${Number(item.price || 0).toLocaleString('en-IN')}</td>
                    <td class="px-6 py-4">
                        <span class="px-2.5 py-1 rounded-full text-[10px] font-bold uppercase bg-green-50 text-green-600">Active</span>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <button class="text-[#9AA3B2] hover:text-[#1E73BE] p-2 rounded-lg hover:bg-[#EAF3FB] transition-all">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"/><path d="m15 5 4 4"/></svg>
                        </button>
                    </td>
                </tr>
            `).join('');
        } else {
            tbody.innerHTML = `<tr><td colspan="6" class="px-6 py-12 text-center text-sm text-[#5B6271]">No listings found.</td></tr>`;
        }
    },

    showCreateDeal: () => {
        document.getElementById('page-title').textContent = 'Create New Deal';
        const content = document.getElementById('content-area');
        content.innerHTML = `
            <div class="max-w-4xl card p-10">
                <form id="deal-form" class="space-y-8">
                    <div class="grid grid-cols-2 gap-8">
                        <div class="col-span-2">
                            <label class="block text-xs font-bold text-[#0B0B12] uppercase tracking-wider mb-3">Main Image (URL)</label>
                            <div class="flex gap-4">
                                <input type="text" id="img" required class="flex-1 bg-[#F5F7FA] border border-[#E6EAF0] rounded-xl px-5 py-4 text-sm outline-none focus:border-[#1E73BE]" placeholder="https://images.unsplash.com/...">
                                <button type="button" class="bg-white border border-[#E6EAF0] px-6 rounded-xl text-sm font-bold hover:bg-gray-50 transition-colors">Upload</button>
                            </div>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-[#0B0B12] uppercase tracking-wider mb-3">Deal Name</label>
                            <input type="text" id="name" required class="w-full bg-[#F5F7FA] border border-[#E6EAF0] rounded-xl px-5 py-4 text-sm outline-none focus:border-[#1E73BE]" placeholder="e.g. Sunday Brunch at Olive">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-[#0B0B12] uppercase tracking-wider mb-3">Category</label>
                            <select id="category" required class="w-full bg-[#F5F7FA] border border-[#E6EAF0] rounded-xl px-5 py-4 text-sm outline-none focus:border-[#1E73BE]">
                                <option>Restaurants</option>
                                <option>Cafes</option>
                                <option>Nightlife</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-[#0B0B12] uppercase tracking-wider mb-3">Price (Offer)</label>
                            <input type="number" id="price" required class="w-full bg-[#F5F7FA] border border-[#E6EAF0] rounded-xl px-5 py-4 text-sm outline-none focus:border-[#1E73BE]" placeholder="2400">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-[#0B0B12] uppercase tracking-wider mb-3">Original Price</label>
                            <input type="number" id="orig" required class="w-full bg-[#F5F7FA] border border-[#E6EAF0] rounded-xl px-5 py-4 text-sm outline-none focus:border-[#1E73BE]" placeholder="4800">
                        </div>
                    </div>
                    <div class="pt-6 border-t border-[#E6EAF0] flex gap-4">
                        <button type="submit" class="bg-[#0B0B12] text-white font-bold px-10 py-4 rounded-xl hover:bg-[#1E73BE] transition-all">Publish Deal</button>
                        <button type="button" onclick="routes.listings()" class="bg-gray-100 text-[#0B0B12] font-bold px-10 py-4 rounded-xl hover:bg-gray-200 transition-all">Cancel</button>
                    </div>
                </form>
            </div>
        `;
        
        document.getElementById('deal-form').addEventListener('submit', async (e) => {
            e.preventDefault();
            const formData = {
                name: document.getElementById('name').value,
                category: document.getElementById('category').value,
                price: document.getElementById('price').value,
                orig: document.getElementById('orig').value,
                img: document.getElementById('img').value,
                status: 'published'
            };
            
            const res = await apiFetch('/listings', {
                method: 'POST',
                body: JSON.stringify(formData)
            });
            
            if (!res.error) {
                alert('Deal published successfully!');
                routes.listings();
            }
        });
    },

    categories: async () => {
        document.getElementById('page-title').textContent = 'CMS - Category Manager';
        const content = document.getElementById('content-area');
        content.innerHTML = `
            <div class="flex flex-col gap-8">
                <div class="flex justify-end">
                    <button class="bg-[#0B0B12] text-white text-xs font-bold px-6 py-3 rounded-xl hover:bg-[#1E73BE] transition-all flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="M12 5v14"/></svg>
                        New Category
                    </button>
                </div>
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                    ${[1,2,3,4,5].map(i => `
                    <div class="card p-6 flex items-center gap-4 group">
                        <div class="w-16 h-16 rounded-2xl bg-gray-100 overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?q=80&w=200" class="w-full h-full object-cover">
                        </div>
                        <div class="flex-1">
                            <h4 class="font-bold text-[#0B0B12]">Category ${i}</h4>
                            <p class="text-[10px] text-[#5B6271] uppercase font-bold tracking-widest mt-0.5">12 Deals Published</p>
                        </div>
                        <button class="opacity-0 group-hover:opacity-100 transition-opacity p-2 text-[#9AA3B2] hover:text-[#0B0B12]">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"/><path d="m15 5 4 4"/></svg>
                        </button>
                    </div>
                    `).join('')}
                </div>
            </div>
        `;
    },

    bookings: async () => {
        document.getElementById('page-title').textContent = 'Bookings & Reservations';
        const content = document.getElementById('content-area');
        content.innerHTML = `
            <div class="card p-0 overflow-hidden">
                <div class="p-6 border-b border-[#E6EAF0] flex items-center justify-between bg-gray-50/50">
                    <div class="flex items-center gap-4">
                        <select class="bg-white border border-[#E6EAF0] rounded-lg px-4 py-2 text-sm outline-none">
                            <option>All Status</option>
                            <option>Pending</option>
                            <option>Confirmed</option>
                            <option>Completed</option>
                        </select>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="bg-gray-50 text-[#9AA3B2] uppercase text-[10px] font-bold tracking-widest border-b border-[#E6EAF0]">
                                <th class="px-6 py-4">Customer</th>
                                <th class="px-6 py-4">Venue</th>
                                <th class="px-6 py-4">Date & Time</th>
                                <th class="px-6 py-4">Guests</th>
                                <th class="px-6 py-4">Status</th>
                                <th class="px-6 py-4 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            ${[1,2,3,4].map(i => `
                            <tr class="border-b border-[#F0F2F5] hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 rounded-full bg-blue-100 text-[#1E73BE] flex items-center justify-center text-xs font-bold">JD</div>
                                        <p class="font-bold text-sm text-[#0B0B12]">John Doe</p>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-sm text-[#5B6271]">Olive Bar & Kitchen</td>
                                <td class="px-6 py-4 text-sm text-[#5B6271]">May 12, 8:00 PM</td>
                                <td class="px-6 py-4 text-sm text-[#0B0B12] font-bold">4</td>
                                <td class="px-6 py-4">
                                    <span class="px-2.5 py-1 rounded-full text-[10px] font-bold uppercase ${i%2===0 ? 'bg-orange-50 text-orange-600' : 'bg-green-50 text-green-600'}">${i%2===0 ? 'Pending' : 'Confirmed'}</span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <button class="text-xs font-bold text-[#1E73BE] hover:underline">Manage</button>
                                </td>
                            </tr>
                            `).join('')}
                        </tbody>
                    </table>
                </div>
            </div>
        `;
    },

    users: async () => {
        document.getElementById('page-title').textContent = 'User Management';
        const content = document.getElementById('content-area');
        content.innerHTML = `
            <div class="grid md:grid-cols-3 gap-8 mb-10">
                <div class="card p-6 flex items-center gap-4">
                    <div class="w-12 h-12 rounded-2xl bg-blue-50 text-[#1E73BE] flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                    </div>
                    <div>
                        <p class="text-[10px] font-bold text-[#9AA3B2] uppercase tracking-widest">Total Users</p>
                        <h4 class="text-2xl font-extrabold text-[#0B0B12]">12,450</h4>
                    </div>
                </div>
            </div>
            <div class="card p-0 overflow-hidden">
                <table class="w-full text-left">
                    <thead class="bg-gray-50 border-b border-[#E6EAF0]">
                        <tr class="text-[10px] font-bold text-[#9AA3B2] uppercase tracking-widest">
                            <th class="px-6 py-4">User</th>
                            <th class="px-6 py-4">Role</th>
                            <th class="px-6 py-4">Join Date</th>
                            <th class="px-6 py-4">Activity</th>
                            <th class="px-6 py-4 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        ${[1,2,3].map(() => `
                        <tr class="border-b border-[#F0F2F5] hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <img src="https://i.pravatar.cc/100?u=${Math.random()}" class="w-8 h-8 rounded-full">
                                    <p class="font-bold text-sm text-[#0B0B12]">User Name</p>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-xs font-bold text-[#5B6271] uppercase tracking-wide">Member</td>
                            <td class="px-6 py-4 text-sm text-[#5B6271]">Apr 2026</td>
                            <td class="px-6 py-4"><div class="w-24 h-1.5 bg-gray-100 rounded-full overflow-hidden"><div class="w-2/3 h-full bg-[#1E73BE]"></div></div></td>
                            <td class="px-6 py-4 text-right">
                                <button class="text-[#9AA3B2] hover:text-[#0B0B12]"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="1"/><circle cx="19" cy="12" r="1"/><circle cx="5" cy="12" r="1"/></svg></button>
                            </td>
                        </tr>
                        `).join('')}
                    </tbody>
                </table>
            </div>
        `;
    },

    settings: async () => {
        document.getElementById('page-title').textContent = 'Platform Settings';
        const content = document.getElementById('content-area');
        content.innerHTML = `
            <div class="max-w-3xl card p-8">
                <h4 class="font-bold text-[#0B0B12] mb-6">General Configuration</h4>
                <div class="space-y-6">
                    <div class="grid grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-bold text-[#0B0B12] uppercase tracking-wider mb-2">Platform Name</label>
                            <input type="text" value="GetOnDeal" class="w-full bg-[#F5F7FA] border border-[#E6EAF0] rounded-xl px-5 py-3 text-sm outline-none">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-[#0B0B12] uppercase tracking-wider mb-2">Support Email</label>
                            <input type="email" value="support@getondeal.com" class="w-full bg-[#F5F7FA] border border-[#E6EAF0] rounded-xl px-5 py-3 text-sm outline-none">
                        </div>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-[#0B0B12] uppercase tracking-wider mb-2">Maintenance Mode</label>
                        <div class="flex items-center gap-3">
                            <button class="w-12 h-6 bg-gray-200 rounded-full relative transition-all">
                                <span class="absolute left-1 top-1 w-4 h-4 bg-white rounded-full transition-all"></span>
                            </button>
                            <span class="text-sm text-[#5B6271]">Disabled</span>
                        </div>
                    </div>
                    <div class="pt-6 border-t border-[#E6EAF0]">
                        <button class="bg-[#0B0B12] text-white text-sm font-bold px-8 py-3 rounded-xl hover:bg-[#1E73BE] transition-all">Save Changes</button>
                    </div>
                </div>
            </div>
        `;
    }
};

// Initial Load
const activePage = 'overview';
routes[activePage]();

// Event Listeners for Nav
document.querySelectorAll('.sidebar-item').forEach(btn => {
    btn.addEventListener('click', () => {
        document.querySelectorAll('.sidebar-item').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
        const page = btn.getAttribute('data-page');
        if (routes[page]) routes[page]();
        else {
            document.getElementById('page-title').textContent = page.charAt(0).toUpperCase() + page.slice(1);
            document.getElementById('content-area').innerHTML = `<div class="card p-12 text-center text-[#5B6271]">Module <b>${page}</b> is under development.</div>`;
        }
    });
});

// Logout
document.getElementById('logout-btn').addEventListener('click', () => {
    localStorage.removeItem('god_token');
    localStorage.removeItem('god_user');
    window.location.href = 'login.php';
});
