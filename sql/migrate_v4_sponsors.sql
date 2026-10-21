SET NAMES utf8mb4;
-- Rock the Equinox — v4: sponsors (major logos + linked names)
-- Run AFTER sql/schema.sql on existing databases:
--   mysql -u root equinox < sql/migrate_v4_sponsors.sql
--
-- Display rule (public/sponsors.php and the homepage sponsors band):
--   tier = 'Major'  -> big logo card; the logo links to the sponsor's
--                      website and opens in a new tab.
--   any other tier  -> name only, linked to the sponsor's website
--                      (new tab). No website = plain name.
-- Sponsors are managed in admin/sponsors.php.

-- Repair: if an earlier import ran under a non-UTF-8 client charset, the
-- en dash in event_dates got double-encoded (shows as garbage characters).
-- Detect the mangled byte pattern and restore the correct value.
UPDATE settings SET `value` = 'October 2–3, 2026'
WHERE `key` = 'event_dates' AND HEX(`value`) LIKE '%C3A2E282AC%';

-- First major sponsor. Website is a placeholder test link (Google)
-- until the board supplies the real URL — update it in the admin.
INSERT INTO sponsors (name, tier, logo_url, website, sort_order)
SELECT 'Ol'' Raptor Tackle', 'Major', 'assets/img/sponsors/ol-raptor-tackle.jpg', 'https://www.google.com', 1
WHERE NOT EXISTS (SELECT 1 FROM sponsors WHERE name = 'Ol'' Raptor Tackle');
