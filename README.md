# 📄 Resume Keyword Analyzer

A PHP-based web application that analyzes resume images uploaded by users, extracts text using Tesseract OCR, and searches for key skills/keywords from a predefined XML database. Styled with Tailwind CSS and includes email functionality via PHPMailer.

## 🚀 Features

- 📷 Upload resume image files (JPG, PNG, etc.)
- 🧠 OCR-based text extraction using **Tesseract**
- 🔍 Keyword matching against an XML database
- 📧 Email results to users using **PHPMailer**
- 🎨 Clean UI powered by **Tailwind CSS**

---

## 🛠️ Tech Stack

| Technology    | Purpose                      |
|---------------|------------------------------|
| PHP           | Backend logic                |
| Tesseract OCR | Text extraction from images  |
| Tailwind CSS  | Responsive and modern styling|
| XML           | XMLHttpRequests              |
| PHPMailer     | Sending email notifications  |

---

## 📁 Project Structure

```plaintext
├── uploads/                 # Uploaded resume images
├── results/                 # Output results (optional)
├── index.php                # Main upload UI
├── process.php              # OCR + keyword matching
├── mailer.php               # Email sending script
├── assets/                  # Tailwind CSS, images
├── README.md                # This file
