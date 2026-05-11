# Deployment Checklist

Date: 2026-05-11

## Pre-Deploy Security

- [ ] Confirm no real secrets in tracked files.
- [ ] Confirm `.env` files are excluded from git.
- [ ] Set strong `JWT_SECRET` in Render env vars.
- [ ] Set production `MONGODB_URI` in Render (Atlas) OR approved production Mongo endpoint.
- [ ] Confirm CORS production origins configured via `CORS_ALLOWED_ORIGINS`.

## Backend (Render) Readiness

- [ ] Build/install succeeds (`npm install` in `server`).
- [ ] Server boots and logs successful Mongo connection.
- [ ] Health endpoint `/api/health` returns 200.
- [ ] CSRF token endpoint `/api/auth/csrf-token` returns token.
- [ ] Auth + protected routes validated with role checks.

## Frontend/PHP (Hostinger) Readiness

- [ ] PHP runtime active and includes resolved.
- [ ] `config.php` environment variables set on host:
  - `DB_HOST`, `DB_USER`, `DB_PASSWORD`, `DB_NAME`
- [ ] Homepage/modules render with no missing assets.
- [ ] Admin login + affiliate login verified.
- [ ] Legacy PHP endpoints (login/signup/book) validated with CSRF token flow.

## Functional Smoke Matrix

- [ ] Listings CRUD + pagination
- [ ] Categories CRUD + pagination
- [ ] Reviews query + pagination
- [ ] Users query + pagination (admin-only)
- [ ] Bookings query + pagination (admin/vendor)
- [ ] Analytics endpoints return expected payload shape
- [ ] Tracking click endpoint logs writes

## Observability

- [ ] Request logs visible in backend runtime.
- [ ] 4xx/5xx errors return normalized payload with request ID.
- [ ] Monitor startup and DB connectivity alerts.

## Final Release Gate

- [ ] Staging smoke pass complete.
- [ ] Rollback plan documented.
- [ ] Production DNS/API URL wiring validated.
- [ ] Final sign-off granted.
