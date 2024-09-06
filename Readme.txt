# AshwinArchives

**AshwinArchives** is a PHP-based web application designed to help you store, create, and manage your educational archives efficiently. This project features secure and accessible storage solutions for your notes, with an intuitive interface for easy organization.

## Features

- **Organize Notes**: Easily categorize and manage your educational notes with user-friendly tools.
- **Secure Storage**: Protect your data with robust security features to ensure privacy.
- **Cloud Access**: Access your notes from anywhere using our secure cloud storage.
- **Download or Email Notes**: Save your notes locally or send them via email directly from the platform.

## Database Schema

### `notes` Table

| Column     | Type         | Null | Default               | Comment                         |
|------------|--------------|------|-----------------------|---------------------------------|
| id         | `int(11)`    | No   |                       | Primary key                     |
| content    | `text`       | No   |                       | The content of the note         |
| created_at | `timestamp`  | No   | `current_timestamp()` | Timestamp when the note was created |
| username   | `varchar(255)` | Yes  | `NULL`                | Username of the note creator    |

### `users` Table

| Column    | Type          | Null | Default               | Comment                    |
|-----------|---------------|------|-----------------------|----------------------------|
| id        | `int(11)`     | No   |                       | Primary key                |
| username  | `varchar(255)` | No   |                       | Username for login         |
| password  | `varchar(255)` | No   |                       | Password for login         |
| created   | `datetime`    | No   | `current_timestamp()` | Timestamp when the user was created |

## Getting Started

Follow these steps to set up **AshwinArchives** on your local machine.

### Prerequisites

- PHP 7.0+
- MySQL or MariaDB
- Composer
- Web server (Apache, Nginx)

### Installation

1. **Clone the Repository**:
   ```bash
   git clone https://github.com/yourusername/AshwinArchives.git
