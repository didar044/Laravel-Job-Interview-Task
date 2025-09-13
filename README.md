# 📚 Laravel Course Management System


A Laravel-based web application for creating and managing **Courses, Modules, and Contents**.  
This project was built as part of a **Laravel Job Interview Task Assessment**.  

---

## 🚀 Features
- Create, edit, and delete **Courses**  
- Add unlimited **Modules** inside each course  
- Add unlimited **Contents** inside each module  
- Nested view of Course → Modules → Contents  
- Frontend validation with **HTML, CSS, JavaScript, and jQuery**  
- Backend validation with **Laravel**  
- Proper relational database design (One-to-Many, Nested)  
- Error handling & user-friendly feedback  

---

## ⚙️ Project Setup Instructions

1. **Download the project**
   - Go to the GitHub repo: [https://github.com/didar044/Laravel-Job-Interview-Task](https://github.com/didar044/Laravel-Job-Interview-Task)  
   - Click **Code → Download ZIP**  
   - Extract the ZIP file to your local machine  

2. **Install dependencies**
   - Open a terminal inside the project folder
   ```bash
   composer install
   npm install && npm run dev


3. **Environment setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

   - Configure your database in `.env` file (e.g., DB_DATABASE, DB_USERNAME, DB_PASSWORD).

4. **Run migrations**
   ```bash
   php artisan migrate
   ```

5. **Start development server**
   ```bash
   php artisan serve
   ```

6. Open in browser:
   ```
   http://127.0.0.1:8000
   ```

---

## 🗂️ Project Structure
- **Courses** → Main entity (title, description, category, etc.)
- **Modules** → Belongs to a course (title, description, etc.)
- **Contents** → Belongs to a module (text, image, video, links, etc.)

---



---

## 👨‍💻 Tech Stack
- **Backend:** Laravel 10, PHP 8+
- **Frontend:** HTML, CSS, Vanilla JavaScript, jQuery
- **Database:** MySQL
- **Other Tools:** Composer, NPM, Artisan CLI

---

## 👨‍🎓 Author
- **Md Didarul Islam**  
- Email: mddidar199911@gmail.com 
- GitHub: https://github.com/didar044  
---

## 📩 Submission
This project is submitted as part of the **Laravel Job Interview Task Assessment**.  
Repo link: https://github.com/didar044/Laravel-Job-Interview-Task
