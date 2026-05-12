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

        try {
            // Log click in backend using global api utility
            const data = await api.post('/track/click', { listingId, refCode });

            if (data && data.targetUrl) {
                // Redirect to affiliate link
                window.open(data.targetUrl, '_blank');
            } else {
                alert('Deal link not available. Contact support.');
            }
        } catch (err) {
            console.error('Tracking Error:', err);
            // Fallback: the api utility already handles error logging/toast
            alert('Something went wrong. Please try again.');
        }
    }
};

document.addEventListener('DOMContentLoaded', () => Tracking.init());
