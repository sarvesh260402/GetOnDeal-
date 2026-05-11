# Security Upgrade Report (Phase 2)

Date: 2026-05-11

## Security Upgrades Implemented

## CSRF
- Added API CSRF bootstrap endpoint and middleware validation:
  - `GET /api/auth/csrf-token`
  - `server/middleware/csrfMiddleware.js`
- Integrated CSRF token usage in admin/affiliate login + dashboard + tracking JS clients.
- Added PHP CSRF helper and applied checks to legacy POST endpoints:
  - `includes/csrf.php`
  - `login.php`, `signup.php`, `book.php`

## Validation
- Added centralized validation middleware and field schemas:
  - `server/middleware/validateMiddleware.js`
  - `server/validation/schemas.js`
- Applied schema validation to auth, listings, tracking payloads, and paginated query endpoints.

## Error Normalization + Traceability
- Added request IDs and normalized API error responses:
  - `server/middleware/requestLogger.js`
  - `server/middleware/errorMiddleware.js`

## Access/Role Integrity
- Added `affiliate` role support in `server/models/User.js` enum to align with existing affiliate login flow checks.

## Open Security Gaps (Not Removed Yet)

- JWT still stored in localStorage in frontend login flows (XSS token theft risk remains).
- CSRF middleware runs in compatibility mode to prevent regressions; strict mode rollout still needed.
- No CSP policy yet for frontend pages.
- Brute force controls for auth endpoints can be tighter (route-specific rate limits).

## Rollout Recommendation

1. Stage deploy with compatibility mode enabled.
2. Monitor CSRF validation metrics and client header adoption.
3. Enable strict CSRF enforcement in phased manner:
   - API strict mode after all clients confirm token send.
   - PHP strict mode with `CSRF_ENFORCE=1`.
4. Plan next hardening sprint for httpOnly cookie auth migration.
