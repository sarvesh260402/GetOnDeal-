/**
 * Spotlight Deal Countdown Timer
 */
document.addEventListener('DOMContentLoaded', () => {
    const hrsEl = document.getElementById('countdown-hrs');
    const minEl = document.getElementById('countdown-min');
    const secEl = document.getElementById('countdown-sec');

    if (!hrsEl || !minEl || !secEl) return;

    let totalSeconds = (3 * 3600) + (45 * 60) + 21;

    const updateTimer = () => {
        if (totalSeconds <= 0) {
            clearInterval(timerInterval);
            return;
        }

        totalSeconds--;

        const h = Math.floor(totalSeconds / 3600);
        const m = Math.floor((totalSeconds % 3600) / 60);
        const s = totalSeconds % 60;

        hrsEl.textContent = h.toString().padStart(2, '0');
        minEl.textContent = m.toString().padStart(2, '0');
        secEl.textContent = s.toString().padStart(2, '0');
    };

    const timerInterval = setInterval(updateTimer, 1000);
});
