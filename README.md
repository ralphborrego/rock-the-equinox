# Rock the Equinox — festival website (PHP + MySQL)

Community site for the Rock the Equinox festival, Stigler, Oklahoma.
Plain PHP (no framework) + MySQL/MariaDB via PDO. Source of truth is GitHub;
local dev happens on-device; production runs on GoDaddy shared hosting.

## Layout

```
public/          → document root (point the web server here)
  index.php      → home        lineup.php / schedule.php / tickets.php
  vendors.php / sponsors.php / contact.php
  assets/css/style.css
includes/        → config.php (DB creds via env vars), db.php (PDO), header/footer
admin/           → board login: lineup, schedule, contact messages, site settings
sql/schema.sql   → full database schema + seed settings
```

## Local dev on Android (Termux)

```sh
# 1. Install Termux from F-Droid, then:
pkg update && pkg install php mariadb git -y

# 2. Start MariaDB and create the database:
mysqld_safe -u root &
mysql -u root -e "CREATE DATABASE equinox CHARACTER SET utf8mb4;"

# 3. Clone and set up:
git clone <your-github-repo-url> rock-the-equinox
cd rock-the-equinox
mysql -u root equinox < sql/schema.sql
# After pulling updates, apply migrations in order:
mysql -u root equinox < sql/migrate_v2.sql
mysql -u root equinox < sql/migrate_v3_lineup2026.sql

# 4. Create your board admin login:
php -r "echo password_hash('choose-a-strong-password', PASSWORD_DEFAULT), PHP_EOL;"
mysql -u root equinox -e "INSERT INTO admins (username, password_hash) VALUES ('admin', '<paste-hash>');"

# 5. Serve it (document root is public/):
cd public && php -S 127.0.0.1:8080
# Open http://127.0.0.1:8080 in your phone's browser.
```

DB credentials come from environment variables (`DB_HOST`, `DB_NAME`, `DB_USER`, `DB_PASS`);
defaults assume local MariaDB with no root password.

## Deploy to GoDaddy (cPanel shared hosting)

1. In cPanel → **MySQL Databases**: create a database + user, grant all privileges.
2. In cPanel → **phpMyAdmin**: import `sql/schema.sql`, then insert your admin row.
3. In cPanel → **Git Version Control**: clone your GitHub repo (or upload via File Manager).
4. Point the domain's document root at the repo's `public/` folder
   (cPanel → Domains → document root), or copy `public/*` into `public_html/`.
5. Set env vars for the DB credentials. On cPanel the simplest reliable way is
   a `.user.ini` / `.htaccess` `SetEnv`, or edit `includes/config.php` to read
   from a file outside the document root. Do NOT commit real credentials to git.
6. Visit `yourdomain.com/admin/` and log in.

## Workflow

```sh
git pull            # get latest (on phone or anywhere)
# ... make changes ...
git add -A && git commit -m "describe the change" && git push
# then pull on GoDaddy (cPanel Git → Pull / Deploy)
```

Keep `main` deployable. That's the whole religion.
