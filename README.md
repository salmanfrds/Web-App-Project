# 📄  Report and Documentation for IIUM Student Activity Tracker Website

## 📌 Project Title
**ACTIVITY TRACKER FOR IIUM STUDENT**

## 🧑‍🤝‍🧑 Group 4 Members:
| Name                     | Matric No   |
|--------------------------|-------------|
| Firdaus Muhammad Salman  | 2223281     |
| Naqash Mohd Aouf         | 2224251     |
| Muhammad Assad Iskandar  | 2217961     |
| Youssouf Adoum Abakar    | 2115185     |

## 📌 Table of Contents

1. [Introduction](#introduction)  
2. [Features](#features)  
3. [Environment Setup](#environment-setup)  
4. [Authentication](#authentication)  
5. [Routing](#routing)  
6. [Views](#views)  
7. [Controllers](#controllers)  
8. [Image Upload & Storage](#image-upload--storage)  
9. [Author](#author)  

---

## 📝 Introduction

This project is a student activity tracker specifically tailored for IIUM students. It allows users to:
- Register and log in to the system.
- Create, view, edit, and delete their activity records.
- Manage their personal profile and activity statuses.

---

## ✨ Features

- 🔐 Secure Login and Registration System
- 📝 Activity CRUD (Create, Read, Update, Delete)
- 🙋‍♂️ User Profile Management
- 🖼️ Image Upload for Activity Documentation (if implemented)
- 📜 Role-based Middleware Protection
- 💻 Clean Blade UI with responsive layout

---

## 🛠️ Environment Setup

### Requirements

- PHP >= 8.0  
- Laravel >= 10.x  
- MySQL or PostgreSQL  
- Composer  
- Node.js & NPM (if frontend assets are managed)

### Installation

```bash
git clone https://github.com/your-username/student-activity-tracker.git
cd student-activity-tracker
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve
php artisan storage:link
```

---

## 🔑 Authentication

The authentication system is built using Laravel's built-in authentication features:

- User registration with validation
- Secure login with session management
- Password reset functionality
- Email verification (if implemented)
- Protected routes using middleware

---

## 🔄 Routing

The application's routes are organized in the following structure:
1. Root Route

Route::get('/', [ActivityController::class, 'index'])->middleware(Authenticate::class);

Purpose: Main entry point of the application

Behavior:

- Shows activity index page
- Protected by authentication middleware
- Users must be logged in to access


2. Authentication Routes
// Login
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);

// Registration
Route::get('/register', [UserController::class, 'register'])->name('register');
Route::post('/register', [UserController::class, 'store'])->name('register.store');

Login Flow:

- GET /login - Shows login form
- POST /login - Processes login credentials
- POST /logout - Handles user logout

Registration Flow:

- GET /register - Shows registration form
- POST /register - Stores new user data

3. Activity CRUD Routes (Protected)

Route::middleware([Authenticate::class])->group(function () {
    Route::get('/activities', [ActivityController::class, 'displayActivities'])->name('activities');
    Route::get('/activities/add', [ActivityController::class, 'displayAdd']);
    Route::post('/activities/add', [ActivityController::class, 'addActivity'])->name('activities.store');
    Route::get('/activities/{id}', [ActivityController::class, 'viewActivity'])->name('activities.view');
    Route::post('/activities/{id}/status', [ActivityController::class, 'editActivity'])->name('activities.edit');
    Route::delete('/activities/{id}', [ActivityController::class, 'deleteActivity'])->name('activities.delete');
});

Security: All routes protected by authentication middleware

CRUD Operations:

List: GET /activities - Shows all activities

Create:

- GET /activities/add - Shows creation form
- POST /activities/add - Stores new activity

Read: GET /activities/{id} - Views specific activity

Update: POST /activities/{id}/status - Edits activity status

Delete: DELETE /activities/{id} - Removes activity

4. Profile Routes (Protected)

Route::middleware([Authenticate::class])->group(function () {
    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
    Route::get('/profile/edit', [UserController::class, 'edit']);
    Route::post('/profile/edit', [UserController::class, 'update'])->name('profile.update');
});

Profile Management:

- GET /profile - Shows user profile
- GET /profile/edit - Shows edit form
- POST /profile/edit - Updates profile data

Console Routes (routes/console.php)

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Purpose: Developer utility command

Functionality:

- Runs when executing php artisan inspire
- Displays random inspirational quote
- Primarily for demonstration purposes

  
---

## 👁️ Views

The application uses Blade templates with a clean, responsive design:

- Layouts with common elements
- Component-based design for reusability
- Form validation with error messages
- Activity listing with search and filter options
- User dashboard with activity statistics

---

## 🎮 Controllers

Key controllers include:

- `AuthController` - Handles user authentication
- `ActivityController` - Manages activity CRUD operations
- `ProfileController` - Handles user profile management
- `HomeController` - Manages the dashboard and home page

---

## 📸 Image Upload & Storage

The system uses Laravel's file storage system for handling activity images:

- Secure file uploads with validation
- Image resizing and optimization
- Storage using Laravel's filesystem
- Public access links for approved images

---

## 👨‍💻 Author & Contributions

Developed by Group 4 for INFO 3308, Web Application Development Class, International Islamic University Malaysia, Semester 1 2023/2024.

| Name                     | Matric No   | Contributions                                         |
|--------------------------|-------------|----------------------------------------------------- |
| Firdaus Muhammad Salman  | 2223281     | Authentication                            |
| Naqash Mohd Aouf         | 2224251     | Profile page view, controllers and routes |
| Muhammad Assad Iskandar  | 2217961     | Edit page view, routes                    |
| Youssouf Adoum Abakar    | 2115185     | |

---
