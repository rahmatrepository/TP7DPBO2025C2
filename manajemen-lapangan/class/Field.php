<?php
// Memuat file konfigurasi database
require_once __DIR__ . '/../config/db.php';// Menggunakan require_once untuk memastikan file hanya dimuat sekali
// Menggunakan require_once untuk menghindari pemanggilan berulang yang dapat menyebabkan error
class Field {
    private $conn;// Menyimpan koneksi database
    public function __construct() {     // Konstruktor untuk menginisialisasi koneksi database
        $database = new Database();
        $this->conn = $database->getConnection();
    }
    public function getAll() {
        $stmt = $this->conn->prepare('SELECT * FROM fields');
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);// Mengambil semua data dari tabel fields
    }
    public function getById($id) {
        $stmt = $this->conn->prepare('SELECT * FROM fields WHERE id = ?');// Mengambil data berdasarkan ID
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);// Mengambil data sebagai array asosiatif
    }
    public function create($name, $type, $location) {
        $stmt = $this->conn->prepare('INSERT INTO fields (name, type, location) VALUES (?, ?, ?)');
        return $stmt->execute([$name, $type, $location]);// Menyimpan data baru ke dalam tabel fields
    }
    public function update($id, $name, $type, $location) {
        $stmt = $this->conn->prepare('UPDATE fields SET name=?, type=?, location=? WHERE id=?');
        return $stmt->execute([$name, $type, $location, $id]);// Memperbarui data berdasarkan ID
    }
    public function delete($id) {
        $stmt = $this->conn->prepare('DELETE FROM fields WHERE id=?');
        return $stmt->execute([$id]);// Menghapus data berdasarkan ID
    }
}
?>
