**BlogSphere:**

**Project Overview:**

    BlogSphere is a full-stack blog publishing application developed using Laravel. 
    It provides two major panels: Blogger Panel and Admin Panel, enabling bloggers to create and manage content while allowing admins to moderate users and posts.
    This project demonstrates real-world application architecture, authentication, authorization, and role-based access control.

**Blogger Panel:**

    Create Blogs
    Update Blogs
    Delete Blogs (Soft Delete)
    View Blogs Feed (All Bloggers)
    View Deleted Blogs
    Profile Management
    Change Password
    Forgot Password (Email Verification)
    Logout

**Admin Panel:**

    Manage Bloggers (Reject / Status Change)
    Manage Blogs (Reject)
    Email Notifications for Actions

**Authentication Module:**

    Registration with Email Verification
    Login (Manual Authentication)
    Password Reset via Email

**System Architecture:**

    Role-Based Access:
        Blogger Middleware
        Admin Middleware

    Design Pattern:
        MVC Architecture     
        Service Layer for Business Logic
        Request Validation Layer

**API Communication:**

    All dynamic operations are handled using jQuery AJAX
    JSON responses for status and messages
    Error handling through HTTP status codes

**Security Implementation:**

    Middleware-based authorization
    Route protection
    CSRF protection
    Password hashing
    Input validation using Request classes

**Performance Optimization:**

    Eloquent Relationships to avoid N+1 Queries
    Pagination in listing modules
    Service Layer for reusable logic

**Validation & Error Handling:**

    Custom Request Classes
    Server-side validation
    Proper error messages

**Author:**

    Aravind Kumar
    Full Stack Developer
