/**
 * Global App Logic
 * Intersection Observer for Fade-up animations
 */
const API_URL = window.GOD_CONFIG?.API_BASE_URL || 'http://localhost:5000/api';

document.addEventListener('DOMContentLoaded', () => {
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('fade-up');
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    document.querySelectorAll('.animate-on-scroll').forEach(el => {
        observer.observe(el);
    });
});

// Global API utilities
const api = {
    csrfToken: null,
    showLoader() {
        const loader = document.getElementById('global-loader');
        if (loader) loader.classList.remove('hidden');
    },
    hideLoader() {
        const loader = document.getElementById('global-loader');
        if (loader) loader.classList.add('hidden');
    },
    showError(message) {
        // Generic error toast logic
        console.error('API Error:', message);
    },
    async ensureCsrfToken() {
        if (this.csrfToken) return this.csrfToken;
        try {
            const res = await fetch(`${API_URL}/auth/csrf-token`, { credentials: 'include' });
            const data = await res.json();
            this.csrfToken = data?.csrfToken || null;
        } catch (err) {
            console.warn('CSRF token bootstrap failed:', err);
        }
        return this.csrfToken;
    },
    async get(endpoint) {
        this.showLoader();
        try {
            const res = await fetch(`${API_URL}${endpoint}`, { credentials: 'include' });
            const data = await res.json();
            if (data.success === false) throw new Error(data.message || 'API Error');
            return data;
        } catch (err) {
            this.showError(err.message);
            return null;
        } finally {
            this.hideLoader();
        }
    },
    async post(endpoint, data, token = null) {
        this.showLoader();
        try {
            const csrfToken = await this.ensureCsrfToken();
            const headers = { 'Content-Type': 'application/json' };
            if (token) headers['Authorization'] = `Bearer ${token}`;
            if (csrfToken) headers['X-CSRF-Token'] = csrfToken;
            const res = await fetch(`${API_URL}${endpoint}`, {
                method: 'POST',
                headers,
                credentials: 'include',
                body: JSON.stringify(data)
            });
            const result = await res.json();
            if (result.success === false) throw new Error(result.message || 'API Error');
            return result;
        } catch (err) {
            this.showError(err.message);
            return null;
        } finally {
            this.hideLoader();
        }
    }
};
