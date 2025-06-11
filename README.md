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

The Student Activity Tracker is a web-based application designed to help students efficiently manage and track their extracurricular or academic activities. This system enables users to register and securely log in to a personal dashboard where they can create, view, edit, and delete their own activities. By integrating basic CRUD operations with secure authentication mechanisms, the system provides a simple and intuitive interface for users to stay organized and reflect on their participation over time. The application aims to support students in developing better self-management habits and maintaining a log of their achievements and involvements.

---

## 🎯 Objectives

 #### Support Student Engagement:
- To encourage students to actively participate in academic and extracurricular activities by providing a platform to record and reflect on their involvement.
 #### Promote Self-Management and Accountability:
- To help students take ownership of their time and responsibilities by allowing them to log and monitor their personal activities and progress.
 #### Enhance Organization and Productivity:
-  To provide students with a structured system for organizing their tasks and commitments, reducing the risk of missing deadlines or forgetting important events.
 #### Foster Digital Record Keeping:
- To offer a centralized digital space where students can securely store and manage their activity records, which can be useful for resumes, portfolios, or academic evaluations.
 #### Encourage Consistent Participation:
- To motivate students to maintain continuous engagement in university life by tracking patterns and consistency in their activities over time.

---

## ✨ Features

- 🔐 Secure Login and Registration System
- 📝 Activity CRUD (Create, Read, Update, Delete)
- 🙋‍♂️ User Profile Management (CRUD)
- 🖼️ Image Upload for Activity Documentation (if implemented)
- 📜 Middleware Protection
- 💻 Clean Blade UI with responsive layout

---

## 🛠️ Environment Setup

### Requirements

- PHP >= 8.0  
- Laravel >= 12.x  
- Sqlite Database  
- Composer  

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

### Entity-Relationship Diagram (ERD)

![Activity Tracker ERD](./image/erd-diagram.png)

> 💡 we added the image attributes to the user and activity table, while not implementing the dashboard table in execution because its not necessary
._


### Sequence Diagram

![Sequence Diagram](./image/seq-diagram.png)

> 💡 _This sequence diagram shows a **student** interacting with a website to perform **login** and **CRUD operations**. Requests from the **web browser** go to the **controller and route**, which communicate with the **auth system** for login and permission checks, and the **database** for data access. Responses are then returned to the browser.
._

---

## 🔑 Authentication

The authentication system is built using Laravel's built-in authentication features:

- User registration
```php
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password, //automatic hashing
        ]);

        return redirect()->route('profile')->with('success', 'Account registered successfully!');
    }
```
- Secure login and Logout with session management
```php
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        // Validate input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Attempt to login
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }

        return redirect()->route('login')->with('error', 'Invalid email or password');
    }
```
- Protected routes using middleware

```php
/Authencticate Middleware to protect router
class Authenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            // If not logged in, redirect to /login
            return redirect()->route('login');
        }

        return $next($request);
    }
}
```

---

## 🛣️ Routing

The application uses a structured routing system organized into logical groups:

### Root Route
```php
Route::get('/', [ActivityController::class, 'index'])->middleware(Authenticate::class);
```
- Serves as the main entry point
- Protected by authentication middleware
- Redirects to login if user is not authenticated

### Authentication Routes
```php
// Login
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);

// Registration
Route::get('/register', [UserController::class, 'register'])->name('register');
Route::post('/register', [UserController::class, 'store'])->name('register.store');
```
- Handles user authentication flows
- Provides login, logout, and registration functionality
- Named routes for easier reference in views

### Activity Management Routes
```php
Route::middleware([Authenticate::class])->group(function () {
    Route::get('/activities', [ActivityController::class, 'displayActivities'])->name('activities');
    Route::get('/activities/add', [ActivityController::class, 'displayAdd']);
    Route::post('/activities/add', [ActivityController::class, 'addActivity'])->name('activities.store');
    Route::get('/activities/{id}', [ActivityController::class, 'viewActivity'])->name('activities.view');
    Route::post('/activities/{id}/status', [ActivityController::class, 'editActivity'])->name('activities.edit');
    Route::delete('/activities/{id}', [ActivityController::class, 'deleteActivity'])->name('activities.delete');
});
```
- All routes protected by authentication middleware
- Complete CRUD operations for activities
- RESTful design pattern for resource management

### Profile Routes
```php
Route::middleware([Authenticate::class])->group(function () {
    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
    Route::get('/profile/edit', [UserController::class, 'edit']);
    Route::post('/profile/edit', [UserController::class, 'update'])->name('profile.update');
});
```
- Secure user profile management
- Allows viewing and editing user information
- Protected by authentication checks

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

### 🗂️ ActivityController Functions

- **`index()`**  
  Displays the dashboard with user name, upcoming/ongoing activities, and activity statistics.

- **`displayActivities()`**  
  Shows all activities for the logged-in user.

- **`addActivity(Request $request)`**  
  Saves a new activity using input from the form and redirects to the activities page.

- **`displayAdd()`**  
  Displays the form to add a new activity.

- **`viewActivity($id)`**  
  Shows the details of a specific activity based on its ID.

- **`editActivity(Request $request, $id)`**  
  Updates the status of a specific activity.

- **`deleteActivity($id)`**  
  Deletes an activity by its ID and redirects to the activities page.

- **`uploadBanner(Request $request, $id)`**  
  Validates and uploads a new banner image for an activity.  
  Deletes the old image if it exists and updates the activity with the new image path.


### 🔐 AuthController Functions

- **`index()`**  
  Displays the login page.

- **`login(Request $request)`**  
  Validates login input and attempts to authenticate the user.  
  Redirects to the homepage if successful or back to login with an error if failed.

- **`logout(Request $request)`**  
  Logs out the user, clears the session, and redirects to the login page.


### 👤 UserController Functions

- **`profile()`**  
  Displays the user's profile page.

- **`register()`**  
  Shows the registration form.

- **`store(Request $request)`**  
  Validates registration input and creates a new user.  
  Redirects to profile on success.

- **`edit()`**  
  Loads the profile edit form with current user data and options for gender and kulliyah.

- **`update(Request $request)`**  
  Validates and updates the user's profile data, including image upload if provided.

---

## 🖼️ Image Upload & Storage

The system uses Laravel's file storage system to handle profile and activity banner images securely and efficiently.

### 🔐 Secure Upload & Validation
- All uploaded images are validated (`jpg`, `jpeg`, `png`, max 2MB).
- Prevents invalid or malicious files from being stored.
- Enforces correct MIME types and file size restrictions.

### 🔄 Auto File Replacement
- When users or activities update their images, old files are deleted from storage to save space and avoid clutter.
- Unique filenames are generated using Laravel's `hashName()` to avoid conflicts.

### 🗂️ Organized Storage
- Images are saved in the `public/images` directory using Laravel’s `Storage` facade.
- Profile pictures: `public/images/filename.jpg`
- Activity banners: `public/images/filename.jpg`

### 🌐 Public Access to Approved Images
- Uploaded images are converted into public URLs (`storage/images/...`) using `url()` helper.
- These links are safely displayed in views, such as user profiles and activity detail pages.

### 🛠️ Code Integration

**UserController - Profile Picture Upload**
- Handles optional image upload during profile update.
- Deletes old profile image if a new one is uploaded.

**ActivityController - Banner Image Upload**
- Validates and uploads banner images for activities.
- Deletes old banners and updates the activity record with the new image path.


---

## 👨‍💻 Author & Contributions

Developed by Group 4 for INFO 3308, Web Application Development Class, International Islamic University Malaysia, Semester 1 2023/2024.

| Name                     | Matric No   | Contributions                                         |
|--------------------------|-------------|----------------------------------------------------- |
| Firdaus Muhammad Salman  | 2223281     | All Login, Register and Activities views, controller, routes, and Middleware.|
| Naqash Mohd Aouf         | 2224251     | Profile page view, controllers and routes |
| Muhammad Assad Iskandar  | 2217961     | Edit page view, routes                    |
| Youssouf Adoum Abakar    | 2115185     | |

---
