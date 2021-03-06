# Welcome to Phoenix Club!
This is the repo for the Purdue Hillenbrand Hall Phoenix Club website, which holds the club's attendance records, event data, documents (bills, meeting minutes, etc.), floor point amounts, and important links.

This website uses the [CodeIgniter](https://codeigniter.com/) PHP framework, in part because Purdue University servers only allow PHP web services and because CodeIgniter is easy to implement and install.

# To Do for v2.5
- [ ] Make sure that TotalPoints vs. LastSemesterPoints works properly (just save the latter, always increment the former)
- [ ] Archive rather than delete students at end of year
- [ ] Quick point-adder (or link to point-adder) on `/students` if logged in
- [ ] Quick point adder uses `phoenix_records`
- [X] Ability to edit student (everything but PUID)
- [x] Add ability to edit /links
- [X] Fix: match rest of website layout with `/links` (e.g. alert retrieval, title, form validation errors, etc.) (set error delimiters in app/config/form_validation.php)
	- [X] Auth login error partial for login.php
- [X] Fix form validation messages for adding students
- [X] Add more details to `/students`

# Branch descriptions
- The `develop` branch is where changes are staged for production
- The `production` branch is what the Phoenix Club server is currently running (through Purdue University's servers)

# Help! How do I put this in production mode?
- In `application/config/config.php`, set `$config['log_threshold'] = 1;`
- In `application/config/config.php`, set `$config['base_url'] = '<WEBSITE_URL>';`
- In `application/config/database.php`, set each of the database variables that are set as blank
- In `index.php`, change `define('ENVIRONMENT', isset($_SERVER['CI_ENV']) ? $_SERVER['CI_ENV'] : 'development');` to `define('ENVIRONMENT', 'production');`
- Run `dbSetup.sql` (you can also remove the `AUTO_INCREMENT=<num>` as well)
- Change the values for `BanquetAmount` and `RollcallAmount` in `phoenix_globals`
- Change the username/password in `phoenix_users`
