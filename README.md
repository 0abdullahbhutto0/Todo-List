# 📝 Comic-Style TODO List App

A fun and interactive TODO list application with a hand-drawn, comic book aesthetic. Built with PHP, MySQL, and custom CSS styling that makes task management feel like writing in a personal diary!
## ✨ Features

User Authentication: Secure login and signup system
Sticky Note Design: Tasks displayed as colorful sticky notes in a responsive grid
Priority Levels: Organize tasks by Low, Medium, or High priority
Hand-Drawn Aesthetic: Custom fonts and comic-style borders
Textured Background: Beautiful SVG paper texture with doodle patterns
Responsive Layout: Works seamlessly on desktop and mobile devices
Interactive Animations: Hover effects and smooth transitions

## 🎨 Design Highlights

Patrick Hand and Comic Neue fonts for authentic hand-written feel
Color-coded sticky notes with slight variations for visual interest
Bold black borders with rounded corners and drop shadows
Textured paper background with pencil doodles
Smooth hover animations that make notes "pop"

## 🚀 Getting Started

### Prerequisites

PHP 7.0 or higher

MySQL 5.6 or higher

Apache web server

Web browser

Installation

Clone the repository

bash   git clone https://github.com/0abdullahbhutto0/Todo-List.git
   
   cd Todo-List

Set up the database

Create a new MySQL database
Import the database schema (create tables for users and tasks)
Update database credentials in your PHP connection file


Configure the application

Update TODO_DB_LOGIN.php with your database credentials
Update TODO_DB_SIGNIN.php with your database credentials
Ensure proper file permissions


Start your web server

Place files in your web server's document root
Access the application through your browser


## 📁 File Structure
comic-todo-app/

├── index.php              # Main TODO list page

├── TODO_DB_LOGIN.php      # Login handler

├── TODO_DB_SIGNIN.php     # Signup handler

├── login.html             # Login page

├── signup.html            # Signup page

├── background.svg         # Custom paper texture background

└── styles.css             # Main stylesheet

## 🎯 Usage

Sign Up: Create a new account with username and password
Login: Access your personal TODO list
Add Tasks: Enter task name and select priority level
View Tasks: Tasks display as sticky notes in a responsive grid
Manage: Tasks are organized and easy to scan

## 🎨 Customization
Colors
The app uses a vibrant color palette that can be customized in the CSS:

Primary Pink: #ff006e (headers and accents)
Warning Yellow: #ffb703 (primary buttons)
Info Blue: #90e0ef (secondary buttons)
Paper Cream: #fffbea (sticky notes)
Background: #fdf6e3 (page background)

Fonts

To change fonts, update the Google Fonts import:
css@import url('https://fonts.googleapis.com/css2?family=YourFont&display=swap');

## 🔒 Security Notes

This is a demonstration project. For production use, consider:

Implementing password hashing (bcrypt/Argon2)
Adding CSRF protection
Sanitizing all user inputs
Using prepared statements for database queries
Implementing rate limiting
Adding session security measures

## 🐛 Known Issues

Session management needs enhancement for production
No password recovery feature yet
Tasks cannot be edited or deleted (feature coming soon)

## 🚧 Future Enhancements

 Edit and delete tasks
 Task completion checkboxes
 Drag and drop reordering
 Task categories/tags
 Due dates and reminders
 Export tasks to PDF
 Dark mode toggle
 Multi-language support

## 📄 License
This project is open source and available under the MIT License.
## 🤝 Contributing
Contributions, issues, and feature requests are welcome! Feel free to check the issues page.

Fork the project
Create your feature branch (git checkout -b feature/AmazingFeature)
Commit your changes (git commit -m 'Add some AmazingFeature')
Push to the branch (git push origin feature/AmazingFeature)
Open a Pull Request

## 👤 Author
### Abdullah Bhutto
### GitHub: @0abdullahbhutto0

## 🙏 Acknowledgments

Google Fonts for Patrick Hand and Comic Neue
Inspiration from traditional sticky note TODO lists
Comic book and hand-drawn design aesthetics
