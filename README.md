# 🧩 Laravel Task Management System

### Teams • Projects • Tasks • Comments • Attachments • Activity Logs

A complete **Task Management Backend** built using **Laravel**, supporting Teams, Projects, Tasks, Comments, Attachments, Activity Logs, and Notifications.

This backend is suitable for SaaS platforms, internal management tools, and enterprise workflow systems.

---

## 🚀 Features

### 👥 Teams

-   Create teams
-   Add members (owner, admin, member, viewer)
-   Stored in `team_user` pivot with roles and status

### 📂 Projects

-   Each team can create unlimited projects
-   Store status (active/archived), start/end dates, creator

### 📝 Tasks

-   Title & description
-   Status: todo, in_progress, review, done, blocked
-   Priority: low, medium, high, urgent
-   Assignee & reporter
-   Dates (start, due)
-   Estimated & actual hours
-   Subtasks (parent_task_id)
-   Kanban sort order

### 💬 Comments

-   Threaded collaboration inside each task

### 📎 Attachments

-   Upload files per task
-   Store path, original name, and size

### 🕒 Activity Log

-   Track every field change
-   Status changes, assignment, priority, comments, uploads…

### 🔔 Notifications

-   Optional custom notification table
-   OR use Laravel Notifications

---

## 🏗 System Architecture

└── Teams
└── Projects
└── Tasks
├── Comments
├── Attachments
└── Activity Logs

---

## 📦 Installation

### 1️⃣ Clone

````bash
git clone https://github.com/your-repo/task-manager.git
cd task-manager

### 2️⃣ Install Dependencies
```bash
composer install
````

### 3️⃣ Environment Setup

```bash
cp .env.example .env
php artisan key:generate
```

Configure your database and other settings in `.env`.

### 4️⃣ Migrate & Seed

```bash
php artisan migrate --seed
```

### 5️⃣ Serve

```bash
php artisan serve
```
