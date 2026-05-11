const Booking = require('../models/Booking');
const { parsePagination, parseSort, paginateQuery } = require('../utils/pagination');

const getBookings = async (req, res) => {
  try {
    const { status, userId, listingId, sortBy, order } = req.query;
    const { page, limit } = parsePagination(req.query);
    const query = {};

    if (status) query.status = status;
    if (userId) query.userId = userId;
    if (listingId) query.listingId = listingId;

    const safeSortBy = ['createdAt', 'bookingDate', 'totalPrice', 'status'].includes(sortBy) ? sortBy : 'createdAt';
    const data = await paginateQuery({
      model: Booking,
      query,
      page,
      limit,
      sort: parseSort(safeSortBy, order),
      populate: [{ path: 'userId', select: 'name email' }, { path: 'listingId', select: 'name category area' }],
    });

    return res.status(200).json(data);
  } catch (error) {
    return res.status(500).json({ message: error.message });
  }
};

module.exports = { getBookings };
