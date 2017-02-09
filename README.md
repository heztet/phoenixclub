# Welcome to Phoenix Club!
This is the repo for the Purdue Hillenbrand Hall Phoenix Club website.

# To Do for v2.3
- [ ] Event types (check-in vs sign-up)
- [ ] Update db SQL
- [ ] Newsletter changes
	 - [ ] Change to `/documents`
	 - [ ] Have document types (Newsletters, Bills, etc.)
- [ ] Login redirects to original destination
- [ ] Quick point-adder (or link to point-adder) on `/students` if logged in
- [ ] Quick point adder uses `phoenix_records`
- [ ] Ability to edit student (besides PUID)
- [X] Correctly calculate `BanquetEligible`
- [X] Check that going to `/banquet` or `/downloads/banquet` will always run `banquet_check`
- [X] `/database` redirect
- [X] List of links on user dash
- [X] Remove password from rollcalls
- [X] Rollcall uses `Rollcall` value in `phoenix_globals`
- [X] Fix footer link
- [X] Downloads for students have LastSemesterPoints
- [X] Event viewer
	- [X] Add student list
	- [X] Add download button
- [X] Download student data for specific events
- [X] Phone number column for `phoenix_students`
- [X] Show student email/phone on `leaderboard` when logged in

# Branch descriptions
- The `develop` branch is where changes are staged for production
- The `production` branch is what the Phoenix Club server is currently running

# Help! How do I put this in production mode?
- In `application/config/config.php`, set `$config['log_threshold'] = 1;`
- In `application/config/config.php`, set `$config['base_url'] = '<WEBSITE_URL>';`
- In `application/config/database.php`, set each of the database variables that are set as blank
- In `index.php`, change `define('ENVIRONMENT', isset($_SERVER['CI_ENV']) ? $_SERVER['CI_ENV'] : 'development');` to `define('ENVIRONMENT', 'production');`
- Run `dbSetup.sql` (you can also remove the `AUTO_INCREMENT=<num>` as well)
- Add a value for `BanquetAmount` in `phoenix_globals`