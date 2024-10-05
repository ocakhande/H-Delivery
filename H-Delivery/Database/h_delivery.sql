
-- Tabloları Oluşturma
CREATE TABLE roles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    role_name VARCHAR(50) NOT NULL
);

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role_id INT NOT NULL,
    FOREIGN KEY (role_id) REFERENCES roles(id)
);

-- Rolleri Ekleme
INSERT INTO roles (role_name) VALUES ('admin'), ('employee');

-- Kullanıcıyı Ekleme
INSERT INTO roles (role_name) VALUES ('admin'), ('employee');
INSERT INTO users (email, password, role_id) VALUES ('admin@example.com', '$2y$10$qOFsezUTKWFp4cIGAQSwmeHkgcq7w9LVRGojISASeyPHPwRK/4jjq', 1);

-- Çalışan bilgilerini içeren tablo
CREATE TABLE employees (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fullName VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    phoneNumber VARCHAR(20) NOT NULL,
    gender VARCHAR(20) NOT NULL,
    birthDate DATE NOT NULL,
    city VARCHAR(50) NOT NULL,
    district VARCHAR(50) NOT NULL,
    address TEXT,
    department VARCHAR(50) NOT NULL,
    position VARCHAR(100) NOT NULL
);

CREATE TABLE cargo_data (
    id INT AUTO_INCREMENT PRIMARY KEY,
    receiverFullName VARCHAR(100) NOT NULL,
    receiverEmail VARCHAR(100) NOT NULL,
    receiverPhoneNumber VARCHAR(20) NOT NULL,
    receiverCity VARCHAR(50) NOT NULL,
    receiverDistrict VARCHAR(50) NOT NULL,
    receiverAddress TEXT NOT NULL,
    senderFullName VARCHAR(100) NOT NULL,
    senderEmail VARCHAR(100) NOT NULL,
    senderPhoneNumber VARCHAR(20) NOT NULL,
    senderCity VARCHAR(50) NOT NULL,
    senderDistrict VARCHAR(50) NOT NULL,
    senderAddress TEXT NOT NULL,
    type VARCHAR(50) NOT NULL,
    weight DECIMAL(10,2) NOT NULL,
    length DECIMAL(10,2) NOT NULL,
    width DECIMAL(10,2) NOT NULL,
    paymentType VARCHAR(20) NOT NULL,
    price DECIMAL(10,2),
    tracking_number VARCHAR(255) NOT NULL,
    status VARCHAR(50) NOT NULL DEFAULT 'Gönderi Alındı',
    status_history TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE contact_messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(255) NOT NULL,
    phone VARCHAR(20),
    subject VARCHAR(50) NOT NULL,
    message TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
