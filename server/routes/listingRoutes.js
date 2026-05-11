const express = require('express');
const { getListings, getListingById, createListing } = require('../controllers/listingController');
const { protect, authorize } = require('../middleware/authMiddleware');
const { validate } = require('../middleware/validateMiddleware');
const { listingSchemas } = require('../validation/schemas');

const router = express.Router();

router.route('/')
  .get(getListings)
  .post(protect, authorize('admin', 'vendor'), validate(listingSchemas.create), createListing);

router.route('/:id')
  .get(getListingById);

module.exports = router;
