const Click = require('../models/Click');
const Listing = require('../models/Listing');
const Affiliate = require('../models/Affiliate');

// Helper for unique IDs
const generateClickId = () => Math.random().toString(36).substring(2, 15) + Math.random().toString(36).substring(2, 15);

// @desc    Track a click and get redirect URL
// @route   POST /api/track/click
// @access  Public
const trackClick = async (req, res) => {
  const { listingId, refCode } = req.body;

  try {
    const listing = await Listing.findById(listingId);
    if (!listing) {
      return res.status(404).json({ message: 'Listing not found' });
    }

    let affiliate = null;
    if (refCode) {
      affiliate = await Affiliate.findOne({ referralCode: refCode });
      if (affiliate) {
        // Increment affiliate clicks
        affiliate.totalClicks += 1;
        await affiliate.save();
      }
    }

    const clickId = generateClickId();
    
    // Create Click Log
    await Click.create({
      clickId,
      listingId,
      affiliateId: affiliate ? affiliate._id : null,
      ip: req.ip,
      userAgent: req.headers['user-agent'],
      referer: req.headers['referer']
    });

    // Return the tracking info and target URL
    res.status(200).json({
      clickId,
      targetUrl: listing.affiliateUrl || '#',
      listingName: listing.name
    });

  } catch (error) {
    res.status(500).json({ message: error.message });
  }
};

module.exports = { trackClick };
