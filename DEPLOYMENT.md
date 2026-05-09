# Deployment & Setup Guide - GetOnDeal

This guide provides step-by-step instructions for setting up the GetOnDeal platform locally using XAMPP and deploying it to a production environment like Hostinger.

## 1. Project Verification Checklist
- [x] **File Paths**: All CSS, JS, and PHP includes verified.
- [x] **Modular Structure**: Data, logic, and UI components are properly separated.
- [x] **Responsive Design**: Mobile-first architecture verified from 320px to 4K.
- [x] **Asset Optimization**: Deferred scripts and lazy-loaded images implemented.
- [x] **SEO & Meta**: Semantic tags and Open Graph metadata verified.

---

## 2. Local Setup Guide (XAMPP)

1. **Install XAMPP**: Download and install XAMPP from [apachefriends.org](https://www.apachefriends.org/).
2. **Locate htdocs**: Open the XAMPP installation folder (usually `C:\xampp`) and navigate to `htdocs`.
3. **Copy Project**: Create a folder named `getondeal` inside `htdocs` and copy all project files into it.
    - Path: `C:\xampp\htdocs\getondeal\`
4. **Start Apache**: Open the XAMPP Control Panel and click **Start** next to Apache.
5. **Access Site**: Open your browser and go to `http://localhost/getondeal/index.php`.

> [!NOTE]
> If you see a different page (like the old index.html), rename or delete `index.html` in your project folder so that `index.php` becomes the default.

---

## 3. Hostinger Deployment Guide

1. **Access hPanel**: Log in to your Hostinger account and go to the **File Manager**.
2. **Upload Files**: Navigate to `public_html`. Upload all files and folders (`assets`, `data`, `includes`, `index.php`, etc.).
3. **Set PHP Version**: Ensure your Hostinger account is running **PHP 8.1 or higher** (managed under the 'PHP Configuration' section in hPanel).
4. **Configure index.php as Default**: 
    - If your site still loads `index.html`, you can either delete it or add the following line to a `.htaccess` file in your `public_html` directory:
      ```apache
      DirectoryIndex index.php index.html
      ```
5. **Verify SSL**: Ensure HTTPS is enabled in hPanel for a "Secure" padlock in the browser.

---

## 4. GitHub Push Commands

If you want to manage your code via GitHub:

1. **Initialize Repository**:
   ```bash
   git init
   ```
2. **Add Files**:
   ```bash
   git add .
   ```
3. **Commit**:
   ```bash
   git commit -m "Initial production-grade modular release"
   ```
4. **Create Remote & Push**:
   ```bash
   git remote add origin https://github.com/yourusername/getondeal.git
   git branch -M main
   git push -u origin main
   ```

---

## 5. Final Production Structure Verification
```text
/
├── index.php           # Main entry point
├── assets/             # Production assets
│   ├── css/            # Organized stylesheets
│   ├── js/             # Performance-optimized logic
│   ├── images/         # Compressed visual assets
│   └── icons/          # SVG icons
├── data/               # Content management arrays
│   ├── deals.php
│   ├── categories.php
│   └── testimonials.php
├── includes/           # Reusable UI components
│   ├── navbar.php
│   ├── footer.php
│   ├── hero.php
│   └── ...
└── README.md           # Documentation
```

> [!TIP]
> **Pro Tip**: Before final launch, run your URL through [PageSpeed Insights](https://pagespeed.web.dev/) to verify the performance gains from the modular structure and deferred loading.
