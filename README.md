**Online Quiz System** is a fully functional web application designed for **students and teachers** to manage quizzes online efficiently.  
Admins (teachers) can create quizzes, add students, manage classes, and track results, while students can participate in quizzes securely using generated credentials.

📋 Table of Contents
- [Features](#features)
- [Screenshots](#screenshots)
- [User Side](#user-side)
- [Admin Side](#admin-side)
- [Steps to Install](#steps-to-install)
- [Project Overview](#project-overview)
- [Technology Stack](#technology-stack)
- [Collaborate with Us](#collaborate-with-us)
- [Bug / Feature Request](#bug--feature-request)

🌟 Features
- Fully Functional Admin Panel
- Clean and Responsive Quiz Website UI
- Admin can add classes and students
- Admin can create new quizzes and add questions
- Import quiz questions from spreadsheets (.xls, .xlsx, .ods)
- View statistics of quizzes and student scores
- Generate random passwords for student login per quiz
- Export student credentials to PDF for printing

 🖼 Screenshots

 User Side
| Page | Screenshot |
|------|------------|
| Login Page | ![User Login](screenshots/user_login.png) |
| Dashboard | ![User Dashboard](screenshots/user_dashboard.png) |
| Quiz Page | ![Quiz](screenshots/quiz_page.png) |
| Quiz Complete | ![Quiz Done](screenshots/quiz_done.png) |

 Admin Side
| Page | Screenshot |
|------|------------|
| Login Page | ![Admin Login](screenshots/admin_login.png) |
| Dashboard | ![Admin Dashboard](screenshots/admin_dashboard.png) |
| Create Test | ![Create Test](screenshots/create_test.png) |
| Test Details | ![Test Details](screenshots/test_details.png) |
| Add Question | ![Add Question](screenshots/add_question.png) |
| Student Result | ![Student Result](screenshots/student_result.png) |


👨‍💻 User Side
- Students can register and login securely
- Choose from available quizzes
- Answer multiple-choice questions
- Submit quiz and view instant results

 👩‍🏫 Admin Side
- Login to Admin Panel
- Create new quizzes and manage existing ones
- Add classes and students
- Import questions from spreadsheets
- Track student scores and quiz statistics
- Generate PDF of student login credentials

## ⚡ Steps to Install
1. Clone the repository:
bash
git clone https://github.com/Dolphin7890/Online-Quiz-System.git

2. Copy the project into your **WAMP/LAMP/XAMPP** folder.
3. Create a database in MySQL (e.g., `quiz_db`).
4. Import `script.sql` from the database folder.
5. For sample data, import `sampleData.sql`.
6. Update database credentials in `config.php`.
7. Run the project in your local server:

```url
http://localhost/Online-Quiz-System/
```

8. Default admin credentials:

```
email: admin@example.com
Password: admin123
```

---

 🔎 Project Overview

* Random passwords are generated for students for each quiz.
* Admin dashboard allows:

  * Creating new quizzes
  * Managing existing quizzes
 
* Student dashboard allows:

  * Viewing available quizzes
  * Taking quizzes
  * Checking results immediately

 🛠 Technology Stack

* **Frontend:** HTML, CSS, Bootstrap 5
* **Backend:** PHP
* **Database:** MySQL

## 🤝 Collaborate with Us

Want to contribute? Follow these steps:

1. Fork the repository
2. Create a new branch:

```bash
git checkout -b improve-feature
```

3. Make changes
4. Commit your changes:

```bash
git commit -am 'Improve feature'
```

5. Push your branch:

```bash
git push origin improve-feature
```

6. Open a Pull Request

---

## 🐛 Bug / Feature Request

* Found a bug? Open an [Issue](https://github.com/Dolphin7890/Online-Quiz-System/issues)
* Want a new feature? Open an [Issue](https://github.com/Dolphin7890/Online-Quiz-System/issues)

---

**Made with ❤️ by [Dolphin7890](https://github.com/Dolphin7890)**

