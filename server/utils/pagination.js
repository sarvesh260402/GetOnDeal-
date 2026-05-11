const parsePagination = (query = {}) => {
  const page = Math.max(parseInt(query.page, 10) || 1, 1);
  const limit = Math.min(Math.max(parseInt(query.limit, 10) || 20, 1), 100);
  const skip = (page - 1) * limit;
  return { page, limit, skip };
};

const parseSort = (sortBy = 'createdAt', order = 'desc') => {
  const direction = String(order).toLowerCase() === 'asc' ? 1 : -1;
  return { [sortBy]: direction };
};

const paginateQuery = async ({ model, query = {}, select = null, populate = null, sort = { createdAt: -1 }, page = 1, limit = 20 }) => {
  const skip = (page - 1) * limit;
  let cursor = model.find(query).sort(sort).skip(skip).limit(limit).lean();
  if (select) cursor = cursor.select(select);
  if (populate) cursor = cursor.populate(populate);

  const [items, total] = await Promise.all([
    cursor.exec(),
    model.countDocuments(query),
  ]);

  return {
    items,
    pagination: {
      page,
      limit,
      total,
      totalPages: Math.ceil(total / limit),
      hasNext: page * limit < total,
      hasPrev: page > 1,
    },
  };
};

module.exports = { parsePagination, parseSort, paginateQuery };
