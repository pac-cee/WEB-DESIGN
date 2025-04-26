# Eventify - Full-Stack Event Management Web Application

Eventify is a modern event management platform built with PHP, MySQL, JavaScript, HTML5, and CSS3. It supports multiple user roles (Admin, Organizer, Attendee) and advanced features such as real-time seat updates, PDF ticketing, email notifications, interactive maps, and analytics.

## Features
- User roles: Admin, Organizer, Attendee (with registration & login)
- Role-based dashboards
- Event creation/editing (date-picker, image upload, rich-text description)
- Event calendar view with animated tooltips
- Real-time seat availability (AJAX)
- PDF ticket generation (TCPDF)
- Email notifications (PHPMailer)
- Responsive design with Flexbox & CSS Grid
- CSS3 transitions, scroll-triggered fade-ins
- Interactive maps (Leaflet.js)
- Analytics charts (Chart.js)

## Setup
1. Import `setup_eventify.sql` into your MySQL database.
2. Run `composer install` to fetch PHP dependencies (TCPDF, PHPMailer).
3. Configure your database connection in `config/db.php`.
4. Add Leaflet.js, Chart.js, Flatpickr, and Quill.js via CDN in your HTML as needed (see `assets/js/libs.txt`).
5. Start building out controllers, models, and views for each feature.

## Folder Structure
- `assets/` - CSS, JS, images
- `config/` - Configuration files
- `controllers/` - PHP logic for routes and features
- `models/` - Database models
- `views/` - HTML/PHP templates
- `vendor/` - Composer libraries

## Libraries Used
- [TCPDF](https://tcpdf.org/)
- [PHPMailer](https://github.com/PHPMailer/PHPMailer)
- [Leaflet.js](https://leafletjs.com/)
- [Chart.js](https://www.chartjs.org/)
- [Flatpickr](https://flatpickr.js.org/)
- [Quill.js](https://quilljs.com/)

---

For detailed implementation, see the docs or comments in each module. Begin with user authentication, then add dashboards and event features.
