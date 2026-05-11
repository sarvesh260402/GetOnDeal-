const mongoose = require('mongoose');

const affiliateSchema = mongoose.Schema(
  {
    userId: {
      type: mongoose.Schema.Types.ObjectId,
      ref: 'User',
      required: true,
    },
    referralCode: {
      type: String,
      required: true,
      unique: true,
      trim: true,
    },
    status: {
      type: String,
      enum: ['pending', 'approved', 'rejected', 'suspended'],
      default: 'pending',
    },
    website: String,
    socialMedia: String,
    totalClicks: { type: Number, default: 0 },
    totalConversions: { type: Number, default: 0 },
    totalEarnings: { type: Number, default: 0 },
    pendingEarnings: { type: Number, default: 0 },
  },
  {
    timestamps: true,
  }
);

affiliateSchema.index({ referralCode: 1 }, { unique: true });
affiliateSchema.index({ status: 1, createdAt: -1 });
affiliateSchema.index({ totalClicks: -1, totalConversions: -1 });

module.exports = mongoose.model('Affiliate', affiliateSchema);
