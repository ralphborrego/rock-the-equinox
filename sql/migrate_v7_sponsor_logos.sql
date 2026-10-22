SET NAMES utf8mb4;
-- Rock the Equinox — v7: sponsor logos for the RTE XI roster.
-- Run AFTER sql/migrate_v6_sponsors_2026.sql:
--   mysql -u root equinox < sql/migrate_v7_sponsor_logos.sql
--
-- Logos are the sponsors' own Facebook profile images (Oct 21, 2026):
--   The Loud Spot Podcast — logo (1000x1000); its website is updated to
--     the sponsor's own site, theloudspot.net, from its Facebook page.
--   Surviving Rocklahoma — logo (1080x1080); link uses its vanity URL.
-- Rebellious Photography's profile picture is a photo, not a logo, so
-- its logo is the gothic 'Rebellious' wordmark from its Facebook cover
-- photo (2048x1536).
-- Camp Chaos has no logo: the Facebook entity the festival tagged is an
-- unclaimed place page with no custom image (only Facebook's default
-- avatar, which is not used), so it stays a name-only Major card.
-- Idempotent: plain UPDATEs keyed by sponsor name; safe to re-run.

UPDATE sponsors SET logo_url = 'assets/img/sponsors/loud-spot-podcast.jpg',
                    website  = 'https://www.theloudspot.net'
WHERE name = 'The Loud Spot Podcast';

UPDATE sponsors SET logo_url = 'assets/img/sponsors/surviving-rocklahoma.jpg',
                    website  = 'https://www.facebook.com/SurvivingRocklahoma'
WHERE name = 'Surviving Rocklahoma';

UPDATE sponsors SET logo_url = 'assets/img/sponsors/rebellious-photography.jpg'
WHERE name = 'Rebellious Photography';
