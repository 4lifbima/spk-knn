# 🎓 SPK Smart - Sistem Pendukung Keputusan K-Nearest Neighbors

Aplikasi web berbasis Laravel 12 untuk analisis kelayakan inventaris menggunakan algoritma K-Nearest Neighbors (KNN).

## 🌟 Fitur Utama

- ✅ **Dashboard Overview** - Statistik real-time inventaris
- ✅ **Manajemen Dataset** - CRUD data inventaris dengan auto-status
- ✅ **Preprocessing** - Visualisasi normalisasi Min-Max
- ✅ **Proses KNN** - Kalkulasi dengan Euclidean Distance
- ✅ **Riwayat Analisis** - Track semua perhitungan dengan detail
- ✅ **Profile Management** - Update profil & foto (tanpa storage link)
- ✅ **Password Settings** - Ubah kata sandi dengan validasi
- ✅ **Dark Mode** - Toggle tema terang/gelap (persistent)
- ✅ **Responsive Design** - Mobile-friendly & modern UI

## 🛠️ Tech Stack

- **Backend**: Laravel 12, PHP 8.2
- **Auth**: Laravel Breeze
- **Database**: MySQL/MariaDB
- **Frontend**: Tailwind CSS (via CDN), Lucide Icons
- **Font**: Plus Jakarta Sans

## 📦 Instalasi Cepat

```bash
# 1. Clone atau extract project
git clone https://github.com/4lifbima/spk-knn.git

# 2. Install dependencies
composer install

# 3. Setup environment
cp .env.example .env
php artisan key:generate

# 4. Konfigurasi database di .env
DB_DATABASE=spk_smart
DB_USERNAME=root
DB_PASSWORD=

# 5. Jalankan migration & seeder
php artisan migrate
php artisan db:seed --class=InventarisSeeder

# 6. Buat folder upload
mkdir -p public/uploads/profile
chmod -R 775 public/uploads

# 7. Jalankan aplikasi
php artisan serve
```

Akses: `http://localhost:8000`

## 📂 File Structure

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── DashboardController.php      # Dashboard overview
│   │   ├── InventarisController.php     # CRUD dataset
│   │   ├── KnnController.php            # Proses KNN & preprocessing
│   │   ├── HistoryController.php        # Riwayat analisis
│   │   ├── ProfileController.php        # Update profil (modified)
│   │   └── SettingsController.php       # Password settings (NEW)
│   └── Requests/
│       └── ProfileUpdateRequest.php
├── Models/
│   ├── User.php                         # Updated with relations
│   ├── Inventaris.php
│   └── HistoryKnn.php
database/
├── migrations/
│   ├── xxxx_add_profile_fields_to_users_table.php
│   ├── xxxx_create_inventaris_table.php
│   └── xxxx_create_history_knn_table.php
└── seeders/
    └── InventarisSeeder.php
resources/views/dashboard/
├── layout.blade.php                     # Main layout
├── index.blade.php                      # Dashboard
├── dataset.blade.php                    # Dataset management
├── preprocessing.blade.php              # Preprocessing view
├── process.blade.php                    # KNN process
├── history.blade.php                    # History list
├── profile.blade.php                    # Profile edit
└── settings.blade.php                   # Password settings (NEW)
routes/
└── web.php                              # All routes
```

## 🎯 Routes

| Method | URI | Controller | Name |
|--------|-----|------------|------|
| GET | /dashboard | DashboardController@index | dashboard |
| GET | /dataset | InventarisController@index | dataset.index |
| POST | /dataset | InventarisController@store | dataset.store |
| DELETE | /dataset/{id} | InventarisController@destroy | dataset.destroy |
| GET | /preprocessing | KnnController@preprocessing | preprocessing |
| GET | /process | KnnController@index | process.index |
| POST | /process/calculate | KnnController@calculate | process.calculate |
| GET | /history | HistoryController@index | history.index |
| GET | /history/{id} | HistoryController@show | history.show |
| GET | /profile | ProfileController@edit | profile.edit |
| PATCH | /profile | ProfileController@update | profile.update |
| GET | /settings | SettingsController@index | settings.index |
| PATCH | /settings/password | SettingsController@updatePassword | settings.password |

## 💾 Database Schema

### Users Table
```
- id
- name
- username (unique, nullable)
- email (unique)
- password
- role (default: 'Kepala Bagian Sarana')
- photo (nullable, stored in public/uploads/profile/)
- timestamps
```

### Inventaris Table
```
- id
- nama
- kondisi (1-5)
- jumlah
- tahun
- status (Layak/Perlu Diganti/Perawatan)
- status_val (0, 0.5, 1)
- timestamps
```

### History KNN Table
```
- id
- user_id (foreign)
- k_value
- input_kondisi
- input_jumlah
- result
- confidence
- neighbors (JSON)
- timestamps
```

## 🎨 Design Features

### Preserved from Original HTML
✅ Warna primary: `#301CA0`  
✅ Font: Plus Jakarta Sans  
✅ Layout sidebar + content area  
✅ Grid responsif (1/2/3/4 columns)  
✅ Dark mode toggle dengan localStorage  
✅ Lucide icons  
✅ Smooth animations (fadeUp)  
✅ Custom scrollbar  

### Menu Sidebar
1. Dashboard
2. Dataset Sarana
3. Preprocessing
4. Proses KNN
5. Riwayat
6. Profil
7. **Pengaturan** (NEW - untuk ubah password)
8. Logout

## 🔐 Authentication

Menggunakan Laravel Breeze (sudah terinstall):
- Register: `/register`
- Login: `/login`
- Logout: Form POST ke `/logout`

## 📸 Upload Foto

**PENTING**: Foto profil TIDAK menggunakan `storage:link`

```php
// Lokasi penyimpanan
public/uploads/profile/TIMESTAMP_FILENAME.jpg

// Akses di view
<img src="{{ asset($user->photo) }}">

// Contoh: public/uploads/profile/1703123456_avatar.jpg
```

Pastikan folder exists & writable:
```bash
mkdir -p public/uploads/profile
chmod -R 775 public/uploads
```

## 🧮 Algoritma KNN

### Normalisasi Min-Max
```
x' = (x - min) / (max - min)
```

### Euclidean Distance
```
d = √Σ(xi - yi)²
```

### Voting
- K = jumlah tetangga terdekat (1, 3, 5, 7)
- Majority vote dari K tetangga
- Confidence = (max_vote / K) × 100%

## 📝 Usage Examples

### 1. Tambah Data Inventaris
```
Nama: Komputer Desktop HP
Kondisi: 4 (Baik)
Jumlah: 15
Tahun: 2022
→ Auto Status: "Layak" (kondisi >= 4)
```

### 2. Proses KNN
```
Input:
- K Value: 3
- Kondisi: 5
- Jumlah: 10

Output:
- 3 Tetangga Terdekat dengan jarak
- Hasil: "Layak Digunakan" / "Perlu Diganti"
- Confidence: 100% (3/3) atau 66.7% (2/3)
```

### 3. Update Profil
```
Form Fields:
- Nama Lengkap
- Username
- Email
- Role
- Foto Profil (JPG/PNG, max 2MB)

→ Foto tersimpan di public/uploads/profile/
```

### 4. Ubah Password
```
Form Fields:
- Kata Sandi Saat Ini
- Kata Sandi Baru (min 8 karakter)
- Konfirmasi Kata Sandi Baru

Validasi:
- Current password harus benar
- New password minimal 8 karakter
- Confirmation harus match
```

## 🐛 Troubleshooting

### Error: SQLSTATE Connection Refused
```bash
# Check MySQL service
sudo systemctl start mysql

# Atau update .env
DB_HOST=127.0.0.1
DB_PORT=3306
```

### Error: Permission denied (upload)
```bash
chmod -R 775 public/uploads
sudo chown -R $USER:www-data public/uploads
```

### Error: Route not found
```bash
php artisan route:clear
php artisan cache:clear
php artisan config:clear
```

### Dark mode tidak tersimpan
Pastikan browser tidak dalam mode incognito/private

### Foto tidak muncul
```bash
# Check file exists
ls -la public/uploads/profile/

# Check permissions
chmod 644 public/uploads/profile/*
```

## 🚀 Production Deployment

```bash
# Optimize
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Set environment
APP_ENV=production
APP_DEBUG=false
```

## 📊 Data Sample

Seeder menyediakan 8 data inventaris:
1. Laptop Dell XPS (Layak)
2. Proyektor Epson (Perlu Diganti)
3. Meja Kantor Kayu (Layak)
4. Kursi Staff (Perlu Diganti)
5. AC Panasonic 2PK (Perawatan)
6. Printer HP LaserJet (Layak)
7. Router Cisco (Layak)
8. Lemari Arsip Besi (Perlu Diganti)

## 🎓 Credits

- **Framework**: Laravel 12
- **Auth**: Laravel Breeze
- **UI**: Tailwind CSS + Lucide Icons
- **Font**: Plus Jakarta Sans (Google Fonts)
- **Algorithm**: K-Nearest Neighbors

## 📄 License

Open source - bebas digunakan untuk keperluan edukasi & Tugas Kuliah.

---

**Developed with ❤️ using Laravel 12**
Alif Bima Pradana