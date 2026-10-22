SET NAMES utf8mb4;
-- Rock the Equinox — migrate v5: band photos for the 2026 lineup.
-- Images live in public/assets/img/bands/ and were sourced from the bands'
-- own pages (Facebook, Bandsintown, official sites, EPKs) on Oct 21, 2026.
-- Idempotent: plain UPDATEs keyed by artist name; safe to re-run.
-- Not yet photographed (no verifiable public photo found as of Oct 21, 2026):
--   Shotgun Funeral, Sin & Scar, The Struggle — their cards render without
--   an image until a verified photo is supplied.

UPDATE artists SET image_url = 'assets/img/bands/waking-the-sleeper.jpg'    WHERE name = 'Waking the Sleeper';
UPDATE artists SET image_url = 'assets/img/bands/left-on-red.jpg'          WHERE name = 'Left On Red';
UPDATE artists SET image_url = 'assets/img/bands/stonebreed.jpg'           WHERE name = 'Stonebreed';
UPDATE artists SET image_url = 'assets/img/bands/stories-through-storms.jpg' WHERE name = 'Stories Through Storms';
UPDATE artists SET image_url = 'assets/img/bands/oklahoma-blood.jpg'       WHERE name = 'Oklahoma Blood';
UPDATE artists SET image_url = 'assets/img/bands/dime-store-riot.jpg'      WHERE name = 'Dime Store Riot';
UPDATE artists SET image_url = 'assets/img/bands/seven-foot-monkey.jpg'    WHERE name = 'Seven Foot Monkey';
UPDATE artists SET image_url = 'assets/img/bands/redefind.jpg'             WHERE name = 'Redefind';
UPDATE artists SET image_url = 'assets/img/bands/stanleys-revenge.jpg'     WHERE name = 'Stanley''s Revenge';
UPDATE artists SET image_url = 'assets/img/bands/my-nightmare.jpg'         WHERE name = 'My Nightmare';
UPDATE artists SET image_url = 'assets/img/bands/the-stacys.jpg'           WHERE name = 'The Stacys';
UPDATE artists SET image_url = 'assets/img/bands/dreadful-day.jpg'         WHERE name = 'Dreadful Day';
UPDATE artists SET image_url = 'assets/img/bands/strength-in-agony.jpg'    WHERE name = 'Strength In Agony';
UPDATE artists SET image_url = 'assets/img/bands/stilnoct.jpg'             WHERE name = 'Stilnoct';
UPDATE artists SET image_url = 'assets/img/bands/no-one.jpg'               WHERE name = 'No One';
UPDATE artists SET image_url = 'assets/img/bands/cirkus.jpg'               WHERE name = 'Cirkus';
UPDATE artists SET image_url = 'assets/img/bands/she-hates-me-not.jpg'     WHERE name = 'She Hates Me Not';
