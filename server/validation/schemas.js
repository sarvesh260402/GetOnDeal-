const authSchemas = {
  register: {
    source: 'body',
    fields: {
      name: { required: true, maxLength: 120 },
      email: { required: true, type: 'email' },
      password: { required: true, maxLength: 120 },
    },
  },
  login: {
    source: 'body',
    fields: {
      email: { required: true, type: 'email' },
      password: { required: true, maxLength: 120 },
    },
  },
};

const listingSchemas = {
  create: {
    source: 'body',
    fields: {
      name: { required: true, maxLength: 200 },
      category: { required: true, maxLength: 80 },
      price: { required: false, type: 'number', min: 0 },
      orig: { required: false, type: 'number', min: 0 },
      area: { required: false, maxLength: 120 },
      status: { required: false, enum: ['draft', 'published', 'archived'] },
    },
  },
};

const categorySchemas = {
  create: {
    source: 'body',
    fields: {
      name: { required: true, maxLength: 80 },
      slug: { required: true, maxLength: 120 },
      order: { required: false, type: 'number', min: 0 },
    },
  },
};

const affiliateSchemas = {
  trackClick: {
    source: 'body',
    fields: {
      listingId: { required: true, maxLength: 64 },
      refCode: { required: false, maxLength: 64 },
    },
  },
};

const bookingSchemas = {
  listQuery: {
    source: 'query',
    fields: {
      page: { required: false, type: 'number', min: 1 },
      limit: { required: false, type: 'number', min: 1, max: 100 },
      status: { required: false, enum: ['pending', 'confirmed', 'cancelled', 'completed'] },
    },
  },
};

const reviewSchemas = {
  listQuery: {
    source: 'query',
    fields: {
      page: { required: false, type: 'number', min: 1 },
      limit: { required: false, type: 'number', min: 1, max: 100 },
      minRating: { required: false, type: 'number', min: 1, max: 5 },
    },
  },
};

module.exports = {
  authSchemas,
  listingSchemas,
  categorySchemas,
  affiliateSchemas,
  bookingSchemas,
  reviewSchemas,
};
