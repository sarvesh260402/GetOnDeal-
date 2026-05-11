const express = require('express');
const { getBookings } = require('../controllers/bookingController');
const { protect, authorize } = require('../middleware/authMiddleware');
const { validate } = require('../middleware/validateMiddleware');
const { bookingSchemas } = require('../validation/schemas');

const router = express.Router();

router.get('/', protect, authorize('admin', 'vendor'), validate(bookingSchemas.listQuery), getBookings);

module.exports = router;
