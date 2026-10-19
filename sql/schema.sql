-- Rock the Equinox — database schema (MySQL / MariaDB)
-- Import: mysql -u USER -p DBNAME < sql/schema.sql

CREATE TABLE IF NOT EXISTS admins (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS artists (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(120) NOT NULL,
    genre VARCHAR(80) DEFAULT '',
    bio TEXT,
    image_url VARCHAR(255) DEFAULT '',
    stage VARCHAR(80) DEFAULT 'Main Stage',
    sort_order INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS schedule_slots (
    id INT AUTO_INCREMENT PRIMARY KEY,
    artist_id INT NULL,
    stage VARCHAR(80) DEFAULT 'Main Stage',
    day VARCHAR(20) NOT NULL DEFAULT 'Saturday',
    start_time TIME NOT NULL,
    end_time TIME NOT NULL,
    notes VARCHAR(255) DEFAULT '',
    FOREIGN KEY (artist_id) REFERENCES artists(id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS vendors (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(120) NOT NULL,
    type VARCHAR(80) DEFAULT '',
    description TEXT,
    contact_email VARCHAR(120) DEFAULT '',
    website VARCHAR(255) DEFAULT '',
    approved TINYINT(1) DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS sponsors (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(120) NOT NULL,
    tier VARCHAR(40) DEFAULT 'Bronze',
    logo_url VARCHAR(255) DEFAULT '',
    website VARCHAR(255) DEFAULT '',
    sort_order INT DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(120) NOT NULL,
    email VARCHAR(120) NOT NULL,
    subject VARCHAR(160) DEFAULT '',
    message TEXT NOT NULL,
    is_read TINYINT(1) DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS settings (
    `key` VARCHAR(60) PRIMARY KEY,
    `value` TEXT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Default site settings (edit via admin or SQL)
INSERT INTO settings (`key`, `value`) VALUES
    ('site_name', 'Rock the Equinox'),
    ('tagline', 'Stigler, Oklahoma\'s rock festival'),
    ('event_dates', 'Dates TBA'),
    ('venue', 'Stigler, OK'),
    ('ticket_url', ''),
    ('contact_email', '')
ON DUPLICATE KEY UPDATE `value` = VALUES(`value`);

-- Sample data (delete or replace with real lineup)
INSERT INTO artists (name, genre, bio, stage, sort_order) VALUES
    ('Sample Headliner', 'Rock', 'Replace with your real headliner bio.', 'Main Stage', 1),
    ('Sample Opener', 'Southern Rock', 'Replace with your real opener bio.', 'Main Stage', 2);
