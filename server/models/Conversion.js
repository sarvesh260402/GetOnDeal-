const mongoose = require('mongoose');

const conversionSchema = mongoose.Schema(
  {
    clickId: {
      type: String,
      required: true,
    },
    affiliateId: {
      type: mongoose.Schema.Types.ObjectId,
      ref: 'Affiliate',
    },
    listingId: {
      type: mongoose.Schema.Types.ObjectId,
      ref: 'Listing',
    },
    type: {
      type: String,
      enum: ['lead', 'claim', 'booking'],
      default: 'lead',
    },
    value: {
      type: Number,
      default: 0,
    },
    commission: {
      type: Number,
      default: 0,
    },
    status: {
      type: String,
      enum: ['pending', 'approved', 'rejected'],
      default: 'pending',
    },
  },
  {
    timestamps: true,
  }
);

conversionSchema.index({ clickId: 1 });
conversionSchema.index({ affiliateId: 1, status: 1 });

module.exports = mongoose.model('Conversion', conversionSchema);
