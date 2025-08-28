# Secure Coding Exam Lab 🛡️🧑‍💻
Lab ini digunakan untuk uji coba keamanan aplikasi secara static dan manual. Tidak untuk diunggah pada production server, kecuali Anda mengerti risiko yang ditimbulkan.

---

## 🔗 Source

Aplikasi ini merupakan modifikasi dari source asli:
https://github.com/hermanka/scxlab

---

## 🚦 Status Keamanan

Lab ini telah diperbaiki dari beberapa critical vulnerability yang sebelumnya ditemukan, di antaranya:

- 🛡️ **SQL Injection** (login.php, wiki.php) — Sudah menggunakan prepared statement
- 🛡️ **Command Injection** (ping.php) — Input divalidasi dan di-escape
- 🛡️ **Cross-Site Scripting (XSS)** (comment.php) — Output sudah di-encode
- 🛡️ **Insecure Deserialization** (profile.php) — Tidak lagi menggunakan unserialize dari cookie, diganti session
- 🛡️ **Information Disclosure** (crash.php) — Validasi input dan error handling

Setiap perbaikan dilakukan dengan cara sederhana agar kerentanan tidak dapat dieksploitasi.

---

# 🚀 Build and Run

```
> docker compose up -d --build
```

Kunjungi 🌐 http://localhost:8080 via web browser