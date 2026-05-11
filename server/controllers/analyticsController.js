const Affiliate = require('../models/Affiliate');
const Conversion = require('../models/Conversion');
const Click = require('../models/Click');
const { parsePagination, parseSort, paginateQuery } = require('../utils/pagination');

const getAffiliateAnalytics = async (req, res) => {
  try {
    const { status, search, sortBy, order } = req.query;
    const { page, limit } = parsePagination(req.query);
    const query = {};

    if (status) query.status = status;
    if (search) query.referralCode = { $regex: search, $options: 'i' };

    const safeSortBy = ['createdAt', 'totalClicks', 'totalConversions', 'totalEarnings'].includes(sortBy) ? sortBy : 'createdAt';
    const data = await paginateQuery({
      model: Affiliate,
      query,
      page,
      limit,
      sort: parseSort(safeSortBy, order),
      populate: { path: 'userId', select: 'name email' },
    });

    return res.status(200).json(data);
  } catch (error) {
    return res.status(500).json({ message: error.message });
  }
};

const getDashboardStats = async (req, res) => {
  try {
    const [totalAffiliates, totalClicks, totalConversions] = await Promise.all([
      Affiliate.countDocuments(),
      Click.countDocuments(),
      Conversion.countDocuments(),
    ]);

    return res.status(200).json({
      totalAffiliates,
      totalClicks,
      totalConversions,
      conversionRate: totalClicks > 0 ? Number(((totalConversions / totalClicks) * 100).toFixed(2)) : 0,
    });
  } catch (error) {
    return res.status(500).json({ message: error.message });
  }
};

module.exports = { getAffiliateAnalytics, getDashboardStats };
