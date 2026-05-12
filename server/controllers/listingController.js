const Listing = require('../models/Listing');
const { parsePagination, parseSort, paginateQuery } = require('../utils/pagination');

// @desc    Get all listings
// @route   GET /api/listings
// @access  Public
const getListings = async (req, res) => {
  const { category, area, search, status, sortBy, order } = req.query;
  const { page, limit } = parsePagination(req.query);
  let query = {};

  if (category && category !== 'All') {
    query.category = category;
  }

  if (area) {
    query.area = area;
  }

  if (search) {
    query.$or = [
      { name: { $regex: search, $options: 'i' } },
      { description: { $regex: search, $options: 'i' } },
      { venue: { $regex: search, $options: 'i' } },
    ];
  }

  if (status) {
    query.status = status;
  }

  try {
    const safeSortBy = ['createdAt', 'updatedAt', 'price', 'rating', 'name'].includes(sortBy) ? sortBy : 'createdAt';
    const result = await paginateQuery({
      model: Listing,
      query,
      page,
      limit,
      sort: parseSort(safeSortBy, order),
    });
    res.status(200).json({
      success: true,
      ...result
    });
  } catch (error) {
    res.status(500).json({ 
      success: false,
      message: 'Failed to fetch listings',
      error: process.env.NODE_ENV === 'production' ? 'Internal server error' : error.message,
      requestId: req.requestId
    });
  }
};

// @desc    Get single listing
// @route   GET /api/listings/:id
// @access  Public
const getListingById = async (req, res) => {
  try {
    const listing = await Listing.findById(req.params.id);
    if (!listing) {
      return res.status(404).json({ 
        success: false,
        message: 'Listing not found',
        requestId: req.requestId
      });
    }
    res.status(200).json({
      success: true,
      data: listing
    });
  } catch (error) {
    res.status(500).json({ 
      success: false,
      message: 'Failed to fetch listing',
      error: process.env.NODE_ENV === 'production' ? 'Internal server error' : error.message,
      requestId: req.requestId
    });
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
    res.status(201).json({
      success: true,
      data: listing
    });
  } catch (error) {
    res.status(400).json({ 
      success: false,
      message: 'Failed to create listing',
      error: error.message,
      requestId: req.requestId
    });
  }
};

module.exports = {
  getListings,
  getListingById,
  createListing,
};
