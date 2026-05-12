const mongoose = require('mongoose');

const connectDB = async () => {
  try {
    const isProduction = process.env.NODE_ENV === 'production';
    const mongoUri = isProduction ? process.env.MONGODB_URI : (process.env.MONGODB_URI_LOCAL || process.env.MONGODB_URI || 'mongodb://localhost:27017/GetOnDeal');

    if (isProduction && !mongoUri) {
      throw new Error('MONGODB_URI environment variable is required in production but was not found.');
    }

    if (!mongoUri) {
      console.warn('MONGODB_URI not set, falling back to local MongoDB');
    }

    console.log(`Connecting to MongoDB...`);
    const conn = await mongoose.connect(mongoUri || 'mongodb://localhost:27017/GetOnDeal', {
      serverSelectionTimeoutMS: 5000,
    });
    console.log(`MongoDB Connected: ${conn.connection.host}/${conn.connection.name}`);
  } catch (error) {
    console.error(`MongoDB connection error: ${error.message}`);
    process.exit(1);
  }
};

module.exports = connectDB;
