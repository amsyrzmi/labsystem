# Labcore - Laboratory Management System

Labcore is a comprehensive, role-based laboratory management system built with Laravel 12. It streamlines the workflow between Teachers, Lab Assistants, and Administrators, making experiment scheduling and inventory management effortless.

## 👥 User Roles & Features

### 1. Teacher
* **Booking Requests:** Create lab requests by selecting the educational level, subject, and specific experiment.
* **Notifications:** Receive automated email notifications once a request is approved or rejected by a lab assistant.
* **History & Timetable:** View past requests and upcoming scheduled lab sessions.

### 2. Lab Assistant
* **Request Management:** Review, approve, or reject booking requests submitted by teachers.
* **Experiment Management:** Add, edit, and configure experiments categorized by level and subject.
* **Inventory Control:** Manage both default apparatus/materials for specific experiments and the overall physical inventory to ensure adequate stock levels.

### 3. Administrator
* **User Management:** Create, edit, and oversee system users (Teachers and Lab Assistants).
* **System Oversight:** View overarching system metrics, experiment configurations, and global lab schedules.

## 📸 Screenshots
*(Tip: Replace these placeholders with actual screenshots of your application)*

* **Teacher Booking Flow:** `![Teacher Booking Form](docs/teacher-booking.png)`
* **Lab Assistant Dashboard:** `![Lab Assistant View](docs/lab-assistant.png)`
* **Admin User Management:** `![Admin Panel](docs/admin-panel.png)`

## 🚀 Getting Started (Docker Installation)

This project is fully containerized using Docker, ensuring a smooth setup process across different environments.

### Prerequisites
* [Docker](https://docs.docker.com/get-docker/)
* [Docker Compose](https://docs.docker.com/compose/install/)

### Installation Steps

1. **Clone the repository:**
   ```bash
   git clone [https://github.com/yourusername/LabsystemDTHO.git](https://github.com/yourusername/LabsystemDTHO.git)
   cd LabsystemDTHO
