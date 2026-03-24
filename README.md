# 🗂️ Task Management System

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

---

##  Tech Stack

* **Backend:** Core PHP
* **Frontend:** HTML, Bootstrap, JavaScript, ajax
* **Database:** PostgreSQL
* **AJAX:** For asynchronous operations and better UX

---

##  How It Works

* Users register and log in securely
* After login, users are redirected to a dashboard
* All task operations (Create, Read, Update, Delete) are handled using AJAX
* Tasks are dynamically filtered using status tabs without reloading the page

---

##  Installation & Setup

### 1 Clone the repository

```bash
git clone https://github.com/yourusername/task-management.git
```

### 2 Navigate to project folder

```bash
cd task-management
```

### 3 Setup Database (PostgreSQL)

* Create a database:

```sql
CREATE DATABASE task_management;
```

* Import your SQL file (if available)
  
* Update your database config in PHP:
   config.php
$host = "localhost";
$port = "5432";
$db   = "task_management";
$user = "postgres";
$pass = "postgres";
```

---

###  Run the project

* Place project in `htdocs` (XAMPP) or `www` (WAMP)
* Start Apache & PostgreSQL
* Open in browser:

```
http://localhost/task-management
```

---

##  Project Structure (Basic)

```
/task-management
│── /assets
│── /config
│── /controllers
│── /ajax
│── /views
│── index.php
│── login.php
│── dashboard.php
```

---

##  Future Improvements

* Password hashing & security enhancements
* User Registration
* Filters
* UI improvements

---

##  Author

**Ebin Varghese**

---

##  License

This project is open-source and available for learning and development purposes.

---
