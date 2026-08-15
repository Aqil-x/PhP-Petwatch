#  PetWatch

A PHP-based web application for reporting and managing lost pets. PetWatch allows users to create accounts, report missing pets, browse existing reports, and record sightings to help reunite lost pets with their owners.

This project was developed as part of my university studies and was built using PHP, SQLite, HTML, CSS and the MVC (Model-View-Controller) architectural pattern.

---

## Overview

PetWatch provides a centralised platform where users can report lost pets and manage their listings.

The application is designed around two main types of users:

* **Visitors** – Can browse available lost-pet listings.
* **Registered users** – Can create and manage pet listings and submit sightings.

The project focuses on implementing a functional web application while applying concepts such as MVC architecture, database management, authentication, CRUD operations and server-side programming.

---

## Features

### User Accounts

* User registration and login
* Session-based authentication
* Protected functionality for authenticated users
* User-specific pet listings

### Pet Listings

* Create lost-pet reports
* View available pet listings
* Edit existing listings
* Delete listings
* View pets associated with an owner

### Sightings

* Record sightings of missing pets
* Store sighting information in the database
* Associate sightings with specific pets

### Database

* SQLite database
* Structured relational data
* Separate tables for users, pets and sightings
* Database initialisation using SQL schema files

---

## Technologies Used

| Technology   | Purpose                       |
| ------------ | ----------------------------- |
| **PHP**      | Server-side application logic |
| **SQLite**   | Database management           |
| **HTML**     | Page structure                |
| **CSS**      | Styling and layout            |
| **MVC**      | Application architecture      |
| **PHPStorm** | Development environment       |

---

##  Project Architecture

PetWatch follows the **Model-View-Controller (MVC)** pattern.

```text
petwatch_mvc_sqlite/
│
├── controllers/
│   └── Application controllers
│
├── models/
│   ├── DB.php
│   ├── Pet.php
│   └── User.php
│
├── views/
│   ├── addPet/
│   ├── editPet/
│   ├── login/
│   ├── ownerPets/
│   ├── pets/
│   └── templates/
│
├── schema.sql
├── seed.php
└── petwatch.db
```

### MVC Structure

**Model**

Handles communication with the SQLite database and represents application data such as users and pets.

**View**

Responsible for displaying information to the user through HTML templates and PHP views.

**Controller**

Handles application requests and connects the models with the appropriate views.

Using MVC helps separate the application's data, user interface and application logic, making the project easier to maintain and extend.

---

##  Getting Started

### Prerequisites

You will need:

* PHP
* PHP SQLite extension
* A web browser
* Git (optional)

You can check whether PHP is installed by running:

```bash
php --version
```

---

### 1. Clone the Repository

```bash
git clone https://github.com/Aqil-x/PhP-Petwatch.git
```

Navigate into the project:

```bash
cd PhP-Petwatch
```

---

### 2. Navigate to the Application

```bash
cd petwatch_mvc_sqlite
```

---

### 3. Initialise the Database

The project includes the SQL schema required to create the database structure.

If required, initialise the database using:

```bash
php seed.php
```

The application uses SQLite, so no separate MySQL server is required.

---

### 4. Start the PHP Development Server

From the application directory, run:

```bash
php -S localhost:8000
```

Then open:

```text
http://localhost:8000
```

in your browser.

---

##  Authentication

PetWatch includes user authentication for functionality that requires an account.

Users can:

1. Create an account
2. Log in
3. Access authenticated functionality
4. Create and manage their pet listings

Visitors can still browse pet listings without creating an account.

---

##  Database Structure

The application uses SQLite to store persistent application data.

The main entities include:

### Users

Stores information relating to registered users.

### Pets

Stores information about reported lost pets, including details such as:

* Pet name
* Pet type
* Location
* Owner

### Sightings

Stores information about reported sightings and associates them with the relevant pet.

The database schema is provided in:

```text
schema.sql
```

---

##  Learning Objectives

This project allowed me to develop practical experience with:

* PHP web development
* MVC architecture
* Object-oriented programming
* SQLite databases
* SQL queries
* CRUD operations
* User authentication
* Session management
* HTML and CSS
* Server-side validation
* Debugging and troubleshooting
* Git and GitHub
* Structuring a web application

---

##  Future Improvements

Possible improvements to the project include:

* Improved responsive UI
* More detailed pet profiles
* Image uploads for pet listings
* Interactive maps for pet locations
* Improved search and filtering
* Email notifications for sightings
* Password reset functionality
* Additional input validation
* Automated testing
* Improved error handling
* Deployment to a production web server

---

##  Project Status

This project is a university-developed application and represents my practical experience learning PHP and web application development.

The core functionality has been implemented, with further improvements possible as part of future development.

---

Pages

Home Page <img width="1284" height="471" alt="Screenshot 2026-08-14 at 22 04 33" src="https://github.com/user-attachments/assets/e0f63473-7e66-4cb0-ad35-fcd2b3a0ec59" />


##  Author

**Aqil Ahmed**

Computer Science Undergraduate

GitHub: [Aqil-x](https://github.com/Aqil-x)

---
