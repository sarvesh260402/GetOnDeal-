const Review = require('../models/Review');
const { parsePagination, parseSort, paginateQuery } = require('../utils/pagination');

const getReviews = async (req, res) => {
  try {
    const { listingId, userId, minRating, sortBy, order } = req.query;
    const { page, limit } = parsePagination(req.query);
    const query = {};

    if (listingId) query.listingId = listingId;
    if (userId) query.userId = userId;
    if (minRating) query.rating = { $gte: Number(minRating) };

    const safeSortBy = ['createdAt', 'rating'].includes(sortBy) ? sortBy : 'createdAt';
    const data = await paginateQuery({
      model: Review,
      query,
      page,
      limit,
      sort: parseSort(safeSortBy, order),
      populate: [{ path: 'userId', select: 'name' }, { path: 'listingId', select: 'name slug' }],
    });

    return res.status(200).json(data);
  } catch (error) {
    return res.status(500).json({ message: error.message });
  }
};

module.exports = { getReviews };
