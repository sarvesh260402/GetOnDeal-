# Performance Report - GetOnDeal

Date: 2026-05-11

## Current Performance Posture

- Homepage script loading already uses `defer`, which is positive.
- Backend includes payload limit (`10kb`) and rate limiting baseline.
- Dashboard relies on heavy dynamic template rendering and large inline markup, which can impact responsiveness on low-end devices.

## Findings

## Frontend
- Tailwind runtime CDN usage on major pages can increase startup cost and reduce deterministic builds.
- Several pages include large inline CSS/HTML blocks; cacheability and parse cost can be improved.
- Missing explicit image optimization pipeline (responsive sizes, modern formats, lazy strategy consistency).

## Backend/API
- Listing search currently uses regex in `server/controllers/listingController.js` without pagination.
- No server-side response caching strategy for read-heavy listing endpoints.
- No query projections/lean optimization visible on high-read paths.

## Database
- Some useful indexes exist in Mongo schemas (`Click`, `Conversion`, `Listing`).
- Additional indexing should be validated against production query plans (SQL and Mongo both).

## Optimizations Applied in This Pass

- Restored/fixed broken backend model path causing startup/runtime instability (`server/models/Listing.js`).
- Restored missing tracking route mount to avoid front-end retry/failure overhead from broken endpoint (`/api/track/click`).

## Recommended Next Performance Tasks (Priority)

1. Add pagination + limit/offset or cursor in `/api/listings`.
2. Add `lean()` and field projections where full Mongoose docs are not needed.
3. Move Tailwind from CDN to build pipeline for production.
4. Introduce static asset compression and cache headers for CSS/JS/images.
5. Add Lighthouse CI and baseline budgets for Core Web Vitals.
6. Add server profiling for hot endpoints and query timing logs.

## Expected Impact If Completed

- Faster first contentful paint and interaction readiness.
- Lower API response time under concurrent load.
- Better stability under traffic spikes.
