
# Easy Set-Up

1. Install a PHP/MySQL/Apache Server (e.g. XAMPP https://www.apachefriends.org/index.html, start via `sudo /opt/lampp/lampp start`)
2. Make sure PHP is in your $PATH if you didn't install it via package manager. (e.g. add `/opt/lampp/bin` to your `~/.profile`)
3. Install wp-cli (http://wp-cli.org/)
4. Clone this repo, `cd` into it.
5. Run `wp core download`
6. Run `wp core config --dbname="forum" --dbuser=root`
7. Create the database by running `mysql -u root -e "CREATE DATABASE forum;"`
8. Make sure Apache is configured to serve your wordpress folder (e.g. make sure your `/opt/lampp/etc/httpd.conf`'s `DocumentRoot` and the `Directory` right below it point to the directory).
9. Visit localhost and follow the wizard.
10. Select flueba-forum Theme in the admin interface.

