SET NAMES utf8mb4;
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
    ('event_dates', 'October 2–3, 2026'),
    ('venue', 'Lake John Wells, Stigler, OK'),
    ('ticket_url', ''),
    ('contact_email', '')
ON DUPLICATE KEY UPDATE `value` = VALUES(`value`);

-- Sponsors — the RTE XI (2026) roster; mirrors migrate_v6_sponsors_2026.sql
-- (which supersedes the v4 test entry). tier 'Major' = big logo card
-- (links out, new tab); any other tier = name only. Source: the festival's
-- Oct 4, 2026 thank-you post.
INSERT INTO sponsors (name, tier, logo_url, website, sort_order) VALUES
    ('The Loud Spot Podcast',   'Major', '',     'https://www.facebook.com/profile.php?id=100064166256775', 1),
    ('Camp Chaos',              'Major', '',            '', 2),
    ('Surviving Rocklahoma',    'Major', '',  'https://www.facebook.com/profile.php?id=100062920795534', 3),
    ('Rebellious Photography',  'Major', '','https://www.facebook.com/profile.php?id=61570799018498', 4),
    ('Monty Littlefield',       'Gold',      '', '', 5),
    ('Sebastian Cosme',         'Community', '', '', 6),
    ('Joey Fairchild',          'Community', '', '', 7),
    ('Naomi Daniel',            'Community', '', '', 8),
    ('Shannon Lee Palmer',      'Community', '', '', 9),
    ('Tammy Lyn Durrett Thomas','Community', '', '', 10),
    ('Christopher Scarbrough',  'Community', '', '', 11),
    ('Jeremy Lovell',           'Community', '', '', 12),
    ('City of Stigler',         'Community', '', '', 13);

-- Rock the Equinox XI lineup (October 2-3, 2026) — mirrors migrate_v3_lineup2026.sql
-- image_url values mirror migrate_v5_band_images.sql (photos sourced from the
-- bands' own pages, Oct 21, 2026; blank = no verified photo found yet).
INSERT INTO artists (name, genre, bio, image_url, stage, sort_order) VALUES
    ('Shotgun Funeral',        'Metal',         '', 'assets/img/bands/shotgun-funeral.jpg', 'Main Stage', 1),
    ('Stanley''s Revenge',     'Rock',          '', 'assets/img/bands/stanleys-revenge.jpg', 'Main Stage', 2),
    ('My Nightmare',           'Alt Rock',      '', 'assets/img/bands/my-nightmare.jpg', 'Main Stage', 3),
    ('Sin & Scar',             'Metal',         '', 'assets/img/bands/sin-and-scar.jpg', 'Main Stage', 4),
    ('Oklahoma Blood',         'Groove Thrash', '', 'assets/img/bands/oklahoma-blood.jpg', 'Main Stage', 5),
    ('Seven Foot Monkey',      'Rock',          '', 'assets/img/bands/seven-foot-monkey.jpg', 'Main Stage', 6),
    ('Dime Store Riot',        'Rock',          '', 'assets/img/bands/dime-store-riot.jpg', 'Main Stage', 7),
    ('Redefind',               'Rock',          '', 'assets/img/bands/redefind.jpg', 'Main Stage', 8),
    ('Waking the Sleeper',     'Hard Rock',     '', 'assets/img/bands/waking-the-sleeper.jpg', 'Main Stage', 9),
    ('The Struggle',           'Rock',          '', '', 'Main Stage', 10),
    ('The Stacys',             'Rock',          '', 'assets/img/bands/the-stacys.jpg', 'Main Stage', 11),
    ('Stonebreed',             'Hard Rock',     '', 'assets/img/bands/stonebreed.jpg', 'Main Stage', 12),
    ('Dreadful Day',           'Metal',         '', 'assets/img/bands/dreadful-day.jpg', 'Main Stage', 13),
    ('Strength In Agony',      'Metal',         '', 'assets/img/bands/strength-in-agony.jpg', 'Main Stage', 14),
    ('Stilnoct',               'Metal',         '', 'assets/img/bands/stilnoct.jpg', 'Main Stage', 15),
    ('No One',                 'Rock',          '', 'assets/img/bands/no-one.jpg', 'Main Stage', 16),
    ('Cirkus',                 'Rock',          '', 'assets/img/bands/cirkus.jpg', 'Main Stage', 17),
    ('She Hates Me Not',       'Rock',          '', 'assets/img/bands/she-hates-me-not.jpg', 'Main Stage', 18),
    ('Stories Through Storms', 'Metalcore',     '', 'assets/img/bands/stories-through-storms.jpg', 'Main Stage', 19),
    ('Left On Red',            'Rock',          '', 'assets/img/bands/left-on-red.jpg', 'Main Stage', 20);
