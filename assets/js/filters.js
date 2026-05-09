/**
 * Deal Category Filtering
 */
function filterDeals(button, category) {
    // Update button states
    const buttons = button.parentElement.querySelectorAll('button');
    buttons.forEach(btn => {
        btn.classList.remove('bg-[#0B0B12]', 'text-white', 'shadow-[0_8px_20px_-8px_rgba(11,11,18,0.6)]');
        btn.classList.add('bg-white', 'text-[#0B0B12]', 'border', 'border-[#E6EAF0]', 'hover:border-[#0B0B12]');
    });

    button.classList.add('bg-[#0B0B12]', 'text-white', 'shadow-[0_8px_20px_-8px_rgba(11,11,18,0.6)]');
    button.classList.remove('bg-white', 'text-[#0B0B12]', 'border', 'border-[#E6EAF0]', 'hover:border-[#0B0B12]');

    // Filter cards
    const cards = document.querySelectorAll('.deal-card');
    cards.forEach(card => {
        if (category === 'All' || card.getAttribute('data-cat') === category) {
            card.style.display = 'block';
        } else {
            card.style.display = 'none';
        }
    });
}

function scrollDeals(direction) {
    const track = document.getElementById('deals-track');
    if (track) {
        const scrollAmount = 350 * direction;
        track.scrollBy({ left: scrollAmount, behavior: 'smooth' });
    }
}
