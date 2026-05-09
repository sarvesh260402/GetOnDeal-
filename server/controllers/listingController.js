const Listing = require('../models/Listing');

// @desc    Get all listings
// @route   GET /api/listings
// @access  Public
const getListings = async (req, res) => {
  const { category, area, search } = req.query;
  let query = {};

  if (category && category !== 'All') {
    query.category = category;
  }

  if (area) {
    query.area = area;
  }

  if (search) {
    query.title = { $regex: search, $options: 'i' };
  }

  try {
    const listings = await Listing.find(query);
    res.status(200).json(listings);
  } catch (error) {
    res.status(500).json({ message: error.message });
  }
};

// @desc    Get single listing
// @route   GET /api/listings/:id
// @access  Public
const getListingById = async (req, res) => {
  try {
    const listing = await Listing.findById(req.params.id);
    if (!listing) {
      return res.status(404).json({ message: 'Listing not found' });
    }
    res.status(200).json(listing);
  } catch (error) {
    res.status(500).json({ message: error.message });
  }
};

// @desc    Create listing
// @route   POST /api/listings
// @access  Private (Admin/Vendor)
const createListing = async (req, res) => {
  try {
    const listing = await Listing.create({
      ...req.body,
      vendorId: req.user.id,
    });
    res.status(201).json(listing);
  } catch (error) {
    res.status(400).json({ message: error.message });
  }
};

module.exports = {
  getListings,
  getListingById,
  createListing,
};
