# Backend Deployment & Setup Guide - GetOnDeal

Your full-stack Node.js + Express + MongoDB backend is now ready. The frontend is integrated and will automatically fetch from the API when the server is running.

## 1. Local Setup
1. **Navigate to the server folder**:
   ```bash
   cd server
   ```
2. **Install dependencies**:
   ```bash
   npm install
   ```
3. **Run the server**:
   ```bash
   npm start
   ```
   *The server will start on http://localhost:5000*

## 2. Populating Data (Seeding)
I've implemented the `Listing` model to match your current PHP structure. To move your static data into MongoDB, you can use the following snippet in a temporary `seed.js` file:

```javascript
// Example seeding logic
const Listing = require('./models/Listing');
const deals = [/* copy from data/deals.php */];
await Listing.insertMany(deals);
```

## 3. API Endpoints
- **Auth**:
  - `POST /api/auth/register` - User registration
  - `POST /api/auth/login` - User login
  - `GET /api/auth/me` - Get current user (Private)
- **Listings**:
  - `GET /api/listings` - Get all deals (Supports filters: `category`, `area`, `search`)
  - `GET /api/listings/:id` - Get deal details
  - `POST /api/listings` - Create new deal (Admin/Vendor only)

## 4. Production Deployment (e.g., Render, Heroku, or VPS)
1. **Environment Variables**: Ensure you set the following on your host:
   - `MONGODB_URI`: Your MongoDB Atlas string.
   - `JWT_SECRET`: A long, random string.
   - `NODE_ENV`: set to `production`.
2. **Frontend Update**: Update the `API_URL` in `assets/js/app.js` and `includes/api_helper.php` to your production URL.

## 5. Security Features
- **JWT Protection**: Private routes require a `Bearer <token>` header.
- **Password Hashing**: User passwords are encrypted with Bcrypt before saving.
- **CORS Config**: Configured to allow cross-origin requests from your frontend.
- **Validation**: Mongoose schemas include strict validation for emails and required fields.
