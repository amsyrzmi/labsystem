content = """# Labcore - Laboratory Management System

Labcore is a comprehensive, role-based laboratory management system built with Laravel 12. It streamlines the workflow between Teachers, Lab Assistants, and Administrators, making experiment scheduling, apparatus/material booking, and inventory management effortless.

## 👥 User Roles & Features

### 1. Teacher
* **Booking Requests:** Create lab requests by selecting the educational level, subject, and specific experiment (including custom experiments).
* **Calculations:** Automated reagent calculations based on booking requirements.
* **Notifications:** Receive automated email notifications once a request is approved or rejected by a lab assistant.
* **History & Timetable:** View past requests and upcoming scheduled lab sessions.

### 2. Lab Assistant
* **Request Management:** Review, approve, or reject booking requests submitted by teachers.
* **Experiment Management:** Add, edit, and configure standard experiments categorized by level, subject, and topic.
* **Inventory Control:** Manage default apparatus and materials for specific experiments.
* **Stock Management:** Track overall physical inventory (apparatus and materials) and monitor inventory transactions.

### 3. Administrator
* **User Management:** Create, edit, and oversee system users, roles, and approval statuses.
* **System Oversight:** View overarching system metrics, experiment configurations, and global lab request history.

## 📸 Screenshots
*(Add your application screenshots here)*

* **Teacher Booking Flow:** `![Teacher Booking Form](public/images/teacher-booking.png)`
* **Lab Assistant Dashboard:** `![Lab Assistant View](public/images/lab-assistant.png)`
* **Admin User Management:** `![Admin Panel](public/images/admin-panel.png)`

## 🚀 Tech Stack
* **Backend:** PHP 8.2, Laravel 12
* **Frontend:** Vite, TailwindCSS 4, Blade Templating
* **Database:** MySQL 8.0
* **Infrastructure:** Docker, Nginx

## 🐳 Local Development Setup (Docker)

This project is fully containerized using Docker to ensure a consistent environment. 

### Prerequisites
* [Docker](https://docs.docker.com/get-docker/) installed and running.
* (Linux users) Ensure your user is in the `docker` group to run commands without `sudo`.

### Installation Steps

1. **Clone the repository:**# LabsystemDTHO 🧪

A fully Dockerized Laravel application utilizing PHP 8.2, Nginx, and MySQL 8.0.

## 📦 Prerequisites

Before starting, ensure you have the following installed on your host machine:
* [Docker](https://docs.docker.com/get-docker/)
* [Docker Compose](https://docs.docker.com/compose/install/)

**Pro-Tip for Linux Users:** Ensure your user is added to the `docker` group so you don't have to run commands with `sudo`:
```bash
sudo usermod -aG docker $USER
newgrp docker
