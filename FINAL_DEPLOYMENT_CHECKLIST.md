# Final Deployment Checklist - GetOnDeal

Date: 2026-05-11

## Must Complete Before Public Launch

- [ ] Rotate and replace any previously exposed DB credentials.
- [ ] Populate environment variables for:
  - [ ] PHP DB (`DB_HOST`, `DB_USER`, `DB_PASSWORD`, `DB_NAME`)
  - [ ] Node API (`MONGODB_URI`, `JWT_SECRET`, `NODE_ENV`, CORS origin settings)
- [ ] Run full regression testing of:
  - [ ] auth/login/signup
  - [ ] listing fetch/create
  - [ ] affiliate click tracking and redirect
  - [ ] admin dashboard critical modules
- [ ] Confirm `server/package.json` dependencies installed in deployment image.

## Security Verification

- [ ] Add CSRF protection for legacy session-based forms.
- [ ] Add CSP policy and verify no required inline script breakage.
- [ ] Add brute-force protection for login endpoints.
- [ ] Confirm admin/affiliate role checks enforced server-side on all protected routes.

## Performance Verification

- [ ] Run Lighthouse on home/listings/dashboard and record baseline scores.
- [ ] Add pagination limits on listing APIs.
- [ ] Set CDN/cache headers for static assets.
- [ ] Verify image optimization pipeline (sizes, formats, lazy loading).

## SEO/Content Verification

- [ ] Verify canonical/OG/twitter metadata resolves to valid image URLs in production.
- [ ] Add sitemap.xml and robots.txt strategy.
- [ ] Validate structured data using Google Rich Results test.

## Data & Observability

- [ ] Add request logging + error tracking (client and server).
- [ ] Add DB backups and restore drill.
- [ ] Add uptime and health endpoint monitoring.

## Release Gate

- [ ] All critical/high issues in `SECURITY_REPORT.md` addressed or accepted with owner and due date.
- [ ] Product owner sign-off on `FULL_AUDIT_REPORT.md`.
- [ ] Deployment dry run completed in staging with rollback plan tested.
