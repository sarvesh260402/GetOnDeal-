const express = require('express');
const { getAffiliateAnalytics, getDashboardStats } = require('../controllers/analyticsController');
const { protect, authorize } = require('../middleware/authMiddleware');

const router = express.Router();

router.get('/affiliates', protect, authorize('admin'), getAffiliateAnalytics);
router.get('/dashboard', protect, authorize('admin', 'vendor'), getDashboardStats);

module.exports = router;
