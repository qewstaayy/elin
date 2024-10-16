# Pandawa Employee Management System

Pandawa Employee Management System adalah aplikasi sederhana untuk mengelola data karyawan. Aplikasi ini memungkinkan pengguna untuk menambahkan informasi karyawan termasuk nama, email, nomor telepon, alamat, tanggal masuk, informasi bank, nomor BPJS, gender, ukuran pakaian, dan mengunggah foto KTP, KK, serta ijazah.

## Fitur

- Tambah karyawan dengan informasi lengkap.
- Upload foto KTP, KK, dan Ijazah.
- Validasi form input.
- Tampilan yang user-friendly dengan HTML dan CSS.

## Persyaratan

- PHP
- MySQL
- XAMPP atau server lokal lainnya

## Instalasi

1. Clone repository ini ke direktori lokal Anda:

    ```bash
    git clone https://github.com/username/pandawa-employee-management-system.git
    ```

2. Pindah ke direktori proyek:

    ```bash
    cd pandawa-employee-management-system
    ```

3. Buat database baru di MySQL dan import file `database.sql` untuk membuat tabel yang diperlukan.

4. Konfigurasi koneksi database di file `config.php`:

    ```php
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "employee_managements";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    ?>
    ```

## Penggunaan

1. Jalankan XAMPP dan nyalakan Apache serta MySQL.
2. Buka browser dan akses `http://localhost/employee_managements/`.
3. Form untuk menambah karyawan dapat diakses di `http://localhost/employee_managements/add_employee.php`.

## Struktur Proyek

- `index.php`: Halaman utama.
- `add_employee.php`: Script untuk menambah karyawan.
- `display.php`: Script untuk menampilkan daftar karyawan.
- `config.php`: Konfigurasi koneksi database.
- `uploads/`: Direktori untuk menyimpan file yang diunggah.
- `styles.css`: File CSS untuk styling form.
- `README.md`: File ini.

## Contoh Tampilan

![Form Tambah Karyawan](./screenshots/form.png)

## Contributing

Jika Anda ingin berkontribusi pada proyek ini, silakan fork repository ini dan buat pull request dengan perubahan Anda.

## Lisensi

Proyek ini dilisensikan di bawah lisensi MIT.

---

Pandawa Employee Management System - Proyek untuk mengelola data karyawan dengan mudah dan efisien.
