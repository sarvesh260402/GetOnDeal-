const express = require('express');
const { getCategories, createCategory } = require('../controllers/categoryController');
const { protect, authorize } = require('../middleware/authMiddleware');
const { validate } = require('../middleware/validateMiddleware');
const { categorySchemas } = require('../validation/schemas');

const router = express.Router();

router.route('/')
  .get(getCategories)
  .post(protect, authorize('admin'), validate(categorySchemas.create), createCategory);

module.exports = router;
