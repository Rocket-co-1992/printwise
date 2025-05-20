# Print Calculator Backoffice

## Overview
The Print Calculator Backoffice is a web application designed for managing digital printing costs. It provides functionalities for user authentication, material management, dynamic pricing calculations, and report generation. The application is built using PHP 8.x, Twig, MySQL, JavaScript (ES6+), Tailwind CSS, and Dompdf.

## Features
- **User Authentication**: Secure login and registration for users with role-based access control (admin and operator).
- **CRUD Operations**: Manage materials, formats, and finishings through a user-friendly interface.
- **Dynamic Pricing Calculator**: Real-time pricing calculations using APIs to fetch data from the MySQL database.
- **Report Generation**: Create and download budget reports in PDF and CSV formats.
- **Dashboard**: View statistics and history of budgets in an intuitive dashboard.
- **Automatic Updates**: Check for application updates via the GitHub API and manage versioning.
- **SEO Optimization**: Friendly URLs, meta tags, and a sitemap for better search engine visibility.
- **Performance Enhancements**: Tailwind CSS minification, caching strategies, and image compression.

## Project Structure
```
print-calculator
├── config
│   ├── app.php
│   ├── database.php
│   └── permissions.php
├── public
│   ├── index.php
│   ├── assets
│   │   ├── css
│   │   │   └── app.css
│   │   ├── js
│   │   │   ├── calculator.js
│   │   │   └── dashboard.js
│   │   └── images
│   └── uploads
├── src
│   ├── Auth
│   │   ├── Authentication.php
│   │   └── Authorization.php
│   ├── Controllers
│   │   ├── AuthController.php
│   │   ├── DashboardController.php
│   │   ├── MaterialController.php
│   │   ├── FormatController.php
│   │   ├── FinishingController.php
│   │   ├── CalculatorController.php
│   │   └── ReportController.php
│   ├── Models
│   │   ├── User.php
│   │   ├── Material.php
│   │   ├── Format.php
│   │   ├── Finishing.php
│   │   └── Quote.php
│   ├── Services
│   │   ├── PdfGenerator.php
│   │   ├── CsvExporter.php
│   │   └── UpdateService.php
│   ├── Utils
│   │   ├── Database.php
│   │   └── Helper.php
│   └── Api
│       └── CalculatorApi.php
├── templates
│   ├── base.twig
│   ├── auth
│   │   ├── login.twig
│   │   └── register.twig
│   ├── dashboard
│   │   └── index.twig
│   ├── materials
│   │   ├── index.twig
│   │   ├── create.twig
│   │   └── edit.twig
│   ├── formats
│   │   ├── index.twig
│   │   ├── create.twig
│   │   └── edit.twig
│   ├── finishing
│   │   ├── index.twig
│   │   ├── create.twig
│   │   └── edit.twig
│   ├── calculator
│   │   └── index.twig
│   └── reports
│       └── index.twig
├── vendor
├── .env.example
├── .gitignore
├── composer.json
├── package.json
├── tailwind.config.js
└── README.md
```

## Installation
1. Clone the repository:
   ```
   git clone https://github.com/yourusername/print-calculator.git
   cd print-calculator
   ```

2. Install dependencies:
   ```
   composer install
   npm install
   ```

3. Configure the environment:
   - Copy `.env.example` to `.env` and update the database credentials and other settings.

4. Set up the database:
   - Create a MySQL database and import the necessary schema.

5. Build assets:
   ```
   npm run build
   ```

## Configuration
- **Database**: Update `config/database.php` with your database connection details.
- **Permissions**: Define user roles in `config/permissions.php`.

## Generating PDFs
To generate PDF reports, ensure that Dompdf is properly installed and configured. Use the `PdfGenerator` service to create PDF files from your reports.

## Deployment
For automatic deployment, set up CI/CD pipelines using GitHub Actions or similar tools to deploy to staging and production environments.

## Automatic Updates
The application checks for updates via the GitHub API. Ensure that the `UpdateService` is configured to handle version comparisons and downloads.

## SEO
Implement basic SEO practices by configuring friendly URLs, adding meta tags in your templates, and generating a `sitemap.xml`.

## Performance
Optimize performance by minifying CSS and JavaScript files, implementing caching strategies, and compressing images.

## License
This project is licensed under the MIT License. See the LICENSE file for more details.

## Acknowledgments
Thanks to the contributors and the open-source community for their support and resources.