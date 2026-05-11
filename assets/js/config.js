/**
 * GetOnDeal Platform Configuration
 * Centralized environment management for local and production modes.
 */

const GOD_CONFIG = {
    // Detect environment
    isLocal: window.location.hostname === 'localhost' || window.location.hostname === '127.0.0.1',
    env: window.__GOD_ENV__ || {},

    // API Base URLs
    get API_BASE_URL() {
        if (this.env.API_BASE_URL) return this.env.API_BASE_URL;
        return this.isLocal 
            ? 'http://localhost:5000/api' 
            : 'https://api.getondeal.com/api'; // Replace with production URL when ready
    },

    // Tracking Configuration
    tracking: {
        cookieName: 'god_ref',
        expiryDays: 30
    }
};

// Export to window for global access
window.GOD_CONFIG = GOD_CONFIG;
