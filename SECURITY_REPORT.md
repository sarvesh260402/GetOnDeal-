# Security Report - GetOnDeal

Date: 2026-05-11

## Critical Findings (Resolved in This Pass)

- **SQL injection risk in legacy PHP endpoints**  
  Affected: `login.php`, `signup.php`, `book.php`, `dashboard.php`  
  Fix: Replaced string interpolation queries with prepared statements and added basic input validation.

- **Hardcoded database secrets in repository**  
  Affected: `config.php`  
  Fix: Replaced static credentials with environment-based loading (`DB_HOST`, `DB_USER`, `DB_PASSWORD`, `DB_NAME`).

- **Unsafe referral cookie handling**  
  Affected: `index.php`  
  Fix: Sanitized `ref` value and added cookie attributes (`HttpOnly`, `SameSite=Lax`, conditional `Secure`).

- **Stored/DOM XSS exposure in dashboard listing render path**  
  Affected: `dashboard/assets/js/dashboard.js`  
  Fix: Escaped API-derived values before template injection for listing fields.

## High Findings (Open)

- **JWT stored in localStorage**
  - Affected flows: admin and affiliate frontend auth.
  - Risk: token theft on XSS.
  - Recommendation: migrate to secure httpOnly cookie sessions or short-lived access + rotating refresh tokens in cookie.

- **No visible CSRF protection for legacy session endpoints**
  - Recommendation: add CSRF tokens for all state-changing PHP form posts.

- **No strict Content Security Policy configured**
  - Recommendation: add CSP (nonce/hash-based) and reduce inline script usage over time.

## Medium Findings

- CORS allowlist is static in `server/server.js`; should be env-configurable.
- Rate limiting is global and coarse; add tighter per-auth-route limits.
- Login endpoints do not show account lockout/brute force protection.

## Immediate Post-Audit Actions Required

1. Rotate any previously committed DB password immediately.
2. Add `.env.example` and environment documentation for both PHP and Node services.
3. Add CSRF middleware/token checks to legacy POST forms.
4. Plan migration away from localStorage JWT storage.

## Security Status

Major exploitable issues were reduced significantly in this pass, but full production-hardening requires token/session and CSRF strategy completion before public scale.
