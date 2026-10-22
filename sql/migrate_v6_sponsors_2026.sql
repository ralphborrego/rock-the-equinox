SET NAMES utf8mb4;
-- Rock the Equinox — v6: the official RTE XI (2026) sponsor roster.
-- Run AFTER sql/migrate_v4_sponsors.sql on existing databases:
--   mysql -u root equinox < sql/migrate_v6_sponsors_2026.sql
--
-- Source: the festival's own thank-you post (Rock The Equinox Facebook
-- page, Oct 4, 2026) naming the sponsors of the Oct 2-3, 2026 festival.
-- Ol' Raptor Tackle is REMOVED (it was a test entry, per the board,
-- Oct 21, 2026). Display rule (unchanged): tier 'Major' = big logo card,
-- any other tier = name only (linked if a website is set, new tab).
-- Sponsors are managed in admin/sponsors.php.
--
-- Tiers: the four businesses are 'Major' (logo cards). Monty Littlefield
-- is 'Gold' — he brought the stage and the afterparty and donated back
-- his 50/50 winnings. Individual and municipal supporters are 'Community'
-- with no website (plain names; personal profiles are not linked).
-- The four Major sponsors' logo FILES (and their logo_url values) land
-- in migrate_v7 with the images themselves; until then their cards
-- render name-only.
-- Idempotent: the delete and every insert are safe to re-run.

DELETE FROM sponsors WHERE name = 'Ol'' Raptor Tackle';

INSERT INTO sponsors (name, tier, logo_url, website, sort_order)
SELECT 'The Loud Spot Podcast', 'Major', '', 'https://www.facebook.com/profile.php?id=100064166256775', 1
WHERE NOT EXISTS (SELECT 1 FROM sponsors WHERE name = 'The Loud Spot Podcast');

INSERT INTO sponsors (name, tier, logo_url, website, sort_order)
SELECT 'Camp Chaos', 'Major', '', '', 2
WHERE NOT EXISTS (SELECT 1 FROM sponsors WHERE name = 'Camp Chaos');

INSERT INTO sponsors (name, tier, logo_url, website, sort_order)
SELECT 'Surviving Rocklahoma', 'Major', '', 'https://www.facebook.com/profile.php?id=100062920795534', 3
WHERE NOT EXISTS (SELECT 1 FROM sponsors WHERE name = 'Surviving Rocklahoma');

INSERT INTO sponsors (name, tier, logo_url, website, sort_order)
SELECT 'Rebellious Photography', 'Major', '', 'https://www.facebook.com/profile.php?id=61570799018498', 4
WHERE NOT EXISTS (SELECT 1 FROM sponsors WHERE name = 'Rebellious Photography');

INSERT INTO sponsors (name, tier, logo_url, website, sort_order)
SELECT 'Monty Littlefield', 'Gold', '', '', 5
WHERE NOT EXISTS (SELECT 1 FROM sponsors WHERE name = 'Monty Littlefield');

INSERT INTO sponsors (name, tier, logo_url, website, sort_order)
SELECT 'Sebastian Cosme', 'Community', '', '', 6
WHERE NOT EXISTS (SELECT 1 FROM sponsors WHERE name = 'Sebastian Cosme');

INSERT INTO sponsors (name, tier, logo_url, website, sort_order)
SELECT 'Joey Fairchild', 'Community', '', '', 7
WHERE NOT EXISTS (SELECT 1 FROM sponsors WHERE name = 'Joey Fairchild');

INSERT INTO sponsors (name, tier, logo_url, website, sort_order)
SELECT 'Naomi Daniel', 'Community', '', '', 8
WHERE NOT EXISTS (SELECT 1 FROM sponsors WHERE name = 'Naomi Daniel');

INSERT INTO sponsors (name, tier, logo_url, website, sort_order)
SELECT 'Shannon Lee Palmer', 'Community', '', '', 9
WHERE NOT EXISTS (SELECT 1 FROM sponsors WHERE name = 'Shannon Lee Palmer');

INSERT INTO sponsors (name, tier, logo_url, website, sort_order)
SELECT 'Tammy Lyn Durrett Thomas', 'Community', '', '', 10
WHERE NOT EXISTS (SELECT 1 FROM sponsors WHERE name = 'Tammy Lyn Durrett Thomas');

INSERT INTO sponsors (name, tier, logo_url, website, sort_order)
SELECT 'Christopher Scarbrough', 'Community', '', '', 11
WHERE NOT EXISTS (SELECT 1 FROM sponsors WHERE name = 'Christopher Scarbrough');

INSERT INTO sponsors (name, tier, logo_url, website, sort_order)
SELECT 'Jeremy Lovell', 'Community', '', '', 12
WHERE NOT EXISTS (SELECT 1 FROM sponsors WHERE name = 'Jeremy Lovell');

INSERT INTO sponsors (name, tier, logo_url, website, sort_order)
SELECT 'City of Stigler', 'Community', '', '', 13
WHERE NOT EXISTS (SELECT 1 FROM sponsors WHERE name = 'City of Stigler');
