# TCET-Publication-System
<br>

## Overview

The Faculty Publication Management System is designed to manage and track academic publications by faculty members at Thakur College of Engineering and Technology. The system allows users to log in, submit papers, view publications, and manage their profiles. 

## Features

- User Authentication: Secure login and registration for faculty members.
- Dashboard: Personalized dashboard to view and manage publications.
- Paper Submission: Submit new publications and track their status.
- Publication Management: View, edit, and delete existing publications.
- Responsive Design: Mobile-friendly interface for accessibility on various devices.

## Technologies

- Frontend: HTML, CSS, JavaScript
- Backend: PHP
- Database: MySQL

## How to start Contributing?

### Prerequisites

- XAMPP/WAMP/MAMP: For a local server environment.
- Composer: For PHP dependency management.
- Git: For version control.

### Steps

1. **Clone the Repository**

```
git clone https://github.com/your-username/faculty-publication-management-system.git
```

2. **Set Up the Local Server**

Download and install XAMPP/WAMP/MAMP from their respective websites.
Start Apache and MySQL services from the XAMPP/WAMP/MAMP control panel.

3. **Configure the Database**

Open phpMyAdmin (usually accessible via http://localhost/phpmyadmin).
Create a new database named faculty_publication_system.
Run the create_tables.php script to set up the necessary tables:

4. **Configure PHP**

Ensure that the db_connection.php file has the correct database connection settings.

5. **Run the Application**

Place the project folder in the htdocs directory (XAMPP) or the appropriate directory for WAMP/MAMP.
Access the application via your web browser at http://localhost/faculty-publication-management-system/public/html/login.html.

## Usage

- Login: Access the login page at login.html and enter your credentials.
- Dashboard: After logging in, you will be redirected to your dashboard where you can manage publications.
- Submit Paper: Use the submit paper form on submit_paper.html to add new publications.
- Manage Publications: View and manage publications from your dashboard.