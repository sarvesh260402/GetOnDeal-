const sanitizeString = (value) => String(value || '').trim();

const validate = (schema = {}) => (req, res, next) => {
  const source = schema.source === 'query' ? req.query : req.body;
  const errors = [];
  const sanitized = { ...source };

  for (const [field, rule] of Object.entries(schema.fields || {})) {
    let value = source[field];

    if (typeof value === 'string' && rule.trim !== false) {
      value = sanitizeString(value);
      sanitized[field] = value;
    }

    if (rule.required && (value === undefined || value === null || value === '')) {
      errors.push({ field, message: `${field} is required` });
      continue;
    }

    if ((value === undefined || value === null || value === '') && !rule.required) {
      continue;
    }

    if (rule.type === 'email') {
      const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      if (!emailRegex.test(String(value))) {
        errors.push({ field, message: `${field} must be a valid email` });
      } else {
        sanitized[field] = String(value).toLowerCase();
      }
    }

    if (rule.type === 'number') {
      const parsed = Number(value);
      if (Number.isNaN(parsed)) {
        errors.push({ field, message: `${field} must be a number` });
      } else {
        if (rule.min !== undefined && parsed < rule.min) {
          errors.push({ field, message: `${field} must be >= ${rule.min}` });
        }
        if (rule.max !== undefined && parsed > rule.max) {
          errors.push({ field, message: `${field} must be <= ${rule.max}` });
        }
        sanitized[field] = parsed;
      }
    }

    if (rule.enum && !rule.enum.includes(value)) {
      errors.push({ field, message: `${field} must be one of: ${rule.enum.join(', ')}` });
    }

    if (rule.maxLength && String(value).length > rule.maxLength) {
      errors.push({ field, message: `${field} exceeds max length ${rule.maxLength}` });
    }
  }

  if (errors.length > 0) {
    return res.status(400).json({
      message: 'Validation failed',
      errors,
    });
  }

  if (schema.source === 'query') req.query = sanitized;
  else req.body = sanitized;
  return next();
};

module.exports = { validate };
