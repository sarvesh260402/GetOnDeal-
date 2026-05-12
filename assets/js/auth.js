/**
 * GetOnDeal Authentication Logic
 */

const AUTH_CONFIG = {
    API_BASE: '/api/auth',
    CSRF_HEADER: 'x-csrf-token'
};

let csrfToken = null;

/**
 * Initialize CSRF token
 */
async function initAuth() {
    try {
        const response = await fetch(`${AUTH_CONFIG.API_BASE}/csrf-token`);
        const data = await response.json();
        csrfToken = data.csrfToken;
        console.log('Auth initialized');
    } catch (err) {
        console.error('Failed to initialize auth:', err);
    }
}

/**
 * Show loading state on button
 */
function setLoading(isLoading) {
    const btn = document.querySelector('.btn-primary');
    const loader = document.getElementById('loader');
    const btnText = document.getElementById('btnText');
    const errorAlert = document.getElementById('errorMessage');

    if (isLoading) {
        btn.disabled = true;
        loader.style.display = 'block';
        btnText.style.opacity = '0.5';
        errorAlert.style.display = 'none';
    } else {
        btn.disabled = false;
        loader.style.display = 'none';
        btnText.style.opacity = '1';
    }
}

/**
 * Show error message
 */
function showError(message) {
    const errorAlert = document.getElementById('errorMessage');
    errorAlert.textContent = message;
    errorAlert.style.display = 'block';

    // Add shake animation
    errorAlert.classList.add('animate-shake');
    setTimeout(() => errorAlert.classList.remove('animate-shake'), 500);
}

/**
 * Handle Login
 */
window.handleLogin = async (email, password) => {
    setLoading(true);

    try {
        if (!csrfToken) await initAuth();

        const response = await fetch(`${AUTH_CONFIG.API_BASE}/login`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                [AUTH_CONFIG.CSRF_HEADER]: csrfToken
            },
            body: JSON.stringify({ email, password })
        });

        const data = await response.json();

        if (response.ok) {
            // Store user data and token
            localStorage.setItem('user', JSON.stringify(data));
            localStorage.setItem('token', data.token);

            // Success redirect
            window.location.href = 'index.html'; // Or dashboard if available
        } else {
            showError(data.message || 'Login failed. Please check your credentials.');
        }
    } catch (err) {
        showError('Network error. Please try again later.');
    } finally {
        setLoading(false);
    }
};

/**
 * Handle Register
 */
window.handleRegister = async (name, email, password) => {
    setLoading(true);

    try {
        if (!csrfToken) await initAuth();

        const response = await fetch(`${AUTH_CONFIG.API_BASE}/register`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                [AUTH_CONFIG.CSRF_HEADER]: csrfToken
            },
            body: JSON.stringify({ name, email, password })
        });

        const data = await response.json();

        if (response.ok) {
            localStorage.setItem('user', JSON.stringify(data));
            localStorage.setItem('token', data.token);
            window.location.href = 'index.html';
        } else {
            showError(data.message || 'Registration failed.');
        }
    } catch (err) {
        showError('Network error. Please try again later.');
    } finally {
        setLoading(false);
    }
};

// Initialize on load
document.addEventListener('DOMContentLoaded', initAuth);
