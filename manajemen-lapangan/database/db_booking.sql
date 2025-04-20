-- Struktur tabel users
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone VARCHAR(20) NOT NULL
);

-- Struktur tabel fields
CREATE TABLE IF NOT EXISTS fields (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    type VARCHAR(50) NOT NULL,
    location VARCHAR(100) NOT NULL
);

-- Struktur tabel bookings
CREATE TABLE IF NOT EXISTS bookings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    field_id INT NOT NULL,
    booking_date DATE NOT NULL,
    time_slot VARCHAR(20) NOT NULL,
    status VARCHAR(20) NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (field_id) REFERENCES fields(id) ON DELETE CASCADE
);

-- Data dummy users
INSERT INTO users (name, email, phone) VALUES
('Budi Santoso', 'budi@example.com', '08123456789'),
('Siti Aminah', 'siti@example.com', '08129876543');

-- Data dummy fields
INSERT INTO fields (name, type, location) VALUES
('Lapangan Futsal A', 'Futsal', 'Jl. Merdeka 1'),
('Lapangan Basket B', 'Basket', 'Jl. Sudirman 2');

-- Data dummy bookings
INSERT INTO bookings (user_id, field_id, booking_date, time_slot, status) VALUES
(1, 1, '2025-04-21', '08:00-10:00', 'Booked'),
(2, 2, '2025-04-22', '10:00-12:00', 'Booked');
