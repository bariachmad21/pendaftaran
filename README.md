# 🚀 Digital Talent 2026 Registration Form

A futuristic, high-performance registration platform designed for the **Digital Talent 2026** competition. This project features a stunning **Interactive "Living Wave" Background**, glassmorphism aesthetics, and real-time **WhatsApp Notifications**.


## ✨ Key Features

- **🎨 Interactive UI/UX**:

  - **"Living Wave" Cursor**: Canvas-based particle system that reacts to mouse movements with organic fluid animations.
  - **Onyx Prism Design**: Premium dark-themed glassmorphism interface.
  - **Custom Date Picker**: Built-in, lightweight date selector without external heavy libraries.
- **⚡ Powerful Backend**:

  - **Auto WhatsApp Notification**: Integrated with [Fonnte API](https://fonnte.com/) to send detailed confirmation messages instantly upon registration.
  - **Secure Database**: MySQL integration for reliable data storage.
- **📱 Fully Responsive**: Optimized for Desktop, Tablet, and Mobile experiences.

## 🛠️ Tech Stack

- **Frontend**: HTML5 Canvas, CSS3 (Variables & Animations), Vanilla JavaScript.
- **Backend**: Native PHP (No heavy frameworks).
- **Database**: MySQL.
- **Third-Party**: Fonnte API (for WhatsApp Gateway).

## 🚀 Getting Started

Follow these steps to run the project locally on your machine.

### Prerequisites

- **XAMPP** (or any PHP/MySQL local server).
- Web Browser (Chrome/Edge/Firefox).

### Installation

1. **Clone the Repository**

   ```bash
   git clone https://github.com/yourusername/digital-talent-registration.git
   ```
2. **Setup Database**

   - Open **phpMyAdmin** (`http://localhost/phpmyadmin`).
   - Create a new database named `lomba`.
   - Import the `pendaftaran.sql` file located in this project folder.
3. **Configure Connection**

   - Open `koneksi.php`.
   - Adjust the database credentials if necessary (Default XAMPP):
     ```php
     $host = "localhost";
     $user = "root";
     $pass = ""; // Leave empty for default XAMPP
     $db   = "lomba";
     ```
4. **Configure WhatsApp Token (Optional)**

   - Register at [Fonnte.com](https://fonnte.com/) to get your token.
   - Open `pendaftaran.php` and replace the token:
     ```php
     $token = "YOUR_FONNTE_TOKEN_HERE";
     ```
5. **Run the Project**

   - Move the project folder to `htdocs` (e.g., `C:\xampp\htdocs\lomba`).
   - Access via browser: `http://localhost/lomba`

## 📁 File Structure

- `index.php` - The main frontend interface with Canvas animation.
- `pendaftaran.php` - Backend logic for database insertion & API handling.
- `koneksi.php` - Database connection settings.
- `pendaftaran.sql` - SQL dump for database structure.

## 👤 Author

**Bari Achmad**
*Front-end Enthusiast & PHP Developer*

---

*Created for Digital Talent 2026 Selection Process.*
