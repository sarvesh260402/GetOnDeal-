# Production Hardening & Deployment Checklist - GetOnDeal

This document outlines the security, performance, and infrastructure strategies implemented to ensure the platform is production-ready.

## 1. Security Strategy
- **API Protection**:
  - Implemented `helmet` for secure HTTP headers.
  - Implemented `express-rate-limit` to prevent brute-force and DoS attacks (100 req/15min per IP).
  - Body payload size limited to `10kb` to prevent large-object attacks.
- **Authentication**:
  - JWT tokens are used for all admin/affiliate sessions.
  - Passwords are salted and hashed using `bcrypt` with 10 rounds.
- **Input Sanitization**:
  - All Mongoose models use strict schemas with type validation.
  - Recommended: Integrate `express-validator` for custom business logic validation.

## 2. Performance & CWV Optimization
- **Database Performance**:
  - Added compound indexes for status/category filtering in `Listings`.
  - Added text indexes for full-text search across `name`, `description`, and `venue`.
  - Added indexes for affiliate click attribution.
- **Core Web Vitals**:
  - **LCP (Largest Contentful Paint)**: First hero and card images use `fetchpriority="high"` and `loading="eager"`.
  - **CLS (Cumulative Layout Shift)**: All dynamic images now have explicit `width` and `height` attributes to reserve space during loading.
  - **Lazy Loading**: Native `loading="lazy"` applied to all off-screen assets.

## 3. Monitoring & Logging
- **Logging Strategy**:
  - Use `morgan` for HTTP request logging in production.
  - Use `winston` or `pino` for structured application logging (error, warn, info).
- **Monitoring**:
  - Recommended: Setup **New Relic** or **Datadog** for APM.
  - Setup **Sentry** for real-time frontend/backend error tracking.

## 4. Backup & Disaster Recovery
- **Database**:
  - MongoDB Atlas automatically handles daily snapshots and point-in-time recovery.
  - Recommended: Enable "Cross-Region Backups" for critical data.
- **Assets**:
  - All images should be hosted on **Cloudinary** or **AWS S3** with versioning enabled.

## 5. Deployment Pipeline
1. **CI/CD**: Use GitHub Actions to run linting and tests on every push.
2. **Environment**: Use separate `staging` and `production` environments in MongoDB Atlas.
3. **Caching**: Setup a **Redis** layer for frequently accessed listings if traffic exceeds 100k requests/day.

---
**Status**: `HARDENED` · **Last Audit**: 2026-05-09
