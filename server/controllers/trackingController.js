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
      try {
        affiliate = await Affiliate.findOne({ referralCode: refCode });
        if (affiliate) {
          // Increment affiliate clicks
          affiliate.totalClicks += 1;
          await affiliate.save();
        }
      } catch (affError) {
        console.error(`Affiliate update error: ${affError.message}`);
        // Non-blocking: continue even if affiliate update fails
      }
    }

    const clickId = generateClickId();
    
    // Create Click Log
    try {
      await Click.create({
        clickId,
        listingId,
        affiliateId: affiliate ? affiliate._id : null,
        ip: req.ip,
        userAgent: req.headers['user-agent'],
        referer: req.headers['referer']
      });
    } catch (clickError) {
      console.error(`Click logging error: ${clickError.message}`);
      // If we can't log, we should still try to redirect the user
    }

    // Return the tracking info and target URL
    res.status(200).json({
      success: true,
      clickId,
      targetUrl: listing.affiliateUrl || '#',
      listingName: listing.name
    });

  } catch (error) {
    res.status(500).json({ 
      success: false,
      message: 'Tracking failed', 
      error: process.env.NODE_ENV === 'production' ? 'Internal server error' : error.message,
      requestId: req.requestId 
    });
  }
};

module.exports = { trackClick };
