/**
 * GetOnDeal Affiliate Tracking Logic
 */

const Tracking = {
    csrfToken: null,
    init() {
        // Capture referral code from URL
        const urlParams = new URLSearchParams(window.location.search);
        const ref = urlParams.get('ref');
        
        if (ref) {
            localStorage.setItem('god_ref_code', ref);
            console.log('Referral tracked:', ref);
        }

        // Attach click listeners to all book buttons
        document.addEventListener('click', (e) => {
            if (e.target.closest('[data-action="book"]')) {
                e.preventDefault();
                const btn = e.target.closest('[data-action="book"]');
                const listingId = btn.getAttribute('data-id');
                this.handleAffiliateClick(listingId);
            }
        });
    },

    async handleAffiliateClick(listingId) {
        const refCode = localStorage.getItem('god_ref_code');
        const API_URL = window.GOD_CONFIG ? window.GOD_CONFIG.API_BASE_URL : 'http://localhost:5000/api';

        try {
            if (!this.csrfToken) {
                const csrfRes = await fetch(`${API_URL}/auth/csrf-token`, { credentials: 'include' });
                const csrfData = await csrfRes.json();
                this.csrfToken = csrfData?.csrfToken || null;
            }
            // Log click in backend
            const response = await fetch(`${API_URL}/track/click`, {
                method: 'POST',
                credentials: 'include',
                headers: { 
                    'Content-Type': 'application/json',
                    ...(this.csrfToken ? { 'X-CSRF-Token': this.csrfToken } : {})
                },
                body: JSON.stringify({ listingId, refCode })
            });

            const data = await response.json();

            if (data.targetUrl) {
                // Redirect to affiliate link
                window.open(data.targetUrl, '_blank');
            } else {
                alert('Deal link not available. Contact support.');
            }
        } catch (err) {
            console.error('Tracking Error:', err);
            // Fallback: just open a default link if API fails
            alert('Redirecting to partner site...');
        }
    }
};

document.addEventListener('DOMContentLoaded', () => Tracking.init());
