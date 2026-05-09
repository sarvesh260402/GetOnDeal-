const express = require('express');
const dotenv = require('dotenv');
const cors = require('cors');
const helmet = require('helmet');
const rateLimit = require('express-rate-limit');
const connectDB = require('./config/db');

// Load env vars
dotenv.config();

// Connect to database
connectDB();

const app = express();

// Security Hardening
app.use(helmet()); // Sets various HTTP headers for security
app.use(cors({ origin: process.env.CLIENT_URL || '*' }));

// Rate Limiting
const limiter = rateLimit({
  windowMs: 15 * 60 * 1000, // 15 minutes
  max: 100, // limit each IP to 100 requests per windowMs
  message: 'Too many requests from this IP, please try again after 15 minutes'
});
app.use('/api/', limiter);

// Body parser
app.use(express.json({ limit: '10kb' })); // Limit body size to prevent DoS

// Route files
const authRoutes = require('./routes/authRoutes');
const listingRoutes = require('./routes/listingRoutes');

// Mount routers
app.use('/api/auth', authRoutes);
app.use('/api/listings', listingRoutes);

// Health check
app.get('/api/health', (req, res) => {
  res.status(200).json({ status: 'OK', message: 'GetOnDeal API is running' });
});

const PORT = process.env.PORT || 5000;

app.listen(PORT, () => {
  console.log(`Server running in ${process.env.NODE_ENV} mode on port ${PORT}`);
});
