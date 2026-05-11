const Category = require('../models/Category');
const { parsePagination, parseSort, paginateQuery } = require('../utils/pagination');

const getCategories = async (req, res) => {
  try {
    const { isActive, search, sortBy, order } = req.query;
    const { page, limit } = parsePagination(req.query);
    const query = {};
    if (isActive !== undefined) query.isActive = String(isActive) === 'true';
    if (search) query.name = { $regex: search, $options: 'i' };

    const safeSortBy = ['createdAt', 'order', 'name'].includes(sortBy) ? sortBy : 'order';
    const data = await paginateQuery({
      model: Category,
      query,
      page,
      limit,
      sort: parseSort(safeSortBy, order),
    });
    return res.status(200).json(data);
  } catch (error) {
    return res.status(500).json({ message: error.message });
  }
};

const createCategory = async (req, res) => {
  try {
    const category = await Category.create(req.body);
    return res.status(201).json(category);
  } catch (error) {
    return res.status(400).json({ message: error.message });
  }
};

module.exports = { getCategories, createCategory };
