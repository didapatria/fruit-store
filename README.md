# 🍏 Fruit Store App

Fruit Store App adalah aplikasi berbasis Laravel dan Vue.js dengan desain **mobile-first**, mendukung fitur e-commerce seperti manajemen produk, shopping cart, dan sistem pemesanan.

## 📌 Persyaratan
Sebelum menjalankan proyek, pastikan kamu memiliki:
- **PHP 8+**
- **Composer**
- **Node.js & npm**
- **MySQL atau PostgreSQL**
- **Laravel 10+**

---

## 🚀 Cara Menjalankan Project

### **Clone Repository**
```sh
git clone https://github.com/didapatria/fruit-store.git
cd fruit-store
```

### **Install Dependencies**
```sh
npm install && npm run build
composer install
```

### **Konfigurasi Environment**
Copy file `.env.example` dan buat file `.env` baru:
```sh
cp .env.example .env
```
Kemudian atur database di `.env`:
```ini
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=fruit_store
DB_USERNAME=root
DB_PASSWORD=
```

### **Generate App Key**
```sh
php artisan key:generate
```

### **Migrate & Seed Database**
```sh
php artisan migrate --seed
```

### **Publish Spatie Activity Log**
```sh
php artisan vendor:publish --provider="Spatie\Activitylog\ActivitylogServiceProvider"
```

### **Jalankan Development Server**
```sh
composer run dev
```

Aplikasi sekarang berjalan di **http://127.0.0.1:8000** 🚀🎉
