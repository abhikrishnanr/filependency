# File Adalath - Online Portal

This is a simple prototype of a file pendency tracking system built with core PHP and Bootstrap 5. The portal retrieves master data from the official File Adalath APIs and stores local status updates in MySQL.

## Features
- User login with roles: superadmin, deptadmin and sectionofficer
- PROFORMA 1 interface to update file status
- PROFORMA 2 summary report with export buttons
- Remote API calls for departments, sections and files

## Setup
1. Import `database.sql` into a MySQL database and update `config/db.php` with credentials.
2. Host the project in a PHP 8 environment.
3. Access `login.php` and log in using credentials from the users table. A demo super admin account is created when importing the SQL file:

   - **Email:** someone@example.com
   - **Password:** 123456

The demo uses external APIs provided by the Government of Kerala to fetch department data. Only status updates are stored locally.
