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
    res.status(200).json(result);
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
