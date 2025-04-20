CREATE DATABASE db_club_olahraga;
USE db_club_olahraga;

-- Tabel Tim
CREATE TABLE teams (
    id INT AUTO_INCREMENT PRIMARY KEY,
    team_name VARCHAR(100) NOT NULL,
    coach_name VARCHAR(100)
);

-- Tabel Pemain
CREATE TABLE players (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    position VARCHAR(50),
    team_id INT,
    FOREIGN KEY (team_id) REFERENCES teams(id) ON DELETE SET NULL
);

-- Tabel Pertandingan
CREATE TABLE matches (
    id INT AUTO_INCREMENT PRIMARY KEY,
    home_team_id INT,
    away_team_id INT,
    match_date DATE,
    score_home INT DEFAULT 0,
    score_away INT DEFAULT 0,
    FOREIGN KEY (home_team_id) REFERENCES teams(id) ON DELETE CASCADE,
    FOREIGN KEY (away_team_id) REFERENCES teams(id) ON DELETE CASCADE
);

INSERT INTO teams (team_name, coach_name) VALUES
('Prawira Harum Bandung', 'Coach David Singleton'),
('Pelita Jaya', 'Coach Ahang'),
('Satria Muda', 'Coach Youbel Sondakh');

INSERT INTO players (name, position, team_id) VALUES
-- Prawira Harum Bandung
('Rizky Pratama', 'Point Guard', 4),
('Budi Santoso', 'Shooting Guard', 4),
('Agus Santoso', 'Point Guard', 4),
('Rendi Maulana', 'Shooting Guard', 4),
('Daffa Faiz', 'Shooting Guard', 4),
-- Pelita Jaya
('Andi Setiawan', 'Center', 5),
('Budi Kurniawan', 'Shooting Guard', 5),
('Cindy Rahmawati', 'Small Forward', 5),
('Doni Saputra', 'Small Forward', 5),
('Farah Lestari', 'Power Forward', 5),
-- Satria Muda
('Eko Prasetyo', 'Point Guard', 6),
('Fajar Nugraha', 'Shooting Guard', 6),
('Gilang Ramadhan', 'Small Forward', 6),
('Hendra Setiawan', 'Power Forward', 6),
('Kevin Pratama', 'Center', 6)

INSERT INTO matches (home_team_id, away_team_id, match_date, score_home, score_away) VALUES
(4, 5, '2025-02-10', 78, 65),
(6, 4, '2025-02-17', 72, 72),
(5, 6, '2025-02-25', 80, 77);