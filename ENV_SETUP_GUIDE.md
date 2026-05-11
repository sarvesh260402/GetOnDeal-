# Environment Setup Guide

Date: 2026-05-11

## Goal

Support both local development and production deployment safely without exposing secrets.

## Files Added

- Root PHP template: `.env.example`
- Backend template: `server/.env.example`
- Frontend runtime template: `assets/js/config.template.js`
- Local backend env configured: `server/.env`

## Local Development Configuration

Backend (`server/.env`):

```env
NODE_ENV=development
PORT=5000
MONGODB_URI=mongodb://localhost:27017/getondeal
JWT_SECRET=change_this_in_production
```

This uses local MongoDB instance and database name `getondeal`.

## Production Configuration (Atlas-supported)

In production, set `MONGODB_URI` to Atlas URI in environment variables (not committed files), for example:

```env
MONGODB_URI=mongodb+srv://<user>:<password>@<cluster>/<db>?retryWrites=true&w=majority
```

`server/config/db.js` remains environment-driven, so local and production switching is preserved.

## Hostinger / Render Notes

- Keep secrets in platform environment variable managers.
- Do not commit real passwords/tokens.
- Ensure CORS origins are set via:
  - `CORS_ALLOWED_ORIGINS`

## Verification Steps

1. Start local MongoDB service.
2. Start backend from `server` folder:
   - `npm install`
   - `npm run dev` or `npm start`
3. Confirm log indicates connection to:
   - `localhost/getondeal`
4. Hit health check:
   - `GET /api/health`
5. Confirm collections create automatically after first writes.

## CSRF Enforcement Controls

For legacy PHP endpoints, strict CSRF validation can be toggled via:

```env
CSRF_ENFORCE=1
```

Recommended rollout: enable after clients are confirmed to send tokens.
