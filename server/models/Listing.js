const mongoose = require('mongoose');

const listingSchema = mongoose.Schema(
  {
    name: {
      type: String,
      required: true,
      trim: true,
    },
    slug: {
      type: String,
      unique: true,
    },
    description: String,
    venue: String,
    area: String,
    city: {
      type: String,
      default: 'Mumbai',
    },
    category: {
      type: String,
      required: true,
    },
    cat: String, // Short category tag
    img: String, // Main image
    gallery: [String], // Additional images
    price: Number,
    orig: Number,
    discount: String,
    tag: String,
    rating: {
      type: Number,
      default: 4.5,
    },
    reviews: {
      type: String,
      default: '0',
    },
    
    // Affiliate & CMS logic
    affiliateUrl: String,
    commissionValue: { type: Number, default: 0 },
    commissionType: { type: String, enum: ['percentage', 'fixed'], default: 'percentage' },
    
    isFeatured: { type: Boolean, default: false },
    isSpotlight: { type: Boolean, default: false },
    status: {
      type: String,
      enum: ['draft', 'published', 'archived'],
      default: 'draft',
    },
    expiryDate: Date,
    
    // SEO
    seoTitle: String,
    seoDesc: String,
    seoKeywords: [String],
    
    vendorId: {
      type: mongoose.Schema.Types.ObjectId,
      ref: 'User',
    },
  },
  {
    timestamps: true,
  }
);

// Generate slug before saving
listingSchema.pre('save', function(next) {
  if (this.isModified('name')) {
    this.slug = this.name.toLowerCase().replace(/[^\w ]+/g, '').replace(/ +/g, '-');
  }
// Compound index for filtering
listingSchema.index({ status: 1, category: 1, isFeatured: -1 });
listingSchema.index({ area: 1 });
// Text index for advanced search
listingSchema.index({ name: 'text', description: 'text', venue: 'text' });

module.exports = mongoose.model('Listing', listingSchema);
