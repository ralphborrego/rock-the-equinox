-- Rock the Equinox — v2 upgrade: festival-style features
-- Run AFTER sql/schema.sql on existing databases:
--   mysql -u root equinox < sql/migrate_v2.sql

-- Artist tiers (Headliner / Support)
ALTER TABLE artists ADD COLUMN IF NOT EXISTS tier VARCHAR(20) DEFAULT 'Support';

-- Ticket tiers (GA / VIP / etc.)
CREATE TABLE IF NOT EXISTS ticket_tiers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(80) NOT NULL,
    price VARCHAR(40) DEFAULT '',
    description TEXT,
    url VARCHAR(255) DEFAULT '',
    featured TINYINT(1) DEFAULT 0,
    sort_order INT DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- FAQs
CREATE TABLE IF NOT EXISTS faqs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    question VARCHAR(255) NOT NULL,
    answer TEXT NOT NULL,
    sort_order INT DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Newsletter subscribers
CREATE TABLE IF NOT EXISTS subscribers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(160) NOT NULL UNIQUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- New settings
INSERT INTO settings (`key`, `value`) VALUES
    ('event_start', ''),
    ('facebook_url', ''),
    ('instagram_url', ''),
    ('youtube_url', '')
ON DUPLICATE KEY UPDATE `value` = VALUES(`value`);

-- Sample ticket tiers (replace with real ones)
INSERT INTO ticket_tiers (name, price, description, sort_order, featured) VALUES
    ('General Admission', 'TBA', 'Full festival access, all stages, all days.', 1, 0),
    ('VIP', 'TBA', 'Everything in GA plus VIP viewing areas, premium restrooms, and a commemorative laminate.', 2, 1);
