# Deployment Instructions - GetOnDeal

This guide provides step-by-step instructions for deploying the GetOnDeal platform.

## 1. Backend (Render / VPS)

### Render Deployment (Recommended)
1.  **Repository**: Connect your GitHub repository to Render.
2.  **Configuration**: Render will automatically detect the `render.yaml` file in the root.
3.  **Root Directory**: Ensure it is set to `server` (handled by `render.yaml`).
4.  **Environment Variables**:
    - `MONGODB_URI`: Your MongoDB connection string (e.g., your local VPS DB or Atlas).
    - `JWT_SECRET`: A secure random string for signing tokens.
    - `CORS_ALLOWED_ORIGINS`: The URL of your frontend (e.g., `https://your-domain.com`).
    - `NODE_ENV`: `production`

### Local VPS Deployment
1.  **Prerequisites**: Install Node.js, NPM, and MongoDB.
2.  **Steps**:
    ```bash
    cd server
    npm install
    npm start
    ```
3.  **Process Manager**: Use `pm2` to keep the server running:
    ```bash
    npm install -g pm2
    pm2 start server.js --name "getondeal-api"
    ```

## 2. Frontend (Hostinger / Apache)

1.  **Preparation**:
    - Update `assets/js/config.js` to point `API_BASE_URL` to your production backend URL.
    - Ensure `includes/api_helper.php` is configured to use the production API URL.
2.  **Upload**:
    - Upload all files (excluding the `server/` directory) to the `public_html` folder on Hostinger via FTP or File Manager.
3.  **PHP Version**: Ensure PHP 7.4+ or 8.x is used.
4.  **CORS**: Ensure your Hostinger domain is added to the `CORS_ALLOWED_ORIGINS` in your backend configuration.

## 3. Database (Local MongoDB)

- Ensure MongoDB is running and accessible to the backend.
- If using a local MongoDB on a VPS, ensure the backend `.env` uses `mongodb://localhost:27017/getondeal`.
