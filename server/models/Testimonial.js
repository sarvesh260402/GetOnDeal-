const mongoose = require('mongoose');

const testimonialSchema = mongoose.Schema(
  {
    name: {
      type: String,
      required: true,
    },
    role: String,
    avatar: String,
    content: {
      type: String,
      required: true,
    },
    rating: {
      type: Number,
      default: 5,
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

module.exports = mongoose.model('Testimonial', testimonialSchema);
