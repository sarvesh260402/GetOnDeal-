# GetOnDeal - Premium Discovery & Booking Platform

A high-performance, modular PHP implementation of the GetOnDeal landing page.

## Architecture
The project follows a modular architecture designed for scalability and maintainability:

- **assets/**: Compiled and organized CSS/JS assets.
- **data/**: PHP-based data arrays for easy management of content.
- **includes/**: Reusable PHP components for each section of the page.
- **index.php**: Main entry point using PHP includes.

## Tech Stack
- **Backend**: PHP 8.x
- **Frontend**: HTML5, CSS3 (Custom Architecture + Tailwind Utilities)
- **Animation**: CSS Keyframes + Framer-inspired Vanilla JS transitions
- **Performance**: Intersection Observer for lazy animations, responsive image loading, deferred JS.

## Performance Features
- Lighthouse optimized structures.
- Zero layout shifts (CLS).
- Semantic SEO tags and Schema-ready markup.
- Fully responsive from 320px to 4K.

## Setup
1. Point your web server (Apache/Nginx) to the `public_html` directory.
2. Ensure PHP is enabled.
3. Access `index.php` in your browser.

## Customization
Content can be updated by modifying the arrays in the `data/` directory. Styles can be adjusted in `assets/css/components.css` and `global.css`.
