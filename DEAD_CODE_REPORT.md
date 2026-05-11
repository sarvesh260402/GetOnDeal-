# Dead Code / Unused Surface Report - GetOnDeal

Date: 2026-05-11

## Likely Dead or Low-Value Artifacts

- Standalone static HTML pages appear partially detached from active PHP/Node flows:
  - `affiliate-login.html`
  - `affiliate-signup.html`
  - `affiliate-self-booking.html`
  - `affiliate-admin-panel.html`
  - `leaderboard.html`
  - `affiliate.html`
- These files also include injected challenge snippets that are likely export artifacts and should be reviewed.

## Duplicate Logic Hotspots

- Authentication/business logic exists in both:
  - Legacy PHP SQL endpoints
  - Node + Mongo API
- Referral tracking logic split across:
  - Cookie (`index.php`)
  - LocalStorage (`assets/js/tracking.js`)
  - SQL affiliate flows
  - Mongo click conversion models

## Potentially Unused Backend Models (Needs Runtime Confirmation)

- `server/models/City.js`
- `server/models/Review.js`
- `server/models/Testimonial.js`
- `server/models/Section.js`
- `server/models/Category.js`
- `server/models/Booking.js`
- `server/models/Conversion.js`

Note: Models may be planned for future routes; no deletion was performed.

## Safe Cleanup Plan (Not Auto-Executed)

1. Add runtime usage telemetry (route/model import map, request logs).
2. Mark uncertain files as `@deprecated` first.
3. Remove only after one full release cycle with no references.
4. Move archive artifacts to a dedicated archival directory outside active runtime paths.
