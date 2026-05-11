const express = require('express');
const { trackClick } = require('../controllers/trackingController');
const { validate } = require('../middleware/validateMiddleware');
const { affiliateSchemas } = require('../validation/schemas');

const router = express.Router();

router.post('/click', validate(affiliateSchemas.trackClick), trackClick);

module.exports = router;
