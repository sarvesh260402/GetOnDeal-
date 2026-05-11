const express = require('express');
const { getReviews } = require('../controllers/reviewController');
const { protect, authorize } = require('../middleware/authMiddleware');
const { validate } = require('../middleware/validateMiddleware');
const { reviewSchemas } = require('../validation/schemas');

const router = express.Router();

router.get('/', protect, authorize('admin', 'vendor'), validate(reviewSchemas.listQuery), getReviews);

module.exports = router;
