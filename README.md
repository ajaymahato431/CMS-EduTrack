# EduTrack - Learning Management System

EduTrack is a Laravel-based learning management system designed to streamline course delivery for schools and coaching institutes. It provides dedicated workspaces for administrators, teachers, and students so every stakeholder can manage day-to-day academic activities from a single, responsive dashboard.

## Highlights

-   **Role-aware dashboards** for administrators, teachers, and students with guarded route access.
-   **Course & student management** including add/edit/delete flows, profile updates, and bulk actions.
-   **Enrollment tracking** that lets students explore offerings and register with one click.
-   **Jetstream & Livewire foundation** for secure authentication, modern UI components, and smooth interactions.
-   **Seeded demo data** to get started quickly (admin account plus sample courses).

## Installation

1. **Clone the repository**
   `bash
git clone https://github.com/your-org/edutrack.git
cd edutrack
`
2. **Install PHP dependencies**
   `bash
composer install
`
3. **Install Node dependencies** (optional but recommended for asset rebuilding)
   `bash
npm install
`
4. **Environment setup** - Copy .env.example to .env and update database, mail, and application settings. - Generate the application key:
   `bash
php artisan key:generate
`
5. **Database migration & seed**
   `bash
php artisan migrate --seed
`
   The seeders provision an admin@example.com / password123 account and sample courses.
6. **Build frontend assets** (choose one)
   `bash
npm run dev     # hot reloading during development
npm run build   # optimized assets for production
`
7. **Serve the application**
   `bash
php artisan serve
`
   Visit http://localhost:8000 in your browser.

## How to Use

1. **Log in** with the seeded admin account or register a new user.
2. **Administrators** can manage users, assign roles, create courses, and review enrollments.
3. **Teachers** gain access to their course and student lists, with tools to edit content or record progress.
4. **Students** browse available courses, enroll, and maintain their profiles from the student dashboard.
5. Use the top navigation to move between modules, or the responsive mobile menu when on smaller screens.

Feel free to customize the roles, branding, and content to match your institution's needs. Contributions are welcome�open an issue or submit a pull request to suggest enhancements.
