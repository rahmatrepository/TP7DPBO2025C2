<?php
class Database {
    private $host = 'localhost'; // Host database                        
    private $db_name = 'booking_lapangan';//  Nama database
    // Nama database yang digunakan untuk menyimpan data booking lapangan
    private $username = 'root'; // Username untuk koneksi database
    // Username yang digunakan untuk mengakses database
    private $password = '';     // Password untuk koneksi database
    // Password yang digunakan untuk mengakses database
    public $conn;           // Koneksi database

    public function getConnection() {
        $this->conn = null;         // Inisialisasi koneksi menjadi null
        // Mencoba untuk membuat koneksi ke database menggunakan PDO
        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);// Mengatur mode error PDO menjadi exception
        } catch(PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();// Menampilkan pesan error jika koneksi gagal
        }
        return $this->conn;
    }
}
?>
