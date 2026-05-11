# Scalability Report - GetOnDeal

Date: 2026-05-11

## Current Scalability Posture

- Architecture supports early-stage traffic but has medium-term scaling constraints due to mixed-stack data paths and duplicated business logic.

## Key Scalability Risks

1. Data Layer Split
- SQL and Mongo both appear to hold overlapping operational concerns.
- Attribution, commissions, and user flows are not fully unified.

2. API Read Path
- Listings endpoint lacks pagination/cursor controls.
- Search uses regex without explicit limits.

3. Session/Auth Strategy
- Client JWT in localStorage does not provide enterprise-grade session control.

4. Operational Gaps
- No visible job queue for async heavy tasks (emailing, media processing, reconciliation).
- No central observability/tracing setup shown in code.

## Scalability Improvements Applied in This Pass

- Repaired broken core model/runtime path in Mongo API.
- Restored missing track route integration, reducing request failure loops and attribution data loss.

## Recommended Scalability Roadmap

## Phase 1 (Immediate)
- Add API pagination and hard limits.
- Add query-level indexes based on real traffic query plans.
- Add structured logging + request IDs.

## Phase 2 (Pre-traffic Growth)
- Introduce Redis caching for hot listing/category endpoints.
- Add async queue for non-critical work (notifications, analytics enrichment).
- Add DB pooling, circuit breakers, and retry policies where needed.

## Phase 3 (Scale-out)
- Separate read/write workloads and add background analytics pipeline.
- Introduce API versioning and domain service boundaries.
- Add automated load testing in CI with clear SLO thresholds.

## Scaling Readiness Verdict

Ready for controlled beta traffic after immediate follow-up tasks; not yet optimized for large public spikes without caching, pagination discipline, and observability upgrades.
