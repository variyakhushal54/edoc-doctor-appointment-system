# eDoc: Online Doctor Appointment System

A PHP and MySQL web application for booking doctor appointments. Three roles share one login page:

- **Patient:** register, browse doctors and sessions, book appointments, view and cancel bookings, edit profile.
- **Doctor:** manage own profile, create and delete sessions (schedule slots), view patients and appointments.
- **Admin:** manage doctors and patients, add doctors, create sessions, view all appointments.

Built by **Khushalkumar Variya** as a web-development project.

## Features

- Role-based login (patient, doctor, admin) with session handling
- Doctor search by name or email, with specialty listing
- Session (schedule) creation with a daily patient limit
- Appointment booking with per-session numbering
- Profile editing with ownership checks and email-conflict checks
- Responsive, animated UI built with plain CSS

## Tech stack

- PHP 8 (procedural, mysqli)
- MySQL / MariaDB
- HTML5, CSS3, plain JavaScript
- Local development with XAMPP (Apache + MySQL)

## Setup

1. Install [XAMPP](https://www.apachefriends.org/) and start **Apache** and **MySQL**.
2. Copy this folder to `C:\xampp\htdocs\edoct` (or your web root).
3. Open phpMyAdmin (`http://localhost/phpmyadmin`) and import `edoc.sql`. It creates the `edoc` database with sample data.
4. Open `http://localhost/edoct/` in your browser.

Database settings default to XAMPP's local values (`localhost`, user `root`, empty password, database `edoc`). To use other values, set the environment variables `EDOC_DB_HOST`, `EDOC_DB_USER`, `EDOC_DB_PASS` and `EDOC_DB_NAME` before starting Apache.

## Sample accounts

| Role    | Email               | Password     |
|---------|---------------------|--------------|
| Admin   | admin@edoc.com      | Admin@123    |
| Doctor  | doctor@edoc.com     | Doctor@123   |
| Patient | patient@edoc.com    | Patient@123  |

All personal details in the sample data are fictional. Change these passwords before any real use.

## Security

Issues found in the earlier version of this project have been fixed:

- **SQL injection:** every query that uses user input escapes string values (`$database->esc()`) and casts ID values to integers (`$database->int()`). Login uses the same escaping.
- **Plaintext passwords:** passwords are stored with `password_hash()` and checked with `password_verify()`. Existing databases with plaintext passwords must be re-created from `edoc.sql` or have their passwords reset.
- **Output escaping:** user and database values printed into HTML go through `h()` (`htmlspecialchars`). URL query values are URL-encoded.
- **Access control:** each page checks that the logged-in user has the correct role. Doctor and patient profile pages only update the logged-in user's own record, not a record chosen in the form. Doctors can only delete their own sessions and the bookings in them, and patients can only cancel their own bookings or delete their own account. Admin pages are restricted to admins.
- **Session handling:** the session ID is regenerated on login and signup.
- **Redirects:** every redirect is followed by `exit`.
- **Configuration:** database credentials can come from environment variables instead of being hard-coded.

### Known limitations

- No CSRF tokens on forms or delete links. Delete actions use GET requests as in the original design.
- No rate limiting or account lockout on login.
- No password-strength rules beyond "not empty and matching confirmation".
- The `Extra/` folder holds older copies of the dashboards kept for reference. The live pages are in `admin/`, `doctor/` and `patient/`.

## Project structure

```
.
├── index.php, login.php, signup.php, create-account.php, logout.php
├── connection.php          # Database connection and escaping helpers
├── edoc.sql                # Schema and sample data
├── admin/                  # Admin dashboard, doctors, patients, sessions, appointments
├── doctor/                 # Doctor dashboard, sessions, appointments, settings
├── patient/                # Patient dashboard, doctors, booking, appointments, settings
├── css/                    # Stylesheets
├── img/                    # Images and icons
├── Extra/                  # Older dashboard copies (reference)
└── Screenshots/            # Application screenshots
```

## Screenshots

See the [`Screenshots/`](Screenshots/) folder for the landing page, patient dashboard, doctor dashboard and other views.
