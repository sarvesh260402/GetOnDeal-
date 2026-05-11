# Security Runtime Report

Date: 2026-05-11

## Verified Active Controls

- Helmet enabled in backend.
- CORS policy active with env-switchable allowed origins.
- API rate limiter active.
- JSON payload size capped.
- Request validation middleware active on key routes.
- CSRF bootstrap and validation middleware implemented.
- PHP CSRF helper integrated for legacy POST endpoints.
- SQL injection mitigations (prepared statements) present in critical PHP auth/booking paths.

## Runtime Security Findings

## High
- JWT tokens are still stored in browser `localStorage` for dashboard/affiliate flows.
  - Risk: token theft if XSS occurs.
  - Status: accepted temporarily for backward compatibility.

## Medium
- CSRF middleware is currently compatibility-first to avoid breaking old clients.
  - Stronger strict enforcement should be staged after client confirmation.

## Medium
- Legacy static HTML artifacts include suspicious injected challenge scripts and should not be deployed as active production assets without cleanup review.

## Runtime Validation Status

- Backend security middleware compiles and wires correctly.
- Full exploit simulation not executed here due missing full runtime stack (local Mongo + PHP service constraints in current environment).

## Recommended Immediate Hardening Before Launch

1. Move JWT to httpOnly cookie strategy or hybrid refresh-token cookie model.
2. Enable strict CSRF enforcement after final UI client checks.
3. Add CSP headers for frontend pages.
4. Add route-specific brute-force throttling on login endpoints.
