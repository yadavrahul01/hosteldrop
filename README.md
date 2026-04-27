🍜 HostelDrop

HostelDrop** is a full-stack, mobile-responsive web application built to solve a real problem for students: emergency late-night delivery
of snacks, beverages, and daily essentials directly to hostel rooms.

 🚀 Features
 Dynamic Storefront: Browse products by category (Snacks, Beverages, Essentials).
 Live Search Bar: Instantly filter snacks using JavaScript.
Interactive Cart System: Add items, calculate totals, and place orders seamlessly.
Toast Notifications: Clean, modern popup alerts for user feedback.
Admin Dashboard: A secure backend interface to view incoming orders and read student messages in real-time.
Mobile-First Design: Fully responsive layout optimized for smartphone browsers.

 💻 Tech Stack
 Frontend: HTML, CSS(Flexbox/Grid), Vanilla JavaScript , Fetch API
Backend: PHP 
Database:MySQL
Deployment: GitHub (Version Control), InfinityFree (Live Hosting)

 📸 How it Works
1. Students select their favorite items and add them to the cart.
2. They enter their specific Hostel Block and Room Number.
3. The JavaScript `Fetch API` sends the order to the PHP backend.
4. The PHP script securely stores the order in the MySQL database.
5. The Admin (Owner) checks the dashboard to see live orders and messages.

 🛠️ Local Setup Instructions
If you want to run this project on your local machine:
1. Clone this repository.
2. Move the folder to your `xampp/htdocs` directory.
3. Open `phpMyAdmin` and create a database named `hosteldrop_db`.
4. Import the provided `hosteldrop_db.sql` file.
5. Update `api/db_connect.php` with your local database credentials (e.g., `root`, no password).
6. Open `http://localhost/hosteldrop` in your browser.


Built with ❤️ for hostel students.
