<?php
// class/User.php
require_once __DIR__ . '/../config/db.php';// Menggunakan require_once untuk memastikan file hanya dimuat sekali
// Menggunakan require_once untuk menghindari pemanggilan berulang yang dapat menyebabkan error
class User {
    private $conn;
    public function __construct() {
       
        $database = new Database();
        $this->conn = $database->getConnection();// Menginisialisasi koneksi database
    }
    public function getAll() {
        $stmt = $this->conn->prepare('SELECT * FROM users');// Mengambil semua data dari tabel users
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getById($id) {
        $stmt = $this->conn->prepare('SELECT * FROM users WHERE id = ?');// Mengambil data berdasarkan ID
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);// Mengambil data sebagai array asosiatif
    }
    public function create($name, $email, $phone) {
        $stmt = $this->conn->prepare('INSERT INTO users (name, email, phone) VALUES (?, ?, ?)');
        return $stmt->execute([$name, $email, $phone]);// Menyimpan data baru ke dalam tabel users
    }
    public function update($id, $name, $email, $phone) {
        $stmt = $this->conn->prepare('UPDATE users SET name=?, email=?, phone=? WHERE id=?');
        return $stmt->execute([$name, $email, $phone, $id]);// Memperbarui data berdasarkan ID
    }
    public function delete($id) {
        $stmt = $this->conn->prepare('DELETE FROM users WHERE id=?');       // Menghapus data berdasarkan ID
        // Pastikan untuk menghapus data terkait di tabel lain jika ada
        return $stmt->execute([$id]);       // Eksekusi query untuk menghapus data
    }
}
?>
