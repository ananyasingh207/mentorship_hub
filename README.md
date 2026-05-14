# Mentorship Hub

Mentorship Hub is a comprehensive platform built with Laravel 12 that connects early-stage startups with experienced mentors. The platform facilitates meaningful mentorship connections through smart matching, direct communication, and a robust scheduling system.

## 🌟 Key Features

### Role-Based Architecture
- **Startups**: Can browse mentors, send mentorship requests, book time slots, and review sessions.
- **Mentors**: Can manage their availability, accept/reject requests from startups, and track their mentorship impact.
- **Admins**: Can moderate the platform by approving or rejecting newly registered mentor profiles.

### 🔍 Smart Discovery & Matching
- **Mentor Directory**: Startups can browse an directory of verified mentors, complete with filters for specific expertise areas.
- **Match Score Algorithm**: Automatically calculates a compatibility percentage between a startup's industry and a mentor's expertise to highlight the best fits.

### 📅 Booking & Scheduling System
- **Availability Management**: Mentors can create custom availability slots on their dashboard.
- **Conflict Prevention**: Built-in validation prevents double-booking and overlapping time slots.
- **Session Tracking**: Track upcoming sessions and mark them as completed. Mentors have full control to cancel or finalize sessions.

### 🤝 Mentorship Requests
- **Request Flow**: Startups must send a request with a tailored message before booking sessions.
- **Status Tracking**: Requests go through a `pending`, `accepted`, or `rejected` lifecycle. Startups can even withdraw requests if needed.

### 💬 Direct Messaging
- Private messaging system allowing approved startups and mentors to communicate seamlessly before and after sessions.

### ⭐ Reviews & Ratings
- After a completed session, startups can leave a 1-5 star rating and written review for the mentor.
- Mentors accumulate verified reviews, which build their reputation and display directly on their public profile.

---

## 🛠️ Technology Stack

- **Backend**: Laravel 12 (PHP 8.2+)
- **Frontend**: Blade Templates, Tailwind CSS
- **Authentication**: Laravel Breeze
- **Database**: SQLite (default, easily configurable to MySQL/PostgreSQL)

---

## 🚀 Getting Started

Follow these steps to set up the project locally for development.

### Prerequisites
- PHP >= 8.2
- Composer
- Node.js & NPM
- Git

### Installation

1. **Clone the repository**
   ```bash
   git clone <repository-url>
   cd mentorship-hub
   ```

2. **Install dependencies**
   Install both PHP and Node dependencies:
   ```bash
   composer install
   npm install
   ```

3. **Environment Setup**
   Copy the example `.env` file and generate your application key:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Database Configuration (MySQL)**
   Open the `.env` file and update the database settings to match your local MySQL configuration:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=mentorship_hub
   DB_USERNAME=root
   DB_PASSWORD=
   ```

5. **Migrate and Seed the Database**
   Run the migrations to create the tables, and seed the database to generate the default admin account:
   ```bash
   php artisan migrate --seed
   ```

6. **Compile Frontend Assets**
   Build the Tailwind CSS and Vite assets:
   ```bash
   npm run build
   # (For active development, you can use: npm run dev)
   ```

7. **Run the Development Server**
   Start the Laravel local server:
   ```bash
   php artisan serve
   ```
   You can now access the application at `http://localhost:8000`.

---

## 👥 Usage Guide

### Creating Accounts
- You can register a new account and choose whether you are a **Startup** or a **Mentor**.
- Note: New mentors will be placed in a `pending` state and must be approved by an Admin before they appear in the discovery list.

### Accessing the Admin Panel
To test the admin features (like approving mentors), you can log in with the default admin account created by the database seeder:
- **Email**: `admin@test.com`
- **Password**: `password`

### Typical Workflow
1. **Mentor** registers, fills out their profile (expertise, bio), and waits for approval.
2. **Admin** logs in, reviews the mentor, and clicks "Approve".
3. **Mentor** logs in and adds open Time Slots to their calendar.
4. **Startup** registers, completes their profile, and navigates to "Discover Mentors".
5. **Startup** sends a Mentorship Request to a mentor.
6. **Mentor** reviews the incoming request and clicks "Accept".
7. **Startup** navigates to the mentor's profile and books an available Time Slot.
8. **Mentor** conducts the session and clicks "Complete" on their dashboard.
9. **Startup** leaves a 5-star review for the mentor!

