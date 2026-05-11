const User = require('../models/User');
const { parsePagination, parseSort, paginateQuery } = require('../utils/pagination');

const getUsers = async (req, res) => {
  try {
    const { role, search, sortBy, order } = req.query;
    const { page, limit } = parsePagination(req.query);
    const query = {};

    if (role) query.role = role;
    if (search) {
      query.$or = [
        { name: { $regex: search, $options: 'i' } },
        { email: { $regex: search, $options: 'i' } },
      ];
    }

    const safeSortBy = ['createdAt', 'updatedAt', 'name', 'email'].includes(sortBy) ? sortBy : 'createdAt';
    const data = await paginateQuery({
      model: User,
      query,
      page,
      limit,
      sort: parseSort(safeSortBy, order),
      select: '-password',
    });

    return res.status(200).json(data);
  } catch (error) {
    return res.status(500).json({ message: error.message });
  }
};

module.exports = { getUsers };
