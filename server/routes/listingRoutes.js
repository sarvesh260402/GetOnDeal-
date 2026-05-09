const express = require('express');
const { getListings, getListingById, createListing } = require('../controllers/listingController');
const { protect, authorize } = require('../middleware/authMiddleware');

const router = express.Router();

router.route('/')
  .get(getListings)
  .post(protect, authorize('admin', 'vendor'), createListing);

router.route('/:id')
  .get(getListingById);

module.exports = router;
