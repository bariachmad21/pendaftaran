CREATE DATABASE IF NOT EXISTS lomba;
USE lomba;

CREATE TABLE IF NOT EXISTS pendaftaranlomba (
    id INT(25) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL, -- Adjusted to 255 for validity, though image showed 25
    tgl_lahir DATE NOT NULL,
    gender VARCHAR(255) NOT NULL,
    lomba VARCHAR(255) NOT NULL,
    sekolah VARCHAR(255) NOT NULL,
    whatsapp VARCHAR(25) NOT NULL, -- Changed to VARCHAR to preserve leading zero for valid WA integration
    alamat VARCHAR(255) NOT NULL
);
