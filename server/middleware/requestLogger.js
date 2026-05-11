const requestLogger = (req, res, next) => {
  const start = Date.now();
  const reqId = `${Date.now().toString(36)}-${Math.random().toString(36).slice(2, 8)}`;

  req.requestId = reqId;
  res.setHeader('X-Request-Id', reqId);

  res.on('finish', () => {
    if (process.env.NODE_ENV === 'test') return;
    const durationMs = Date.now() - start;
    const log = `[${new Date().toISOString()}] ${req.method} ${req.originalUrl} ${res.statusCode} ${durationMs}ms reqId=${reqId}`;
    console.log(log);
  });

  next();
};

module.exports = requestLogger;
