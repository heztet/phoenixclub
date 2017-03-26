# Welcome to Phoenix Club!
This is the repo for the Purdue Hillenbrand Hall Phoenix Club website.

# To Do for v2.4
- [X] Add URL shortener
- [X] Add delete ability
- [X] Add functionality to 'Copy' button for URL shortener
- [X] Have `/pages` check for shortened link
- [ ] Update dash with URL shortener
- [ ] Add event/document button to shorten URL
- [ ] Quick point-adder (or link to point-adder) on `/students` if logged in
- [ ] Quick point adder uses `phoenix_records`
- [ ] Ability to edit student (everything but PUID)
- [ ] Ability to edit events

# Branch descriptions
- The `develop` branch is where changes are staged for production
- The `production` branch is what the Phoenix Club server is currently running

# Help! How do I put this in production mode?
- In `application/config/config.php`, set `$config['log_threshold'] = 1;`
- In `application/config/config.php`, set `$config['base_url'] = '<WEBSITE_URL>';`
- In `application/config/database.php`, set each of the database variables that are set as blank
- In `index.php`, change `define('ENVIRONMENT', isset($_SERVER['CI_ENV']) ? $_SERVER['CI_ENV'] : 'development');` to `define('ENVIRONMENT', 'production');`
- Run `dbSetup.sql` (you can also remove the `AUTO_INCREMENT=<num>` as well)
- Change the values for `BanquetAmount` and `RollcallAmount` in `phoenix_globals`
- Change the username/password in `phoenix_users`
