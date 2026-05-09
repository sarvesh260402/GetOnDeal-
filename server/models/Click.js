const mongoose = require('mongoose');

const clickSchema = mongoose.Schema(
  {
    affiliateId: {
      type: mongoose.Schema.Types.ObjectId,
      ref: 'Affiliate',
      required: false, // Can be direct click
    },
    listingId: {
      type: mongoose.Schema.Types.ObjectId,
      ref: 'Listing',
      required: true,
    },
    clickId: {
      type: String,
      required: true,
      unique: true,
    },
    ip: String,
    userAgent: String,
    referer: String,
    os: String,
    device: String,
    location: String,
    timestamp: {
      type: Date,
      default: Date.now,
    },
  },
  {
    timestamps: true,
  }
);

clickSchema.index({ affiliateId: 1, timestamp: -1 });
clickSchema.index({ clickId: 1 }, { unique: true });

module.exports = mongoose.model('Click', clickSchema);
