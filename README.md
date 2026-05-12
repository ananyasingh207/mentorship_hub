# Mentorship Hub 🚀

Mentorship Hub is a premium, role-based platform designed to connect ambitious startup founders with industry-leading mentors. It features a modern SaaS interface, real-time messaging, and a robust session booking system.

---

## 🛠️ Tech Stack

- **Backend**: Laravel 12 (PHP 8.2+)
- **Frontend**: Tailwind CSS, Blade Templates, Vanilla JavaScript
- **Build Tool**: Vite
- **Database**: MySQL (Primary)

---

## 🚀 Getting Started

Follow these steps to set up the project on your local machine.

### 1. Prerequisites
Ensure you have the following installed:
- [PHP 8.2+](https://www.php.net/downloads)
- [Composer](https://getcomposer.org/)
- [Node.js & NPM](https://nodejs.org/)

### 2. Installation

```bash
# Clone the repository
git clone <repository-url>
cd mentorship-hub

# Install PHP dependencies
composer install

# Install Frontend dependencies
npm install
```

### 3. Environment Setup
```bash
# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

### 4. Database Setup
The project uses MySQL. Ensure your `.env` is configured with your database credentials:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=mentorship_hub
DB_USERNAME=root
DB_PASSWORD=
```

```bash
# Create the database in MySQL (if using CLI)
mysql -u root -e "CREATE DATABASE mentorship_hub;"

# Run migrations and seed test data
php artisan migrate --seed
```

### 5. Running the Application
You need to run two processes simultaneously:

**Terminal 1: Vite (Assets)**
```bash
npm run dev
```

**Terminal 2: PHP Server**
```bash
php artisan serve
```
The application will be available at `http://127.0.0.1:8000`.

---

## 🔐 Test Credentials

After running `php artisan migrate --seed`, you can use these accounts to explore the platform:

| Role | Email | Password |
| :--- | :--- | :--- |
| **Admin** | `admin@test.com` | `password` |
| **Test User** | `test@example.com` | `password` |

*Note: You can register as a **Startup** or **Mentor** directly from the landing page.*

---

## ✨ Key Features

- **Dynamic Dashboards**: Tailored experiences for Admins, Startups, and Mentors.
- **SaaS Navigation**: Premium, role-aware navbar with intuitive shortcuts.
- **Booking System**: Real-time time slot management and session booking.
- **Direct Messaging**: Built-in secure chat between mentors and founders.
- **Discovery Grid**: Filter and find approved mentors with ease.
- **Review System**: Rate and review mentors after successful sessions.

---

## 📁 Project Structure

- `resources/views/components/`: Reusable SaaS UI components (navbars, etc.)
- `app/Http/Controllers/`: Role-specific logic (Admin, Startup, Mentor)
- `app/Http/Middleware/`: Security layers for role-based access and profile completion.
- `routes/web.php`: Organized role-restricted route groups.

---

## 🤝 Contributing

1. Create a feature branch.
2. Ensure your code follows the premium SaaS design language (2px corners, clean typography).
3. Submit a Pull Request.

---
© {{ date('Y') }} Mentorship Hub. Built with Laravel.
