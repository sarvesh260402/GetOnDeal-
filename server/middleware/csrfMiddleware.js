const crypto = require('crypto');

const CSRF_COOKIE = 'god_csrf';
const CSRF_HEADER = 'x-csrf-token';

const issueCsrfToken = (req, res) => {
  const token = crypto.randomBytes(32).toString('hex');
  res.cookie(CSRF_COOKIE, token, {
    httpOnly: false,
    sameSite: 'lax',
    secure: process.env.NODE_ENV === 'production',
    maxAge: 1000 * 60 * 60 * 12,
  });
  return token;
};

const csrfBootstrap = (req, res) => {
  const token = req.cookies?.[CSRF_COOKIE] || issueCsrfToken(req, res);
  return res.status(200).json({ csrfToken: token });
};

const csrfProtection = (req, res, next) => {
  const method = req.method.toUpperCase();
  if (['GET', 'HEAD', 'OPTIONS'].includes(method)) return next();

  const cookieToken = req.cookies?.[CSRF_COOKIE];
  const headerToken = req.headers[CSRF_HEADER];

  // In production, strictly enforce CSRF.
  if (process.env.NODE_ENV === 'production' && (!cookieToken || !headerToken)) {
    return res.status(403).json({ 
      success: false,
      message: 'CSRF token missing',
      requestId: req.requestId 
    });
  }

  // Backward compatible mode for dev: if token is not sent yet, skip once.
  if (process.env.NODE_ENV !== 'production' && !cookieToken && !headerToken) return next();

  if (!cookieToken || !headerToken || cookieToken !== headerToken) {
    return res.status(403).json({ 
      success: false,
      message: 'Invalid CSRF token',
      requestId: req.requestId
    });
  }

  return next();
};

module.exports = { csrfBootstrap, csrfProtection, issueCsrfToken };
