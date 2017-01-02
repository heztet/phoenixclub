# Welcome to Phoenix Club!
This is the repo for the Purdue Hillenbrand Hall Phoenix Club website.

# To Do for v2.2
- [ ] User management:
	- [X] Pick framework
		- [X] https://github.com/trafficinc/CodeIgniter-Authit
		- ~~[ ] http://benedmunds.com/ion_auth/~~
		- ~~[ ] http://community-auth.com/documentation~~
	- [X] Unhash passwords (necessary for revolving-door club and no ability to email)
	- [X] Remove extra bits
	- [ ] Update views for login/dash
	- [ ] Update admin tools to require login
- [ ] Better grid system for forms (make most of the form elements way smaller for large screens)
- [X] Fix main page errors about getting content (HTTP/HTTPS issue)
- [X] Button to reset floor points
- [X] Newsletter section
- [X] Newsletter form
- [X] VITAL: FIX CONTACT PAGE
- [X] VITAL: Fix SimpleHeader for Contact/Leaderboard
- [X] VITAL: Fix PhoenixClub link on home page (and slogan)
- [X] Add destroy_newsletters to reset year
- [X] End of semester feature -> erase points, record whether student had >= a certain amount of points
- [X] Use `global_helper` for password comparing (currently open to SQL injections)
- [X] `/banquet` page (basic)
- [X] Add ability to download CSV of banquet eligible students
- [X] Add ability to download all students (without PUID!)
- [X] Check for BanquetEligiblity when checking-in and creating students
- [X] Add email address to student (warning message when not registered?)
- [X] Better form validation messages (ex: "You did not have a <field>", "<Field> cannot have <this>")
- [X] Refactoring and consistent coding:
	- [X] Remove '_helper' from `$this->load->helper()`
	- [X] Remove IsCurrent column for students
	- ~~[ ] Properly use `$this->db->dbprefix()` ([example](https://stackoverflow.com/questions/16021367/adding-table-prefix-to-join-in-codeigniter))~~

# Why Codeigniter?
Originally I was going to build a Rails app, but Purdue's web servers only support mysql and PHP. I chose Codeigniter because it was the simplest PHP framework to use.

# Help! How do I put this in production mode?
- In `application/config/config.php`, set `$config['log_threshold'] = 1;`
- In `application/config/config.php`, set `$config['base_url'] = '<WEBSITE_URL>';`
- In `application/config/database.php`, set each of the database variables that are set as blank
- In `system/core/Controller.php`, set `$this->output->enable_profiler(FALSE);`
- In `index.php`, change `define('ENVIRONMENT', isset($_SERVER['CI_ENV']) ? $_SERVER['CI_ENV'] : 'development');` to `define('ENVIRONMENT', 'production');`
- Rum `dbSetup.sql` (you can also remove the `AUTO_INCREMENT=<num>` as well)
- Add a value for `ResetYearKey`, `ResetSemesterKey`, `ResetFloorKey`, and `RollcallKey` in `phoenix_globals`
