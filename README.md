# Simple User Form with PHP and MySQL

This is a simple PHP project that allows users to submit their name and age through a form. The submitted data is saved to a MySQL database, and all records are displayed in a table with an option to toggle the user's status between Active and Inactive.

## Features

- Add user (name and age)
- Display all users in a table
- Toggle status (Active or Inactive) for each user
- Store data in a MySQL database
- Simple and clean layout

## Technologies Used

- PHP
- MySQL
- HTML
- CSS (basic styling)
- XAMPP for local hosting

## Setup Instructions

1. Clone the repository or download the ZIP file.

2. Copy the project files into the htdocs directory of your XAMPP installation:
   Example: D:/xampp/htdocs/user-form-project/

3. Start XAMPP and enable Apache and MySQL.

4. Open phpMyAdmin and create a database named userdata.

5. Import the userdata.sql file provided in the project to create the required table.

6. Open your browser and go to:
   http://localhost/user-form-project/

## Files Included

- index.php – Main application file
- userdata.sql – SQL file to create the database and users table
