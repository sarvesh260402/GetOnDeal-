const express = require('express');
const { registerUser, loginUser, getMe } = require('../controllers/authController');
const { protect } = require('../middleware/authMiddleware');
const { validate } = require('../middleware/validateMiddleware');
const { authSchemas } = require('../validation/schemas');
const { csrfBootstrap } = require('../middleware/csrfMiddleware');
const rateLimit = require('express-rate-limit');

const authLimiter = rateLimit({
  windowMs: 60 * 60 * 1000, // 1 hour
  max: 10, // limit each IP to 10 attempts per hour
  message: {
    success: false,
    message: 'Too many auth attempts, please try again after an hour'
  }
});

const router = express.Router();

router.get('/csrf-token', csrfBootstrap);
router.post('/register', authLimiter, validate(authSchemas.register), registerUser);
router.post('/login', authLimiter, validate(authSchemas.login), loginUser);
router.get('/me', protect, getMe);

module.exports = router;
