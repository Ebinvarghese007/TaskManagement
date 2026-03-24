#  Task Management System

A simple and efficient **Task Management Web Application** built using Core PHP, PostgreSQL, and AJAX. This application allows users to manage their daily tasks with a smooth, single-page experience (no full page reloads).

---

##  Features

*  User Registration & Authentication
*  Secure Login System
*  View all tasks on dashboard
*  Create new tasks
*  Edit and update existing tasks
*  Delete tasks
*  Task filtering with tabs:

  * Active
  * Completed
  * Pending
*  AJAX-based operations (no page reload)
*  Responsive UI using Bootstrap

##  Tech Stack

* **Backend:** Core PHP
* **Frontend:** HTML, Bootstrap, JavaScript, ajax
* **Database:** PostgreSQL
* **AJAX:** For asynchronous operations and better UX

##  How It Works

##  Application Workflow

- **User Registration & Authentication**  
  New users can create an account by providing their basic credentials. The system validates user input and securely stores user data in the PostgreSQL database. Registered users can log in using their credentials, ensuring that only authenticated users can access the application features.

- **Dashboard Access After Login**  
  Once authenticated, users are redirected to a personalized dashboard where they can view and manage their tasks. The dashboard acts as the central hub, displaying task data in a structured and user-friendly interface.

- **AJAX-Based Task Operations (CRUD)**  
  All task-related operations — including creating new tasks, retrieving existing tasks, updating task details, and deleting tasks — are performed asynchronously using AJAX. This eliminates the need for full page reloads and provides a seamless, fast, and responsive user experience.

- **Dynamic Task Filtering with Tabs**  
  Tasks are categorized based on their status (e.g., Active, Completed, Pending). Users can switch between tabs to filter tasks instantly. The filtering is handled dynamically on the client side using AJAX, ensuring that only relevant data is displayed without refreshing the page.

- **Single Page Application Behavior**  
  Although built with Core PHP, the use of AJAX enables the application to behave like a Single Page Application (SPA). This improves usability by reducing load times and creating a smoother interaction flow.

- **Real-Time UI Updates**  
  Any changes made to tasks (such as status updates or deletions) are immediately reflected in the UI without requiring a manual refresh, enhancing overall user experience.

---

##  Installation & Setup

### 1 Clone the repository

### 2 Navigate to project folder

```bash 
cd taskManagement
```

### 3 Setup Database (PostgreSQL)

* Create a database:

```sql
CREATE DATABASE taskManagement;
```

* Import your SQL file 
import sql file from the folder dbBackup
if import not work from UI, please upload through cmd

# * if the database import not work please execute the query for table creation

   CREATE TABLE tbl_users (
    user_id SERIAL PRIMARY KEY,
    user_name VARCHAR(100) NOT NULL,
    user_email VARCHAR(150) UNIQUE NOT NULL,
    user_password TEXT NOT NULL, -- best for hashed passwords
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
 CREATE TABLE user_tasks (
    task_id SERIAL PRIMARY KEY,
    user_id INT NOT NULL,
    task_name VARCHAR(255) NOT NULL,
    task_priority VARCHAR(50) NOT NULL,
    task_due_date DATE NOT NULL,
	task_status VARCHAR(50) NOT NULL,
    task_created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	task_updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    -- Foreign key (assuming you have a users table)
    CONSTRAINT fk_user
        FOREIGN KEY(user_id) 
        REFERENCES tbl_users(user_id)
        ON DELETE CASCADE
);
  INSERT INTO public.tbl_users(user_name, user_email, user_password)VALUES ('EBIN', 'ebin@gmail.com', '$2y$10$wc0ktWTVDefcUVLafJOB8.zc2OfWRsNrAmQMOSTOcqE2.YFXFSxR6');

INSERT INTO public.tbl_users(user_name, user_email, user_password)VALUES ('Mariya', 'mariya@gmail.com', '$2y$10$rMDKm6/fb.g5YGtZsDWS2OxPd4gP5lGOWZN5IxnkDQn8vmN0ih04e');

* Update your database config in PHP:
config.php
$host = "localhost";
$port = "5432";
$db   = "taskManagement";
$user = "postgres";
$pass = "postgres";
```

---

###  Run the project

* Place project in `htdocs` (XAMPP) or `www` (WAMP)
* Start Apache & PostgreSQL
* Open in browser:

http://localhost/taskManagement

# * user name and password
---------------------------------

       1.   ebin@gmail.com
            123456
       2.   mariya@gmail.com
            654321

          you can create new users through this application
---

##  Project Structure (Basic)

```
/task-management
│── /assets
 -js
 -bootstrap
│── /config
 -config.php
│── /controllers
  -userRegistrstionController
  -taskManagementController
  -loginController
│── /ajax
│── /views
 ── index.php
 ── login.php
 ── dashboard.php
 ── index.php
 ── login.php
---

## Improvements

* Password hashing & security enhancements
* User Registration
* Filters
* UI improvements

---

##  Author

**Ebin Varghese**

---
