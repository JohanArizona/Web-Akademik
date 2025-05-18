CREATE TABLE mata_kuliah (
    kode VARCHAR(10) PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    sks INT NOT NULL,
    semester INT NOT NULL
);

INSERT INTO mata_kuliah (kode, nama, sks, semester) VALUES
('MK001', 'Pemrograman Web', 3, 1),
('MK002', 'Basis Data', 3, 1),
('MK003', 'Algoritma', 3, 2),
('MK004', 'Struktur Data', 3, 2);