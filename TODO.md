# TODO: Perbaikan Sistem Voucher

## Masalah Saat Ini

-   Admin tidak bisa membuat voucher (padahal seharusnya bisa)
-   Alumni dan siswa tidak bisa menggunakan voucher (padahal seharusnya bisa)
-   Admin bisa menggunakan voucher (sudah benar)

## Plan Perbaikan

### 1. Perbaiki Logic Admin Check di VoucherController

-   [x] Update method `isCurrentUserAdmin()` untuk mendukung multiple guard admin
-   [x] Pastikan admin bisa membuat voucher dengan guard 'admin'

### 2. Perbaiki Logic Penggunaan Voucher

-   [x] Pastikan alumni dan siswa bisa menggunakan voucher
-   [x] Update method `isUsedByUser()` jika perlu
-   [ ] Test semua user types bisa menggunakan voucher

### 3. Update View Voucher

-   [x] Pastikan tombol "Gunakan" muncul untuk semua user yang login
-   [x] Update logic pengecekan admin di view

### 4. Testing

-   [ ] Test admin membuat voucher
-   [ ] Test admin menggunakan voucher
-   [ ] Test alumni menggunakan voucher
-   [ ] Test siswa menggunakan voucher
-   [ ] Test user yang belum login tidak bisa menggunakan voucher

## Files yang Perlu Diubah

-   app/Http/Controllers/VoucherController.php
-   resources/views/voucher.blade.php
-   app/Models/Voucher.php (jika perlu)
