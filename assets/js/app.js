/**
 * Global App Logic
 * Intersection Observer for Fade-up animations
 */
const API_URL = 'http://localhost:5000/api';

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
    async get(endpoint) {
        try {
            const res = await fetch(`${API_URL}${endpoint}`);
            return await res.json();
        } catch (err) {
            console.error(`API Get Error (${endpoint}):`, err);
            return null;
        }
    },
    async post(endpoint, data, token = null) {
        try {
            const headers = { 'Content-Type': 'application/json' };
            if (token) headers['Authorization'] = `Bearer ${token}`;
            const res = await fetch(`${API_URL}${endpoint}`, {
                method: 'POST',
                headers,
                body: JSON.stringify(data)
            });
            return await res.json();
        } catch (err) {
            console.error(`API Post Error (${endpoint}):`, err);
            return null;
        }
    }
};
