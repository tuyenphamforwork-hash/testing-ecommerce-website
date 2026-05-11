# E-Commerce Website Source Code

## Introduction

This repository contains the source code of an open-source e-commerce website used for a software testing and quality assurance project. The system includes both customer-facing and administrator-facing features, allowing the testing team to perform comprehensive manual and automated testing activities using Katalon Studio.

The project is developed using PHP, MySQL, HTML, CSS, Bootstrap, and JavaScript, and serves as the main application under test for functional testing, UI testing, regression testing, and automation testing.

---

## Project Purpose

The purpose of this repository is to provide a fully functional e-commerce platform for:

* Manual Testing
* Automation Testing with Katalon Studio
* Defect Reporting
* Test Case Design
* Regression Testing
* UI/UX Evaluation
* Academic Software Testing Projects

---

## Technologies Used

* **PHP** — Backend server-side development
* **MySQL** — Database management
* **HTML5** — Page structure
* **CSS3** — Styling and layout
* **Bootstrap** — Responsive UI framework
* **JavaScript** — Client-side interactions

---

## Main Features

### Customer-Side Features

* User registration and login
* Product browsing
* Product search
* Product category filtering
* Product detail pages
* Shopping cart management
* Checkout process
* Order placement
* User profile management

### Admin-Side Features

* Admin authentication
* Product management
* Category management
* Order management
* Customer management
* Inventory management
* Dashboard overview

---

## Project Structure

```text
E-commerce/
│
├── admin/                 # Admin panel
├── assets/                # CSS, JS, images
├── database/              # SQL database files
├── includes/              # Shared PHP components
├── products/              # Product pages
├── uploads/               # Uploaded images/files
└── ...
```

---

## Installation Guide

### Prerequisites

Make sure the following software is installed:

* XAMPP / WAMP / Laragon
* PHP 7.0+
* MySQL / MariaDB
* Web browser (Chrome recommended)

---

## Setup Instructions

### 1. Clone Repository

```bash
git clone https://github.com/your-username/ecommerce-website-sourcecode.git
```

Or download the repository as a ZIP file.

---

### 2. Move Project to Web Server Directory

Example for XAMPP:

```text
C:/xampp/htdocs/E-commerce
```

---

### 3. Create Database

Open phpMyAdmin and create a database:

```text
db_ecommerce
```

---

### 4. Import SQL File

Import the SQL file located in:

```text
/database/db_ecommerce.sql
```

---

### 5. Configure Database Connection

Update database configuration if needed:

```php
localhost
root
password
db_ecommerce
```

Configuration file example:

```text
/admin/includes/config.php
```

---

### 6. Run the Website

Customer site:

```text
http://localhost/E-commerce
```

Admin panel:

```text
http://localhost/E-commerce/admin
```

---

## Default Admin Account

```text
Username: admin
Password: adminfahad
```

---

## Testing Repository

Automation testing scripts and Katalon project files are maintained separately in the testing repository:

```text
ecommerce-website-testing
```

This separation helps keep the application source code independent from automation scripts and test reports.

---

## Recommended Environment

To avoid compatibility issues during testing, team members should use:

* Same Katalon version
* Same browser version
* Same ChromeDriver version

---

## Known Limitations

* Online payment gateway is not implemented
* Email notification system is incomplete
* Security hardening is limited
* Input validation is partially implemented
* Performance optimization is minimal

---

## Future Improvements

* Payment gateway integration
* Product review system
* Wishlist feature
* Advanced product filtering
* Email notifications
* Responsive UI improvements
* Security enhancements

---

## Credits

This project is based on and customized from the following open-source resources:

### Front-end Template

* Repository: `codewithsadee/anon-ecommerce-website`

### Admin Panel Template

* Repository: `Bhabishya-123/E-commerce`

Additional modifications, integrations, and testing implementations were developed for educational and software testing purposes.

---

## License

This project is intended for educational, learning, and software testing purposes only.
