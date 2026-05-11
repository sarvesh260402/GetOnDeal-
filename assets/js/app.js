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
        try {
            const res = await fetch(`${API_URL}${endpoint}`, { credentials: 'include' });
            return await res.json();
        } catch (err) {
            console.error(`API Get Error (${endpoint}):`, err);
            return null;
        }
    },
    async post(endpoint, data, token = null) {
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
            return await res.json();
        } catch (err) {
            console.error(`API Post Error (${endpoint}):`, err);
            return null;
        }
    }
};
