const express = require('express');
const { registerUser, loginUser, getMe } = require('../controllers/authController');
const { protect } = require('../middleware/authMiddleware');
const { validate } = require('../middleware/validateMiddleware');
const { authSchemas } = require('../validation/schemas');
const { csrfBootstrap } = require('../middleware/csrfMiddleware');

const router = express.Router();

router.get('/csrf-token', csrfBootstrap);
router.post('/register', validate(authSchemas.register), registerUser);
router.post('/login', validate(authSchemas.login), loginUser);
router.get('/me', protect, getMe);

module.exports = router;
