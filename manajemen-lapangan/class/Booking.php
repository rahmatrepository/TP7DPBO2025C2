<?php
require_once __DIR__ . '/../config/db.php'; 

class Booking {   
    private $conn; 

    // Konstruktor untuk menginisialisasi koneksi database
    public function __construct() { 
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // Fungsi untuk mendapatkan semua data booking, dengan opsi pencarian
    public function getAll($search = '') {
        $sql = 'SELECT b.*, u.name as user_name, f.name as field_name FROM bookings b 
                JOIN users u ON b.user_id = u.id 
                JOIN fields f ON b.field_id = f.id';
        if ($search) {
            $sql .= ' WHERE u.name LIKE :search OR f.name LIKE :search'; // Filter berdasarkan nama pengguna atau nama lapangan
        }
        $sql .= ' ORDER BY b.booking_date DESC, b.time_slot'; // Urutkan berdasarkan tanggal booking dan slot waktu
        $stmt = $this->conn->prepare($sql);
        if ($search) {
            $stmt->bindValue(':search', "%$search%", PDO::PARAM_STR); // Bind parameter pencarian
        }
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Kembalikan hasil sebagai array asosiatif
    }

    // Fungsi untuk mendapatkan data booking berdasarkan ID
    public function getById($id) {
        $stmt = $this->conn->prepare('SELECT * FROM bookings WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC); // Kembalikan hasil sebagai array asosiatif
    }

    // Fungsi untuk membuat data booking baru
    public function create($user_id, $field_id, $booking_date, $time_slot, $status) {
        $stmt = $this->conn->prepare('INSERT INTO bookings (user_id, field_id, booking_date, time_slot, status) VALUES (?, ?, ?, ?, ?)');
        return $stmt->execute([$user_id, $field_id, $booking_date, $time_slot, $status]); // Eksekusi query
    }

    // Fungsi untuk memperbarui data booking berdasarkan ID
    public function update($id, $user_id, $field_id, $booking_date, $time_slot, $status) {
        $stmt = $this->conn->prepare('UPDATE bookings SET user_id=?, field_id=?, booking_date=?, time_slot=?, status=? WHERE id=?');
        return $stmt->execute([$user_id, $field_id, $booking_date, $time_slot, $status, $id]); // Eksekusi query
    }

    // Fungsi untuk menghapus data booking berdasarkan ID
    public function delete($id) {
        $stmt = $this->conn->prepare('DELETE FROM bookings WHERE id=?');
        return $stmt->execute([$id]); // Eksekusi query
    }
}
?>
