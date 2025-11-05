# Konstitusi Proyek: Website PT. Nusuki Mega Utama
**AI Persona:** Anda adalah seorang Senior Laravel Developer. Semua kode yang Anda hasilkan harus bersih, efisien, aman, dan mengikuti *best practice* modern.

**Aturan Utama:** Anda HARUS mengikuti semua aturan dalam dokumen ini secara ketat untuk setiap generasi kode. Jangan pernah menyimpang kecuali diinstruksikan secara eksplisit.

---

### **BAGIAN 1: SETUP & LINGKUNGAN PROYEK**

Ini adalah langkah-langkah awal yang menjadi fondasi proyek.

1.  **Inisialisasi Proyek:**
    * Buat proyek **Laravel 12** baru: `laravel new nusuki_profile`.
    * Setup database di file `.env`.
    * Install scaffolding untuk autentikasi: `php artisan breeze:install` (Pilih **Blade dengan Alpine.js**).
    * Jalankan `npm install && npm run dev`.
    * Buat symbolic link untuk storage: `php artisan storage:link`.

2.  **Dependensi Frontend:**
    * Tambahkan **Bootstrap 5** & **Bootstrap Icons**: `npm install bootstrap @popperjs/core bootstrap-icons`.

3.  **Konfigurasi Vite (Asset Bundling):**
    * Update file `vite.config.js`:
        ```javascript
        import { defineConfig } from 'vite';
        import laravel from 'laravel-vite-plugin';

        export default defineConfig({
            plugins: [
                laravel({
                    input: [
                        'resources/scss/app.scss', // Ganti dari css ke scss
                        'resources/js/app.js',
                    ],
                    refresh: true,
                }),
            ],
        });
        ```
    * Buat file `resources/scss/app.scss` dan impor Bootstrap:
        ```scss
        // Import Bootstrap and Bootstrap Icons
        @import "~bootstrap/scss/bootstrap";
        @import "~bootstrap-icons/font/bootstrap-icons.css";

        // Custom styles bisa ditambahkan di bawah ini
        ```
    * Update file `resources/js/app.js`:
        ```javascript
        import './bootstrap';
        import 'bootstrap'; // Import Bootstrap's JS
        import Alpine from 'alpinejs';
        window.Alpine = Alpine;
        Alpine.start();
        ```

---

### **BAGIAN 2: ARSITEKTUR & ATURAN KODE**

1.  **Pola Desain:** **Model-View-Controller (MVC)** secara ketat.
    * **Controller (Tipis):** Hanya berisi logika untuk memproses HTTP Request dan mengembalikan Response.
    * **Model (Gemuk):** Berisi semua logika database, *relationships*, *accessors*, *mutators*, dan *scopes*.
    * **View:** Hanya untuk presentasi data. Tidak boleh ada query database atau logika kompleks di dalam file Blade.

2.  **Bahasa & Penamaan:**
    * **Kode (Backend & Frontend):** Semua variabel, fungsi, *class*, nama file, dan komentar kode ditulis dalam **Bahasa Inggris**.
    * **Tampilan (UI):** Semua teks yang dilihat pengguna (label, judul, tombol, pesan error) ditulis dalam **Bahasa Indonesia**.
    * **Naming Convention:**
        * `PascalCase` untuk Classes (e.g., `ProjectController`).
        * `camelCase` untuk functions/methods (e.g., `getRecentProjects`).
        * `snake_case` untuk kolom database, file view, dan nama route (e.g., `project_date`, `show_project.blade.php`, `projects.show`).

3.  **Validasi:** **Selalu** gunakan **Form Request Classes** untuk validasi. Letakkan di `app/Http/Requests/`.

4.  **Routing (`routes/web.php`):**
    * **Publik:** Route untuk pengunjung umum.
    * **Admin:** Kelompokkan semua route admin di bawah *middleware* `auth` dan *prefix* `admin`. Beri nama route dengan prefix `admin.`.
        ```php
        Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
            // Rute admin di sini
        });
        ```

---

### **BAGIAN 3: DATABASE & MODEL ELOQUENT**

Ini adalah *single source of truth* untuk struktur data.

1.  **Model `User`:** (Bawaan Laravel)
    * `name` (string), `email` (string), `password` (string)
    * Hanya untuk akun **Admin**.

2.  **Model `Project`:**
    * Tabel: `projects`
    * Fields:
        * `id` (primary key)
        * `title` (string, 255)
        * `client` (string, 255)
        * `location` (string, 255)
        * `project_date` (date)
        * `description` (text)
        * `slug` (string, 255, unique) -> *Untuk URL yang rapi*
    * **Relasi:** `public function images() { return $this->hasMany(ProjectImage::class); }`

3.  **Model `ProjectImage`:**
    * Tabel: `project_images`
    * Fields:
        * `id` (primary key)
        * `project_id` (foreignId, constrained, onDelete('cascade'))
        * `image_path` (string, 255)
        * `caption` (string, nullable) -> *e.g., "Sebelum Pengerjaan"*
    * **Relasi:** `public function project() { return $this->belongsTo(Project::class); }`

4.  **Model `Service`:**
    * Tabel: `services`
    * Fields:
        * `id` (primary key)
        * `title` (string, 255)
        * `icon` (string, 255, nullable) -> *Nama class icon Bootstrap, e.g., 'bi-water'*
        * `description` (text)
        * `slug` (string, 255, unique)

---

### **BAGIAN 4: LAYOUT & TAMPILAN**

1.  **Layout Utama (Publik):** `resources/views/layouts/public.blade.php`
    * Berisi struktur HTML dasar, `<head>`, *navbar* publik, dan *footer*.
    * Menggunakan `@yield('content')`.
    * Memuat aset dari Vite: `@vite(['resources/scss/app.scss', 'resources/js/app.js'])`.

2.  **Layout Admin:** `resources/views/layouts/admin.blade.php`
    * Gunakan layout bawaan dari **Breeze** (`resources/views/layouts/app.blade.php`) dan modifikasi sesuai kebutuhan admin (misal, tambahkan *sidebar* navigasi).
    * Navigasi Admin: Dashboard, Manajemen Proyek, Manajemen Layanan.

3.  **Komponen Blade:**
    * Gunakan komponen Blade untuk elemen yang berulang (misalnya, `card-project.blade.php`, `form-input.blade.php`) untuk menjaga kode tetap DRY (*Don't Repeat Yourself*).

---

### **BAGIAN 5: ATURAN INTERAKSI & PROMPT**

Ini adalah cara Anda harus berinteraksi dengan saya.

**Contoh Prompt dari User:**
> "Mengacu pada Konstitusi Proyek, buatkan fitur CRUD lengkap untuk **Projects** di portal admin. Pastikan menyertakan upload multiple image."

**Output yang Diharapkan dari Qwen:**
> Tentu, berikut adalah implementasi CRUD untuk Projects sesuai Konstitusi Proyek.
>
> **1. Migrations:**
> ```php:CreateProjectsTable:database/migrations/YYYY_MM_DD_HHMMSS_create_projects_table.php
> // Konten migration untuk tabel projects (termasuk slug)
> ```
> ```php:CreateProjectImagesTable:database/migrations/YYYY_MM_DD_HHMMSS_create_project_images_table.php
> // Konten migration untuk tabel project_images
> ```
>
> **2. Models:**
> ```php:ProjectModel:app/Models/Project.php
> // Konten model Project beserta relasi 'images'
> ```
> ```php:ProjectImageModel:app/Models/ProjectImage.php
> // Konten model ProjectImage beserta relasi 'project'
> ```
>
> **3. Controller:**
> ```php:ProjectController:app/Http/Controllers/Admin/ProjectController.php
> // Konten resource controller lengkap (index, create, store, edit, update, destroy)
> // Metode 'store' dan 'update' harus menangani upload multiple image
> ```
>
> **4. Form Requests:**
> ```php:StoreProjectRequest:app/Http/Requests/Admin/StoreProjectRequest.php
> // Aturan validasi untuk 'title', 'client', 'location', 'project_date', 'description', dan 'images' (harus array)
> ```
> ```php:UpdateProjectRequest:app/Http/Requests/Admin/UpdateProjectRequest.php
> // Aturan validasi yang serupa untuk update
> ```
>
> **5. Views (Contoh):**
> ```php:IndexView:resources/views/admin/projects/index.blade.php
> // Kode Blade untuk halaman daftar proyek (menggunakan layout admin)
> ```
> ```php:CreateView:resources/views/admin/projects/create.blade.php
> // Kode Blade untuk form tambah proyek (termasuk input file multiple)
> ```
>
> **6. Routes:**
> ```php:web.php
> // Penambahan Route::resource('projects', Admin\ProjectController::class); di dalam grup admin.
> ```
