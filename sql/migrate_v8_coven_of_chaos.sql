SET NAMES utf8mb4;
-- Rock the Equinox — v8: sponsor name correction + logo.
-- Run AFTER sql/migrate_v7_sponsor_logos.sql:
--   mysql -u root equinox < sql/migrate_v8_coven_of_chaos.sql
--
-- The festival's Oct 4, 2026 thank-you post named/tagged this sponsor
-- as "Camp Chaos" (the tag resolved to an unrelated, unclaimed place
-- page in Des Arc, AR). Per the board (Oct 21, 2026): the sponsor is
-- COVEN OF CHAOS, and its logo is the raven/skull artwork in
-- public/assets/img/sponsors/coven-of-chaos.jpg, supplied by the board.
-- Idempotent: safe to re-run (the rename no-ops once applied).

UPDATE sponsors
SET name = 'Coven of Chaos',
    logo_url = 'assets/img/sponsors/coven-of-chaos.jpg'
WHERE name = 'Camp Chaos';

-- Cover a database where the row already carries the corrected name:
UPDATE sponsors
SET logo_url = 'assets/img/sponsors/coven-of-chaos.jpg'
WHERE name = 'Coven of Chaos';
