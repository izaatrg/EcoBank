# 🚀 EcoBank Quick Reference & Setup Guide

## Prerequisites

```bash
PHP >= 8.0
Composer
MySQL/MariaDB
Node.js & NPM
```

## Initial Setup (If Fresh Installation)

```bash
# 1. Clone/Setup project
cd d:\Laravel10\EcoBank

# 2. Install dependencies
composer install
npm install

# 3. Create .env file (if not exists)
cp .env.example .env

# 4. Generate app key
php artisan key:generate

# 5. Configure database in .env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ecobank
DB_USERNAME=root
DB_PASSWORD=

# 6. Run migrations
php artisan migrate

# 7. Run seeders (optional, untuk sample data)
php artisan db:seed

# 8. Build frontend assets
npm run dev    # Development with file watching
npm run build  # Production build

# 9. Start server
php artisan serve
# Akses: http://localhost:8000
```

## File Structure

```
d:\Laravel10\EcoBank\
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── AdminController.php
│   │   │   ├── PetugasController.php
│   │   │   ├── WargaController.php
│   │   │   ├── KategoriSampahController.php
│   │   │   ├── RewardController.php
│   │   │   ├── TransaksiSetoranController.php
│   │   │   ├── PenjemputanController.php
│   │   │   ├── PenukaranRewardController.php
│   │   │   ├── SaldoKoinController.php
│   │   │   ├── RiwayatKoinController.php
│   │   │   └── ProfileController.php
│   │   ├── Middleware/
│   │   │   └── RoleMiddleware.php
│   │   └── Kernel.php (dengan role middleware alias)
│   └── Models/
│       ├── User.php
│       ├── KategoriSampah.php
│       ├── TransaksiSetoran.php
│       ├── Penjemputan.php
│       ├── Reward.php
│       ├── PenukaranReward.php
│       └── SaldoKoin.php
├── routes/
│   ├── web.php (terorganisir dengan role-based groups)
│   └── auth.php
├── resources/views/
│   ├── layouts/
│   │   ├── admin.blade.php
│   │   ├── petugas.blade.php
│   │   └── warga.blade.php
│   ├── admin/
│   │   ├── dashboard.blade.php
│   │   ├── kategori/*
│   │   ├── reward/*
│   │   ├── petugas/*
│   │   ├── warga/*
│   │   ├── transaksi/*
│   │   └── penjemputan/*
│   ├── petugas/
│   │   ├── dashboard.blade.php
│   │   ├── profile.blade.php
│   │   ├── setoran/*
│   │   └── penjemputan/*
│   └── warga/
│       ├── dashboard.blade.php
│       ├── profile.blade.php
│       ├── setor/
│       ├── jemput/
│       └── tukar/
└── database/
    ├── migrations/
    └── seeders/
```

## Key Routes

### Admin Routes

```
GET     /admin/dashboard                    → AdminController@dashboard
GET     /admin/kategori                     → KategoriSampahController@index
POST    /admin/kategori                     → KategoriSampahController@store
GET     /admin/kategori/{id}/edit           → KategoriSampahController@edit
PATCH   /admin/kategori/{id}                → KategoriSampahController@update
DELETE  /admin/kategori/{id}                → KategoriSampahController@destroy

GET     /admin/reward                       → RewardController@index
POST    /admin/reward                       → RewardController@store
GET     /admin/reward/{id}/edit             → RewardController@edit
PATCH   /admin/reward/{id}                  → RewardController@update
DELETE  /admin/reward/{id}                  → RewardController@destroy

GET     /admin/warga                        → WargaController@index
POST    /admin/warga                        → WargaController@store
GET     /admin/warga/{id}/edit              → WargaController@edit
PATCH   /admin/warga/{id}                   → WargaController@update
DELETE  /admin/warga/{id}                   → WargaController@destroy

GET     /admin/petugas                      → PetugasController@index
POST    /admin/petugas                      → PetugasController@store
GET     /admin/petugas/{id}/edit            → PetugasController@edit
PATCH   /admin/petugas/{id}                 → PetugasController@update
DELETE  /admin/petugas/{id}                 → PetugasController@destroy

GET     /admin/transaksi                    → TransaksiSetoranController@index
POST    /admin/transaksi                    → TransaksiSetoranController@store
GET     /admin/transaksi/{id}/edit          → TransaksiSetoranController@edit
PATCH   /admin/transaksi/{id}               → TransaksiSetoranController@update
DELETE  /admin/transaksi/{id}               → TransaksiSetoranController@destroy

GET     /admin/penjemputan                  → PenjemputanController@index
POST    /admin/penjemputan                  → PenjemputanController@store
GET     /admin/penjemputan/{id}/edit        → PenjemputanController@edit
PATCH   /admin/penjemputan/{id}             → PenjemputanController@update
DELETE  /admin/penjemputan/{id}             → PenjemputanController@destroy
```

### Petugas Routes

```
GET     /petugas/dashboard                  → PetugasController@dashboard
GET     /petugas/setoran                    → TransaksiSetoranController@indexPetugas
GET     /petugas/setoran/create             → TransaksiSetoranController@createPetugas
POST    /petugas/setoran                    → TransaksiSetoranController@storePetugas
GET     /petugas/setoran/{id}/edit          → TransaksiSetoranController@editPetugas
PATCH   /petugas/setoran/{id}               → TransaksiSetoranController@updatePetugas
DELETE  /petugas/setoran/{id}               → TransaksiSetoranController@destroyPetugas

GET     /petugas/penjemputan                → PenjemputanController@index
GET     /petugas/penjemputan/{id}           → PenjemputanController@show
PATCH   /petugas/penjemputan/{id}/status    → PenjemputanController@updateStatus

GET     /petugas/riwayat                    → TransaksiSetoranController@showRiwayatPetugas
GET     /petugas/profile                    → PetugasController@showProfile
PATCH   /petugas/profile                    → PetugasController@updateProfile
```

### Warga Routes

```
GET     /warga/dashboard                    → WargaController@dashboard

GET     /warga/setor                        → TransaksiSetoranController@showFormWarga
POST    /warga/setor                        → TransaksiSetoranController@storeWarga

GET     /warga/jemput                       → PenjemputanController@showFormWarga
POST    /warga/jemput                       → PenjemputanController@storeWarga
GET     /warga/jemput-history               → PenjemputanController@historyWarga

GET     /warga/tukar                        → PenukaranRewardController@showFormWarga
POST    /warga/tukar                        → PenukaranRewardController@storeWarga
GET     /warga/tukar-history                → PenukaranRewardController@historyWarga

GET     /warga/riwayat                      → TransaksiSetoranController@showRiwayatWarga
GET     /warga/profile                      → WargaController@showProfile
PATCH   /warga/profile                      → WargaController@updateProfile
```

## Test Credentials

### Setup Test Users

Buat user dengan seeder atau manual SQL:

```sql
-- Admin
INSERT INTO users (name, email, password, role, created_at, updated_at)
VALUES ('Admin', 'admin@ecobank.test', bcrypt('password'), 'admin', NOW(), NOW());

-- Petugas
INSERT INTO users (name, email, password, role, created_at, updated_at)
VALUES ('Petugas', 'petugas@ecobank.test', bcrypt('password'), 'petugas', NOW(), NOW());

-- Warga
INSERT INTO users (name, email, password, role, created_at, updated_at)
VALUES ('Warga', 'warga@ecobank.test', bcrypt('password'), 'warga', NOW(), NOW());
```

Atau gunakan factory:

```bash
php artisan tinker
User::factory(10)->create(['role' => 'admin'])
User::factory(10)->create(['role' => 'petugas'])
User::factory(50)->create(['role' => 'warga'])
```

## Common Issues & Solutions

### Issue: Routes tidak ditemukan

**Solution:** Run `php artisan route:list` untuk verify semua routes

### Issue: View not found

**Solution:** Check blade filename case-sensitive di Windows

### Issue: Middleware not protecting routes

**Solution:** Verify 'role' middleware terdaftar di Kernel.php

### Issue: Database connection error

**Solution:** Check .env DB\_\* settings dan pastikan MySQL running

### Issue: Assets not loading

**Solution:** Run `npm run build` dan clear cache

## Useful Commands

```bash
# View all routes
php artisan route:list

# Clear caches
php artisan cache:clear
php artisan view:clear
php artisan config:clear

# Generate admin/petugas/warga users
php artisan tinker
User::factory(5)->create(['role' => 'admin'])
User::factory(5)->create(['role' => 'petugas'])
User::factory(20)->create(['role' => 'warga'])

# Run tests
php artisan test

# Check model structure
php artisan model:show User

# Generate missing views
php artisan make:view admin.penukaran.index
```

## Next Phase Recommendations

1. **Implement remaining views** - admin/penukaran, admin/saldo, petugas/setoran, warga/tukar
2. **Add search & filters** - di list views
3. **Add pagination** - ensure working sa lahat ng list views
4. **Export to PDF** - E-Struk functionality
5. **Email notifications** - when status changes
6. **API Development** - untuk mobile app
7. **Admin Reports** - dengan charts & graphs

---

**Tip:** Use `php artisan serve` untuk testing locally  
**Debug Mode:** Set `APP_DEBUG=true` sa .env untuk detailed error messages
