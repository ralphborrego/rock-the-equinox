SET NAMES utf8mb4;
-- Rock the Equinox — v3: the real Rock the Equinox XI lineup (October 2–3, 2026)
-- Run AFTER sql/schema.sql and sql/migrate_v2.sql:
--   mysql -u root equinox < sql/migrate_v3_lineup2026.sql
--
-- Source: the festival's official 2026 poster and day-of schedule graphic.
-- 21 bands were announced; 9 Left Dead appeared on the first poster but not on
-- the day-of schedule and are intentionally NOT loaded here.

START TRANSACTION;

-- This migration REPLACES the lineup with the 2026 one, so clear the lineup
-- tables first. That keeps it idempotent (safe to re-run) and prevents
-- duplicates when a fresh install seeds artists from schema.sql before this
-- migration runs. Vendors, sponsors, and everything else are untouched.
DELETE FROM schedule_slots;
DELETE FROM artists;

-- The 2026 lineup, in playing order (sort_order runs across both days).
INSERT INTO artists (name, genre, bio, stage, sort_order, tier) VALUES
    ('Shotgun Funeral',        'Metal',      '', 'Main Stage', 1,  'Support'),
    ('Stanley''s Revenge',     'Rock',       '', 'Main Stage', 2,  'Support'),
    ('My Nightmare',           'Alt Rock',   '', 'Main Stage', 3,  'Support'),
    ('Sin & Scar',             'Metal',      '', 'Main Stage', 4,  'Support'),
    ('Oklahoma Blood',         'Groove Thrash', '', 'Main Stage', 5, 'Support'),
    ('Seven Foot Monkey',      'Rock',       '', 'Main Stage', 6,  'Support'),
    ('Dime Store Riot',        'Rock',       '', 'Main Stage', 7,  'Support'),
    ('Redefind',               'Rock',       '', 'Main Stage', 8,  'Support'),
    ('Waking the Sleeper',     'Hard Rock',  '', 'Main Stage', 9,  'Headliner'),
    ('The Struggle',           'Rock',       '', 'Main Stage', 10, 'Support'),
    ('The Stacys',             'Rock',       '', 'Main Stage', 11, 'Support'),
    ('Stonebreed',             'Hard Rock',  '', 'Main Stage', 12, 'Support'),
    ('Dreadful Day',           'Metal',      '', 'Main Stage', 13, 'Support'),
    ('Strength In Agony',      'Metal',      '', 'Main Stage', 14, 'Support'),
    ('Stilnoct',               'Metal',      '', 'Main Stage', 15, 'Support'),
    ('No One',                 'Rock',       '', 'Main Stage', 16, 'Support'),
    ('Cirkus',                 'Rock',       '', 'Main Stage', 17, 'Support'),
    ('She Hates Me Not',       'Rock',       '', 'Main Stage', 18, 'Support'),
    ('Stories Through Storms', 'Metalcore',  '', 'Main Stage', 19, 'Support'),
    ('Left On Red',            'Rock',       '', 'Main Stage', 20, 'Headliner')
ON DUPLICATE KEY UPDATE genre = VALUES(genre), sort_order = VALUES(sort_order), tier = VALUES(tier);

-- Friday, October 2, 2026
INSERT INTO schedule_slots (artist_id, stage, day, start_time, end_time, notes)
SELECT id, 'Main Stage', 'Friday', '15:00:00', '15:40:00', '' FROM artists WHERE name = 'Shotgun Funeral';
INSERT INTO schedule_slots (artist_id, stage, day, start_time, end_time, notes)
SELECT id, 'Main Stage', 'Friday', '16:00:00', '16:40:00', '' FROM artists WHERE name = 'Stanley''s Revenge';
INSERT INTO schedule_slots (artist_id, stage, day, start_time, end_time, notes)
SELECT id, 'Main Stage', 'Friday', '17:00:00', '17:40:00', '' FROM artists WHERE name = 'My Nightmare';
INSERT INTO schedule_slots (artist_id, stage, day, start_time, end_time, notes)
SELECT id, 'Main Stage', 'Friday', '18:00:00', '18:40:00', '' FROM artists WHERE name = 'Sin & Scar';
INSERT INTO schedule_slots (artist_id, stage, day, start_time, end_time, notes)
SELECT id, 'Main Stage', 'Friday', '19:00:00', '19:40:00', '' FROM artists WHERE name = 'Oklahoma Blood';
INSERT INTO schedule_slots (artist_id, stage, day, start_time, end_time, notes)
SELECT id, 'Main Stage', 'Friday', '20:00:00', '20:40:00', '' FROM artists WHERE name = 'Seven Foot Monkey';
INSERT INTO schedule_slots (artist_id, stage, day, start_time, end_time, notes)
SELECT id, 'Main Stage', 'Friday', '21:00:00', '21:40:00', '' FROM artists WHERE name = 'Dime Store Riot';
INSERT INTO schedule_slots (artist_id, stage, day, start_time, end_time, notes)
SELECT id, 'Main Stage', 'Friday', '22:00:00', '22:40:00', '' FROM artists WHERE name = 'Redefind';
INSERT INTO schedule_slots (artist_id, stage, day, start_time, end_time, notes)
SELECT id, 'Main Stage', 'Friday', '23:00:00', '00:00:00', 'Friday headliner' FROM artists WHERE name = 'Waking the Sleeper';

-- Saturday, October 3, 2026
INSERT INTO schedule_slots (artist_id, stage, day, start_time, end_time, notes)
SELECT id, 'Main Stage', 'Saturday', '12:00:00', '12:40:00', '' FROM artists WHERE name = 'The Struggle';
INSERT INTO schedule_slots (artist_id, stage, day, start_time, end_time, notes)
SELECT id, 'Main Stage', 'Saturday', '13:00:00', '13:40:00', '' FROM artists WHERE name = 'The Stacys';
INSERT INTO schedule_slots (artist_id, stage, day, start_time, end_time, notes)
SELECT id, 'Main Stage', 'Saturday', '14:00:00', '14:40:00', '' FROM artists WHERE name = 'Stonebreed';
INSERT INTO schedule_slots (artist_id, stage, day, start_time, end_time, notes)
SELECT id, 'Main Stage', 'Saturday', '15:00:00', '15:40:00', '' FROM artists WHERE name = 'Dreadful Day';
INSERT INTO schedule_slots (artist_id, stage, day, start_time, end_time, notes)
SELECT id, 'Main Stage', 'Saturday', '16:00:00', '16:40:00', '' FROM artists WHERE name = 'Strength In Agony';
INSERT INTO schedule_slots (artist_id, stage, day, start_time, end_time, notes)
SELECT id, 'Main Stage', 'Saturday', '17:00:00', '17:40:00', '' FROM artists WHERE name = 'Stilnoct';
INSERT INTO schedule_slots (artist_id, stage, day, start_time, end_time, notes)
SELECT id, 'Main Stage', 'Saturday', '18:00:00', '18:40:00', '' FROM artists WHERE name = 'No One';
INSERT INTO schedule_slots (artist_id, stage, day, start_time, end_time, notes)
SELECT id, 'Main Stage', 'Saturday', '19:00:00', '19:40:00', '' FROM artists WHERE name = 'Cirkus';
INSERT INTO schedule_slots (artist_id, stage, day, start_time, end_time, notes)
SELECT id, 'Main Stage', 'Saturday', '20:00:00', '20:40:00', '' FROM artists WHERE name = 'She Hates Me Not';
INSERT INTO schedule_slots (artist_id, stage, day, start_time, end_time, notes)
SELECT id, 'Main Stage', 'Saturday', '21:00:00', '21:40:00', '' FROM artists WHERE name = 'Stories Through Storms';
INSERT INTO schedule_slots (artist_id, stage, day, start_time, end_time, notes)
SELECT id, 'Main Stage', 'Saturday', '22:00:00', '23:00:00', 'Festival closer' FROM artists WHERE name = 'Left On Red';

-- Site settings for the 2026 edition.
-- event_start is deliberately left blank: with no 2027 date announced yet, the
-- homepage countdown hides itself and reads "Dates announced soon" instead of
-- pointing at a date in the past.
INSERT INTO settings (`key`, `value`) VALUES
    ('event_dates', 'October 2–3, 2026'),
    ('venue', 'Lake John Wells, Stigler, OK')
ON DUPLICATE KEY UPDATE `value` = VALUES(`value`);

COMMIT;
