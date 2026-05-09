/**
 * Testimonials Slider
 */
document.addEventListener('DOMContentLoaded', () => {
    const sliderItems = document.querySelectorAll('.testimonial-item');
    const dots = document.querySelectorAll('.testimonial-dot');
    const prevBtn = document.getElementById('test-prev');
    const nextBtn = document.getElementById('test-next');
    
    if (!sliderItems.length) return;

    let currentIndex = 0;

    const showTestimonial = (index) => {
        sliderItems.forEach((item, i) => {
            item.style.display = i === index ? 'block' : 'none';
        });
        dots.forEach((dot, i) => {
            dot.style.backgroundColor = i === index ? '#F7931E' : '#E6EAF0';
        });
    };

    if (prevBtn) {
        prevBtn.addEventListener('click', () => {
            currentIndex = (currentIndex - 1 + sliderItems.length) % sliderItems.length;
            showTestimonial(currentIndex);
        });
    }

    if (nextBtn) {
        nextBtn.addEventListener('click', () => {
            currentIndex = (currentIndex + 1) % sliderItems.length;
            showTestimonial(currentIndex);
        });
    }

    // Initialize
    showTestimonial(0);
});
