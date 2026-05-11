# Validation Architecture

Date: 2026-05-11

## Design Goals

- Reusable, centralized validation for API payloads and query parameters.
- Input sanitization for string fields.
- Consistent 400 responses for malformed payloads.
- Backward-compatible integration with existing controllers/routes.

## Core Components

1. Middleware engine
- File: `server/middleware/validateMiddleware.js`
- Capabilities:
  - required checks
  - email format checks
  - number coercion + min/max
  - enum checks
  - max length checks
  - string trim/sanitization

2. Schema registry
- File: `server/validation/schemas.js`
- Domain schemas included:
  - auth (register/login)
  - listings (create)
  - categories (create)
  - affiliate data (track click)
  - bookings (list query)
  - reviews (list query)

3. Route integration
- Applied in:
  - `server/routes/authRoutes.js`
  - `server/routes/listingRoutes.js`
  - `server/routes/trackingRoutes.js`
  - `server/routes/bookingRoutes.js`
  - `server/routes/reviewRoutes.js`
  - `server/routes/categoryRoutes.js`

## Error Response Contract

Validation failures return:

```json
{
  "message": "Validation failed",
  "errors": [
    { "field": "email", "message": "email must be a valid email" }
  ]
}
```

## Extension Pattern

To add new validation:
1. Add schema block in `server/validation/schemas.js`
2. Apply `validate(schema)` in route definition
3. Keep controller business logic unchanged

This preserves maintainability and avoids scattered ad hoc input checks.
