# GetOnDeal Full Project Audit Report

Date: 2026-05-11  
Scope: frontend, backend, database models, CMS/admin, affiliate system, APIs, security, performance, SEO, maintainability.

## Executive Summary

- Platform is close to functional MVP quality, but not yet production-ready without additional follow-up.
- Several high-risk security flaws were found in legacy PHP endpoints (SQL injection patterns and secret exposure), and core backend reliability defects existed.
- High-impact safe fixes were applied automatically in this pass.
- No architecture rewrites were performed.

## What Was Auto-Fixed (Safe Changes Applied)

1. Backend/API
- Fixed `server/models/Listing.js` hook/index structure to prevent runtime/syntax failure.
- Added missing tracking route wiring:
  - Added `server/routes/trackingRoutes.js`
  - Mounted in `server/server.js` as `/api/track`
- Added missing backend dependencies in `server/package.json`:
  - `helmet`
  - `express-rate-limit`
- Hardened auth middleware flow in `server/middleware/authMiddleware.js`:
  - Return after unauthorized responses
  - Handle missing user after JWT decode
- Improved auth controller robustness in `server/controllers/authController.js`:
  - Added input normalization for email
  - Added request validation and controlled 500 responses

2. Security/PHP Hardening
- Removed hardcoded DB credentials in `config.php`; switched to env-based DB configuration.
- Enabled MySQL charset `utf8mb4` in `config.php`.
- Converted raw SQL auth and account flows to prepared statements:
  - `login.php`
  - `signup.php`
  - `book.php`
  - `dashboard.php`
- Added input validation and stronger request guards in those endpoints.

3. Frontend/SEO/UI Safety
- Hardened referral cookie handling in `index.php`:
  - input sanitization
  - `HttpOnly`, `SameSite=Lax`, conditional `Secure`
- Added canonical, OpenGraph URL/image, Twitter card tags, and baseline JSON-LD in `index.php`.
- Fixed malformed HTML in `dashboard/index.php` (prematurely unclosed style block issue).
- Added output escaping in `dashboard/assets/js/dashboard.js` for API-driven listing rendering to reduce XSS risk.

## Deep Audit Findings by Area

## 1) Frontend
- Strong visual language and premium styling consistency in main pages.
- Risks:
  - Multiple pages rely on large inline templates and `innerHTML` rendering.
  - Missing broader accessibility coverage (focus states, ARIA labels, keyboard nav checks).
  - Loading/error states are inconsistent outside dashboard/login.

## 2) Backend
- Express stack has good baseline hardening (`helmet`, CORS, rate limiting).
- Risks:
  - No central async error middleware layer.
  - No request schema validation middleware (e.g., Joi/Zod/express-validator).
  - CORS allowlist is static and not env-driven.

## 3) Database
- Mongoose schemas are mostly reasonable.
- Risks:
  - Mixed SQL + Mongo architecture with duplicated business data paths.
  - Missing explicit indexes on some frequently queried SQL tables (not auto-modified in this pass).
  - Referral/commission data quality constraints are inconsistent across SQL and Mongo stores.

## 4) CMS/Admin Dashboard
- UI polish is high.
- Risks:
  - Several sections use static demo-like data blocks and not true CRUD wiring.
  - Client-side role checks are present, but still rely on JWT in localStorage.
  - Upload flow appears placeholder-only in current dashboard view.

## 5) Affiliate System
- End-to-end click tracking route now correctly mounted.
- Risks:
  - Attribution logic still split across cookie + localStorage + mixed SQL/Mongo data paths.
  - Anti-fraud/duplicate conversion controls are not comprehensive.

## 6) API Architecture
- Centralized frontend config exists via `assets/js/config.js`.
- Risks:
  - Hardcoded production API URL placeholder remains.
  - No versioned API namespace (`/api/v1`).

## 7) Security
- Critical SQL injection vectors in key PHP paths were fixed.
- Risks:
  - JWT storage in localStorage remains vulnerable to XSS token theft.
  - No CSRF strategy for legacy cookie/session form actions.
  - Missing explicit upload sanitization module in visible code.

## 8) Performance
- Good use of `defer` on homepage scripts.
- Risks:
  - Tailwind via CDN in production pages (render/perf and determinism tradeoff).
  - Heavy template injection in dashboard can cause layout/paint spikes.

## 9) SEO
- Baseline SEO was decent; improved this pass with canonical/OG/Twitter/JSON-LD on homepage.
- Risks:
  - Other entry pages still need consistent metadata strategy.
  - Sitemap/robots automation not found in repo.

## 10) Code Quality
- Risks:
  - Legacy SQL PHP endpoints and Node API coexist with overlapping concerns.
  - Some dead/demo pages appear disconnected from core runtime.
  - Test suite absent.

## Launch Readiness Status

- Security: improved materially, still needs CSRF/session/token strategy hardening.
- Reliability: improved, still needs centralized error handling + validation middleware.
- Performance: acceptable for MVP, optimize before marketing-scale traffic.
- Maintainability: moderate risk due to mixed stack and duplicated logic.

Overall status: **Conditional launch readiness after critical follow-up items in the checklist are completed.**
