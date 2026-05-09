const mongoose = require('mongoose');

const sectionSchema = mongoose.Schema(
  {
    title: {
      type: String,
      required: true,
    },
    subtitle: String,
    type: {
      type: String,
      enum: ['hero', 'categories', 'spotlight', 'deals', 'testimonials', 'banner', 'newsletter'],
      required: true,
    },
    config: {
      type: Map,
      of: String,
    },
    isActive: {
      type: Boolean,
      default: true,
    },
    order: {
      type: Number,
      default: 0,
    },
  },
  {
    timestamps: true,
  }
);

module.exports = mongoose.model('Section', sectionSchema);
